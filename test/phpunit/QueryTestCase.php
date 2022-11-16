<?php
namespace Gt\SqlBuilder\Test;

use PHPUnit\Framework\TestCase;

abstract class QueryTestCase extends TestCase {
	protected static function normalise(string $query):string {
		$query = str_replace(["\n", "\t"], " ", $query);
		while(strstr($query, "  ")) {
			$query  = str_replace("  ", " ", $query);
		}
		return trim($query);
	}
}
