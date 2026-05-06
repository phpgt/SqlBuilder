<?php
namespace GT\SqlBuilder;

use GT\SqlBuilder\Condition\Condition;
use GT\SqlBuilder\Query\DeleteQuery;

/**
 * @extends AbstractQueryBuilder<DeleteQuery>
 * @method self from(string...$tables)
 * @method self where(string|Condition...$conditions)
 */
class DeleteBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"from" => [],
		"where" => [],
	];

	protected function createQuery():DeleteQuery {
		return new class() extends DeleteQuery {};
	}
}
