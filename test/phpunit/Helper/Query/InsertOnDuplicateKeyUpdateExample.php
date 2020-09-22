<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\InsertQuery;

class InsertOnDuplicateKeyUpdateExample extends InsertQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			"id",
			"name",
		];
	}

	public function onDuplicate():array {
		return $this->set();
	}
}