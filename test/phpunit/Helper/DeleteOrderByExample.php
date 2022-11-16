<?php
namespace Gt\SqlBuilder\Test\Helper;

use Gt\SqlBuilder\Query\DeleteQuery;

class DeleteOrderByExample extends DeleteQuery {
	public function from():array {
		return [
			"student",
		];
	}

	public function orderBy():array {
		return [
			"createdAt desc"
		];
	}

	public function limit():int {
		return 10;
	}
}
