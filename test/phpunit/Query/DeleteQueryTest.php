<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\Query\DeleteExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class DeleteQueryTest extends QueryTestCase {
	public function testDelete() {
		$sut = new DeleteExample();
		$sql = self::normalise($sut);
		self::assertEquals("delete from student where id = :id", $sql);
	}
}
