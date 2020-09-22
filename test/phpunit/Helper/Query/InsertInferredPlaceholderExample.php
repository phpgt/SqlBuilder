<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;

class InsertInferredPlaceholderExample extends InsertQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			"name",
			"dateOfBirth",
		];
	}
}