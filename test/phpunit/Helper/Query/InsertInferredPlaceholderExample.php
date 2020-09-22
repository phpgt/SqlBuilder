<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class InsertInferredPlaceholderExample extends \Gt\SqlBuilder\Query\InsertQuery {
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