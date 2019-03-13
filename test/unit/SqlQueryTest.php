<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SqlQuery;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SqlQueryTest extends TestCase {
	public function testDefaults() {
		/** @var MockObject|SqlQuery $sut */
		$sut = self::getMockForAbstractClass(SqlQuery::class);
		self::assertEquals("", $sut->preQuery());
		self::assertEquals("", $sut->postQuery());
	}
}