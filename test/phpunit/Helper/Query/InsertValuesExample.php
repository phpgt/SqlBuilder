<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\InsertQuery;
use GT\SqlBuilder\Query\SqlQuery;

class InsertValuesExample extends InsertQuery {
	/** @return string[]|SqlQuery[] */
	public function into():array {
		return [
			"student",
		];
	}

	public function columns():array {
		return [
			"name",
			"dateOfBirth"
		];
	}

	public function values():array {
		return [
			":name",
			":dateOfBirth"
		];
	}
}