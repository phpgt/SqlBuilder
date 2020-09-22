<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\ReplaceQuery;

class ReplaceMixedPlaceholderExample extends ReplaceQuery {
	public function into():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			"name",
			"dateOfBirth",
			"createdAt" => ":dateTimeNow",
			"enabled" => 1,
			"type",
		];
	}
}