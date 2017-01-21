<?php
	if ($_REQUEST['error'] == 1)
		{
			$errorDesc = "All three fields must be filled out.<br/> Not too hard, we hope.";
		}
	elseif ($_REQUEST['error'] == 2)
		{
			$errorDesc = "You must enter a valid e-mail address.<br/> You just gotta.";	
		}
	elseif ($_REQUEST['error'] == 3)
		{
			$errorDesc = "We already have that e-mail address on file.<br/> Patience is key!";	
		}
	elseif ($_REQUEST['error'] == 4)
		{
			$errorDesc = "Your math was incorrect.<br/> Are you human?";	
		}					
	echo "<div class='drop'><h6><b>Sorry!</b> $errorDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
