<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Query\SqlQuery;
use Gt\SqlBuilder\Test\QueryTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class SqlQueryTest extends QueryTestCase {
	public function testDefaults() {
		/** @var MockObject|SqlQuery $sut */
		$sut = self::getMockForAbstractClass(SqlQuery::class);
		self::assertEquals("", $sut->preQuery());
		self::assertEquals("", $sut->postQuery());
	}
}