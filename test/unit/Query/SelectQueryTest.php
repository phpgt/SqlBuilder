<?php
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolveInspection TODO: This is not working :( */

namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Query\SelectQuery;
use Gt\SqlBuilder\Test\Helper\Query\SelectExample;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendComplex;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhere;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SelectQueryTest extends TestCase {
	public function testDefaults() {
		/** @var MockObject|SelectQuery $sut */
		$sut = self::getMockForAbstractClass(SelectQuery::class);
		self::assertEmpty($sut->select());
		self::assertEmpty($sut->from());
		self::assertEmpty($sut->where());
		self::assertEmpty($sut->groupBy());
		self::assertEmpty($sut->having());
		self::assertEmpty($sut->window());
		self::assertEmpty($sut->orderBy());
		self::assertEmpty($sut->limit());
	}

	public function testToStringEmpty() {
		$sut = self::getMockForAbstractClass(SelectQuery::class);
		self::assertEmpty((string)$sut);
	}

	public function testSelectSimple() {
		$sut = new SelectExample();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null", $sql);
	}

	public function testSelectExampleExtendWhere() {
		$sut = new SelectExampleExtendWhere();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null and test = 0", $sql);
	}

	public function testSelectExampleExtendComplex() {
		$sut = new SelectExampleExtendComplex();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth, category, location from student where deletedAt is null and test = 0 and ( location = 105 or location is null )", $sql);
	}

	protected static function normalise(string $query):string {
		$query = str_replace(["\n", "\t"], " ", $query);
		$query  = str_replace("  ", " ", $query);
		return trim($query);
	}
}