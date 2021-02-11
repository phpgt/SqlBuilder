<?php
namespace Gt\SqlBuilder\Query;

abstract class DeleteQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"delete from" => $this->from(),
			"partition" => $this->partition(),
			"where" => $this->where(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	abstract public function from():array;

	/** @return string[]|SqlQuery[] */
	public function partition():array {
		return [];
	}

	/** @return array<int|string, int|string|SqlQuery> */
	public function where():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function orderBy():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function limit():array {
		return [];
	}
}
