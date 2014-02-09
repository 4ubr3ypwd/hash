<h1 class="site-title"><?php echo $_SERVER['HTTP_HOST']; ?>@#hash</h1>

<form action="" method="get" id="get-hash">

	<table id="get-has-form">
		<tr>
			<td class="label">Nick</td>
			<td><input type="text" name="nick" value="<?php the_nick('echo'); ?>"></td>
		</tr>
		<tr>
			<td class="label">Hash</td>
			<td>
				<input type="text" name="hash" value="<?php h_hash('echo'); ?>">
				<input type="submit" value="Join Hash">
			</td>
		</tr>
	</table>

</form>