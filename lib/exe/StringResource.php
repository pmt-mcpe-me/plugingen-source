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

class StringResource extends Resource{
	public function __construct($expr, $explain, $noAddCase = false){
		parent::__construct(self::STRING, $expr, $explain);
		if(!$noAddCase){
			$this->children = [
				new StringResource("strtolower($expr)", "$explain in lowercase", true),
				new StringResource("strtoupper($expr)", "$explain in uppercase", true),
			];
		}
	}
}
