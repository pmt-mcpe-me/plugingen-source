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
if(!isset($_GET["name"])){
	redirect(".");
}
$name = strtolower($_GET["name"]);
if(!isset($proj->cmds[$name])){
	echo "<pre>Error: Cannot find such command.</pre>";
	http_response_code(404);
	die;
}
$cmd = $proj->cmds[$name];
?>
<html>
<head>
	<title>Edit Command | Plugin Generator</title>
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
				$.post("apiCmdPropUpdate.php", {
					"cmd": <?= json_encode($cmd->name) ?>,
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
		});
	</script>
	<link rel="stylesheet" type="text/css" href="style/normal.css">
</head>
<body>
<h1>Edit Command <i>/<?= $name ?></i></h1>
<hr>
<table>
	<tr>
		<th>Basic Information</th>
		<th>(Click to Edit)</th>
	</tr>
	<tr>
		<td class="left">Description:</td>
		<td class="right clickable editable" id="descEdit" data-property-type="desc"><?= htmlspecialchars($cmd->desc) ?></td>
	</tr>
	<tr>
		<td class="left">Usage:</td>
		<td class="right clickable editable" id="usageEdit" data-property-type="usage"><?= htmlspecialchars($cmd->usage) ?></td>
		<!-- TODO add edit dialog -->
	</tr>
</table>
<hr>
<h2>Executor</h2>
<?php

?>

<?php include "footer.php"; ?>
</body>
</html>
