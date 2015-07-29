<?php
require_once dirname(__FILE__) . "/utils.php";
$proj = forceProject();
?>
<html>
<head>
	<title>Reset Plugin | Plugin Generator</title>
	<link rel="stylesheet" type="text/css" href="style/normal.css">
	<?= INCLUDE_JQUERY ?>
	<script>
		var nameConfirm;
		var checkName = function(){
			var input = nameConfirm.val();
			if(input == <?= json_encode($proj->getDesc()->getName()) ?>){
				var submit = $("#submit");
				submit.prop("disabled", false);
				submit.click(function(){
					window.location.replace("logout.php");
				});
			}
			setTimeout(checkName, 100);
		}
		$(document).ready(function(){
			nameConfirm = $("#nameConfirm");
			setTimeout(checkName, 100);
		});
	</script>
</head>
<body>
<p>
	Are you really sure to reset the project? Your settings will be lost <em>forever</em>!<br>
	Type the name of the project (<strong><?= $proj->getDesc()->getName() ?></strong>) to confirm.
</p>
<input type="text" id="nameConfirm">
<button disabled type="button" id="submit">Confirm reset</button>
</body>
</html>
