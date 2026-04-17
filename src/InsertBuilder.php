<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\InsertQuery;

/**
 * @extends AbstractQueryBuilder<InsertQuery>
 * TODO: It should be possible to use *insert* into xyz *select* abc
 * @method self into(string...$tables)
 * @method self columns(string...$columns)
 * @method self values(mixed...$values)
 * @method self set(array|string...$assignments)
 */
class InsertBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"into" => [],
		"columns" => [],
		"values" => [],
		"set" => [],
	];

	protected function createQuery():InsertQuery {
		return new class() extends InsertQuery {};
	}
}
