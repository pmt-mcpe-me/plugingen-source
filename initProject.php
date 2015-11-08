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

use pg\lib\Project;

include_once dirname(__FILE__) . "/utils.php";
if(getProject() instanceof Project){
	redirect(".");
	die;
}
if(!isset($_POST["name"], $_POST["version"], $_POST["authors"], $_POST["website"])){
	redirect(".");
	die;
}

try{
	$project = new Project($_POST["name"], $_POST["version"], preg_split("/[ \t]*,[ \t]*/", $_POST["authors"], -1, PREG_SPLIT_NO_EMPTY));
	$project->getDesc()->website = $_POST["website"];
}catch(Exception $e){
	header("Location: .?err=" . urlencode("Error: {$e->getMessage()}"));
	die;
}
setProject($project);
header("Location: .");
