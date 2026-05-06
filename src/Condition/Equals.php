<?php
namespace GT\SqlBuilder\Condition;

use DateTimeInterface;

class Equals extends Condition {
	use SqlValueFormatter;

	protected string $logic = "and";
	protected array $parts = [];

	public function __construct(
		private readonly string $column,
		private readonly string|int|float|bool|DateTimeInterface|null $value,
	) {}

	public function getCondition(
		?string $subLogic = null,
		string $separator = "\n\t",
	):string {
		unset($subLogic, $separator);

		if($this->value === null) {
			return $this->column . " is null";
		}

		return $this->column . " = " . $this->formatValue($this->value);
	}
}
