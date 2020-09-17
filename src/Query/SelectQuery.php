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
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);

		if($this->subQuery) {
			$query = "( $query )";
		}

		return $query;
	}

	/** @return string[] */
	public function select():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function from():array {
		return [];
	}

	/** @return string[] */
	public function innerJoin():array {
		return [];
	}

	/** @return string[] */
	public function crossJoin():array {
		return [];
	}

	/** @return string[] */
	public function straightJoin():array {
		return [];
	}

	/** @return string[] */
	public function leftJoin():array {
		return [];
	}

	/** @return string[] */
	public function leftOuterJoin():array {
		return [];
	}

	/** @return string[] */
	public function rightJoin():array {
		return [];
	}

	/** @return string[] */
	public function rightOuterJoin():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function where():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function groupBy():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function having():array {
		return [];
	}

	/** @return string[] */
	public function orderBy():array {
		return [];
	}

	/** @return string[] */
	public function limit():array {
		return [];
	}
}