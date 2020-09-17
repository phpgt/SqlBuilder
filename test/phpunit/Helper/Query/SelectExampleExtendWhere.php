<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class SelectExampleExtendWhere extends SelectExample {
	public function where():array {
		return array_merge(parent::where(), [
			"test = 123",
		]);
	}
}