<?php /** @noinspection SqlResolve */
/** @noinspection SqlNoDataSourceInspection */
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\InsertBuilder;
use Gt\SqlBuilder\Query\InsertQuery;

class InsertBuilderTest extends QueryTestCase {
	public function testSet_named():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set(
				"id",
				"name",
			);
		self::assertSame(
			"insert into TestTable ( id, name ) values ( :id, :name )",
			self::normalise($sut)
		);
	}

	public function testSet_manual():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set([
				"id" => 123,
				"name" => "'example'"
			]);
		self::assertSame(
			"insert into TestTable ( id, name ) values ( 123, 'example' )",
			self::normalise($sut)
		);
	}

	public function testColumnsValues():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->columns("id", "name")
			->values(123, "'example'");
		self::assertSame(
			"insert into TestTable ( id, name ) values ( 123, 'example' )",
			self::normalise($sut)
		);
	}

	public function testGetQuery():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->columns("id")
			->values(123);

		$query = $sut->getQuery();
		self::assertInstanceOf(InsertQuery::class, $query);
		self::assertSame((string)$sut, (string)$query);
	}
}
