<?php
namespace Gt\SqlBuilder\Test\Query\Table;

use Gt\SqlBuilder\Test\Helper\Query\Table\CreateTableExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class CreateTableQueryTest extends QueryTestCase {
	public function testCreateTableSimple() {
		$sut = new CreateTableExample();
		$sql = self::normalise($sut);
		self::assertSame("create table student (id varchar(32) not null, first_name varchar(32), last_name varchar(32), dob date, primary key(id))", $sql);
	}
}
