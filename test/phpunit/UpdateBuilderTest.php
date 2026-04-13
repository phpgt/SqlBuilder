<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\Query\UpdateQuery;
use Gt\SqlBuilder\SqlBuilderException;
use Gt\SqlBuilder\UpdateBuilder;

class UpdateBuilderTest extends QueryTestCase {
	public function testTable():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable");
		self::assertSame(
			"update TestTable",
			self::normalise($sut),
		);
	}

	public function testWhere():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->where("id = 123");
		self::assertSame(
			"update TestTable where id = 123",
			self::normalise($sut),
		);
	}

	public function testSet_shortNamed():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->set(":title");
		self::assertSame(
			"update TestTable set title = :title",
			self::normalise($sut),
		);
	}

	public function testSet_rejectsImplicitNamed():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->set("title");

		$this->expectException(SqlBuilderException::class);
		$this->expectExceptionMessage("Indexed set() values must use explicit short syntax");
		self::normalise($sut);
	}

	public function testSet_explicitAssignmentString():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->set("title = trim(:title)");
		self::assertSame(
			"update TestTable set title = trim(:title)",
			self::normalise($sut),
		);
	}

	public function testSetBooleanValues():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->set([
				"enabled" => true,
				"archived" => false,
			]);
		self::assertSame(
			"update TestTable set enabled = true, archived = false",
			self::normalise($sut),
		);
	}

	public function testGetQuery():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->where("id = 123");

		$query = $sut->getQuery();
		self::assertInstanceOf(UpdateQuery::class, $query);
		self::assertSame((string)$sut, (string)$query);
	}
}
