<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\InsertQuery;

class InsertBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"insertInto" => [],
		"partition" => [],
		"columns" => [],
		"values" => [],
		"set" => [],
	];

	public function __toString():string {
		$class = new class() extends InsertQuery {};
		$class->setDynamicParts($this->parts);
		return (string)$class;
	}
}
