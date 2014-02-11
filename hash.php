<?php

/**
 * Make sure we have the config and it's
 * an object (for better inserting into strings).
 */
include "config.php";
	$config = objectify_array($config);

/**
 * Set the timezone of the app.
 */
date_default_timezone_set($config->timezone);

/**
 * Let's include our DB library and connect
 * it to our config.php values.
 */
include "meekrodb.2.2.class.php";
	db_init();

/**
 * Connect the DB with our config values.
 */
function db_init(){
	global $config;

	DB::$user = $config->db_user;
	DB::$password = $config->db_password;
	DB::$dbName = $config->db_name;
	DB::$host = $config->db_host;
}

/**
 * We store the nick in the browser
 * session.
 */
session_start();

/**
 * Detect if we're doing an ajax
 * call by detecting action.
 */
if( isset($_GET['action']) ){
	ajax_handler($_GET['action']);

/**
 * If we're not doing an ajax
 * call, watch for the nick.
 */
}else{
	init();
}

/**
 * Watch for the nick, and if it's in $_GET
 * store it in $_SESSION so the url is shareable.
 */
function init(){
	if( isset($_GET['nick']) ){
		$_SESSION['nick']=the_nick();
		header( "Location: ?hash=".the_hash() );
	}
}

/**
 * Handle ajax calls.
 */
function ajax_handler($action){

	global $config;

	/**
	 * If we were passed a message, save it to the DB
	 * and send back the updated conversation.
	 */
	if($action=='post_message'){
		$record = array(
			'nick' => $_GET['nick'],
			'message' => filter_message_before_db(
				$_GET['message']
			),
			'hash' => $_GET['hash'],
			'time' => time(),
		);

		DB::insert($config->db_table, $record);

		$record_id = DB::insertId();

		include "hash-table.html.php";

	/**
	 * Just get the latest messages
	 * in the conversation. Usually updated per
	 * an interval from JS.
	 */
	}elseif($action=='update_table'){
		include "hash-table.html.php";
	}
}

/**
 * Pass back the interval with ease.
 */
function the_interval($how){
	global $config;

	if($how=='echo'){
		echo $config->interval;
	}else{
		return $config->interval;
	}
}

/**
 * Add some classes to an element if the nick
 * is the same as the message being displayed.
 *
 * Allows us to use CSS to make that person's
 * nick highlighted.
 */
function the_nick_classes($nick){
	if(the_nick() == $nick){
		echo " nicksame";
	}
}

/**
 * Pass back the nick with ease.
 */
function the_nick($how=NULL){

	/**
	 * If it's stored in $_GET 
	 * (which should be shortly).
	 */
	if( isset( $_GET['nick'] ) ){
		if($how=='echo'){
			echo $_GET['nick'];
		}else{
			return $_GET['nick'];
		}

	/**
	 * If it's stored in $_SESSION.
	 */
	}else{
		if( isset( $_SESSION['nick'] ) ){
			if($how=='echo'){
				echo $_SESSION['nick'];
			}else{
				return $_SESSION['nick'];
			}
		}else{
			return false;
		}
	}
}

/**
 * Pass the hash back with ease.
 * It persists in the URL via $_GET
 */
function the_hash($how=NULL){
	if( isset($_GET['hash']) ){
		if($how=='echo'){
			echo $_GET['hash'];
		}else{
			return $_GET['hash'];
		}
	}else{
		return false;
	}
}

/**
 * Clean messages before they are stored in the DB.
 */
function filter_message_before_db($text){
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
 * Pass the message back.
 */
function the_message($text){
	$text = filter_message_after_db($text);
	return $text;
}

/**
 * Auto link hyperlinks in text.
 */
function auto_link_text($text){
	return preg_replace(
		'/((.*):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', 
		'<a href="\1">\1</a>',
		$text
	);
}

/**
 * Get all the messages for a hash.
 */
function the_messages($hash){
	global $config;

	$messages = DB::query(
		"SELECT * FROM $config->db_table WHERE hash=%s", the_hash() 
	);

	if( !is_array($messages) ){
		return array();
	}else{
		return $messages;
	}
}

/**
 * Make our arrays $object->friendly
 */
function objectify_array($array){
	return json_decode(json_encode($array));
}

?>