/**
 * Some global vars.
 */
var update_interval = '';
var update_ajax = '';
var window_active = true;
var highlight_id =''
var initial_scrolled_to_message = false;
var scrolled_screen_bottom = false;
var scroll_speed = 500;

$(document).ready(function(){

	/**
	 * Only continue if we have the hash and nick 
	 * which loads up the in-hash page.
	 */
	if(
			php2js.the_hash==''
		|| php2js.the_nick==''
	) return false;
	
	if( $('#message') ){

		setup_page_update_interval();

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
	}

});

/**
 * Send a request to post a message to the database
 * and update the page when done.
 */
function send_message(message, nick, hash){

	/**
	 * Make sure we don't send an 
	 * empty message.
	 */
	if(message==''){
		return;
	}

	/**
	 * Send the message.
	 */
	$.ajax({
		url: 'hash.php',
		method: 'get',
		data: {
			action: 'post_message',
			message: message,
			nick: nick,
			hash: hash,
			highlight_id: window.location.hash
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
				nick: php2js.the_nick,
				highlight_id: window.location.hash
			},
			success: function(
				data, 
				textStatus, 
				jqXHR
			){

				/**
				 * Make sure our " and &quote 
				 * match.
				 */
				data = js_htmlify(data);

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

				if(window.location.hash && !initial_scrolled_to_message){
					goto_message(window.location.hash);
					initial_scrolled_to_message = true;
				}else{
					if(!window.location.hash){
						goto_screen_bottom();
					}
				}

			}
		});
	}, php2js.the_interval);

}

function goto_message(message_hash){

		console.log(message_hash);
		
		$(message_hash).addClass('highlight');

		$("html, body").animate({ 
			scrollTop: $(message_hash).offset().top
				- 200,
		}, scroll_speed);
}

function js_htmlify(data){
	/**
	 * Since jQuery.html() does not convert
	 * " to &quote, data (which has &quote;),
	 * and the current HTML will be different.
	 *
	 * One having " and one having &quote;
	 * when expressing the message.
	 *
	 * This fixes that issue by passing the data
	 * to the DOM, which converts &quote to ",
	 * and then passes it back into data.
	 */
	$('#js_htmlifier').html(data);
	data=$('#js_htmlifier').html();
	return data;
}

function beep(){
	$('#notify')[0].play();
}

/**
 * Track when the window is active
 */
$(window).focus(function(){
	window_active = true;
});

$(window).blur(function(){
	window_active = false;
});

/**
 * Go to the bottom of the screen.
 */
function goto_screen_bottom(){
	if(!scrolled_screen_bottom){
		$("html, body").animate({ 
			scrollTop: $(document).height()
		}, scroll_speed);	
	}

	scrolled_screen_bottom = true;
}