<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\InsertQuery;

class InsertInferredPlaceholderExample extends InsertQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			":name",
			":dateOfBirth",
		];
	}
}
