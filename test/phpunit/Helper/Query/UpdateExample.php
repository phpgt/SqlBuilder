<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Query\UpdateQuery;

class UpdateExample extends UpdateQuery {
	public function table():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			":processedAt",
		];
	}
}
