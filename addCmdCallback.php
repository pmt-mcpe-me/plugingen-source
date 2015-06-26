<?php
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
