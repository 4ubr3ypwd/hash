<?php $messages = the_messages( the_hash() ); ?>

<table id="messages-table">
	<tbody>
		<?php foreach($messages as $message){ ?>
			<tr class="row" id="<?php echo $message['id']; ?>">
				<td class="column message-nick <?php the_nick_classes($message['nick']); ?>">
					<?php echo $message['nick']; ?>
				</td>
				<td class="column message-message">
					<?php echo the_message($message['message']); ?>
				</td>
				<td class="column message-time">
					<a href="#<?php echo $message['id']; ?>">
						<?php echo date("F j, Y, g:i a", $message['time']); ?>
					</a>
				</td>
			</tr>
		<?php } //endforeach; ?>
	</tbody>
</table>