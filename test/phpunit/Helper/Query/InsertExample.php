<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;
use Gt\SqlBuilder\Query\SqlQuery;

class InsertExample extends InsertQuery {
	/** @return string[]|SqlQuery[] */
	public function into():array {
		return [
			"student",
		];
	}

	/** @return string[]|SqlQuery[] */
	public function set():array {
		return [
// Note the repetition here can be avoided by only passing in the keys.
// An indexed array will infer the values. See InsertAssignNoValuesExample.
			"name" => ":name",
			"dateOfBirth" => ":dateOfBirth",
		];
	}
}