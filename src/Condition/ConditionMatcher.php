<?php
namespace GT\SqlBuilder\Condition;

interface ConditionMatcher {
	public function getLogic():string;
}
