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

use pg\lib\exe\Context;
use pg\lib\exe\runnable\Action;

class PlayerResource extends EntityResource{
	public function getChildResoruces(){
		return array_merge(parent::getChildResources(), [
			new StringResource($this->expr . "->getName()", "the login name of $this->explain"),
			new StringResource($this->expr . "->getDisplayName()", "the chat display name of $this->explain"),
			new StringResource($this->expr . "->getNameTag()", "the name tag of $this->explain"),
			new BooleanResource($this->expr . "->isOp()", "$this->explain is an op"),
		]);
	}
	public function getActions(Context $context){
		return array_merge(parent::getActions(), [
			new Action($this->expr . '->sendMessage(%PARAM_message%);', "Send %PARAM_message% to $this->explain in the form of a chat message", [
				"message" => StringResource::class,
			]),
			new Action($this->expr . '->sendTip(%PARAM_message%);', "Send %PARAM_message% to $this->explain in the form of a tip", [
				"message" => StringResource::class,
			]),
			new Action($this->expr . '->sendPopup(%PARAM_message%);', "Send %PARAM_message% to $this->explain in the form of a popup", [
				"message" => StringResource::class,
			]),
			new Action($this->expr . '->kick(%PARAM_reason%, false);', "Kick $this->explain with the reason %PARAM_reason%", [
				"reason" => StringResource::class,
			]),
			new Action($this->expr . '->setHealth(%PARAM_halfhearts%);', "Set the health of $this->explain to %PARAM_halfhearts% halfhearts", [
				"halfhearts" => NumberResource::class,
			]),
			new Action($this->expr . '->teleport(%PARAM_target%);', "Teleport $this->explain to %PARAM_target%", [
				"target" => Vector3Resource::class,
			]),
			new Action($this->expr . '->getInventory()->addItem(%PARAM_item%', "Add  %PARAM_item% to inventory of $this->explain", [
				"item" => ItemResource::class,
			]),
		]);
	}
}
