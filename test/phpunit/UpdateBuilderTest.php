<?php
namespace Gt\SqlBuilder\Test;

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

	public function testLimit():void {
		$sut = new UpdateBuilder();
		$sut->table("TestTable")
			->where("id = 123")
			->limit(1);
		self::assertSame(
			"update TestTable where id = 123 limit 1",
			self::normalise($sut),
		);
	}
}
