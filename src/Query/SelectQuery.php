<?php
namespace Gt\SqlBuilder\Query;

class SelectQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
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
			"window" => $this->window(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function select():array {
		return [];
	}

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

	public function where():array {
		return [];
	}

	public function groupBy():array {
		return [];
	}

	public function having():array {
		return [];
	}

	public function window():array {
		return [];
	}

	public function orderBy():array {
		return [];
	}

	public function limit():array {
		return [];
	}
}