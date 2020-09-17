<?php
namespace Gt\SqlBuilder\Test;

abstract class QueryTestCase extends \PHPUnit\Framework\TestCase {
	protected static function normalise(string $query):string {
		$query = str_replace(["\n", "\t"], " ", $query);
		while(strstr($query, "  ")) {
			$query  = str_replace("  ", " ", $query);
		}
		return trim($query);
	}
}