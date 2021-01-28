<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\Helper\Query\InsertExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertInferredPlaceholderExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertMixedPlaceholderExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertOnDuplicateKeyUpdateExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertPartitionExample;
use Gt\SqlBuilder\Test\Helper\Query\InsertValuesExample;
use Gt\SqlBuilder\Test\QueryTestCase;

class InsertQueryTest extends QueryTestCase {
	public function testInsertSimple() {
		$sut = new InsertExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set name = :name, dateOfBirth = :dateOfBirth", $sql);
	}

	public function testInsertInferredPlaceholder() {
		$sut = new InsertInferredPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set name = :name, dateOfBirth = :dateOfBirth", $sql);
	}

	public function testInsertMixedPlaceholder() {
		$sut = new InsertMixedPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set name = :name, dateOfBirth = :dateOfBirth, createdAt = :dateTimeNow, enabled = 1, type = :type", $sql);
	}

	public function testInsertOnDuplicateKeyUpdate() {
		$sut = new InsertOnDuplicateKeyUpdateExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set id = :id, name = :name on duplicate key update id = :id, name = :name", $sql);
	}

	public function testInsertPartition() {
		$sut = new InsertPartitionExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student partition ( exp1, exp2 ) set name = :name", $sql);
	}

	public function testInsertValues() {
		$sut = new InsertValuesExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student ( name, dateOfBirth ) values ( :name, :dateOfBirth )", $sql);
	}
}