<?php
namespace Gt\SqlBuilder;

use Gt\SqlBuilder\Query\SelectQuery;

class SelectBuilder extends AbstractQueryBuilder {
	const QUERY_PARTS = [
		"select" => [],
		"from" => [],
		"innerJoin" => [],
		"crossJoin" => [],
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
}
