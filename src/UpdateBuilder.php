<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\UpdateQuery;

/**
 * @extends AbstractQueryBuilder<UpdateQuery>
 * @method UpdateBuilder table(string ...$args)
 * @method UpdateBuilder join(string ...$args)
 * @method UpdateBuilder set(string ...$args)
 * @method UpdateBuilder from(string ...$args)
 * @method UpdateBuilder where(string ...$args)
 * @method UpdateBuilder orderBy(string ...$args)
 * @method UpdateBuilder limit(int $limit)
 */
class UpdateBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"table" => [],
		"join" => [],
		"set" => [],
		"from" => [],
		"where" => [],
		"orderBy" => [],
		"limit" => null,
	];

	protected function createQuery():UpdateQuery {
		return new class() extends UpdateQuery {};
	}
}
