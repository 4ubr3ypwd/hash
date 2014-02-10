<h1 id="hash-title">
	<a href="?nick=<?php the_nick('echo'); ?>"><?php the_nick('echo'); ?></a>@#<a href="?hash=<?php the_hash('echo'); ?>"><?php the_hash('echo'); ?></a>
</h1>

<div id="messages">
	<?php include "hash-table.html.php"; ?>
</div>

<div id="message-area">
	<input type="text" id="message">
</div>