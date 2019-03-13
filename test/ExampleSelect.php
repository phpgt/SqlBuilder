<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\SelectQuery;

class ExampleSelect extends SelectQuery {
	public function select():array {
		return [
			"id",
			"name",
		];
	}

	public function from():array {
		return [
			"student",
		];
	}

	public function where():array {
		return [
			"isActive = true",
		];
	}

	public function orderBy():array {
		return [
			"surname",
			"forename",
		];
	}
}