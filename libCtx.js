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

var runtimeAutoId = 0;

//noinspection JSUnusedGlobalSymbols
/**
 * Toggles a spoiler.
 * @param id
 * @returns {boolean} true if spoiler is opened, false if spoiler is closed
 */
function switchSpoiler(id){
	var el = $(".spoiler[data-spoiler-name='" + id + "']");
	var opener = $(".spoiler-opener[data-spoiler-name='" + id + "']");
	if(el.css("display") === "none"){
		el.css("display", "block");
		opener.text("Hide");
		return true;
	}
	el.css("display", "none");
	opener.text("Show");
	return false;
}

function Resource(type, explanation, resId){
	this.type = type;
	this.explain = explanation;
	this.resId = resId;
}

Runnable = {
	writeHTML: function(){
		throw new Error("Child does not implement writeHTML function");
	}
};

function Context(){
	this.resources = {};
}
Context.prototype = Runnable;

Context.prototype.addResource = function(res){
	this.resources[res.resId] = res;
};
Context.prototype.writeHTML = function(element){
	var id = runtimeAutoId++;
	element.addClass("spoiler");
	element.attr("data-spoiler-name", id);
	element.css("display", "none");
	element.before('<button class="spoiler-opener" onclick="switchSpoiler(' + id + ')" data-spoiler-name="' + id + '">Show</button>');
	element.append("<h3>Actions</h3>");

};
