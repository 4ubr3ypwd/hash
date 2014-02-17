<?php

function php2js(){
	?>
	<script>
		/**
		 * Variables that will be accessible to JS
		 */
		var php2js = {
			escaped_nick: "<?php echo escaped_nick( my_nick() ); ?>",
			escaped_hash: "<?php echo escaped_hash( the_hash() ); ?>",
			the_interval: <?php echo the_interval(); ?>
		};
	</script>
	<?php
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
		
		/**
		 * Make sure the message is not empty.
		 */
		if($_GET['message'] != ''){

			$record = array(
				
				/**
				 * Should already be escaped via
				 * php2js
				 */
				'nick' => (
					$_GET['nick']
				),
				
				'message' => filter_message_before_db(
					$_GET['message']
				),

				/**
				 * Should already be escaped via
				 * php2js
				 */
				'hash' => (
					$_GET['hash']
				),

				/**
				 * Time of post.
				 */
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