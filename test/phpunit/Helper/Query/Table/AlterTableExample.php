<?php
namespace GT\SqlBuilder\Test\Helper\Query\Table;

use GT\SqlBuilder\Query\Table\AlterTableQuery;

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
