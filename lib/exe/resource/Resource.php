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

namespace pg\lib\exe\resource;

use pg\lib\exe\runnable\Action;

abstract class Resource{
	public $type;
	public $expr;
	public $explain;
	public $resId;
	private $color;
	public $parent;

	public function __construct($expr, $explain){
		$this->resId = getNextGlobalId();
		$this->expr = $expr;
		$this->color = nextColor();
		$this->explain = '<span style="background-color: #' . sprintf("%'06X", $this->color) . '" class="resource" data-resource-id="$this->resId">' . $explain . "</span>";
	}

	/**
	 * @return self[]
	 */
	public function getChildResources(){
		return [];
	}

	/**
	 * @return Action[]
	 */
	public function getActions(){
		return [];
	}
}
