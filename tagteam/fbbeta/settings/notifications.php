<?php
	if ($_REQUEST['note'] == 1 || $Note == 1)
		{
		$noteDesc = "<b>Great!</b> Your information has been updated!";
		} 
	elseif ($_REQUEST['note'] == 2)
		{
			$noteDesc = "<b>Great!</b> Your profile picture has been updated!";	
		}
	echo "<div class='drop'><h6> $noteDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>
	

	
