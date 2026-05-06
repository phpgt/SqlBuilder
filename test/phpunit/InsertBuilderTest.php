<?php /** @noinspection SqlResolve */
/** @noinspection SqlNoDataSourceInspection */
namespace GT\SqlBuilder\Test;

use GT\SqlBuilder\InsertBuilder;
use GT\SqlBuilder\Query\InsertQuery;
use GT\SqlBuilder\SqlBuilderException;

class InsertBuilderTest extends QueryTestCase {
	public function testSet_shortNamed():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set(
				":id",
				":name",
			);
		self::assertSame(
			"insert into TestTable ( id, name ) values ( :id, :name )",
			self::normalise($sut)
		);
	}

	public function testSet_rejectsImplicitNamed():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set("id");

		$this->expectException(SqlBuilderException::class);
		$this->expectExceptionMessage("Indexed set() values must use explicit short syntax");
		self::normalise($sut);
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

	public function testSet_manualBoolean():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set([
				"enabled" => true,
				"archived" => false,
			]);
		self::assertSame(
			"insert into TestTable ( enabled, archived ) values ( true, false )",
			self::normalise($sut)
		);
	}

	public function testSet_explicitAssignment():void {
		$sut = new InsertBuilder();
		$sut->into("TestTable")
			->set(
				"id = uuid()",
				"name = trim(:name)",
			);
		self::assertSame(
			"insert into TestTable ( id, name ) values ( uuid(), trim(:name) )",
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
