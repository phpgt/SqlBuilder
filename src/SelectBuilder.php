<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Condition\Condition;
use Gt\SqlBuilder\Query\SelectQuery;

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
		return new class($this->parts) extends SelectQuery {
			/** @param array<string, string[]|Condition[]>|array<string, ?int> $parts */
			public function __construct(
				private array $parts
			) {
				parent::__construct();
			}

			function select():array {
				return $this->parts["select"];
			}

			function from():array {
				return $this->parts["from"];
			}

			function innerJoin():array {
				return $this->parts["innerJoin"];
			}

			function crossJoin():array {
				return $this->parts["crossJoin"];
			}

			function leftJoin():array {
				return $this->parts["leftJoin"];
			}

			function leftOuterJoin():array {
				return $this->parts["leftOuterJoin"];
			}

			function rightJoin():array {
				return $this->parts["rightJoin"];
			}

			function rightOuterJoin():array {
				return $this->parts["rightOuterJoin"];
			}

			function where():array {
				return $this->parts["where"];
			}

			function groupBy():array {
				return $this->parts["groupBy"];
			}

			function having():array {
				return $this->parts["having"];
			}

			function orderBy():array {
				return $this->parts["orderBy"];
			}

			function limit():?int {
				return $this->parts["limit"];
			}

			function offset():?int {
				return $this->parts["offset"];
			}
		};
	}
}
