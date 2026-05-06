<?php
namespace GT\SqlBuilder\Test\Helper\Query;

use GT\SqlBuilder\Condition\AndCondition;
use GT\SqlBuilder\Condition\Condition;
use GT\SqlBuilder\Condition\OrCondition;

class SelectExampleExtendComplex extends SelectExampleExtendWhere {
	public function select():array {
		return array_merge(parent::select(), [
			"category",
			"location",
		]);
	}

	public function where():array {
		return array_merge(parent::where(), [
			new AndCondition(
				new Condition("location = 105"),
				new OrCondition("location is null")
			)
		]);
	}
}