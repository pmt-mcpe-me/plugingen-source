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

const IS_PG_READY = true;
const ESTIMATED_READY_TIME = 1438391005;
const SERVER_PATH = "/var/www/";
const SERVER_DOCS = "/var/www/html/";
const SERVER_TMP = "/var/www/tmp/";
const INCLUDE_JQUERY = '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><script src="//code.jquery.com/jquery-1.10.2.js"></script><script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';

if(!IS_PG_READY and $_SERVER["REMOTE_ADDR"] !== "14.199.247.137"){
	header("Content-Type: text/plain");
	echo "Sorry, the plugin generator is under development/maintenance. This generator is expected to become available again on " . date("d-m-Y H:i:s (\\G\\M\\T P)", ESTIMATED_READY_TIME);
	die;
}

if(!defined("ACCEPT_SUBPATH")){
	if(isset($_SERVER["PATH_INFO"])){
		redirect($_SERVER["SCRIPT_NAME"]);
	}
}
spl_autoload_register(function($class){
	if(is_file($file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php")){
		require_once $file;
		if(!class_exists($class, false)){
			if(!isset($DONT_AUTOLOAD) or $DONT_AUTOLOAD === false){
				throw new RuntimeException("Class $class not found");
			}
		}
	}else{
		throw new RuntimeException("Class $class not found");
	}
}, true, true);
session_start();
require_once dirname(__FILE__) . "/license.php";

/**
 * @return Project|null
 */
function getProject(){
	return isset($_SESSION["project"]) ? $_SESSION["project"] : null;
}
/**
 * @param Project|null $project
 */
function setProject($project){
	$_SESSION["project"] = $project;
}

/**
 * @return Project
 */
function forceProject(){
	$project = getProject();
	if(!($project instanceof Project)){
		redirect("/pg/");
	}
	return $project;
}
function redirect($url){
	header("Location: $url");
	exit;
}
function getNewTmp($suffix, $prefix = ""){
	$dir = SERVER_TMP;
	if(!is_dir($dir)){
		mkdir($dir);
	}
	for($i = 6; is_file($file = $dir . $prefix . $i . $suffix); $i++);
	return $file;
}

function html_var_dump(...$var){
	echo "<pre>";
	var_dump(...$var);
	echo "</pre>";
}
function html_print_r($var){
	echo "<pre>";
	echo htmlspecialchars(print_r($var, true));
	echo "</pre>";
}
function notNull(...$vars){
	foreach($vars as $var){
		if($var === null){
			return false;
		}
	}
	return true;
}
