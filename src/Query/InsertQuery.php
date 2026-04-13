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
}
