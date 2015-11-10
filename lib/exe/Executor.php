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

use pg\lib\ClassGenerator;

abstract class Executor extends Runnable{
	/** @var Runnable[] */
	private $runnables = [];

	/**
	 * @param string $mainRef
	 */
	public function __construct($mainRef){
		parent::__construct(new Context($mainRef), getNextGlobalId());
		$_SESSION["executors"][$this->getId()] = $this;
	}

	public function explain(){
		$out = "<span class='executor runnable-group runnable' data-runnable-id='{$this->getId()}'>" . $this->description() . "<ul>";
		foreach($this->runnables as $run){
			$out .= "<li>" . $run->explain() . "</li>";
		}
		return $out . "</ul>";
	}
	public function php(){
		$out = "";
		foreach($this->runnables as $run){
			$out .= $run->php();
			$out .= ClassGenerator::STANDARD_EOL;
		}
		return substr($out, 0, -strlen(ClassGenerator::STANDARD_EOL));
	}
	public abstract function description();
}
