/**
 * Some global vars.
 */
h_table_interval='';
h_table_ajax='';
h_screen_animate='';

$(document).ready(function(){

	/**
	 * Only continue if we have the hash and nick 
	 * which loads up the in-hash page.
	 */
	if(
			php2js.the_hash==''
		|| php2js.the_nick==''
	) return false;

	setup_page_update_interval();
	goto_screen_bottom();

	if( $('#message') ){

		/**
		 * Log and wait for the <enter> key in the message box.
		 */
		$('#message').keypress(function(e) {
			if(e.which == 13) {

				/**
				 * Send a request to post a message to the database
				 * and update the page when done.
				 */
				$.ajax({
					url: 'hash.php',
					method: 'get',
					data: {
						action: 'post_message',
						message: $('#message').val(),
						nick: php2js.the_nick,
						hash: php2js.the_hash
					},
					success: function(
						data, 
						textStatus, 
						jqXHR
					){
						/**
						 * Set our message box back to nothing so 
						 * we can type another.
						 */
						$('#message').val('');

						/**
						 * We've been passed back the updated page, 
						 * update the <div>
						 */
						$('#messages').html(data);

						goto_screen_bottom();
					}
				});
			}
		});
	}
});

/**
 * A developer function so we can kill
 * the interval from console.
 */
function kill_interval(){
	clearInterval(h_table_interval);
}

/**
 * Setup an interval for the page so we can update
 * it with any new messages.
 */
function setup_page_update_interval(){
	h_table_interval = setInterval(function(){
		h_table_ajax = $.ajax({
			url: 'hash.php',
			method: 'get',
			data: {
				action: 'update_table',
				hash: php2js.the_hash,
				nick: php2js.the_nick
			},
			success: function(
				data, 
				textStatus, 
				jqXHR
			){
				/**
				 * If we are close to the bottom of
				 * the screen, scroll down and show
				 * the new messages as they load.
				 */
				if(
					$(window).scrollTop() + $(window).height()
						>= $(document).height() - 50
				){
					goto_screen_bottom();
				}

				/**
				 * Update the page with the 
				 * messages sent back.
				 */
				$('#messages').html(data);	
			}
		});
	}, php2js.the_interval);
}

/**
 * Go to the bottom of the screen.
 */
function goto_screen_bottom(){
	$(window).scrollTop( $(document).height() );
}