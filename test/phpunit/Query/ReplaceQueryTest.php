<?php
namespace Gt\SqlBuilder\Test\Query;

use Gt\SqlBuilder\Test\QueryTestCase;

class ReplaceQueryTest extends QueryTestCase {
	public function testReplaceSimple() {
		$sut = new ReplaceExample();
		$sql = self::normalise($sut);
		self::assertEquals("insert into student set name = :name, dateOfBirth = :dateOfBirth", $sql);
	}

	public function testReplaceInferredPlaceholder() {
		$sut = new ReplaceInferredPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("replace into student set name = :name, dateOfBirth = :dateOfBirth", $sql);
	}

	public function testReplaceMixedPlaceholder() {
		$sut = new ReplaceMixedPlaceholderExample();
		$sql = self::normalise($sut);
		self::assertEquals("replace into student set name = :name, dateOfBirth = :dateOfBirth, createdAt = :dateTimeNow, enabled = 1, type = :type", $sql);
	}

	public function testReplacePartition() {
		$sut = new ReplacePartitionExample();
		$sql = self::normalise($sut);
		self::assertEquals("replace into student partition ( exp1, exp2 ) set name = :name", $sql);
	}
}