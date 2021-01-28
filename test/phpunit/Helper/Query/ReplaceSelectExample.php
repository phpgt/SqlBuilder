<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\ReplaceQuery;
use Gt\SqlBuilder\Query\SelectQuery;

class ReplaceSelectExample extends ReplaceQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function columns():array {
		return [
			"id",
			"name",
			"dateOfBirth",
		];
	}

	public function select():?SelectQuery {
		return new SelectExample();
	}
}