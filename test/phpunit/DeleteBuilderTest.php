<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolve */
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\DeleteBuilder;
use Gt\SqlBuilder\Query\DeleteQuery;

class DeleteBuilderTest extends QueryTestCase {
	public function testFrom():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable");
		/** @noinspection SqlWithoutWhere */
		self::assertSame(
			"delete from TestTable",
			self::normalise($sut)
		);
	}

	public function testWhere():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable")
			->where("softDelete is not null");
		self::assertSame(
			"delete from TestTable where softDelete is not null",
			self::normalise($sut)
		);
	}

	public function testGetQuery():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable")
			->where("softDelete is not null");

		$query = $sut->getQuery();
		self::assertInstanceOf(DeleteQuery::class, $query);
		self::assertSame((string)$sut, (string)$query);
	}
}
