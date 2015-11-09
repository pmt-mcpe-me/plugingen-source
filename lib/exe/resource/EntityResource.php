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

class EntityResource extends PositionResource{
	public function getChildResources(){
		return array_merge(parent::getChildResources(), [
			new NumberResource($this->expr . "->getYaw()", "the <a href='https://upload.wikimedia.org/wikipedia/commons/5/54/Flight_dynamics_with_text.png' title='See diagram on Wikipedia for explanation'>yaw</a> of $this->explain"),
			new NumberResource($this->expr . "->getPitch()", "the <a href='https://upload.wikimedia.org/wikipedia/commons/5/54/Flight_dynamics_with_text.png' title='See diagram on Wikipedia for explanation'>pitch</a> of $this->explain"),
		]);
	}
}
