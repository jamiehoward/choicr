<?php
	if ($_REQUEST['error'] == 1)
		{
			$errorDesc = "There has been a data error!";
		}
	elseif ($_REQUEST['error'] == 2)
		{
			$errorDesc = "You are already following this user!";	
		}
	echo "<div class='drop'><h6><b>Sorry!</b> $errorDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
