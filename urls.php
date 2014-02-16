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
}

?>