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

class StringResource extends Resource{
	/** @var bool */
	private $addCase;
	public function __construct($expr, $explain, $noAddCase = false){
		parent::__construct($expr, $explain);
		$this->addCase = !$noAddCase;
	}
	public function getChildResources(){
		return $this->addCase ? [
			new StringResource("strtolower($this->expr)", "$this->explain in lowercase", true),
			new StringResource("strtoupper($this->expr)", "$this->explain in uppercase", true),
		] : [];
	}
}
