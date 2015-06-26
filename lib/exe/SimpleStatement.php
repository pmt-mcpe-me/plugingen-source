<?php

namespace pg\lib\exe;

class SimpleStatement implements Statement{
	private $msg;
	private $code;
	/**
	 * @param string $msg
	 * @param string $code
	 */
	public function __construct($msg, $code){
		$this->msg = $msg;
		$this->code = $code;
	}
	public function explain(){
		return $this->msg;
	}
	public function getPhpCode($tabs){
		return str_repeat("\t", $tabs) . $this->code;
	}
}
