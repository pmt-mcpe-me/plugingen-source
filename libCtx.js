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

function Resource(type, explanation, resId){
	this.type = type;
	this.explain = explanation;
	this.resId = resId;
}

function Context(){
	this.resources = [];
}
Context.prototype.addResource = function(res){
	if(res instanceof Resource){
		this.resources[res.resId] = res;
	}
};
