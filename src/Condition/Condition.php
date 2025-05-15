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
		?string $subLogic = null,
		string $separator = "\n\t",
	):string {
		$condition = "";
		$brackets = false;

		foreach($this->parts as $i => $part) {
			$condition = $this->addPartToCondition(
				$i,
				$part,
				$condition,
				$separator,
				$subLogic,
			);
			$brackets = $brackets || $part instanceof Condition;
		}

		if($brackets) {
			$condition = "( $condition )";
		}

		return $condition;
	}

	private function addPartToCondition(
		int $i,
		string|Condition $part,
		string $condition,
		string $separator,
		?string $subLogic = null,
	):string {
		if(strlen($condition) > 0) {
			$condition .= $separator;
		}

		if($part instanceof Condition) {
			$logic = $part->getLogic();
			if(strlen($condition) > 0) {
				$condition .= "$logic ";
			}
			$condition .= $part->getCondition($logic);
		}
		else {
			$part = $this->processStringPart($part);
			if($i > 0) {
				$subLogic = $subLogic ?: $this->getLogic();
				$condition .= "$subLogic ";
			}
			$condition .= $part;
		}

		return $condition;
	}

	private function processStringPart(string $part):string {
		if($part[0] === "?") {
			$part = substr($part, 1) . " = ?";
		}
		elseif($part[0] === ":") {
			$part = substr($part, 1) . " = $part";
		}

		return $part;
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
