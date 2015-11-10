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

include_once __DIR__ . "/utils.php";

if(isset($_GET["reset"])){
	setProject(null);
}
if(getProject() instanceof Project){
	include "main.php";
}else{
	include "new.php";
}
