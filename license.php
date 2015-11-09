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

require_once dirname(__FILE__) . "/utils.php";

if(isset($_REQUEST["accept_pg_license"]) and $_REQUEST["accept_pg_license"] === "true"){
	$_SESSION["accept_pg_license"] = true;
	redirect(".");
}
if(!isset($_SESSION["accept_pg_license"])):
?>
<html>
<head>
	<title>Terms of Service</title>
</head>
<body>
<pre>
This website is provided completely free of charge. Meanwhile, we are not to be liable for any illegal activities (such as copyright breaching) done using this website.
This service, PocketMine-MP Plugin Generator, is provided without any warranty. We are not to be liable for any loss, economic, property or otherwise, caused directly or indirectly by this website or the data (including but not limited to generated *.phar files) from it.
This website uses cookies to provide a data store for you.

This website is partially open-source on <a href="https://github.com/PEMapModder/plugingen-source">GitHub</a>. The license for the source can be found in the <a href="https://github.com/PEMapModder/plugingen-source/blob/master/LICENSE">LICENSE</a> file.

By continuing using this website, you agree with the above terms. Click the button below to continue.
</pre>
<form action="license.php" method="post">
	<input type="hidden" name="accept_pg_license" value="true">
	<input type="submit" value="Continue">
</form>
</body>
</html>
<?php
exit;
endif;
?>
