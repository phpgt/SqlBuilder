<?php
namespace GT\SqlBuilder\Test\Query;

use GT\SqlBuilder\Test\Helper\Query\DeleteExample;
use GT\SqlBuilder\Test\QueryTestCase;

class DeleteQueryTest extends QueryTestCase {
	public function testDelete() {
		$sut = new DeleteExample();
		$sql = self::normalise($sut);
		self::assertEquals("delete from student where id = :id", $sql);
	}
}
