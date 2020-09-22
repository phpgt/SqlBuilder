<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\UpdateQuery;

class UpdateExample extends UpdateQuery {
	public function update():array {
		return [
			"student",
		];
	}

	public function set():array {
		return [
			"processedAt",
		];
	}
}