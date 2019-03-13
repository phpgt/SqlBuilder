<?php
namespace Gt\SqlBuilder\Test\Condition;

use Gt\SqlBuilder\Condition\AndCondition;
use Gt\SqlBuilder\Condition\Condition;
use Gt\SqlBuilder\Condition\OrCondition;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase {
	public function testGetLogic() {
		$and = new AndCondition();
		self::assertEquals("and", $and->getLogic());
		$or = new OrCondition();
		self::assertEquals("or", $or->getLogic());
	}

	public function testGetConditionEmpty() {
		/** @var MockObject|Condition $sut */
		$sut = self::getMockForAbstractClass(Condition::class);
		self::assertEquals("", $sut->getCondition());
	}

	public function testGetConditionSingleString() {
		/** @var MockObject|Condition $sut */
		$sut = self::getMockForAbstractClass(
			Condition::class,
			[
				"key = value",
			]
		);

		self::assertEquals(
			"key = value",
			$sut->getCondition()
		);
	}
}