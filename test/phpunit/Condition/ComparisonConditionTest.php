<?php
namespace GT\SqlBuilder\Test\Condition;

use DateTime;
use GT\SqlBuilder\Condition\Between;
use GT\SqlBuilder\Condition\Equals;
use GT\SqlBuilder\Condition\GreaterThan;
use GT\SqlBuilder\Condition\LessThan;
use PHPUnit\Framework\TestCase;

class ComparisonConditionTest extends TestCase {
	public function testEquals():void {
		$sut = new Equals("score", 42);
		self::assertSame("score = 42", $sut->getCondition());
	}

	public function testEqualsNull():void {
		$sut = new Equals("deletedAt", null);
		self::assertSame("deletedAt is null", $sut->getCondition());
	}

	public function testEqualsString():void {
		$sut = new Equals("status", "active");
		self::assertSame("status = 'active'", $sut->getCondition());
	}

	public function testEqualsEscapesSingleQuotes():void {
		$sut = new Equals("surname", "O'Reilly");
		self::assertSame("surname = 'O''Reilly'", $sut->getCondition());
	}

	public function testEqualsFormatsBooleans():void {
		$sut = new Equals("enabled", true);
		self::assertSame("enabled = true", $sut->getCondition());
	}

	public function testGreaterThan():void {
		$sut = new GreaterThan("score", 100);
		self::assertSame("score > 100", $sut->getCondition());
	}

	public function testGreaterThanDateTime():void {
		$sut = new GreaterThan("createdAt", new DateTime("2026-01-02 03:04:05"));
		self::assertSame("createdAt > '2026-01-02 03:04:05'", $sut->getCondition());
	}

	public function testLessThan():void {
		$sut = new LessThan("score", 10);
		self::assertSame("score < 10", $sut->getCondition());
	}

	public function testLessThanFormatsFalseAsKeyword():void {
		$sut = new LessThan("isArchived", false);
		self::assertSame("isArchived < false", $sut->getCondition());
	}

	public function testBetweenScalars():void {
		$sut = new Between("score", 10, 20);
		self::assertSame("score between 10 and 20", $sut->getCondition());
	}

	public function testBetweenDateTime():void {
		$from = new DateTime("2026-01-02 03:04:05");
		$to = new DateTime("2026-06-07 08:09:10");
		$sut = new Between("createdAt", $from, $to);
		self::assertSame(
			"createdAt between '2026-01-02 03:04:05' and '2026-06-07 08:09:10'",
			$sut->getCondition()
		);
	}
}
