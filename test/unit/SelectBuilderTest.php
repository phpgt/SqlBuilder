<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SelectBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SelectBuilderTest extends TestCase {
	public function testDefaults() {
		/** @var MockObject|SelectBuilder $sut */
		$sut = self::getMockForAbstractClass(SelectBuilder::class);
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
		$sut = self::getMockForAbstractClass(SelectBuilder::class);
		self::assertEmpty((string)$sut);
	}
}