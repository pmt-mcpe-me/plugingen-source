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

use pg\lib\Generator;

include_once __DIR__ . "/utils.php";
$proj = forceProject();

if(isset($_GET["dlName"])){
	redirect("download.php/" . $_GET["dlName"] . ".zip");
}

$gen = new Generator($proj);
$gen->generate();

$phar = new Phar($file = getNewTmp(".phar", "pg_"));
$phar->setSignatureAlgorithm(Phar::SHA1);
$phar->setStub('<?php __HALT_COMPILER();');
$phar->startBuffering();
foreach($gen->files as $f => $c){
	$phar->addFromString($f, $c);
}
$phar->compressFiles(Phar::GZ);
$phar->stopBuffering();
header("Content-Type: application/octet-stream");
echo file_get_contents($file);
unlink($file);
