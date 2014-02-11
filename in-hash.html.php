<h1 id="hash-title">
	<a href="?nick=&hash=<?php the_hash('echo'); ?>"><?php the_nick('echo'); ?></a>@<a href="?nick=<?php the_nick('echo'); ?>&hash=">#<?php the_hash('echo'); ?></a>
</h1>

<div id="messages">
	<?php include "hash-table.html.php"; ?>
</div>

<div id="message-area">
	<input type="text" id="message">
</div>

<audio id="notify">
	<source src="notify.mp3" type="audio/mpeg">
</audio>

<div id="js_htmlifier"></div>