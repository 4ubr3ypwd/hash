<?php

include "config.php";
	$config 
		= objectify_array($config);

include "meekrodb.2.2.class.php";
	db_init();

session_start();

function db_init(){
	global $config;

	DB::$user = $config->db_user;
	DB::$password = $config->db_password;
	DB::$dbName = $config->db_name;

}

if( isset($_GET['action']) ){
	ajax_handler($_GET['action']);
}

function the_nick_classes($nick){
	if(the_nick() == $nick){
		echo " nicksame";
	}
}

function ajax_handler($action){

	global $config;

	if($action=='post_message'){
		$record = array(
			'nick' => $_GET['nick'],
			'message' => sanatize_message_before(
				$_GET['message']
			),
			'hash' => $_GET['hash'],
			'time' => time(),
		);

		DB::insert($config->db_table, $record);

		$record_id = DB::insertId();

		include "hash-table.php";

	}elseif($action=='update_table'){
		include "hash-table.php";
	}
}

function the_nick($how=NULL){
	if( isset( $_GET['nick'] ) ){
		if($how=='echo'){
			echo $_GET['nick'];
		}else{
			return $_GET['nick'];
		}
	}else{
		return false;
	}
}

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

function have_nick(){
	if( isset($_GET['nick']) ){
		return true;
	}else{
		return false;
	}
}

function have_hash(){
	if( isset($_GET['hash']) ){
		if($_GET['hash']) return true;
		else return false;
	}
}

function sanatize_message_before($message){
	$message = strip_tags($message);
	return $message;
}

function the_message($text){
	$text = auto_link_text($text);
	return $text;
}

function auto_link_text($text){
	return preg_replace(
		'/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', 
		'<a href="\1">\1</a>', 
		$text
	);
}

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

function objectify_array($array){
	return json_decode(json_encode($array));
}