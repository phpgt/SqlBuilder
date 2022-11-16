<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\SelectQuery;

/**
 * @method self select(string...$args)
 * @method self from(string...$args)
 * @method self innerJoin(string...$args)
 * @method self crossJoin(string...$args)
 * @method self leftJoin(string...$args)
 * @method self leftOuterJoin(string...$args)
 * @method self rightJoin(string...$args)
 * @method self rightOuterJoin(string...$args)
 * @method self straightJoin(string...$args)
 * @method self where(string...$args)
 * @method self groupBy(string...$args)
 * @method self having(string...$args)
 * @method self orderBy(string...$args)
 * @method self limit(int $limit)
 * @method self offset(int $offset)
 */
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
