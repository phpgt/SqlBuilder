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
	];

	/** @var array<string, array<string>> */
	private array $parts;

	public function __construct() {
		$this->parts = self::QUERY_PARTS;
	}

	// NOTE: This doesn't need to do any lazy loading. THat's the job of the
	// database to decide what query to build.
	public function __toString():string {
		return new class($this->parts) extends SelectQuery {
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
		};
	}

	public function select(string...$columns):self {
		$this->parts["select"] = $columns;
		return $this;
	}

	public function from(string...$tables):self {
		$this->parts["from"] = $tables;
		return $this;
	}

	public function innerJoin(string...$joinSpecifications):self {
		$this->parts["innerJoin"] = $joinSpecifications;
		return $this;
	}

	public function crossJoin(string...$joinSpecifications):self {
		$this->parts["crossJoin"] = $joinSpecifications;
		return $this;
	}

	public function leftJoin(string...$joinSpecifications):self {
		$this->parts["leftJoin"] = $joinSpecifications;
		return $this;
	}

	public function leftOuterJoin(string...$joinSpecifications):self {
		$this->parts["leftOuterJoin"] = $joinSpecifications;
		return $this;
	}

	public function rightJoin(string...$joinSpecifications):self {
		$this->parts["rightJoin"] = $joinSpecifications;
		return $this;
	}

	public function rightOuterJoin(string...$joinSpecifications):self {
		$this->parts["rightOuterJoin"] = $joinSpecifications;
		return $this;
	}

	public function where(string|Condition...$conditions):self {
		$this->parts["where"] = $conditions;
		return $this;
	}

	public function groupBy(string...$groupBy):self {
		$this->parts["groupBy"] = $groupBy;
		return $this;
	}

	public function having(string|Condition...$conditions):self {
		$this->parts["having"] = $conditions;
		return $this;
	}

	public function orderBy(string...$orderBy):self {
		$this->parts["orderBy"] = $orderBy;
		return $this;
	}

	public function limit(?int $limit):self {
		$this->parts["limit"] = $limit;
		return $this;
	}
}
