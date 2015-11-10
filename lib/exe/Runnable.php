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

abstract class Runnable{
	private $id;
	public function __construct($id){
		$this->id = $id;
		$_SESSION["runnables"][$id] = $this;
	}

	public abstract function getId();
	public abstract function explain();
	/**
	 * Returns PHP code, assumed indentation starts at 0 tabs. No trailing EOL please.
	 * @return string
	 */
	public abstract function php();
	public function isValid(){
		return true;
	}
}
