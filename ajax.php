<?php

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
		
		/**
		 * Make sure the message is not empty.
		 */
		if($_GET['message'] != ''){

			$record = array(
				'nick' => filter_nick_before_db(
					$_GET['nick']
				),
				'message' => filter_message_before_db(
					$_GET['message']
				),
				'hash' => filter_hash_before_db(
					$_GET['hash']
				),
				'time' => time(),
			);

			DB::insert($config->db_table, $record);

			$record_id = DB::insertId();

			include "hash-table.html.php";

		}

	/**
	 * Just get the latest messages
	 * in the conversation. Usually updated per
	 * an interval from JS.
	 */
	}elseif($action=='update_table'){
		include "hash-table.html.php";
	}
}

?>