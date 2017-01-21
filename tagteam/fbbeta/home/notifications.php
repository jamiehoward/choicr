<?php
	if ($_REQUEST['note'] == 'i1' || $Note == 'i1')
		{
			if ($UnsentInviteCount == 1)
				{
				$noteDesc = "<b>Hey!</b> You have <b>" . $UnsentInviteCount . "</b> beta invite to send out! Enter a friend's e-mail address below to send them an invite! <br /><div class='invite'><form action='../scripts/betainvite.php'><input type='text' name='email' /><input type='submit' value='Invite!'/></form></div>	";
				}
			else
				{
				$noteDesc = "<b>Hey!</b> You have <b>" . $UnsentInviteCount . "</b> beta invites to send out! Enter a friend's e-mail address below to send them an invite! <br /><div class='invite'><form action='../scripts/betainvite.php'><input type='text' name='email' /><input type='submit' value='Invite!'/></form></div>	";
				}
		} 
	elseif ($_REQUEST['note'] == 'i2')
		{
			$noteDesc = "<b>Great!</b> Your beta invite has been sent!";	
		}
	elseif ($_REQUEST['note'] == 's1')
		{
			$noteDesc = "<a href='../settings/'><span class='big'>Heads up!</span><br /=true /> We've opened up the settings area of the site. You can now update your profile information and upload a profile image!</a>";	
		}
	echo "<div class='drop'><h6> $noteDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
