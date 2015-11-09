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

include_once dirname(__FILE__) . "/utils.php";
forceProject();
?>
<hr>
<p>
	<button onclick="location = '/pg';" class="button">Back</button>
</p>
<table style="width: 100%">
	<tr>
		<th style="text-align: left">
			<form action="download.php" method="get">
				<label for="dlName">
					<input type="submit" value="Download plugin phar build" style="
						background-color: transparent;
						border: none;
						font-family: Verdana, sans-serif;
						font-size: 15px;
						font-weight: bold;
						text-decoration: underline;
						color: blue;
						cursor: hand
						">
					with filename:
				</label>
				<input type="text" name="dlName">.zip

</form>
		</th>
		<th style="text-align: right; border-left: solid #808080;"><a href="viewSrc.php">View generated source</a></th>
	</tr>
	<tr>
		<th />
		<th style="text-align: right; border-left: solid #808080;">
			<a href="prelogout.php">Reset project</a>
		</th>
	</tr>
</table>
