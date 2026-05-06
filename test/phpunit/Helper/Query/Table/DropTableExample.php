<?php
namespace GT\SqlBuilder\Test\Helper\Query\Table;

use GT\SqlBuilder\Query\Table\DropTableQuery;

class DropTableExample extends DropTableQuery {
	public function dropTable():string {
		return "student";
	}
}
