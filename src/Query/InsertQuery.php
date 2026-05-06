<?php
namespace GT\SqlBuilder\Query;

abstract class InsertQuery extends SqlQuery {
	public function __toString():string {
		$columns = $this->columns();
		$values = $this->values();
		$set = $this->normaliseSet($this->set());

		if(empty($columns) && empty($values) && !empty($set)) {
			$columns = array_keys($set);
			$values = array_values($set);
		}

		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"insert into" => $this->into(),
			"columns" => $columns,
			"values" => $values,
			"rowSelect" => $this->select(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function into():array {
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
	 * using explicit short syntax (`:name` / `?name`) or full assignment
	 * expressions (`column = expression`).
	 * @return array<int|string, int|string>
	 */
	public function set():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	public function select():?SelectQuery {
		return $this->dynamicReturn(__FUNCTION__, SelectQuery::class);
	}

	/**
	 * @param array<int, string>|array<string, string|int|bool> $setData
	 * @return array<int|string, string>
	 */
	protected function normaliseSet(array $setData):array {
		return $this->normaliseSetData($setData);
	}
}
