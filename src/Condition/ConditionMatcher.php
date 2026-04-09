<?php
namespace Gt\SqlBuilder\Condition;

interface ConditionMatcher {
	public function getLogic():string;
}
