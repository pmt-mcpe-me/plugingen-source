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

class PlayerResource extends Resource{
	private $children;

	public function __construct($expr, $explain){
		parent::__construct(self::PLAYER, $expr, $explain);
	}

	public function getChildResoruces(){
		if(!isset($this->children)){
			$this->children = [
				new StringResource($this->expr . "->getName()", "the login name of $this->explain"),
				new StringResource($this->expr . "->getDisplayName()", "the chat display name of $this->explain"),
				new StringResource($this->expr . "->getDisplayName()", "the name tag of $this->explain"),
				new StringResource($this->expr . "->getLevel()", "the world that $this->explain is in"),
			];
		}
	}
}
