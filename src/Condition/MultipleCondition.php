<?php
namespace Gt\SqlBuilder\Condition;

class MultipleCondition extends Condition {
	/** @var Condition[]|string[] */
	protected array $parts;
	protected string $logic = "and";
	private string $matchLogic;

	/** @param Condition|string $parts */
	public function __construct(
		ConditionMatcher $matcher,
		...$parts
	) {
		$this->matchLogic = $matcher->getLogic();
		$this->parts = $parts;
	}

	public function getCondition(
		?string $subLogic = null,
		string $separator = "\n\t",
	):string {
		unset($subLogic);
		$condition = "";
		$wrap = false;

		foreach($this->parts as $index => $part) {
			if($index > 0) {
				$condition .= $separator . $this->matchLogic . " ";
			}

			if($part instanceof Condition) {
				$rendered = $part->getCondition();
				$wrap = true;
			}
			else {
				$rendered = $part;
			}

			$condition .= $rendered;
		}

		if($wrap) {
			return "( $condition )";
		}

		return $condition;
	}
}
