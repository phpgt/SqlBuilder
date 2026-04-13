<?php
namespace Gt\SqlBuilder\Condition;

class MatchAny implements ConditionMatcher {
	public function getLogic():string {
		return "or";
	}
}
