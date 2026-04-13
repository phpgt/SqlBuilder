<?php
namespace Gt\SqlBuilder\Query;

abstract class InsertQuery extends ReplaceQuery {
	public function __toString():string {
		$columns = $this->columns();
		$values = $this->values();
		$set = $this->normaliseSet($this->set());

		if(empty($columns) && empty($values) && !empty($set)) {
			$columns = array_keys($set);
			$values = array_values($set);
		}

		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"insert into" => $this->into(),
			"columns" => $columns,
			"values" => $values,
			"rowSelect" => $this->select(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/**
	 * Return an assignment list that matches the set() rules. It is often
	 * useful to return a call to set() directly, as it is usual to list the
	 * same assignments as part of the "on duplicate key update" section as
	 * in the "set" section.
	 * @return array<int|string, int|string>
	 */
	public function onDuplicate():array {
		return $this->dynamicReturn(__FUNCTION__);
	}
}
