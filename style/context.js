
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

function registerSpoiler(el){
	el.addClass("spoiler");
	var id = runtimeAutoId++;
	el.before("<button class='button spoiler-opener' data-spoiler-name='" + id + "' onclick='switchSpoiler(" + id + ")'>Show</button>");
	el.attr("data-spoiler-name", id);
	el.css("display", "none");
}

//noinspection JSUnusedGlobalSymbols
/**
 * Toggles a spoiler.
 * @param id
 * @returns {boolean} true if spoiler is opened, false if spoiler is closed
 */
var switchSpoiler = function(id){
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
};
var addAction = function(id){
	window.open("popupAddAction.php?parent=" + id, "addAction", "menubar=0,status=0");
};

$(document).ready(function(){
	$(".runnable-group").each(function(){
		var $this = $(this);
		var id = $this.attr("data-runnable-id");
		if($this.parents(".runnable").length > 0){
			registerSpoiler($this);
		}
		$this.append('<button class="runnable-add-action button" onclick="addAction(' + id + ')">Add action</button>');
	});
});

var addActionCallback = function(id, string){
	$(".runnable-group[data-runnable-id='" + id + "']").after(string);
};
