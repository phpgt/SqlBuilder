<?php
namespace Gt\SqlBuilder;

abstract class SqlQuery {
	abstract public function __toString():string;

	public function preQuery():string {
		return "";
	}

	public function postQuery():string {
		return "";
	}
}