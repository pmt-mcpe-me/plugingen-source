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
