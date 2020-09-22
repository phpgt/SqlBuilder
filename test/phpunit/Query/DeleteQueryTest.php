<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\DeleteOrderByExample;
use Gt\SqlBuilder\Test\Helper\Query\DeleteExample;
use Gt\SqlBuilder\Test\Helper\Query\DeletePartitionExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class DeleteQueryTest extends QueryTestCase {
	public function testDelete() {
		$sut = new DeleteExample();
		$sql = self::normalise($sut);
		self::assertEquals("delete from student where id = :id limit 1", $sql);
	}

	public function testDeletePartition() {
		$sut = new DeletePartitionExample();
		$sql = self::normalise($sut);
		self::assertEquals("delete from student partition ( exp1, exp2, exp3 ) where toDelete = 1", $sql);
	}

	public function testDeleteOrderBy() {
		$sut = new DeleteOrderByExample();
		$sql = self::normalise($sut);
		self::assertEquals("delete from student order by createdAt desc limit 10", $sql);
	}
}