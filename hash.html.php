<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hash</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		var php_ = {
			nick: '<?php the_nick('echo'); ?>',
			_hash: '<?php the_hash('echo'); ?>',
			interval: <?php the_interval('echo'); ?>
		};
	</script>
	<script src="hash.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		if(
			the_nick()
			&& the_hash()
		){
			include "in-hash.html.php";
		}else{
			include "get-hash.html.php";
		}
	?>
</body>
</html>