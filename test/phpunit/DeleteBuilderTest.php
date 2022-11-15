<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolve */
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\DeleteBuilder;

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

	public function testPartition():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable")
			->partition("AnotherExample");
		/** @noinspection SqlWithoutWhere */
		self::assertSame(
			"delete from TestTable partition ( AnotherExample )",
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

	public function testOrderBy():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable")
			->orderBy("exampleColumn");
		/** @noinspection SqlWithoutWhere */
		self::assertSame(
			"delete from TestTable order by exampleColumn",
			self::normalise($sut)
		);
	}

	public function testLimit():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable")
			->limit(1);
		self::assertSame(
			"delete from TestTable limit 1",
			self::normalise($sut)
		);
	}

	public function test_combination():void {
		$sut = new DeleteBuilder();
		$sut->from("TestTable", "AnotherExample")
			->where("softDelete is not null", "actionAllowed = 5")
			->orderBy("TestTable.createdAt")
			->limit(10);
		self::assertSame(
			"delete from TestTable, AnotherExample where softDelete is not null and actionAllowed = 5 order by TestTable.createdAt limit 10",
			self::normalise($sut)
		);
	}
}
