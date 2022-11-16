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
			->from("TestTable");
		self::assertSame("select testColumn from TestTable", self::normalise($sut));
	}

	public function testInnerJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->innerJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable inner join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut),
		);
	}

	public function testCrossJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->crossJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable cross join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut)
		);
	}

	public function testLeftJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->leftJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable left join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut)
		);
	}

	public function testLeftOuterJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->leftOuterJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable left outer join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut)
		);
	}

	public function testRightJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->rightJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable right join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut)
		);
	}

	public function testRightOuterJoin():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->rightOuterJoin("OtherTable on TestTable.id = OtherTable.id");
		self::assertSame(
			"select testColumn from TestTable right outer join OtherTable on TestTable.id = OtherTable.id",
			self::normalise($sut)
		);
	}

	public function testWhere_stringCondition():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->where("id = 123");
		self::assertSame(
			"select testColumn from TestTable where id = 123",
			self::normalise($sut)
		);
	}

	public function testWhere_multipleStringCondition():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->where(
				"id = 123",
				"createdAt > '2020-01-01'"
			);
		self::assertSame(
			"select testColumn from TestTable where id = 123 and createdAt > '2020-01-01'",
			self::normalise($sut)
		);
	}

	public function testGroupBy():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->groupBy("category");
		self::assertSame(
			"select testColumn from TestTable group by category",
			self::normalise($sut)
		);
	}

	public function testHaving():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->having("testColumn = 'example'")
			->where("id > 999");
		/** @noinspection SqlAggregates */
		self::assertSame(
			"select testColumn from TestTable where id > 999 having testColumn = 'example'",
			self::normalise($sut)
		);
	}

	public function testOrderBy():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->orderBy("createdAt desc");
		self::assertSame(
			"select testColumn from TestTable order by createdAt desc",
			self::normalise($sut)
		);
	}

	public function testLimit():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->limit(15);
		self::assertSame(
			"select testColumn from TestTable limit 15",
			self::normalise($sut)
		);
	}

	public function testOffset():void {
		$sut = new SelectBuilder();
		$sut->select("testColumn")
			->from("TestTable")
			->limit(100)
			->offset(500);

// TODO: Offset should not be possible without a limit. If offset is called
// without a limit, there should be an exception thrown.

		self::assertSame(
			"select testColumn from TestTable limit 100 offset 500",
			self::normalise($sut)
		);
	}

	/**
	 * Note that the order of the chained functions is not the order of
	 * correct SQL, although the SQL is output in the correct order.
	 */
	public function test_combination():void {
		$sut = new SelectBuilder();
		$sut->select("id", "createdAt", "email", "max(loginDateTime) as lastLogin")
			->from("user")
			->leftJoin("user_access on user.id = user_access.userId")
			->where("email like '%@example.com'", "deletedAt is null")
			->having("lastLogin > '2020-01-01'")
			->limit(100)
			->orderBy("email")
			->groupBy("email");

		self::assertSame(
			"select id, createdAt, email, max(loginDateTime) as lastLogin from user left join user_access on user.id = user_access.userId where email like '%@example.com' and deletedAt is null group by email having lastLogin > '2020-01-01' order by email limit 100",
			self::normalise($sut)
		);
	}
}
