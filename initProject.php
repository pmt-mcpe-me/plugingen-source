<?php
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
