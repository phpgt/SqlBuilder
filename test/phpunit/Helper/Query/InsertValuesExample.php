<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;
use Gt\SqlBuilder\Query\SqlQuery;

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