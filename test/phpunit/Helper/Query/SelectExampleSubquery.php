<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class SelectExampleSubquery extends SelectExample {
	public function where():array {
		return [
			...parent::where(),
			"age > " . new SelectExampleUsedAsSubquery(true),
		];
	}
}