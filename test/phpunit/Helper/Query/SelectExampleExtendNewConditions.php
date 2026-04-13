<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

use DateTime;
use Gt\SqlBuilder\Condition\Between;
use Gt\SqlBuilder\Condition\Equals;
use Gt\SqlBuilder\Condition\GreaterThan;
use Gt\SqlBuilder\Condition\MatchAny;
use Gt\SqlBuilder\Condition\MultipleCondition;

class SelectExampleExtendNewConditions extends SelectExample {
	public function where():array {
		return array_merge(parent::where(), [
			new Equals("deletedAt", null),
			new GreaterThan("score", 50),
			new MultipleCondition(
				new MatchAny(),
				new Equals("status", "active"),
				new Between(
					"createdAt",
					new DateTime("2026-01-01 00:00:00"),
					new DateTime("2026-12-31 23:59:59"),
				),
			),
		]);
	}
}
