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

include_once __DIR__ . "/utils.php";
$proj = forceProject();
?>
<html>
<head>
	<title>Editing <?= $proj->getDesc()->getName() ?> | Plugin Generator</title>
	<?= INCLUDE_JQUERY ?>
	<script>
		$(document).ready(function(){
			$(".editable").click(function(){
				var $this = $(this);
				var prop = $this.attr("data-property-type");
				if(typeof prop === typeof undefined){
					return;
				}
				var value = $this.text();
				if(value === "(None)"){
					value = "";
				}
				var newValue = prompt("Please enter the new value for " + prop + ":", value);
				if(newValue === value){
					return;
				}
				$.post("apiProjPropUpdate.php", {
					"prop": prop,
					"val": newValue
				}, function(data){
					if(data.status){
						$this.html(data.newValue.length == 0 ? "<span class='invalid'>(None)</span>" : data.newValue);
					}else{
						alert("Error: " + data.error);
					}
				});
			});
			$("button.delete-cmd").click(function(){
				var $this = $(this);
				var cmd = $this.attr("data-cmd-name");
				if(typeof cmd === typeof undefined){
					return;
				}
				if(prompt("Please type the name of the command ("+cmd+") again to confirm!") == cmd){
					$.post("apiCmdDelete.php", {
						cmd: cmd
					}, function(data){
						if(!data.status){
							alert("ERROR: " + data.error);
						}else{
							$("tr[data-cmd-name='" + cmd + "']").remove();
						}
					})
				}else{
					alert("Command deletion aborted.");
				}
			})
		});
	</script>
	<link type="text/css" rel="stylesheet" href="style/normal.css">
</head>
<body>
<h1>Plugin Project: <i><?= htmlspecialchars($proj->getDesc()->getFullName()) ?></i></h1>
<hr>
<table>
	<tr>
		<th>Basic Information</th>
		<th>(Click to Edit)</th>
	</tr>
	<tr>
		<td class="left">Version:</td>
		<td class="right clickable editable" id="version" data-property-type="version"><?= htmlspecialchars($proj->getDesc()->getVersion()) ?></td>
	</tr>
	<tr>
		<td class="left">Website:</td>
		<td class="right clickable editable" id="website" data-property-type="website"><?= strlen($proj->getDesc()->getWebsite()) > 0 ? htmlspecialchars($proj->getDesc()->getWebsite()) : "<span class='invalid'>(None)</span>" ?></td>
	</tr>
</table>
<hr>
<h2>Commands</h2>
<table class="headers">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Usage</th>
		<th>Aliases</th>
		<th>Permission</th>
		<th class="delete">Delete</th>
	</tr>
	<?php foreach($proj->cmds as $cmdName => $cmd): ?>
		<tr data-cmd-name="<?= $cmdName ?>">
			<td><a href="editCmd.php?name=<?= urlencode($cmd->name) ?>"><?= htmlspecialchars($cmd->name) ?></a></td>
			<td><?= htmlspecialchars($cmd->desc) ?></td>
			<td><?= htmlspecialchars($cmd->usage) ?></td>
			<td><?= htmlspecialchars(implode(", ", $cmd->aliases)) ?></td>
			<td><?= htmlspecialchars($cmd->permission) ?></td>
			<td>
				<button class="button delete-cmd" data-cmd-name="<?= $cmdName ?>">
					<span class="delete">Delete</span>
				</button>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<button class="button" onclick="window.location = 'addCmd.php';">Add command</button>
<hr>
<h2>Events</h2>
<table class="headers">
	<tr>
		<th>Event</th>
		<th>Event priority</th>
		<th>Not to handle event if another plugin cancelled it?</th>
		<th>Edit</th>
	</tr>
	<?php
	foreach($proj->events as $evt):
		?>
		<tr>
			<td></td>
		</tr>
	<?php endforeach; ?>
</table>
<hr>
<?php include "footer.php"; ?>
<div id="editDialog" title="Edit " class="dialogs">
	<p>New value:</p>
	<input type="text" id="newValueInput" class="undefined">
</div>
</body>
</html>
