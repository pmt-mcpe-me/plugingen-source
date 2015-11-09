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

class PositionResource extends Vector3Resource{
	public function getChildResources(){
		return array_merge(parent::getChildResources(), [
			new LevelResource($this->expr . "->getLevel()", "the world $this->explain is in"),
		]);
	}
}
