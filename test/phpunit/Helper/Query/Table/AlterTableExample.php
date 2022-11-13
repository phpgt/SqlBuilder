<?php
namespace Gt\SqlBuilder\Test\Helper\Query\Table;

use Gt\SqlBuilder\Query\Table\AlterTableQuery;

class AlterTableExample extends AlterTableQuery {
	public function alterTable():string {
		return "student";
	}

	public function alterOptions():array {
		return [
			"add column telephone int after dob",
			"add column email varchar(256) after id",
		];
	}
}
