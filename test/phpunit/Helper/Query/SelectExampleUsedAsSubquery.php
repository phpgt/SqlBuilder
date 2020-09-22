<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\SelectQuery;

class SelectExampleUsedAsSubquery extends SelectQuery {
	public function select():array {
		return [
			"minAge",
		];
	}

	public function from():array {
		return [
			"consent"
		];
	}

	public function where():array {
		return [
			"consent.district = student.district"
		];
	}
}