<?php
namespace Gt\SqlBuilder\Test\Query\Table;

use Gt\SqlBuilder\Test\Helper\Query\Table\AlterTableExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class AlterTableQueryTest extends QueryTestCase {
	public function testAlterTableSimple() {
		$sut = new AlterTableExample();
		$sql = self::normalise($sut);
		self::assertSame("alter table student add column telephone int after dob, add column email varchar(256) after id", $sql);
	}
}
