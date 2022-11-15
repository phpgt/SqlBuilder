<?php /** @noinspection SqlResolve */
/** @noinspection SqlNoDataSourceInspection */
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SelectBuilder;

class SelectBuilderTest extends QueryTestCase {
	public function testSelect():void {
		$sut = new SelectBuilder();
		$sut->select("'test'");
		self::assertSame("select 'test'", self::normalise($sut));
	}

	public function testSelect_multipleColumns():void {
		$sut = new SelectBuilder();
		$sut->select("col1, col2, now()");
		self::assertSame("select col1, col2, now()", self::normalise($sut));
	}

	public function testFrom():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable");
		self::assertSame("select testColumn from testTable", self::normalise($sut));
	}

	public function testInnerJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->innerJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable inner join otherTable on testTable.id = otherTable.id",
			self::normalise($sut),
		);
	}

	public function testCrossJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->crossJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable cross join otherTable on testTable.id = otherTable.id",
			self::normalise($sut)
		);
	}

	public function testLeftJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->leftJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable left join otherTable on testTable.id = otherTable.id",
			self::normalise($sut)
		);
	}

	public function testLeftOuterJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->leftOuterJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable left outer join otherTable on testTable.id = otherTable.id",
			self::normalise($sut)
		);
	}

	public function testRightJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->rightJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable right join otherTable on testTable.id = otherTable.id",
			self::normalise($sut)
		);
	}

	public function testRightOuterJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("testTable")
			->rightOuterJoin("otherTable on testTable.id = otherTable.id");
		self::assertSame(
			"select testColumn from testTable right outer join otherTable on testTable.id = otherTable.id",
			self::normalise($sut)
		);
	}
}
