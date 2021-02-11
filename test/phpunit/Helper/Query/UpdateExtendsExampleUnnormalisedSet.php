<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class UpdateExtendsExampleUnnormalisedSet extends UpdateExtendsExample {
	public function set():array {
		return [
			...parent::set(),
			"exampleNormalisation",
			"exampleColumn1" => ":exampleValue1",
			"exampleColumn2" => ":exampleValue2"
		];
	}
}
