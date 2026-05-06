<?php
namespace GT\SqlBuilder\Test\Helper\Query;

class SelectExampleExtendWhereIndexedNamedMixedParameters extends SelectExample {
	public function where():array {
		return array_merge(parent::where(), [
			"test = 123",
			":id",
			"?name",
		]);
	}
}
