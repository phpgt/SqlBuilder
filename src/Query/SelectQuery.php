<?php
namespace Gt\SqlBuilder\Query;

/** @SuppressWarnings(PHPMD.TooManyPublicMethods) */
abstract class SelectQuery extends SqlQuery {
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
			"left join" => $this->leftJoin(),
			"left outer join" => $this->leftOuterJoin(),
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
	public function leftJoin():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Zero or more `join_specification` */
	public function leftOuterJoin():array {
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
}
