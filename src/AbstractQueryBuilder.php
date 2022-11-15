<?php
namespace Gt\SqlBuilder;

use Error;
use Stringable;

abstract class AbstractQueryBuilder implements Stringable {
	const QUERY_PARTS = [];

	/** @var array<string, array<string>> */
	protected array $parts;

	public function __construct() {
		$this->parts = static::QUERY_PARTS;
	}

	public function __call(string $name, array $arguments):static {
		if(!array_key_exists($name, static::QUERY_PARTS)) {
			$class = get_class($this);
			throw new Error("Call to undefined method $class::$name()");
		}

		if($name === "limit" || $name === "offset") {
			$this->parts[$name] = $arguments[0];
		}
		else {
			$this->parts[$name] = $arguments;
		}

		return $this;
	}
}
