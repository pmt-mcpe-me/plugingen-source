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

namespace pg\lib\exe\resource\action;

use pg\lib\exe\Context;
use pg\lib\exe\resource\Resource;

class Action{
	private $expr;
	private $explain;
	private $reqParams;
	private $resParams = [];

	/** @var Context */
	private $context;
	private $paramIds = [];
	private $actionId;

	/**
	 * @param string $expr
	 * @param string $explain
	 * @param string[] $params
	 */
	public function __construct($expr, $explain, $params){
		$this->expr = $expr;
		$this->explain = $explain;
		$this->reqParams = $params;
	}
	public function setParam($name, Resource $resource){
		if(isset($this->reqParams[$name])){
			if(is_a($resource, $this->reqParams[$name])){
				$this->resParams[$name] = $resource;
			}else{
				throw new \RuntimeException("Incorrect type " . get_class($resource));
			}
		}
		throw new \RuntimeException("Unknown param");
	}
	public function isValid(){
		return count($this->reqParams) === count($this->resParams);
	}
	/**
	 * @return int
	 */
	public function getActionId(){
		return $this->actionId;
	}
	public function init(Context $context){
		if(isset($this->actionId)){
			throw new \RuntimeException("Already initialized");
		}
		$this->context = $context;
		$this->actionId = getNextActionId();
		foreach($this->reqParams as $name => $class){
			$this->paramIds[$name] = getNextActionParamId();
		}
	}
}
