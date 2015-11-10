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

$("div.context").each(function(){
	var $this = $(this);
	var ctxId = $this.attr("context-id");
	var ctx = contexts[ctxId];
	ctx.writeHTML($this);
});
