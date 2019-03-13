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

	public function testGetConditionSingleCondition() {
		$condition = self::createMock(Condition::class);
		$condition->method("getLogic")
			->willReturn("testlogic");
		$condition->method("getCondition")
			->willReturn("testKey = testValue");

		/** @var MockObject|Condition $sut */
		$sut = self::getMockForAbstractClass(
			Condition::class, [
			$condition,
		]);
		self::assertEquals(
			"( testKey = testValue )",
			$sut->getCondition()
		);
	}

	public function testGetConditionMultipleCondition() {
		$condition1 = self::createMock(Condition::class);
		$condition1->method("getLogic")
			->willReturn("testlogic");
		$condition1->method("getCondition")
			->willReturn("testKey1 = testValue1");
		$condition2 = self::createMock(Condition::class);
		$condition2->method("getLogic")
			->willReturn("testlogic");
		$condition2->method("getCondition")
			->willReturn("testKey2 = testValue2");

		/** @var MockObject|Condition $sut */
		$sut = self::getMockForAbstractClass(
			Condition::class, [
			$condition1,
			$condition2,
		]);

		self::assertEquals(
			"( testKey1 = testValue1\n\ttestlogic testKey2 = testValue2 )",
			$sut->getCondition()
		);
	}
}