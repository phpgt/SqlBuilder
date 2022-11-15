<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Condition\Condition;
use Gt\SqlBuilder\Query\DeleteQuery;

/**
 * @method self from(string...$tables)
 * @method self partition(string...$partitions)
 * @method self where(string|Condition...$conditions)
 * @method self orderBy(string...$orderBy)
 * @method self limit(int $limit)
 */
class DeleteBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"from" => [],
		"partition" => [],
		"where" => [],
		"orderBy" => [],
		"limit" => null,
	];

	public function __toString():string {
		$class = new class() extends DeleteQuery {};
		$class->setDynamicParts($this->parts);
		return (string)$class;
	}
}
