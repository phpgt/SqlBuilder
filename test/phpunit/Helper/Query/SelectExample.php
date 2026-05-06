<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\SelectQuery;

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