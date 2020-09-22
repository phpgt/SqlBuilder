<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\Query\UpdateExample;
use Gt\SqlBuilder\Test\Helper\Query\UpdateExtendsExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class UpdateQueryTest extends QueryTestCase {
	public function testUpdateSimple() {
		$sut = new UpdateExample();
		$sql = self::normalise($sut);
		self::assertEquals("update student set processedAt = :processedAt", $sql);
	}

	public function testUpdateExtends() {
		$sut = new UpdateExtendsExample();
		$sql = self::normalise($sut);
		self::assertEquals("update student set processedAt = :processedAt where createdAt > date_sub(now(), interval 30 day)", $sql);
	}
}