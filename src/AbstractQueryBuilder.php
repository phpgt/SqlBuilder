<?php
namespace Gt\SqlBuilder;

use Error;
use Gt\SqlBuilder\Query\SqlQuery;
use Stringable;

/**
 * @template TQuery of SqlQuery
 */
abstract class AbstractQueryBuilder implements Stringable {
	const QUERY_PARTS = [];

	/** @var array<string, array<mixed>|int|null> */
	protected array $parts;

	public function __construct() {
		$this->parts = static::QUERY_PARTS;
	}

	public function __toString():string {
		return (string)$this->getQuery();
	}

	/**
	 * @return TQuery
	 */
	public function getQuery():SqlQuery {
		$query = $this->createQuery();
		$query->setDynamicParts($this->parts);
		return $query;
	}

	/**
	 * @param string $name
	 * @param array<mixed> $arguments
	 */
	public function __call(string $name, array $arguments):static {
		if(!array_key_exists($name, static::QUERY_PARTS)) {
			$class = get_class($this);
			throw new Error("Call to undefined method $class::$name()");
		}

		if($name === "limit" || $name === "offset") {
			$this->parts[$name] = $arguments[0];
		}
		elseif($name === "set"
			&& count($arguments) === 1
			&& is_array($arguments[0])) {
			// Keep assignment lists flat so query classes receive the same shape
			// from builders as they do from handwritten query subclasses.
			$this->parts[$name] = $arguments[0];
		}
		else {
			$this->parts[$name] = $arguments;
		}

		return $this;
	}

	/**
	 * @return TQuery
	 */
	abstract protected function createQuery():SqlQuery;
}
