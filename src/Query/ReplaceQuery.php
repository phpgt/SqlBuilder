<?php
namespace Gt\SqlBuilder\Query;

class ReplaceQuery extends SqlQuery {
	public function __toString():string {
		$query = $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"replace into" => $this->into(),
			"partition" => $this->partition(),
			"set" => $this->normaliseSet($this->set()),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);

		if($this->subQuery) {
			$query = "( $query )";
		}

		return $query;
	}

	public function into():array {
		return [];
	}

	public function partition():array {
		return [];
	}

	/**
	 * Return either an associative array where the keys are the column
	 * names and the values are the assignment values, or an indexed array
	 * where the values are the column names where the values will be
	 * inferred as the column name prefixed with the colon character.
	 */
	public function set():array {
		return [];
	}

	protected function normaliseSet(array $setData):array {
		$normalised = [];
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