<?php
namespace GT\SqlBuilder\Query;

abstract class UpdateQuery extends SqlQuery {
	public function __toString():string {
		return $this->processClauseList([
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"update" => $this->table(),
			"set" => $this->normaliseSet($this->set()),
			"where" => $this->where(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		]);
	}

	/** @return string[]|SqlQuery[] */
	public function table():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return string[]|SqlQuery[] */
	public function set():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/** @return array<int|string, int|string|SqlQuery> */
	public function where():array {
		return $this->dynamicReturn(__FUNCTION__);
	}

	/**
	 * @param array<int, string>|array<string, string|int|bool> $setData
	 * @return array<int|string, string>
	 */
	protected function normaliseSet(array $setData):array {
		return $this->normaliseSetData($setData);
	}
}
