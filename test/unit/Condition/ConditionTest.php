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

	public function testGetConditionMultipleStringAnd() {
		$sut = new AndCondition(
				"key1 = value1",
				"key2 = value2"
		);
		self::assertEquals(
			"key1 = value1\n\tand key2 = value2",
			$sut->getCondition()
		);
	}

	public function testGetConditionMultipleStringOr() {
		$sut = new OrCondition(
			"key1 = value1",
			"key2 = value2"
		);
		self::assertEquals(
			"key1 = value1\n\tor key2 = value2",
			$sut->getCondition()
		);
	}
}