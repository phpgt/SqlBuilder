<?php
namespace Gt\SqlBuilder\Condition;

class MatchAll implements ConditionMatcher {
	public function getLogic():string {
		return "and";
	}
}
