<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\Query\InsertExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class InsertQueryTest extends QueryTestCase {
	public function testInsertSimple() {
		$sut = new InsertExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set name = :name, dateOfBirth = :dateOfBirth", $sql);
	}
}