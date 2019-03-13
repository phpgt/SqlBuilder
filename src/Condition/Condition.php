<?php
namespace Gt\SqlBuilder\Condition;

abstract class Condition {
	protected $logic;
	protected $parts;

	/** @param string|Condition[] $parts */
	public function __construct(...$parts) {
		$this->parts = $parts;
	}

	public function getLogic():string {
		return $this->logic;
	}

	public function getCondition(
		string $sublogic = null,
		string $separator = "\n\t"
	):string {
		$condition = "";
		$brackets = false;

		foreach($this->parts as $i => $part) {
			if(strlen($condition) > 0) {
				$condition .= $separator;
			}

			if($part instanceof Condition) {
				$logic = $part->getLogic();

				if(strlen($condition) > 0) {
					$condition .= $logic;
					$condition .= " ";
				}
				$condition .= $part->getCondition($logic);
				$brackets = true;
				continue;
			}

			if($sublogic && strlen($condition) > 0) {
				$condition .= $sublogic;
				$condition .= " ";
			}
			$condition .= $part;
		}

		if($brackets) {
			$condition = "( $condition )";
		}

		return $condition;
	}
}