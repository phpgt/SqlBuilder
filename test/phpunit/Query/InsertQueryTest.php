<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolve */
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\Query\InsertExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertInferredPlaceholderExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertMixedPlaceholderExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertSelectInlineExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertValuesExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class InsertQueryTest extends QueryTestCase {
	public function testInsertSimple() {
		$sut = new InsertExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth ) values ( :name, :dateOfBirth )", $sql);
	}

	public function testInsertInferredPlaceholder() {
		$sut = new InsertInferredPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth ) values ( :name, :dateOfBirth )", $sql);
	}

	public function testInsertMixedPlaceholder() {
		$sut = new InsertMixedPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth, createdAt, enabled, type ) values ( :name, :dateOfBirth, :dateTimeNow, 1, :type )", $sql);
	}

	public function testInsertValues() {
		$sut = new InsertValuesExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth ) values ( :name, :dateOfBirth )", $sql);
	}

	public function testInsertSelectInline() {
		$sut = new InsertSelectInlineExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth ) select legalName, assignedDOB from temp where example is not null", $sql);
	}
}
