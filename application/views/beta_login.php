<?php if (validation_errors())
	{ ?>
	<div class='drop'><h6><?=validation_errors()?></h6><br /><a class='close'>&nbsp;</a></div>
	<?php } 
	elseif (isset($error)) {?>
	<div class='drop'><h6><?=$error?></h6><br /><a class='close'>&nbsp;</a></div>
	<?php } ?>

<div class="content">
	<div class="ask">
		<?=form_open('beta/login')?>
		<h1>Welcome to Choicr Beta!</h1><hr /> It looks like you've been selected for beta testing! You can sign in with the username and password you used when signing up from the invite e-mail's link. Throughout your time on Choicr, you will indeed notice places that are not 100% functional or pretty. That is part of the beta process fun! We need your help to make this site amazing, so feel free to use the feedback button on the left side of the page to report suggestions or bugs!<br /><br />
		Did you get here by mistake? Choicr is currently in closed beta, but <a href="../index.php">click here</a> to request a beta invite.
			<table>
				<tr>
					<td><label for="User Name">User Name</label></td>
					<td><div><input type="text" class="text" name="username" id="username" /></div></td>
				</tr>
				<tr>
					<td><label for="Password">Password</label></td>
				  <td><div><input type="password" class="text" name="password" id="password" /></div></td>
				</tr>
			   <tr>
				<td>&nbsp;</td>
				  <td class="submit"><input type="submit" class="submit" value="" /></td>
				</tr>
			</table>
		<?=form_close()?>
	</div>
</div>
<!-- End content -->

