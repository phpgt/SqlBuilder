<?php
namespace Gt\SqlBuilder;

class ExampleExtendedSelect extends ExampleSelect {
	public function where():array {
		return array_merge(
			parent::where(), [
			"dob between :startDob and :endDob"
		]);
	}
}