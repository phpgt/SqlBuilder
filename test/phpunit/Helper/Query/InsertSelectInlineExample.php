<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;
use Gt\SqlBuilder\Query\SelectQuery;

class InsertSelectInlineExample extends InsertQuery {
	public function into():array {
		return [
			"student"
		];
	}

	public function columns():array {
		return [
			"name",
			"dateOfBirth",
		];
	}

	public function select():?SelectQuery {
		return new class extends SelectQuery {
			public function select():array {
				return [
					"legalName",
					"assignedDOB",
				];
			}

			public function from():array {
				return [
					"temp",
				];
			}

			public function where():array {
				return [
					"example is not null",
				];
			}
		};
	}
}