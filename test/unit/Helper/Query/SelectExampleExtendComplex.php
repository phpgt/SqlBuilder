<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\OrCondition;

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
				"location = 105",
				new OrCondition("location is null")
			)
		]);
	}
}