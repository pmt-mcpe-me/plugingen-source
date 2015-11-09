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

class Context{
	/** @var Resource[] */
	private $resources = [];

	/**
	 * @return Resource[]
	 */
	public function getResources(){
		return $this->resources;
	}

	public function addResource(Resource $resource){
		$this->resources[$resource->resId] = $resource;
	}
}
