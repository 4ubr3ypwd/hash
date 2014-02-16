<?php

/**
 * Watch for the nick, and if it's in $_GET
 * store it in $_SESSION so the url is shareable.
 */
function the_nick_url(){
	if( isset($_GET['nick']) ){
		$_SESSION['nick']=my_nick();
		header( "Location: ?hash=".the_hash() );
	}

	// !todo 
	// Make it so the hash and the nick 
	// do not have bad chars and re-load the page
	// without the bad chars
	// 
	// Consider:
	// 
	// they might want "I'm" so we want to be
	// able to keep the ' but not have it break
	// JS or PHP quote issues.
	// 
	// Maybe clean bad chars
	// 
}

?>