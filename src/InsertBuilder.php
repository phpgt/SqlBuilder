<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\InsertQuery;

/**
 * TODO: It should be possible to use *insert* into xyz *select* abc
 * @method self into(string...$tables)
 * @method self partition(string...$partitions)
 * @method self columns(string...$columns)
 * @method self values(mixed...$values)
 * @method self set(array|string...$assignments)
 */
class InsertBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"into" => [],
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
