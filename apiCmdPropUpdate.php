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

header("Content-Type: application/json");

if(!isset($_REQUEST["cmd"], $_REQUEST["prop"], $_REQUEST["val"])){
	echo json_encode(["status" => false, "error" => "Missing request field"]);
	return;
}

if(getProject() === null){
	echo json_encode(["status" => false, "error" => "Session timed out"]);
	return;
}

$proj = getProject();
if(!isset($proj->cmds[strtolower($_REQUEST["cmd"])])){
	echo json_encode(["status" => false, "error" => "Command does not exist"]);
	return;
}
$cmd = $proj->cmds[strtolower($_REQUEST["cmd"])];
$newValue = $_REQUEST["val"];
switch($_REQUEST["prop"]){
	case "description":
	case "desc":
		$oldValue = $cmd->desc;
		$cmd->desc = $newValue;
		echo json_encode([
			"status" => true,
			"oldValue" => $oldValue,
			"newValue" => $newValue,
		]);
		return;
	case "usage":
		$oldValue = $cmd->usage;
		$cmd->usage = $newValue;
		echo json_encode([
			"status" => true,
			"oldValue" => $oldValue,
			"newValue" => $newValue,
		]);
		return;
}
