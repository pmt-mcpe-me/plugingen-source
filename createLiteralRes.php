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

forceProject();

include_once __DIR__ . "/utils.php";
$ctxId = (int) $_REQUEST["ctx"];
if(!isset($_SESSION["contexts"][$ctxId])){
	redirect("./");
}
$ctx = $_SESSION["contexts"][$ctxId];
?>
<html>
<head>
	<title>New resource</title>
	<?= INCLUDE_JQUERY ?>
	<script>
		var type = "number";
		var value = null;
		function onSubmit(){
			if(value === null){
				value = $("#valueInput").val();
				if(type == "number"){
					value = parseInt(value);
				}
			}
			$.post("apiCtxResCreateLiteral.php", {
				ctx: <?= $ctxId ?>,
				type: type,
				literal: value
			}, function(data){
				if(!data.status){
					alert("ERROR: " + data.status);
					return;
				}
				var resId = data.resId;
				window.opener.addLiteral();
			});
		}
	</script>
</head>
<body>
<h1 class="title">Create new resource</h1>

<form>
	<select id="type-select">
		<option value="number" onselect='$("#valueInput").attr("type", "number"); type = "number";' selected>Number
		</option>
		<option value="string" onselect='$("#valueInput").attr("type", "text"); type = "string";'>Text</option>
		<option value="boolean" onselect='type = "boolean"; value = "true";'>True</option>
		<option value="boolean" onselect='type = "boolean"; value = "false";'>False</option>
	</select>
	<br>
	<input type="number" id="valueInput">
</form>
</body>
</html>
