<?php

/**
 * Classes that are put on individual
 * nicks.
 */
function the_nick_classes($nick){
	
	/**
	 * Add some classes to an element if the nick
	 * is the same as the message being displayed.
	 *
	 * Allows us to use CSS to make that person's
	 * nick highlighted.
	 */
	if(my_nick() == $nick){
		return " nicksame";
	}
}

/**
 * Classes that are put on individual messages
 */
function message_classes($message_id){
	if( isset($_GET['highlight_id']) ){

		$highlight_id = str_replace("#",'',$_GET['highlight_id']);

		if($highlight_id == $message_id){
			return "highlight";
		}

	}
}

?>