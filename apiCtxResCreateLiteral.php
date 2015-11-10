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

use pg\lib\exe\Context;
use pg\lib\exe\resource\BooleanResource;
use pg\lib\exe\resource\NumberResource;
use pg\lib\exe\resource\StringResource;

include_once __DIR__ . "/utils.php";

header("Content-Type: application/json");

if(!isset($_REQUEST["ctx"], $_REQUEST["type"], $_REQUEST["literal"])){
	echo json_encode(["status" => false, "error" => "Missing request field"]);
	return;
}

$proj = getProject();
if($proj === null){
	echo json_encode(["status" => false, "error" => "Session timed out"]);
	return;
}
if(!isset($_SESSION["contexts"][$_REQUEST["ctx"]])){
	echo json_encode(["status" => false, "error" => "Undefined context"]);
	return;
}

/** @var Context $ctx */
$ctx = $_SESSION["contexts"][$_REQUEST["ctx"]];

$type = $_REQUEST["type"];
$literal = $_REQUEST["literal"];
if($type === "number"){
	if(!is_numeric($literal)){
		echo json_encode(["status" => false, "error" => "Malformed number - please enter a valid number!"]);
		return;
	}
	$value = preg_match('#^[0-9]+$#', $literal) ? intval($literal) : floatval($literal);
	$res = new NumberResource(beautified_var_export($value, true), $value);
}elseif($type === "string"){
	$res = new StringResource(beautified_var_export($literal, true), $literal);
}elseif($type === "bool" or $type === "boolean"){
	if($literal === "true" or $literal === "on"){
		$value = true;
	}elseif($literal === "false" or $literal === "off"){
		$value = false;
	}else{
		echo json_encode(["status" => false, "error" => "Invalid boolean literal"]);
		return;
	}
	$res = new BooleanResource(beautified_var_export($value, true), $value);
}
if(!isset($res)){
	echo json_encode(["status" => false, "error" => "Unknown type $type"]);
	return;
}

$ctx->addResource($res);
echo json_encode(["status" => true, "resId" => $res->resId]);
