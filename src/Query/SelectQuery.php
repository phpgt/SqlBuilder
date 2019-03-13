<?php
namespace Gt\SqlBuilder\Query;

class SelectQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"select" => $this->select(),
			"from" => $this->from(),
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