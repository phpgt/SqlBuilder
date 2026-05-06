<?php
namespace GT\SqlBuilder;

use GT\SqlBuilder\Query\UpdateQuery;

/**
 * @extends AbstractQueryBuilder<UpdateQuery>
 * @method UpdateBuilder table(string ...$args)
 * @method UpdateBuilder join(string ...$args)
 * @method UpdateBuilder set(string ...$args)
 * @method UpdateBuilder from(string ...$args)
 * @method UpdateBuilder where(string ...$args)
 */
class UpdateBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"table" => [],
		"join" => [],
		"set" => [],
		"from" => [],
		"where" => [],
	];

	protected function createQuery():UpdateQuery {
		return new class() extends UpdateQuery {};
	}
}
