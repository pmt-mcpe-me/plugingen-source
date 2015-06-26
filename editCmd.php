<?php
include_once dirname(__FILE__) . "/utils.php";
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
		<td class="right clickable editable" id="descEdit"><?= htmlspecialchars($cmd->desc) ?></td>
	</tr>
	<tr>
		<td class="left">Usage:</td>
		<td class="right clickable editable" id="usageEdit"><?= htmlspecialchars($cmd->usage) ?></td>
		<!-- TODO add edit dialog -->
	</tr>
</table>
<hr>
<h2>Executor</h2>

<?php include "footer.php"; ?>
</body>
</html>
