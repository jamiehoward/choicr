<?php
	if ($_REQUEST['error'] == 1)
		{
			$errorDesc = "You have already voted on this decision!";
		}
	elseif ($_REQUEST['error'] == 2)
		{
			$errorDesc = "There has been a data error!";	
		}
	elseif ($_REQUEST['error'] == 3)
		{
			$errorDesc = "You cannot vote on your own decisions.";	
		}
	elseif ($_REQUEST['error'] == 'f1')
		{
			$errorDesc = "There has been a data error!";	
		}
	elseif ($_REQUEST['error'] == 'f2')
		{
			$errorDesc = "You are already following this decision!";	
		}
	echo "<div class='drop'><h6><b>Sorry!</b> $errorDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
