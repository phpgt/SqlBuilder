<?php
namespace Gt\SqlBuilder\Query;

abstract class ReplaceQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"replace into" => $this->into(),
			"partition" => $this->partition(),
			"columns" => $this->columns(),
			"values" => $this->values(),
			"set" => $this->normaliseSet($this->set()),
			"rowSelect" => $this->select(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function into():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[]|SqlQuery[] */
	public function partition():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] Ordered list of column names to assign values to with values() */
	public function columns():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[] */
	public function values():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/**
	 * Return either an associative array where the keys are the column
	 * names and the values are the assignment values, or an indexed array
	 * where the values are the column names where the values will be
	 * inferred as the column name prefixed with the colon character.
	 * @return array<int|string, int|string>
	 */
	public function set():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	public function select():?SelectQuery {
		return $this->dynamicReturn(__FUNCTION__, SelectQuery::class);
	}

	/**
	 * @param array<int, string>|array<string, string|string[]> $setData
	 * @return string[]|SqlQuery[]
	 */
	protected function normaliseSet(array $setData):array {
		$normalised = [];

		if(is_array($setData[0])) {
			$setData = $setData[0];
		}

		foreach($setData as $i => $name) {
			if(is_int($i)) {
				$normalised[$name] = ":$name";
			}
			else {
				$normalised[$i] = $name;
			}
		}

		return $normalised;
	}
}
