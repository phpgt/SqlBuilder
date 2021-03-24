<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Condition\MixedIndexedAndNamedParametersException;
use Gt\SqlBuilder\Query\SqlQuery;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereIndexedNamedMixedParameters;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereIndexedParameters;
use Gt\SqlBuilder\Test\Helper\Query\SelectExampleExtendWhereNamedParameters;
use Gt\SqlBuilder\Test\QueryTestCase;
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
