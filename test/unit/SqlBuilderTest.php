<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SqlBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SqlBuilderTest extends TestCase {
	public function testDefaults() {
		/** @var MockObject|SqlBuilder $sut */
		$sut = self::getMockForAbstractClass(SqlBuilder::class);
		self::assertEquals("", $sut->preQuery());
		self::assertEquals("", $sut->postQuery());
	}
}