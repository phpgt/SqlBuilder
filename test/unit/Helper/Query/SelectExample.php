<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\SelectQuery;

class SelectExample extends SelectQuery {
	public function select():array {
		return [
			"id",
			"name",
			"dateOfBirth",
		];
	}

	public function from():array {
		return [
			"student",
		];
	}

	public function where():array {
		return [
			"deletedAt is null",
		];
	}
}