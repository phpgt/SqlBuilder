<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class UpdateExtendsExample extends UpdateExample {
	public function where():array {
		return [
			...parent::where(),
			"createdAt > date_sub(now(), interval 30 day)"
		];
	}
}