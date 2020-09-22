<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;

class InsertPartitionExample extends InsertQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function partition():array {
		return [
			"exp1",
			"exp2",
		];
	}

	public function set():array {
		return [
			"name",
		];
	}
}