<?php
namespace Gt\SqlBuilder\Query;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\Condition;
use Gt\SqlBuilder\Condition\MixedIndexedAndNamedParametersException;
use Stringable;

/** @SuppressWarnings(PHPMD.ExcessiveClassComplexity) */
abstract class SqlQuery implements Stringable {
	const PRE_QUERY_COMMENT = "/* preQuery */";
	const POST_QUERY_COMMENT = "/* postQuery */";
	const WHERE_CLAUSES = ["where", "having"];

	/** @var array<string, array<string|Condition>|int> */
	protected array $dynamicParts;

	abstract public function __toString():string;

	/** @param array<string, array<string|Condition>|int> $parts */
	public function setDynamicParts(array $parts):void {
		$this->dynamicParts = $parts;
	}

	public function preQuery():string {
		return "";
	}

	public function postQuery():string {
		return "";
	}

	/**
	 * @param array<string, string>|array<string, string[]|mixed> $clauses
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @phpcs:disable Generic.Metrics.CyclomaticComplexity
	 */
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
			elseif(str_contains($name, "rowSelect")) {
				if(isset($parts[0]) && $parts[0] instanceof SelectQuery) {
					$query .= $parts[0];
				}
			}
			elseif(str_contains($name, "join")) {
				$query .= $this->processJoinClause(
					$name,
					$parts
				);
			}
			elseif(str_contains($name, "limit")) {
				if(isset($parts[0])) {
					$query .= "\nlimit $parts[0]";
				}
			}
			elseif(str_contains($name, "offset")) {
				if(isset($parts[0])) {
					$query .= "\noffset $parts[0]";
				}
			}
			elseif(str_contains($name, "create definition")) {
				$query .= "(";
				$query .= implode(", \n", $parts);
				$query .= ")";
			}
			elseif(str_contains($name, "alter options")) {
				$query .= implode(", \n", $parts);
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

		$shortParameterSyntax = null;
		$conditionalQuery = "";
		foreach($parts as $part) {
			if(is_string($part)) {
				$part = new AndCondition($part);
			}

			/** @var Condition $part */
			if($partShortParameterSyntax = $part->getShortParameterSyntax()) {
				if($shortParameterSyntax) {
					if($shortParameterSyntax !== $partShortParameterSyntax) {
						throw new MixedIndexedAndNamedParametersException();
					}
				}
				else {
					$shortParameterSyntax = $partShortParameterSyntax;
				}
			}

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

		foreach($parts as $part) {
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

	/** @return array<int|string, int|string|SqlQuery>|int|SelectQuery|null */
	protected function dynamicReturn(
		string $functionName,
		?string $className = null,
	):array|int|SelectQuery|null {
		$functionName = str_replace("_", " ", $functionName);
		$functionName = ucwords($functionName);
		$functionName = str_replace(" ", "", $functionName);
		$functionName = lcfirst($functionName);

		$default = $this->needsDefaultValue($functionName, $className) ? [] : null;

		return $this->dynamicParts[$functionName] ?? $default;
	}

	private function needsDefaultValue(
		string $functionName,
		?string $className,
	):bool {
		return is_null($className)
			&& $functionName !== "limit"
			&& $functionName !== "offset";
	}
}
