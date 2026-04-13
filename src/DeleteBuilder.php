<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Condition\Condition;
use Gt\SqlBuilder\Query\DeleteQuery;

/**
 * @extends AbstractQueryBuilder<DeleteQuery>
 * @method self from(string...$tables)
 * @method self where(string|Condition...$conditions)
 * @method self orderBy(string...$orderBy)
 * @method self limit(int $limit)
 */
class DeleteBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"from" => [],
		"where" => [],
		"orderBy" => [],
		"limit" => null,
	];

	protected function createQuery():DeleteQuery {
		return new class() extends DeleteQuery {};
	}
}
