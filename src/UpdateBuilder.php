<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\UpdateQuery;

/**
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

	public function __toString():string {
		$class = new class() extends UpdateQuery {};
		$class->setDynamicParts($this->parts);
		return (string)$class;
	}
}
