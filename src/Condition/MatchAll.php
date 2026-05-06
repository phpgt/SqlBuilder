<?php
namespace GT\SqlBuilder\Condition;

class MatchAll implements ConditionMatcher {
	public function getLogic():string {
		return "and";
	}
}
