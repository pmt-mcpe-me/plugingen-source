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

var contexts = [];

function Resource(type, explanation, resId){
	this.type = type;
	this.explain = explanation;
	this.resId = resId;
}

function Context(){
	this.resources = {};
}

Context.prototype.addResource = function(res){
	this.resources[res.resId] = res;
};

/*
function Runnable(id, explain){
	this.id = id;
	this.explain = explain;
}
Runnable.prototype.getExplain = function(){
	return this.explain;
};
function RunnableGroup(id, explain){
	this.id = id;
	this.explain = explain;
	this.children = {};
}
RunnableGroup.prototype = Runnable;
RunnableGroup.prototype.getExplain = function(){
	var child;
	var out = this.explain + "<ol>";
	for(child in this.children){
		out += "<li>" + child.getExplain() + "</li>";
	}
	return out + "</ol>";
};
*/
