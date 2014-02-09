h_table_interval='';
h_table_ajax='';
h_screen_animate='';

$(document).ready(function(){

	if(
			php_._hash==''
		|| php_.nick==''
	) return false;

	h_make_table_interval();
	goto_screen_bottom();

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
						goto_screen_bottom();
					}
				});
			}
		});
	}
});

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
					goto_screen_bottom();
				}else{
					
					console.log('stop');
				}

				$('#messages').html(data);	
			}
		});
	}, 300);
}

function goto_screen_bottom(){
	$(window).scrollTop( $(document).height() );
}