<?php

/**
 * Nick ==========================
 */

/**
 * Sanitize hash before it's put in the database.
 */
function filter_nick_before_db($hash){
	/**
	 * Keep special chars out of hashes.
	 */
	$hash = clean_ascii($hash);
	return $hash;
}

/**
 * Sanitize the nick after it's value is 
 * brought in from DB
 */
function filter_nick_after_db($nick){
	return $nick;
}

/**
 * Hash ===============================
 */

/**
 * Sanitize nick before it's put in the database.
 */
function filter_hash_before_db($nick){
	/**
	 * Keep special chars out of nicks.
	 */
	$nick = clean_ascii($nick);

	return $nick;
}

/**
 * Sanitize the hash after
 * it's been pulled from DB
 */
function filter_hash_after_db($hash){
	return $hash;
}

/**
 * Messages ===========================
 */

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