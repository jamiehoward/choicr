<?php
	if ($_REQUEST['note'] == 1 || $Note == 1)
		{
			if ($UnsentInviteCount == 1)
				{
				$noteDesc = "You have <b>" . $UnsentInviteCount . "</b> beta invite to send out! Enter a friend's e-mail address below to send them an invite! <br /><div class='invite'><form action='../scripts/betainvite.php'><input type='text' name='email' /><input type='submit' value='Invite!'/></form></div>	";
				}
			else
				{
				$noteDesc = "You have " . $UnsentInviteCount . " beta invites to send out! Enter a friend's e-mail address below to send them an invite!";
				}
		} 
	elseif ($_REQUEST['note'] == 2)
		{
			$noteDesc = "You are already following this user!";	
		}
	echo "<div class='drop'><h6><b>Hey!</b> $noteDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
