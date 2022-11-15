<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\SelectQuery;

class SelectBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"select" => [],
		"from" => [],
		"innerJoin" => [],
		"crossJoin" => [],
		"leftJoin" => [],
		"leftOuterJoin" => [],
		"rightJoin" => [],
		"rightOuterJoin" => [],
		"straightJoin" => [],
		"where" => [],
		"groupBy" => [],
		"having" => [],
		"orderBy" => [],
		"limit" => null,
		"offset" => null,
	];

	// NOTE: This doesn't need to do any lazy loading. THat's the job of the
	// database to decide what query to build.
	public function __toString():string {
		$class = new class() extends SelectQuery {};
		$class->setDynamicParts($this->parts);
		return (string)$class;
	}
}
