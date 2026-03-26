<?php
namespace Gt\SqlBuilder\Query\Table;

use Gt\SqlBuilder\Query\SqlQuery;
use Gt\SqlBuilder\SqlBuilderException;

abstract class AlterTableQuery extends SqlQuery {
	public function __toString():string {
		$alterOptions = $this->alterOptions();
		if(empty($alterOptions)) {
			throw new SqlBuilderException(
				"AlterTableQuery requires at least one alter option"
			);
		}

		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"alter table" => $this->alterTable(),
			"alter options" => $alterOptions,
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	abstract public function alterTable():string;

	/** @return string[]|SqlQuery[] */
	public function alterOptions():array {
		return [];
	}
}
