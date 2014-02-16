<h1 id="hash-title">
	<span title="<?php echo my_nick(); ?>@#<?php echo the_hash('echo'); ?>"> 
		<a href="?nick=&hash=<?php echo the_hash(); ?>"><?php
			?><?php echo shorten_nick( my_nick() ); ?><?php
		?></a><?php
		?><span class="title-accent">@</span><?php
		?><a href="?nick=<?php echo my_nick(); ?>&hash="><?php
			?><span class="title-accent">#</span><?php echo shorten_hash( the_hash('echo') ); ?><?php
		?></a>
	</span>
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