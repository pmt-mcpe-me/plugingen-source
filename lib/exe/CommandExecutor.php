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

class CommandExecutor extends Executor{
	private $cmd;

	public function __construct(Command $cmd){
		parent::__construct('$this->getPlugin()');
		$this->cmd = $cmd;
		$this->getContext()->addResource(new StringResource('$this->getUsage()', "usage message for this command"));
		$this->getContext()->addResource(new StringResource('$this->getDescription()', "description for this command"));
	}
	public function description(){
		return "Command executor of /{$this->cmd->name}";
	}
}
