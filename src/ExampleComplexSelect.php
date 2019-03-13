<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\OrCondition;

class ExampleComplexSelect extends ExampleSelect {
	public function where():array {
		return array_merge(
			parent::where(), [
				"startDate < :today",
				new AndCondition(
					"isArchived is null",
					new OrCondition(
						"vip = true",
						"specialCase = true"
					)
				),
			]
		);
	}
}