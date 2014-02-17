<?php

/**
 * Filter the nick before it's stored in the DB.
 */
function escaped_nick($nick){

	/**
	 * Take out any non utf-8
	 * crazy chars
	 */
	$nick = clean_ascii($nick);

	/**
	 * Escape values so that when
	 * they are injected into JS
	 * they do not cause escaping 
	 * errors.
	 */
	$nick = mysql_real_escape_string($nick);

	return $nick;
}

/**
 * Filter the hash before it's stored
 * in the DB
 */
function escaped_hash($hash){

	/**
	 * Take out any non utf-8
	 * crazy chars
	 */
	$hash = clean_ascii($hash);

	/**
	 * Escape values so that when
	 * they are injected into JS
	 * they do not cause escaping 
	 * errors.
	 */
	$hash = mysql_real_escape_string($hash);

	return $hash;
}

/**
 * Clean messages before they are stored in the DB.
 */
function filter_message_before_db($text){
	/**
	 * Clean out any crazy special characters
	 * because they're input into the DB
	 * sometimes doesn't match with the output
	 * in HTML causing wild notifications.
	 */
	$text = clean_ascii($text);

	return $text;
}

/**
 * Clean message before it is displayed.
 * @return [type] [description]
 */
function filter_message_after_db($text){

	/**
	 * Don't show I\'m
	 */
	$text = stripslashes($text);

	/**
	 * Make sure we don't output HTML.
	 */
	$text = htmlentities($text);

	/**
	 * Auto-link messages.
	 */	
	$text = auto_link_text($text);

	return $text;
}

/**
 * Cleansing functions ======================
 */

	/**
	 * Remove any non-ASCII characters and convert known non-ASCII characters 
	 * to their ASCII equivalents, if possible.
	 *
	 * @param string $string 
	 * @return string $string
	 * @author Jay Williams <myd3.com>
	 * @license MIT License
	 * @link http://gist.github.com/119517
	 */
	function clean_ascii($string) { 
	  // Replace Single Curly Quotes
	  $search[]  = chr(226).chr(128).chr(152);
	  $replace[] = "'";
	  $search[]  = chr(226).chr(128).chr(153);
	  $replace[] = "'";
	 
	  // Replace Smart Double Curly Quotes
	  $search[]  = chr(226).chr(128).chr(156);
	  $replace[] = '"';
	  $search[]  = chr(226).chr(128).chr(157);
	  $replace[] = '"';
	 
	  // Replace En Dash
	  $search[]  = chr(226).chr(128).chr(147);
	  $replace[] = '--';
	 
	  // Replace Em Dash
	  $search[]  = chr(226).chr(128).chr(148);
	  $replace[] = '---';
	 
	  // Replace Bullet
	  $search[]  = chr(226).chr(128).chr(162);
	  $replace[] = '*';
	 
	  // Replace Middle Dot
	  $search[]  = chr(194).chr(183);
	  $replace[] = '*';
	 
	  // Replace Ellipsis with three consecutive dots
	  $search[]  = chr(226).chr(128).chr(166);
	  $replace[] = '...';
	 
	  // Apply Replacements
	  $string = str_replace($search, $replace, $string);
	 
	  // Remove any non-ASCII Characters
	  $string = preg_replace("/[^\x01-\x7F]/","", $string);
	 
	  return $string; 
	}

?>