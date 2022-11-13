<?php
namespace Gt\SqlBuilder\Test\Helper\Query\Table;

use Gt\SqlBuilder\Query\Table\DropTableQuery;

class DropTableExample extends DropTableQuery {
	public function dropTable():string {
		return "student";
	}
}
