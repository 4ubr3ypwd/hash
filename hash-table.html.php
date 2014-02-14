<?php 

/**
 * Get the messages so we can output them.
 */
$messages = the_messages( the_hash() ); 

?>
<table id="messages-table">
	<tbody>
		<?php foreach($messages as $message){ ?>
			<tr class="row <?php message_classes($message['id']); ?>" id="<?php echo $message['id']; ?>">
				<td class="column message-nick <?php the_nick_classes($message['nick']); ?>">
					<?php echo $message['nick']; ?>
				</td>
				<td class="column message-message">
					<?php echo the_message($message['message']); ?>
				</td>
				<td class="column message-time">
					<a href="#<?php echo $message['id']; ?>" title="<?php echo $config->timezone; ?>">
						<?php echo date("F j, Y, g:i a", $message['time']); ?>
					</a>
				</td>
			</tr>
		<?php } //endforeach; ?>
	</tbody>
</table>