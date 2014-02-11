/**
 * Some global vars.
 */
update_interval='';
update_ajax='';
window_active=true;

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
				send_message(
					$('#message').val(),
					php2js.the_nick,
					php2js.the_hash
				);
			}
		});

		/**
		 * Let everyone know you joined the hash.
		 */
		send_message(
			"~ Joined ~",
			php2js.the_nick,
			php2js.the_hash
		);
	}
});

/**
 * Send a request to post a message to the database
 * and update the page when done.
 */
function send_message(message, nick, hash){
	$.ajax({
		url: 'hash.php',
		method: 'get',
		data: {
			action: 'post_message',
			message: message,
			nick: nick,
			hash: hash
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

/**
 * A developer function so we can kill
 * the interval from console.
 */
function kill_interval(){
	clearInterval(update_interval);
}

/**
 * Setup an interval for the page so we can update
 * it with any new messages.
 */
function setup_page_update_interval(){
	update_interval = setInterval(function(){

		/**
		 * Log the current HTML of the messages
		 * <div>.
		 */
		current_html = $('#messages').html();

		update_ajax = $.ajax({
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
				 * Only update the HTML of it is different
				 * than what it was before.
				 */
				if(data != current_html){

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

					if(!window_active){
						beep();
					}

					/**
					 * Update the page with the 
					 * messages sent back.
					 */
					$('#messages').html(data);	
				}
			}
		});
	}, php2js.the_interval);
}

function beep(){
	$('#notify')[0].play();
}

/**
 * Track when the window is active
 */
$(window).focus(function(){
	window_active = true;
	send_message(
		"~ Online ~",
		php2js.the_nick,
		php2js.the_hash
	);
});

$(window).blur(function(){
	window_active = false;
	send_message(
		"~ Away ~",
		php2js.the_nick,
		php2js.the_hash
	);
});

/**
 * Go to the bottom of the screen.
 */
function goto_screen_bottom(){
	$(window).scrollTop( $(document).height() );
}