<?php

namespace pg\lib;

class CommandExecutor{
	/** @var exe\Statement[] */
	public $statements;
	public function __construct(Command $cmd){
		$this->cmd = $cmd;
	}
	/**
	 * Returns the executor object converted to PHP code, <i>without</i> function declaration.
	 * @return string
	 */
	public function exportExecuteFunction(){
		$out = "";
		foreach($this->statements as $stmt){
			$out .= $stmt->getPhpCode(1);
		}
	}
}
