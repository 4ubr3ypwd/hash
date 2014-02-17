<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hash</title>
	<link rel="icon" type="image/png" href="ico.png" />
	<link rel="apple-touch-icon" type="image/png" href="ico.png">
	<script src="jquery-1.11.0.min.js"></script>
	<?php php2js(); ?>
	<script src="hash.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		/**
		 * If we have both the nick and hash, 
		 * load the hash page.
		 */
		if(
			my_nick()
			&& the_hash()
		){
			include "in-hash.html.php";
		
		/**
		 * If we don't have both, load something to get them.
		 */
		}else{
			include "get-hash.html.php";
		}
	?>
</body>
</html>