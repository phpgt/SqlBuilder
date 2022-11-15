<?php
namespace Gt\SqlBuilder\Query;

use Gt\SqlBuilder\Condition\Condition;

abstract class SelectQuery extends SqlQuery {
	/** @var array<string, array<string|Condition>|int> */
	private array $dynamicParts;

	public function __construct(
		protected bool $subQuery = false
	) {}

	public function __toString():string {
		$query = $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"select" => $this->select(),
			"from" => $this->from(),
			"inner join" => $this->innerJoin(),
			"cross join" => $this->crossJoin(),
			// The underscore is not a typo (https://dev.mysql.com/doc/refman/8.0/en/join.html)
			"straight_join" => $this->straightJoin(),
			"left join" => $this->leftJoin(),
			"left outer join" => $this->leftOuterJoin(),
			"right join" => $this->rightJoin(),
			"right outer join" => $this->rightOuterJoin(),
			"where" => $this->where(),
			"group by" => $this->groupBy(),
			"having" => $this->having(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			"offset" => $this->offset(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);

		if($this->subQuery) {
			$query = "( $query )";
		}

		return $query;
	}

	/** @param array<string, array<string|Condition>|int> $parts */
	public function setDynamicParts(array $parts):void {
		$this->dynamicParts = $parts;
	}

	/** @return string[]|SqlQuery[] One or more `select_expr`, typically a list of columns */
	public function select():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[]|SqlQuery[] One or more `table_reference` */
	public function from():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function innerJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function crossJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function straightJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function leftJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function leftOuterJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function rightJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function rightOuterJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return array<int|string, int|string|SqlQuery> Zero or more `where_condition` */
	public function where():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `col_name | expr | position` */
	public function groupBy():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return array<int|string, int|string|SqlQuery> Zero or more `having_condition` */
	public function having():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `col_name | expr | position` */
	public function orderBy():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return ?int `row_count` */
	public function limit():?int {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return ?int `offset` */
	public function offset():?int {
		return $this->dynamicReturn(__FUNCTION__);
	}

	protected function dynamicReturn(string $functionName):array|int|null {
		$functionName = str_replace("_", " ", $functionName);
		$functionName = ucwords($functionName);
		$functionName = str_replace(" ", "", $functionName);
		$functionName = lcfirst($functionName);

		$default = ($functionName === "limit" || $functionName === "offset")
			? null
			: [];

		return $this->dynamicParts[$functionName] ?? $default;
	}
}
