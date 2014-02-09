<?php 

global $record_id;

$messages = DB::query("SELECT * from messages");

if( !is_array($messages) ){
	$message = array();
}

?>

<table id="messages-table">
	<tbody>
		<?php foreach($messages as $message){ ?>
			<tr class="row" id="message-<?php echo $message['id']; ?>">
				<td class="column message-nick <?php the_nick_classes($message['nick']); ?>">
					<?php echo $message['nick']; ?>
				</td>
				<td class="column message-message">
					<?php echo $message['message']; ?>
				</td>
				<td class="column message-time">
					<?php echo date("F j, Y, g:i a", $message['time']); ?>
				</td>
			</tr>
		<?php } //endforeach; ?>
	</tbody>
</table>