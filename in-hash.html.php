<h1 id="hash-title">
	<span title="<?php e_html( my_nick() ); ?>#<?php e_html( the_hash() ); ?>"> 
		<a href="?nick=&hash=<?php e_html( the_hash() ); ?>"><?php
			?><?php 
				e_html( shorten_nick( my_nick() ) );
			?><?php
		?></a><?php
		?><a href="?nick=<?php e_html( my_nick() ); ?>&hash="><?php
			?><span class="title-accent">@</span><?php 
				e_html( shorten_hash( the_hash() ) );
			?><?php
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