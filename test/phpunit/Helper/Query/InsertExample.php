<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\InsertQuery;
use GT\SqlBuilder\Query\SqlQuery;

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
