<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SelectQuery;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SelectQueryTest extends TestCase {
	public function testDefaults() {
		/** @var MockObject|SelectQuery $sut */
		$sut = self::getMockForAbstractClass(SelectQuery::class);
		self::assertEmpty($sut->select());
		self::assertEmpty($sut->from());
		self::assertEmpty($sut->where());
		self::assertEmpty($sut->groupBy());
		self::assertEmpty($sut->having());
		self::assertEmpty($sut->window());
		self::assertEmpty($sut->orderBy());
		self::assertEmpty($sut->limit());
	}

	public function testToStringEmpty() {
		$sut = self::getMockForAbstractClass(SelectQuery::class);
		self::assertEmpty((string)$sut);
	}
}