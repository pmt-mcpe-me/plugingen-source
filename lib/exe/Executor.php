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
	/** @var Context */
	protected $ctx;

	private $id;

	/** @var Runnable[] */
	private $runnables = [];

	public function __construct($mainRef){
		$this->ctx = new Context($mainRef);
		parent::__construct(getNextGlobalId());
		$_SESSION["executors"][$this->id] = $this;
	}

	/**
	 * @return Context
	 */
	public function getContext(){
		return $this->ctx;
	}
	/**
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}
	public function explain(){
		$out = $this->description() . "<ul>";
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
