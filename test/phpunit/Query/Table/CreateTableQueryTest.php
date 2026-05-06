<?php
namespace GT\SqlBuilder\Test\Query\Table;

use GT\SqlBuilder\Query\SqlQuery;
use GT\SqlBuilder\SqlBuilderException;
use GT\SqlBuilder\Test\Helper\Query\Table\CreateTableExample;
use GT\SqlBuilder\Test\QueryTestCase;

class CreateTableQueryTest extends QueryTestCase {
	public function testCreateTableSimple():void {
		$sut = new CreateTableExample();
		$sql = self::normalise($sut);
		self::assertSame("create table student (id varchar(32) not null, first_name varchar(32), last_name varchar(32), dob date, primary key(id))", $sql);
	}

	public function testCreateTableWithoutDefinitionThrowsException():void {
		$sut = new class extends CreateTableExample {
			public function createDefinition():array {
				return [];
			}
		};

		self::expectException(SqlBuilderException::class);
		self::expectExceptionMessage(
			"CreateTableQuery requires at least one create definition"
		);
		$sut->__toString();
	}

	public function testCreateTableWithPreAndPostQueryComments():void {
		$sut = new class extends CreateTableExample {
			public function preQuery():string {
				return "/* before */";
			}

			public function postQuery():string {
				return "/* after */";
			}
		};

		self::assertSame(
			"/* preQuery */ /* before */ create table student (id varchar(32) not null, first_name varchar(32), last_name varchar(32), dob date, primary key(id))/* postQuery */ /* after */",
			self::normalise($sut)
		);
	}

	public function testCreateTableAllowsSqlQueryDefinitions():void {
		$sut = new class extends CreateTableExample {
			public function createDefinition():array {
				return [
					"id int not null",
					new class extends SqlQuery {
						public function __toString():string {
							return "primary key(id)";
						}
					},
				];
			}
		};

		self::assertSame(
			"create table student (id int not null, primary key(id))",
			self::normalise($sut)
		);
	}
}
