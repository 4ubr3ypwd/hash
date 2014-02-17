<?php

function the_nick_url(){
	
	/**
	 * Strip the nick from the url so it's shareable.
	 */
	if( isset($_GET['nick']) ){
		$_SESSION['nick'] = $_GET['nick'];
		header( "Location: ?hash=" . $_GET['hash'] );
	}

}

?>