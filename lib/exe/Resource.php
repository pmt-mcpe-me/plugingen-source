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

abstract class Resource{
	const PLAYER = "resource.player";
	const STRING = "resource.string";
	const NUMBER = "resource.number";

	public $type;
	public $expr;
	public $explain;
	public $resId;
	protected $children;
	private $color;

	public function __construct($type, $expr, $explain){
		$this->type = $type;
		$this->color = nextColor();
		$this->expr = "<span style=\"background-color: #" . sprintf("%X", $this->color) . ">" . $expr . "</span>";
		$this->explain = $explain;
		$this->resId = \getNextResourceId();
	}

	public function getChildResources(){
		return [];
	}
}
