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
			"name" => ":name",
			"dateOfBirth" => ":dateOfBirth",
		];
	}
}
