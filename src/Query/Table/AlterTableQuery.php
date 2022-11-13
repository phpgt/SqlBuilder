<?php
namespace Gt\SqlBuilder\Query\Table;

use Gt\SqlBuilder\Query\SqlQuery;

abstract class AlterTableQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"alter table" => $this->alterTable(),
			"alter options" => $this->alterOptions(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	abstract public function alterTable():string;

	/** @return string[]|SqlQuery[] */
	public function alterOptions():array {
		return [];
	}
}
