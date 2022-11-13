<?php
namespace Gt\SqlBuilder\Query\Table;

use Gt\SqlBuilder\Query\SqlQuery;

abstract class DropTableQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"drop table" => $this->dropTable(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string tbl_name [IF EXISTS] */
	abstract public function dropTable():string;
}
