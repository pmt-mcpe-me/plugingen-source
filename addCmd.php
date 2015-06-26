<?php
include_once dirname(__FILE__) . "/utils.php";
$proj = forceProject();
?>
<html>
<head>
	<title>Create Command | Plugin Generator</title>
	<?= INCLUDE_JQUERY ?>
	<link href="style/form.css" rel="stylesheet" type="text/css">
	<script>
		$(document).ready(function(){
			setTimeout("loop()", 50);
			$("#usage").focus(function(){
				var usage = $("#usage");
				if(usage.val() === ""){
					usage.val(usage.attr("placeholder"));
				}
			});
			$("#submit").click(function(){
				var name = $("#name");
				name.val(validate(name.val().trim()));
			});
		});
		function loop(){
			var usage = $("#usage");
			var name = $("#name");
			if(usage.val() === ""){
				usage.attr("placeholder", "/" + name.val() + " ");
			}
			var regex = /[ :]+/g;
			if(name.val().search(regex) != -1){
				name.val(name.val().replace(regex, "-"));
			}
			setTimeout("loop()", 50);
		}
		function validate(str){
			return str.replace(/[ :]+/g, "-");
		}
	</script>
</head>
<body>
<h1>Add New Plugin Command</h1>
<hr>
<?php if(isset($_GET["err"])): ?>
	<div>
		<a class="error"><?= $_GET["err"] ?></a>
	</div>
<?php endif ?>
<form action="addCmdCallback.php" method="post">
	<table>
		<tr>
			<td class="left"><label for="name">Command Name:</label></td>
			<td class="right">/ <input type="text" name="name" class="codebox" placeholder="do not put space or colons (:) here" id="name" autofocus></td>
		</tr>
		<tr>
			<td class="left"><label for="desc">Descrption:</label></td>
			<td class="right"><input type="text" name="desc" class="textbox" placeholder=""></td>
		</tr>
		<tr>
			<td class="left"><label for="usage">Usage:</label></td>
			<td class="right"><input type="text" name="usage" class="textbox" placeholder="" id="usage" value=""></td>
		</tr>
	</table>
	<p>
		<input class="button" type="submit" id="submit" value="Continue">
	</p>
</form>
</body>
</html>
