<?php

/*
 * pmt.mcpe.me
 *
 * Copyright (C) 2015 PEMapModder
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

namespace pg\lib\exe;

use pg\lib\Command;
use pg\lib\exe\resource\StringResource;

class CommandExecutor{
	private $cmd;
	/** @var Context */
	private $ctx;

	public function __construct(Command $cmd){
		$this->cmd = $cmd;
		$this->ctx = new Context('$this->getPlugin()');
		$this->ctx->addResource(new StringResource('$this->getUsage()', "usage message for this command"));
		$this->ctx->addResource(new StringResource('$this->getDescription()', "description for this command"));
	}
	/**
	 * Returns the executor object converted to PHP code, <i>without</i> function declaration.
	 * @return string
	 */
	public function exportExecuteFunction(){
		$out = "";
		return $out;
	}
}
