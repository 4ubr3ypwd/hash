<?php include "hash.php"; ?>
<!DOCTYPE html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		var php_ = {
			nick: '<?php the_nick('echo'); ?>',
			_hash: '<?php h_hash('echo'); ?>'
		};
	</script>
	<script src="hash.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		if(
			h_supplied_nick()
			&& h_supplied_hash()
		){
			include "in-hash.php";
		}else{
			include "get-hash.php";
		}
	?>
</body>
</html>