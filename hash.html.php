<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hash</title>
	<link rel="icon" type="image/png" href="ico.png" />
	<link rel="apple-touch-icon" type="image/png" href="ico.png">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		/**
		 * Variables that will be accessible to JS
		 */
		var php2js = {
			the_nick: '<?php echo my_nick(); ?>',
			the_hash: '<?php echo the_hash(); ?>',
			the_interval: <?php echo the_interval(); ?>
		};
	</script>
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