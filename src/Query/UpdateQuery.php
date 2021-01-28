<?php
namespace Gt\SqlBuilder\Query;

class UpdateQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"update" => $this->update(),
			"set" => $this->normaliseSet($this->set()),
			"where" => $this->where(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function update():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function set():array {
		return [];
	}

	/** @return array<int|string, int|string|SqlQuery> */
	public function where():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function orderBy():array {
		return [];
	}

	/** @return string[]|SqlQuery[] */
	public function limit():array {
		return [];
	}

	/**
	 * @param array<int, string>|array<string, string> $setData
	 * @return array<string, string>
	 */
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