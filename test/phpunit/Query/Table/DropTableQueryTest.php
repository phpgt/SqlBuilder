<?php
namespace Gt\SqlBuilder\Test\Query\Table;

use Gt\SqlBuilder\Test\Helper\Query\Table\DropTableExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class DropTableQueryTest extends QueryTestCase {
	public function testDropTableSimple() {
		$sut = new DropTableExample();
		$sql = self::normalise($sut);
		self::assertSame("drop table student", $sql);
	}
}
