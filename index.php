<?php
use pg\lib\Project;

include_once dirname(__FILE__) . "/utils.php";

if(!IS_PG_READY and $_SERVER["REMOTE_ADDR"] !== "119.247.51.252"){
	header("Content-Type: text/plain");
	echo "Sorry, the plugin generator is under development/maintenance. This generator is expected to become available again on " . date("d-m-Y H:i:s (\\G\\M\\T P)", ESTIMATED_READY_TIME);
	die;
}

if(isset($_GET["reset"])){
	setProject(null);
}
if(getProject() instanceof Project){
	include "main.php";
}else{
	include "new.php";
}
