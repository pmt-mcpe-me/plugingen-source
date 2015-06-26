<?php
use pg\lib\Generator;

include_once dirname(__FILE__) . "/utils.php";
$proj = forceProject();
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
