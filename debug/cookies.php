<?php
header("Content-Type: text/plain");
echo "Cookies:\r\n";
var_dump($_COOKIE);
echo "Session:\r\n";
session_start();
var_dump($_SESSION);
