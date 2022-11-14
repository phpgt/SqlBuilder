<?php
namespace Gt\SqlBuilder\Test\Helper\Query\Table;

use Gt\SqlBuilder\Query\Table\CreateTableQuery;

class CreateTableExample extends CreateTableQuery {
	public function createTable():string {
		return "student";
	}

	public function createDefinition():array {
		return [
			"id varchar(32) not null",
			"first_name varchar(32)",
			"last_name varchar(32)",
			"dob date",
			"primary key(id)"
		];
	}
}
