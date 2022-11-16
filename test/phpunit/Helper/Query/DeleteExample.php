<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\DeleteQuery;

class DeleteExample extends DeleteQuery {
	public function from():array {
		return [
			"student",
		];
	}

	public function where():array {
		return [
			"id = :id",
		];
	}

	public function limit():int {
		return 1;
	}
}
