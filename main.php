<?php
include_once dirname(__FILE__) . "/utils.php";
$proj = forceProject();
?>
<html>
<head>
	<title>Editing <?= $proj->getDesc()->getName() ?> | Plugin Generator</title>
	<?= INCLUDE_JQUERY ?>
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
		<td class="right clickable editable" id="version"><?= htmlspecialchars($proj->getDesc()->getVersion()) ?></td>
	</tr>
	<tr>
		<td class="left">Website:</td>
		<td class="right clickable editable" id="website"><?= htmlspecialchars($proj->getDesc()->getWebsite()) ?></td>
	</tr>
</table>
TODO
<hr>
<h2>Commands</h2>
<table class="headers"><tr>
		<th>Name</th>
		<th>Description</th>
		<th>Usage</th>
		<th>Aliases</th>
		<th>Permission</th>
	</tr>
	<?php
	foreach($proj->cmds as $cmd):
		?>
		<tr>
			<td><?= htmlspecialchars($cmd->name) ?></td>
			<td><?= htmlspecialchars($cmd->desc) ?></td>
			<td><?= htmlspecialchars($cmd->usage) ?></td>
			<td><?= htmlspecialchars(implode(", ", $cmd->aliases)) ?></td>
			<td><?= htmlspecialchars($cmd->permission) ?></td>
		</tr>
	<?php endforeach; ?>
</table>
<button class="button" onclick="window.location = 'addCmd.php'">Add command</button>
<hr>
<?php include "footer.php"; ?>
<div id="editDialog" title="Edit " class="dialogs">
	<p>New value:</p>
	<input type="text" id="newValueInput" class="undefined">
</div>
</body>
</html>
