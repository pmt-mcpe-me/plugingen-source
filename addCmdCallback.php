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

use pg\lib\Command;

include_once dirname(__FILE__) . "/utils.php";
$proj = forceProject();
if(!isset($_POST["name"], $_POST["desc"], $_POST["usage"])){
	redirect("addCmd.php");
}
$name = $_POST["name"];
if(strpos($name, " ") !== false or strpos($name, ":") !== false){
	redirect("addCmd.php");
}
$desc = $_POST["desc"];
$usage = $_POST["usage"];
$proj->cmds[strtolower($name)] = $cmd = new Command($name, $desc, $usage);
redirect("editCmd.php?name=" . urlencode($name));
