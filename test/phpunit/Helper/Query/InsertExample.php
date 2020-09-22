<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;

class InsertExample extends InsertQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
// Note the repetition here can be avoided by only passing in the keys.
// An indexed array will infer the values. See InsertAssignNoValuesExample.
			"name" => ":name",
			"dateOfBirth" => ":dateOfBirth",
		];
	}
}