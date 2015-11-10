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

use pg\lib\exe\resource\action\Action;

class Executor{
	/** @var Context */
	protected $ctx;
	private $id;

	public function __construct($mainRef){
		$this->ctx = new Context($mainRef);
		$this->id = getNextExecutorId();
		$_SESSION["executors"][$this->id] = $this;
	}


	/**
	 * Returns the executor object converted to PHP code, <i>without</i> function declaration.
	 * @return string
	 */
	public function exportExecuteFunction(){
		$out = "";
		return $out;
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
	public function getExecutorId(){
		return $this->id;
	}
}
