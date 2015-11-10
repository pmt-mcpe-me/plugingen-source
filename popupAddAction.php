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

use pg\lib\exe\Runnable;

include_once __DIR__ . "/utils.php";

forceProject();

$runnableId = $_REQUEST["parent"];
if(!isset($_SESSION["runnables"][$runnableId])){
	redirect(".");
}
/** @var Runnable $runnable */
$runnable = $_SESSION["runnables"][$runnableId];
?>
<html>
<head>
	<title>Add Action</title>
</head>
<body>
<h1 class="title">Choose an action to add</h1>
<?php
foreach($runnable->getContext()->getResources() as $res){
	foreach($res->getActions() as $i => $action){
		?>
		<input type="radio" name="type" value="<?= $res->resId ?>-<?= $i ?>">
		<?= $action->explain() ?>
		<br>
		<?php
	}
}
?>
</body>
</html>
