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

use pg\lib\exe\Context;

include_once __DIR__ . "/utils.php";

forceProject();
?>
<html>
<head>
	<title>Edit executor</title>
	<?= INCLUDE_JQUERY ?>
	<script src="libCtx.js"></script>
	<script>
		var contexts = {};
		<?php
		/**
		 * @var int $ctxId
		 * @var Context $context
		 */
		foreach($_SESSION["contexts"] as $ctxId => $context): ?>
			var context;
			contexts[<?= json_encode((string) $ctxId) ?>] = context = new Context();
			<?php foreach($context->getResources() as $res): ?>
				context.addResource(new Resource(<?= json_encode(get_class($res)) ?>, <?= json_encode($res->explain) ?>, <?= json_encode($res->resId) ?>));
			<?php endforeach; ?>
		<?php endforeach; ?>
	</script>
	<script src="style/context.js"></script>
</head>
<body>

</body>
</html>
