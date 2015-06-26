<?php
include_once dirname(__FILE__) . "/utils.php";
forceProject();
?>
<table style="width: 100%">
	<tr>
		<th style="text-align: left">
			<form action="download.php" method="get">
				<label for="dlName">
					<input type="submit" value="Download plugin phar build"
					       style="background-color: transparent; border: none; font-family: Verdana, sans-serif; font-size: 15px; font-weight: bold; text-decoration: underline; color: blue; cursor: hand">
						       with filename:</label>
				<input type="text" name="dlName">.zip

</form>
		</th>
		<th style="text-align: right; border-left: solid #808080;"><a href="viewSrc.php">View generated source</a></th>
	</tr>
</table>
