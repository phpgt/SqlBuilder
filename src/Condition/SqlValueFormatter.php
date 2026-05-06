<?php
namespace GT\SqlBuilder\Condition;

use DateTimeInterface;

trait SqlValueFormatter {
	protected function formatValue(
		string|int|float|bool|DateTimeInterface|null $value
	):string {
		if($value === null) {
			return "null";
		}

		if($value instanceof DateTimeInterface) {
			return "'" . $value->format("Y-m-d H:i:s") . "'";
		}

		if(is_bool($value)) {
			return $value ? "true" : "false";
		}

		if(is_int($value) || is_float($value)) {
			return (string)$value;
		}

		return "'" . str_replace("'", "''", $value) . "'";
	}
}
