<?php
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolveInspection TODO: This is not working :( */

namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Query\SelectQuery;
use Gt\SqlBuilder\Test\Helper\Query\SelectExample;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendComplex;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhere;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleInnerJoin;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleSubquery;
use Gt\SqlBuilder\Test\QueryTestCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SelectQueryTest extends QueryTestCase {
	public function testDefaults() {
		/** @var MockObject|SelectQuery $sut */
		$sut = self::getMockForAbstractClass(SelectQuery::class);
		self::assertEmpty($sut->select());
		self::assertEmpty($sut->from());
		self::assertEmpty($sut->where());
		self::assertEmpty($sut->groupBy());
		self::assertEmpty($sut->having());
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
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null and test = 123", $sql);
	}

	public function testSelectExampleExtendComplex() {
		$sut = new SelectExampleExtendComplex();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth, category, location from student where deletedAt is null and test = 123 and ( location = 105 or location is null )", $sql);
	}

	public function testSelectInnerJoin() {
		$sut = new SelectExampleInnerJoin();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth, module.title from student inner join student_has_module shm on shm.studentId = student.id inner join module on shm.moduleId = module.id where deletedAt is null", $sql);
	}

	public function testSelectSubquery() {
		$sut = new SelectExampleSubquery();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null and age > ( select minAge from consent where consent.district = student.district )", $sql);
	}
}