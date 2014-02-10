<h1 class="site-title">Hash</h1>

<form action="" method="get" id="get-hash">

	<table id="get-has-form">
		<tr>
			<td class="label">Nick</td>
			<td><input type="text" name="nick" value="<?php the_nick('echo'); ?>"></td>
		</tr>
		<tr>
			<td class="label">Room</td>
			<td>
				<input type="text" name="hash" value="<?php the_hash('echo'); ?>">
			</td>
		</tr>
		<tr>
			<td class="label"></td>
			<td>
				<input type="submit" value="Join Hash">
			</td>
		</tr>
	</table>

</form>