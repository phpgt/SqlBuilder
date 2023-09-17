<?php
namespace Gt\SqlBuilder\Condition;

class Condition {
	protected string $logic = "";
	/** @var Condition[]|string[] $parts */
	protected array $parts;

	/** @param Condition|string $parts */
	public function __construct(...$parts) {
		$this->parts = $parts;
	}

	public function getLogic():string {
		return $this->logic;
	}

	public function getCondition(
		string $subLogic = null,
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
			elseif(is_string($part)) {
				if($part[0] === "?") {
					$part = substr($part, 1) . " = ?";
				}
				elseif($part[0] === ":") {
					$part = substr($part, 1) . " = $part";
				}
			}

			if($i > 0) {
				if($subLogic) {
					$condition .= $subLogic;
				}
				else {
					$condition .= $this->getLogic();
				}

				$condition .= " ";
			}
			$condition .= $part;
		}

		if($brackets) {
			$condition = "( $condition )";
		}

		return $condition;
	}

	public function getShortParameterSyntax():?string {
		foreach($this->parts as $part) {
			if(!is_string($part)) {
				continue;
			}

			$char1 = $part[0];
			if($char1 === "?"
			|| $char1 === ":") {
				return $char1;
			}
		}

		return null;
	}
}
