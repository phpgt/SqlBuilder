<?php
namespace GT\SqlBuilder\Test\Query;

use GT\SqlBuilder\Condition\MixedIndexedAndNamedParametersException;
use GT\SqlBuilder\Query\SqlQuery;
use GT\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereIndexedNamedMixedParameters;
use GT\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereIndexedParameters;
use GT\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereNamedParameters;
use GT\SqlBuilder\Test\QueryTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class SqlQueryTest extends QueryTestCase {
	public function testDefaults() {
		/** @var MockObject|SqlQuery $sut */
		$sut = self::getMockForAbstractClass(SqlQuery::class);
		self::assertEquals("", $sut->preQuery());
		self::assertEquals("", $sut->postQuery());
	}

	public function testIndexedParameterSyntax() {
		$sut = new SelectExampleExtendWhereIndexedParameters();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null and test = 123 and id = ? and name = ?", $sql);
	}

	public function testNamedParameterSyntax() {
		$sut = new SelectExampleExtendWhereNamedParameters();
		$sql = self::normalise($sut);
		self::assertEquals("select id, name, dateOfBirth from student where deletedAt is null and test = 123 and id = :id and name = :name", $sql);
	}

	public function testIndexedNamedParameterMixedSyntax() {
		$sut = new SelectExampleExtendWhereIndexedNamedMixedParameters();
		self::expectException(MixedIndexedAndNamedParametersException::class);
		$sut->__toString();
	}
}
