h_table_interval='';
h_table_ajax='';
h_screen_animate='';

function h_kill_table_interval(){
	clearInterval(h_table_interval);
}

function h_make_table_interval(){
	//h_table_ajax.abort();
	h_table_interval = setInterval(function(){
		h_table_ajax = $.ajax({
			url: 'hash.php',
			method: 'get',
			data: {
				action: 'update_table',
				hash: php_._hash,
				nick: php_.nick
			},
			success: function(
				data, 
				textStatus, 
				jqXHR
			){
				if(
					$(window).scrollTop() + $(window).height()
						>= $(document).height() - 50
				){
					h_goto_bottom_of_screen();
				}else{
					
					console.log('stop');
				}

				$('#messages').html(data);	
			}
		});
	}, 300);
}

$(document).ready(function(){

	h_make_table_interval();
	h_goto_bottom_of_screen();

	if( $('#message') ){
		$('#message').keypress(function(e) {
			if(e.which == 13) {
				$.ajax({
					url: 'hash.php',
					method: 'get',
					data: {
						action: 'post_message',
						message: $('#message').val(),
						nick: php_.nick,
						hash: php_._hash
					},
					success: function(
						data, 
						textStatus, 
						jqXHR
					){
						$('#message').val('');
						$('#messages').html(data);
						h_goto_bottom_of_screen();
					}
				});
			}
		});
	}
});

function h_goto_bottom_of_screen(){
	$(window).scrollTop( $(document).height() );
}