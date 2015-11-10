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

use pg\lib\ClassGenerator;
use pg\lib\exe\Context;
use pg\lib\exe\resource\BooleanResource;
use pg\lib\exe\Runnable;

class Condition extends Runnable{
	/** @var BooleanResource */
	private $condition;

	/** @var Runnable[] */
	private $runnables = [];

	public function __construct(Context $parentCtx, BooleanResource $condition){
		parent::__construct($parentCtx, getNextGlobalId());
		$this->condition = $condition;
		$parentCtx->addChild($this->getContext());
	}

	public function addRunnable(Runnable $runnable){
		if(!$runnable->isValid()){
			throw new \RuntimeException("Runnable is invalid");
		}
		$this->runnables[$runnable->getId()] = $runnable;
	}

	public function explain(){
		$out = "<span class='condition runnable-group runnable' data-runnable-id='{$this->getId()}'>" .
			"If " . $this->condition->explain . ": <ol>";
		foreach($this->runnables as $run){
			$out .= "<li>" . $run->explain() . "</li>";
		}
		return $out . "</ol></span>";
	}
	public function php(){
		$out = "if({$this->condition->expr}){";
		$out .= ClassGenerator::STANDARD_EOL;
		foreach($this->runnables as $runnable){
			$out .= ClassGenerator::STANDARD_TAB;
			$out .= str_replace(ClassGenerator::STANDARD_EOL, ClassGenerator::STANDARD_EOL . ClassGenerator::STANDARD_TAB, $runnable->php());
			$out .= ClassGenerator::STANDARD_EOL;
		}
		return $out . "}";
	}
}
