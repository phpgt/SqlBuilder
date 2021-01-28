<?php
namespace Gt\SqlBuilder\Query;

class SelectQuery extends SqlQuery {
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

	/** @return string[]|SqlQuery[] One or more `select_expr`, typically a list of columns */
	public function select():array {
		return [];
	}

	/** @return string[]|SqlQuery[] One or more `table_reference` */
	public function from():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function innerJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function crossJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function straightJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function leftJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function leftOuterJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function rightJoin():array {
		return [];
	}

	/** @return string[] Zero or more `join_specification` */
	public function rightOuterJoin():array {
		return [];
	}

	/** @return array<int|string, int|string|SqlQuery> Zero or more `where_condition` */
	public function where():array {
		return [];
	}

	/** @return string[] Zero or more `col_name | expr | position` */
	public function groupBy():array {
		return [];
	}

	/** @return array<int|string, int|string|SqlQuery> Zero or more `having_condition` */
	public function having():array {
		return [];
	}

	/** @return string[] Zero or more `col_name | expr | position` */
	public function orderBy():array {
		return [];
	}

	/** @return ?int `row_count` */
	public function limit():?int {
		return null;
	}

	/** @return ?int `offset` */
	public function offset():?int {
		return null;
	}
}