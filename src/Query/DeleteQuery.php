<?php
namespace Gt\SqlBuilder\Query;

class DeleteQuery extends SqlQuery {
	public function __toString():string {
		$query = $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"delete from" => $this->from(),
			"partition" => $this->partition(),
			"where" => $this->where(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);

		return $query;
	}

	public function from():array {
		return [];
	}

	public function partition():array {
		return [];
	}

	public function where():array {
		return [];
	}

	public function orderBy():array {
		return [];
	}

	public function limit():array {
		return [];
	}
}