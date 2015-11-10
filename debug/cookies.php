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

spl_autoload_register(function ($class){
	if(is_file($file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php")){
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

header("Content-Type: text/plain");
if($_SERVER["REMOTE_ADDR"] !== "14.199.243.132"){
	http_response_code(403);
	echo "Forbidden";
	return;
}
echo "Cookies:\r\n";
var_dump($_COOKIE);
echo "Session:\r\n";
session_start();
var_dump($_SESSION);
