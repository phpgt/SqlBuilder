<?php
namespace GT\SqlBuilder\Test\Query\Table;

use GT\SqlBuilder\Test\Helper\Query\Table\DropTableExample;
use GT\SqlBuilder\Test\QueryTestCase;

class DropTableQueryTest extends QueryTestCase {
	public function testDropTableSimple():void {
		$sut = new DropTableExample();
		$sql = self::normalise($sut);
		self::assertSame("drop table student", $sql);
	}

	public function testDropTableAllowsIfExistsClause():void {
		$sut = new class extends DropTableExample {
			public function dropTable():string {
				return "if exists student";
			}
		};

		self::assertSame(
			"drop table if exists student",
			self::normalise($sut)
		);
	}

	public function testDropTableWithPreAndPostQueryComments():void {
		$sut = new class extends DropTableExample {
			public function preQuery():string {
				return "/* before */";
			}

			public function postQuery():string {
				return "/* after */";
			}
		};

		self::assertSame(
			"/* preQuery */ /* before */ drop table student /* postQuery */ /* after */",
			self::normalise($sut)
		);
	}

	public function testDropTableWithoutTableNameOmitsClauseAndOnlyRendersComments():void {
		$sut = new class extends DropTableExample {
			public function dropTable():string {
				return "";
			}

			public function preQuery():string {
				return "/* before */";
			}
		};

		self::assertSame(
			"/* preQuery */ /* before */",
			self::normalise($sut)
		);
	}
}
