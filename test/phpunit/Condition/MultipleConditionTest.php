<?php
namespace GT\SqlBuilder\Test\Condition;

use GT\SqlBuilder\Condition\Condition;
use GT\SqlBuilder\Condition\Equals;
use GT\SqlBuilder\Condition\GreaterThan;
use GT\SqlBuilder\Condition\LessThan;
use GT\SqlBuilder\Condition\MatchAll;
use GT\SqlBuilder\Condition\MatchAny;
use GT\SqlBuilder\Condition\MultipleCondition;
use PHPUnit\Framework\TestCase;

class MultipleConditionTest extends TestCase {
	public function testMatchAllWithStrings():void {
		$sut = new MultipleCondition(
			new MatchAll(),
			"status = 'active'",
			"deletedAt is null",
		);

		self::assertSame(
			"status = 'active'\n\tand deletedAt is null",
			$sut->getCondition()
		);
	}

	public function testMatchAnyWithStrings():void {
		$sut = new MultipleCondition(
			new MatchAny(),
			"status = 'active'",
			"status = 'pending'",
		);

		self::assertSame(
			"status = 'active'\n\tor status = 'pending'",
			$sut->getCondition()
		);
	}

	public function testMultipleConditionWrapsNestedConditions():void {
		$sut = new MultipleCondition(
			new MatchAll(),
			new GreaterThan("score", 10),
			new MultipleCondition(
				new MatchAny(),
				new Equals("status", "active"),
				new LessThan("score", 100),
			),
		);

		self::assertSame(
			"( score > 10\n\tand ( status = 'active'\n\tor score < 100 ) )",
			$sut->getCondition()
		);
	}

	public function testMultipleConditionRejectsNonMatcher():void {
		$this->expectException(\TypeError::class);
		new MultipleCondition(
			new class extends Condition {},
			"test = 1",
		);
	}
}
