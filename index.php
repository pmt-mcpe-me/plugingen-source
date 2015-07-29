<?php
use pg\lib\Project;

include_once dirname(__FILE__) . "/utils.php";

if(isset($_GET["reset"])){
	setProject(null);
}
if(getProject() instanceof Project){
	include "main.php";
}else{
	include "new.php";
}
