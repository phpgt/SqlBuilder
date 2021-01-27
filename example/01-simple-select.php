<?php
require(__DIR__ . "/../vendor/autoload.php");
use Gt\SqlBuilder\Query\SelectQuery;

class BaseSelect extends SelectQuery {
	public function select():array {
		return [
			"name",
			"dob",
			"class",
		];
	}

	public function from():array {
		return [
			"student"
		];
	}
}

class SelectAllInClass extends BaseSelect {
	public function where():array {
		return [
			"class = ?"
		];
	}
}

echo new SelectAllInClass();