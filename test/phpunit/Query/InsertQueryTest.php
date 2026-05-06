<?php /** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolve */
namespace GT\SqlBuilder\Test\Query;

use GT\SqlBuilder\Test\Helper\Query\InsertExample;
use GT\SqlBuilder\Test\Helper\Query\InsertInferredPlaceholderExample;
use GT\SqlBuilder\Test\Helper\Query\InsertMixedPlaceholderExample;
use GT\SqlBuilder\Test\Helper\Query\InsertSelectInlineExample;
use GT\SqlBuilder\Test\Helper\Query\InsertValuesExample;
use GT\SqlBuilder\Test\QueryTestCase;

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
