<?php
namespace GT\SqlBuilder\Condition;

use DateTimeInterface;

class Between extends Condition {
	use SqlValueFormatter;

	protected string $logic = "and";
	protected array $parts = [];

	public function __construct(
		private readonly string $column,
		private readonly string|int|float|bool|DateTimeInterface $from,
		private readonly string|int|float|bool|DateTimeInterface $upperBound,
	) {}

	public function getCondition(
		?string $subLogic = null,
		string $separator = "\n\t",
	):string {
		unset($subLogic, $separator);
		return sprintf(
			"%s between %s and %s",
			$this->column,
			$this->formatValue($this->from),
			$this->formatValue($this->upperBound),
		);
	}
}
