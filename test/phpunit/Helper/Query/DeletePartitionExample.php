<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\DeleteQuery;

class DeletePartitionExample extends DeleteQuery {
	public function from():array {
		return [
			"student",
		];
	}

	public function partition():array {
		return [
			"exp1",
			"exp2",
			"exp3",
		];
	}

	public function where():array {
		return [
			"toDelete = 1",
		];
	}
}