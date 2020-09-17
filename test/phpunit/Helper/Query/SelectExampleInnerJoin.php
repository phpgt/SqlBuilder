<?php
namespace Gt\SqlBuilder\Test\Helper\Query;

class SelectExampleInnerJoin extends SelectExample {
	public function select():array {
		return [
			...parent::select(),
			"module.title",
		];
	}

	public function innerJoin():array {
		return [
			...parent::innerJoin(),
			"student_has_module shm
				on shm.studentId = student.id",
			"module
				on shm.moduleId = module.id",
		];
	}
}