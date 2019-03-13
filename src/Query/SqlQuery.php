<?php
namespace Gt\SqlBuilder\Query;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\Condition;

abstract class SqlQuery {
	const PRE_QUERY_COMMENT = "/* preQuery */";
	const POST_QUERY_COMMENT = "/* postQuery */";
	const WHERE_CLAUSES = ["where", "having"];

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
		if(empty($parts) || $parts[0] === "") {
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
}