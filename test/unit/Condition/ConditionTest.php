<?php
namespace Gt\SqlBuilder\Test\Condition;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\OrCondition;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase {
	public function testGetLogic() {
		$and = new AndCondition();
		self::assertEquals("and", $and->getLogic());
		$or = new OrCondition();
		self::assertEquals("or", $or->getLogic());
	}
}