<?php
namespace Gt\SqlBuilder\Query\Table;

use Gt\SqlBuilder\Query\SqlQuery;
use Gt\SqlBuilder\SqlBuilderException;

abstract class CreateTableQuery extends SqlQuery {
	public function __toString():string {
		$createDefinition = $this->createDefinition();
		if(empty($createDefinition)) {
			throw new SqlBuilderException(
				"CreateTableQuery requires at least one create definition"
			);
		}

		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"create table" => $this->createTable(),
			"create definition" => $createDefinition,
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string [IF NOT EXISTS] tbl_name */
	abstract public function createTable():string;

	/** @return string[]|SqlQuery[] */
	public function createDefinition():array {
		return [];
	}
}
