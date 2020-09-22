<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\ReplaceQuery;

class ReplaceInferredPlaceholderExample extends ReplaceQuery {
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