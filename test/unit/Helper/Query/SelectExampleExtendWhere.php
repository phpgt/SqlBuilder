<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Query\SelectQuery;

class SelectExampleExtendWhere extends SelectExample {
	public function where():array {
		return array_merge(parent::where(), [
			"test = 0",
		]);
	}
}