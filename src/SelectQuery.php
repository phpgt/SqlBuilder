<?php
namespace Gt\SqlBuilder;

abstract class SelectQuery extends SqlQuery {
	const PRE_QUERY_COMMENT = "/* preQuery */";
	const POST_QUERY_COMMENT = "/* postQuery */";

	public function __toString():string {
		$queryBreakdown = [
			self::PRE_QUERY_COMMENT => $this->preQuery(),
			"select" => $this->select(),
			"from" => $this->from(),
			"where" => $this->where(),
			"group by" => $this->groupBy(),
			"having" => $this->having(),
			"window" => $this->window(),
			"order by" => $this->orderBy(),
			"limit" => $this->limit(),
			self::POST_QUERY_COMMENT => $this->postQuery(),
		];
/*
		$query = "";
		$preQuery = $this->preQuery();
		if(strlen($preQuery) > 0) {
			$query .= self::PRE_QUERY_COMMENT;
			$query .= $preQuery;
			$query .= PHP_EOL;
		}

		$query .= "select\n\t";
		$query .= implode(",\n\t", $this->select());
		$query .= PHP_EOL;

		$query .= "from\n\t";
		$query .= implode(",\n\t", $this->from());
		$query .= PHP_EOL;

		$where = $this->where();
		if(!empty($where)) {
			$query .= "where\n\t";
// TODO: In where(), return [new And("1=1", "2=2"), new Or("1=1", "2=5")]
			$query .= implode("\nand\n\t", $where);
			$query .= PHP_EOL;
		}

		$groupBy = $this->groupBy();
		if(!empty($groupBy)) {
			$query .= "group by\n\t";
			$query .= implode(",\n\t", $groupBy);
			$query .= PHP_EOL;
		}

		$having = $this->having();
		if(!empty($having)) {
			$query .= "having\n\t";
// TODO: In having(), return [new And("1=1", "2=2"), new Or("1=1", "2=5")]
			$query .= implode("\nand\n\t", $having);
			$query .= PHP_EOL;
		}

		$postQuery = $this->postQuery();
		if(strlen($postQuery) > 0) {
			$query .= PHP_EOL;
			$query .= self;
			$query .= $postQuery;
			$query .= PHP_EOL;
		}

		return $query;
		*/
	}

	/** @return string[]|SqlQuery[] */
	public function select():array {
		return [];
	}

	public function from():array {
		return [];
	}

	public function where():array {
		return [];
	}

	public function groupBy():array {
		return [];
	}

	public function having():array {
		return [];
	}

	public function window():array {
		return [];
	}

	public function orderBy():array {
		return [];
	}

	public function limit():array {
		return [];
	}
}