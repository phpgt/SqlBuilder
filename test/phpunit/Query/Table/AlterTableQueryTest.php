<?php
namespace GT\SqlBuilder\Test\Query\Table;

use GT\SqlBuilder\Query\SqlQuery;
use GT\SqlBuilder\SqlBuilderException;
use GT\SqlBuilder\Test\Helper\Query\Table\AlterTableExample;
use GT\SqlBuilder\Test\QueryTestCase;

class AlterTableQueryTest extends QueryTestCase {
	public function testAlterTableSimple():void {
		$sut = new AlterTableExample();
		$sql = self::normalise($sut);
		self::assertSame("alter table student add column telephone int after dob, add column email varchar(256) after id", $sql);
	}

	public function testAlterTableWithoutOptionsThrowsException():void {
		$sut = new class extends AlterTableExample {
			public function alterOptions():array {
				return [];
			}
		};

		self::expectException(SqlBuilderException::class);
		self::expectExceptionMessage(
			"AlterTableQuery requires at least one alter option"
		);
		$sut->__toString();
	}

	public function testAlterTableWithPreAndPostQueryComments():void {
		$sut = new class extends AlterTableExample {
			public function preQuery():string {
				return "/* before */";
			}

			public function postQuery():string {
				return "/* after */";
			}
		};

		self::assertSame(
			"/* preQuery */ /* before */ alter table student add column telephone int after dob, add column email varchar(256) after id/* postQuery */ /* after */",
			self::normalise($sut)
		);
	}

	public function testAlterTableAllowsSqlQueryOptions():void {
		$sut = new class extends AlterTableExample {
			public function alterOptions():array {
				return [
					"add column telephone int after dob",
					new class extends SqlQuery {
						public function __toString():string {
							return "drop column email";
						}
					},
				];
			}
		};

		self::assertSame(
			"alter table student add column telephone int after dob, drop column email",
			self::normalise($sut)
		);
	}
}
