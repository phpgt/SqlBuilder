<?php
namespace Gt\SqlBuilder\Test;

use Gt\SqlBuilder\SelectBuilder;

class SelectBuilderTest extends QueryTestCase {
	public function testSelect():void {
		$sut = new SelectBuilder();
		$sut->select("'test'");
		self::assertSame("select 'test'", self::normalise($sut));
	}
}
