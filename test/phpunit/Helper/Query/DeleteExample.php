<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\DeleteQuery;

class DeleteExample extends DeleteQuery {
	public function from():array {
		return [
			"student",
		];
	}

	public function where():array {
		return [
			"id = :id",
		];
	}
}
