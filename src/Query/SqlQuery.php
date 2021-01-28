<?php
namespace Gt\SqlBuilder\Query;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\Condition;

abstract class SqlQuery {
	const PRE_QUERY_COMMENT = "/* preQuery */";
	const POST_QUERY_COMMENT = "/* postQuery */";
	const WHERE_CLAUSES = ["where", "having"];

	public function __construct(
		protected bool $subQuery = false
	) {}

	abstract public function __toString():string;

	public function preQuery():string {
		return "";
	}

	public function postQuery():string {
		return "";
	}

	/** @param array<string, string>|array<string, string[]|mixed> $clauses */
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
			elseif($name === "columns") {
				$query .= $this->processList($parts);
			}
			elseif($name === "values") {
				$query .= $this->processList($parts, $name);
			}
			elseif($name === "set") {
				$query .= $this->processSetClause($parts);
			}
			elseif($name === "on duplicate key update") {
				$query .= $this->processSetClause($parts, $name);
			}
			elseif($name === "partition") {
				$query .= $this->processPartitionClause($parts);
			}
			elseif(strstr($name, "rowSelect")) {
				if(isset($parts[0]) && $parts[0] instanceof SelectQuery) {
					$query .= $parts[0];
				}
			}
			elseif(strstr($name, "join")) {
				$query .= $this->processJoinClause(
					$name,
					$parts
				);
			}
			elseif(strstr($name, "limit")) {
				if(isset($parts[0])) {
					$query .= "limit $parts[0]";
				}
			}
			elseif(strstr($name, "offset")) {
				if(isset($parts[0])) {
					$query .= "offset $parts[0]";
				}
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

	/** @param string[] $parts */
	protected function processList(
		array $parts,
		string $prefix = ""
	):string {
		if(empty($parts)) {
			return "";
		}

		$query = "$prefix (";
		foreach($parts as $i => $part) {
			if($i > 0) {
				$query .= ",";
			}

			$query .= "\n\t";
			$query .= $part;
		}
		$query .= "\n)";
		$query .= "\n\n";

		return $query;
	}

	/** @param string[] $parts */
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

	/** @param string[] $parts */
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

	/** @param string[] $parts */
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

	/** @param string[] $parts */
	private function processSetClause(
		array $parts,
		string $prefix = "set"
	):string {
		$query = "";

		foreach($parts as $key => $value) {
			if(strlen($query) === 0) {
				$query .= "$prefix " . PHP_EOL;
			}
			else {
				$query .= ", " . PHP_EOL;
			}

			$query .= "$key = $value";
		}

		return $query . PHP_EOL;
	}

	/** @param string[] $parts */
	private function processPartitionClause(array $parts):string {
		if(empty($parts)) {
			return "";
		}

		return "partition ( "
			. PHP_EOL
			. implode(", " . PHP_EOL, $parts)
			. " )"
			. PHP_EOL;
	}
}