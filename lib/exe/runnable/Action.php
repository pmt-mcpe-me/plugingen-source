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

namespace pg\lib\exe\runnable;

use pg\lib\exe\Context;
use pg\lib\exe\resource\Resource;
use pg\lib\exe\Runnable;

class Action extends Runnable{
	private $expr;
	private $explain;
	private $reqParams;
	/** @var ..\resource\Resource[] */
	private $resParams = [];

	/** @var Context */
	private $context;
	private $inited = false;

	/** @noinspection PhpMissingParentConstructorInspection
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

	public function init(Context $context){
		if($this->inited){
			throw new \RuntimeException("Already initialized");
		}
		$this->inited = true;
		$this->context = $context;
		parent::__construct($context, getNextGlobalId());
	}
	/**
	 * @return string
	 */
	public function explain(){
		$explain = $this->explain;
		if($this->isValid()){
			/**
			 * @var string $name
			 * @var ..\resource\Resource $param
			 */
			foreach($this->resParams as $name => $param){
				$explain = str_replace("%PARAM_$name",
					'<span class="resource" data-resource-id="' . $param->resId . '" ' .
					'data-resouce-type="' . str_replace("\\", "\\\\", $this->reqParams[$name]) . '">' .
					$param->explain . "</span>", $explain);
			}
			return "<span class='action runnable' data-runnable-id='{$this->getId()}'>" . $explain . "</span>";
		}
		foreach($this->reqParams as $name => $type){
			$explain = str_replace("%PARAM_$name",
				"<span class='resource' data-resource-type='" . str_replace("\\", "\\\\", $type) . "'>" .
				"<span class='invalid'>(Click to select)</span></span>",
				$explain);
		}
		return $explain;
	}
	/**
	 * @return string
	 */
	public function php(){
		$expr = $this->expr;
		/**
		 * @var string $name
		 * @var ..\resource\Resource $param
		 */
		foreach($this->resParams as $name => $param){
			$expr = str_replace("%PARAM_$name", $param->expr, $expr);
		}
		return $this->expr;
	}
}
