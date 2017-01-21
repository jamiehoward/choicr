<?php
	if ($_REQUEST['error'] == 1)
		{
			$errorDesc = "All four fields must be filled out.<br/> Not too hard, we hope.";
		}
	elseif ($_REQUEST['error'] == 2)
		{
			$errorDesc = "You must enter a valid e-mail address.<br/> You just gotta.";	
		}
	elseif ($_REQUEST['error'] == 3)
		{
			$errorDesc = "The username you entered is not valid.<br/> Pick another!";	
		}
	elseif ($_REQUEST['error'] == 4)
		{
			$errorDesc = "Please enter a valid password.<br/> Pick something strong!";	
		}
	elseif ($_REQUEST['error'] == 5)
		{
			$errorDesc = "That username, although cool, is already taken!<br/> Please pick another.";	
		}	
	elseif ($_REQUEST['error'] == 6)
		{
			$errorDesc = "Your math was incorrect.<br/> Are you human?";	
		}					
	echo "<div class='drop'><h6><b>Sorry!</b> $errorDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
