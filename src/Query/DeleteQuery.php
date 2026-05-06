<?php
namespace GT\SqlBuilder\Query;

abstract class DeleteQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"delete from" => $this->from(),
			"where" => $this->where(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function from():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return array<int|string, int|string|SqlQuery> */
	public function where():array {
		return $this->dynamicReturn(__FUNCTION__);
	}
}
