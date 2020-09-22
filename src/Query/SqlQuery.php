<?php
namespace Gt\SqlBuilder\Query;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\Condition;

abstract class SqlQuery {
	const PRE_QUERY_COMMENT = "/* preQuery */";
	const POST_QUERY_COMMENT = "/* postQuery */";
	const WHERE_CLAUSES = ["where", "having"];

	protected bool $subQuery;

	public function __construct(bool $subQuery = false) {
		$this->subQuery = $subQuery;
	}

	abstract public function __toString():string;

	public function preQuery():string {
		return "";
	}

	public function postQuery():string {
		return "";
	}

	protected function processClauseList(array $clauses):string {
		$query = "";

		foreach($clauses as $name => $parts) {
			if(!is_array($parts)) {
				$parts = [$parts];
			}

			if(in_array($name, self::WHERE_CLAUSES)) {
				$query .= $this->processWhereClause(
					$name,
					$parts
				);
			}
			elseif($name === "set") {
				$query .= $this->processSetClause($parts);
			}
			elseif(strstr($name, "join")) {
				$query .= $this->processJoinClause(
					$name,
					$parts
				);
			}
			else {
				$query .= $this->processClause(
					$name,
					$parts
				);
			}
		}

		return $query;
	}

	protected function processClause(
		string $name,
		array $parts,
		string $listChar = ","
	):string {
		if(empty($parts) || (isset($parts[0]) && $parts[0] === "")) {
			return "";
		}

		$query = $name;
		$query .= "\n\t";
		$query .= implode("$listChar\n\t", $parts);
		$query .= "\n\n";
		return $query;
	}

	protected function processWhereClause(
		string $name,
		array $parts
	):string {
		if(empty($parts) || $parts[0] === "") {
			return "";
		}

		$query = $name;
		$query .= "\n\t";

		$conditionalQuery = "";
		foreach($parts as $i => $part) {
			if(is_string($part)) {
				$part = new AndCondition($part);
			}

			/** @var Condition $part */

			if(strlen($conditionalQuery) > 0) {
				$conditionalQuery .= "\n";
				$conditionalQuery .= $part->getLogic();
				$conditionalQuery .= "\n\t";
			}

			$conditionalQuery .= $part->getCondition();
		}

		$query .= $conditionalQuery;
		$query .= "\n\n";
		return $query;
	}

	private function processJoinClause(
		string $name,
		array $parts
	):string {
		$query = "";

		foreach($parts as $i => $part) {
			$query .= $name . " ";
			$part = str_replace(["\n", "\t"], " ", $part);
			$query .= $part . PHP_EOL;
		}

		return $query;
	}

	private function processSetClause(array $parts):string {
		$query = "";

		foreach($parts as $key => $value) {
			if(strlen($query) === 0) {
				$query .= "set " . PHP_EOL;
			}
			else {
				$query .= ", " . PHP_EOL;
			}

			$query .= "$key = $value";
		}

		return $query;
	}
}