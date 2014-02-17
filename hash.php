<?php

/**
 * Make sure we have the config and it's
 * an object (for better inserting into strings).
 */
include "config.php";
	$config = objectify_array($config);

/**
 * Bring in filtering functions
 * for before_db and after_db
 */
include "filters.php";

/**
 * Formatting
 */
include "formatting.php";

/**
 * Formatting for the URL
 */
include "urls.php";

/**
 * UX
 */
include "ux.php";

/**
 * Ajax handler
 */
include "ajax.php";

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
 * Init function
 */
function init(){
	/**
	 * Strip nick from url so it 
	 * can be shared.
	 */
	the_nick_url();
}

/**
 * Pass back the interval with ease.
 */
function the_interval(){
	global $config;
	return $config->interval;
}

/**
 * Pass back the nick with ease.
 */
function my_nick(){

	/**
	 * If it's stored in $_GET 
	 * (which should be shortly).
	 */
	if( isset( $_GET['nick'] ) ){
		return (
			$_GET['nick']
		);

	/**
	 * If it's stored in $_SESSION.
	 */
	}else{
		if( isset( $_SESSION['nick'] ) ){
			return (
				$_SESSION['nick']
			);
		}else{
			return false;
		}
	}
}

/**
 * Pass back the individual message's
 * nick back with ease
 */
function the_message_nick($nick){
	return ($nick);
}

/**
 * Pass the hash back with ease.
 * It persists in the URL via $_GET
 */
function the_hash(){
	if( isset($_GET['hash']) ){
		return (
			$_GET['hash']
		);
	}else{
		return false;
	}
}

/**
 * Pass the message back.
 */
function the_message($text){
	$text = filter_message_after_db($text);
	return $text;
}

/**
 * Get all the messages for a hash.
 */
function the_messages($hash){
	global $config;

	$messages = DB::query(
		"SELECT * FROM $config->db_table WHERE hash=%s", 
		the_hash()
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