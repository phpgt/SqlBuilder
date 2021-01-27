<?php
namespace Gt\SqlBuilder\Query;

class InsertQuery extends ReplaceQuery {
	public function __toString():string {
		$query = $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"insert into" => $this->into(),
			"partition" => $this->partition(),
			"set" => $this->normaliseSet($this->set()),
			"on duplicate key update" => $this->normaliseSet($this->onDuplicate()),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);

		if($this->subQuery) {
			$query = "( $query )";
		}

		return $query;
	}

	/**
	 * Return an assignment list that matches the set() rules. It is often
	 * useful to return a call to set() directly, as it is usual to list the
	 * same assignments as part of the "on duplicate key update" section as
	 * in the "set" section.
	 * @return string[]|SqlQuery[]
	 */
	public function onDuplicate():array {
		return [];
	}
}