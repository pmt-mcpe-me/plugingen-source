<?php
use pg\lib\Event;

require_once dirname(__FILE__) . "/utils.php";
?>
<html>
<head>
	<link rel="stylesheet" href="style/normal.css" type="text/css">
	<link rel="stylesheet" href="style/form.css" type="text/css">
	<?= INCLUDE_JQUERY ?>
	<script>
		$(document).ready(function(){
			var hidden = true;
			$(".spoiler").each(function(){
				var link = $(this).attr("data-spoiler-link");
				var content = $(".spoiler-content[data-spoiler-link=" + link + "]");
				content.prop("hidden", true);
				$(this).click(function(){
					hidden = !hidden;
					content.prop("hidden", hidden);
				});
			});
		});
	</script>
	<style>
		body{
			text-align: left;
		}
	</style>
</head>
<body>
<form method="get">
	<?php
	$i = 0;
	function echoTree($array){
		global $i;
		foreach($array as $k => $v){
			if(is_array($v)){
				$myIndice = $i++;
				echo "<div class='spoiler' data-spoiler-link='$myIndice'>$k: <button type='button' class='button'>Open</button></div>";
				echo "<ul class='spoiler-content' data-spoiler-link='$myIndice'>";
				echoTree($v);
				echo "</ul>";
			}else{
				$short = end(explode("\\", $k));
				echo "<li><input type='radio' name='event' value='$k'><strong>$short</strong>: $v</li>";
			}
		}
	}
	$array = ["Events" => Event::EVENT_EXPLANATIONS];
	echoTree($array);
	?>
	<input type="submit" class="button">
</form>
</body>
</html>
