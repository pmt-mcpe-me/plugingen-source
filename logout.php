<?php

require_once dirname(__FILE__) . "/utils.php";
forceProject();
unset($_SESSION["project"]);
redirect(".");
