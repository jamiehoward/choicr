<?php
	$LED_SQL = "SELECT dbPostCnt, dbPostTitle FROM Posts WHERE dbUsrCnt = '$dbUsrCnt' AND dbExpDate < NOW() AND dbPostCnt NOT IN (SELECT dbPostCnt FROM Follow_up) ORDER BY dbExpDate DESC LIMIT 1";
	$LED_Results = mysql_query($LED_SQL, $dbconnect);
	$LED = mysql_fetch_array($LED_Results);
	$LED_Title = Truncate($LED['dbPostTitle'], 30);
	$LED_Cnt = $LED['dbPostCnt'];
	$WC0_SQL = "SELECT Count(*) FROM Votes WHERE dbPostCnt = 60 AND dbChcVote = 0";
		$WC0_Results = mysql_query($WC0_SQL, $dbconnect);
	$WC1_SQL = "SELECT Count(*) FROM Votes WHERE dbPostCnt = 60 AND dbChcVote = 1";
		$WC1_Results = mysql_query($WC1_SQL, $dbconnect);
	if ($WC0_Results < $WC1_Results)
		{
		$WC_SQL = "SELECT Choices.dbChcDesc FROM `Choices` JOIN Posts ON Choices.dbChcCnt = Posts.dbChc1Cnt WHERE Posts.dbPostCnt = '$LED_Cnt'";
		}
	else
		{
		$WC_SQL = "SELECT Choices.dbChcDesc FROM `Choices` JOIN Posts ON Choices.dbChcCnt = Posts.dbChc2Cnt WHERE Posts.dbPostCnt = '$LED_Cnt'";
		}
	$WC_Results = mysql_query($WC_SQL, $dbconnect);
	$WC_Info = mysql_fetch_array($WC_Results);
	$Winning_Choice = Truncate($WC_Info['dbChcDesc']);
		
	$followupDesc = "<b>Hey!</b> Your decision, \"<a href='../vote/?post=" . $LED['dbPostCnt'] . "'>" . $LED_Title . "\"</a>, has expired. The winning choice was \"". $Winning_Choice ."\". Send a follow-up message to the community, letting them know how it turned out! <br /><div class='invite'><form action='../scripts/postfollowup.php?p=" . $LED['dbPostCnt'] . "' method=\"POST\"><textarea rows='3' cols='65' name='followuptext'></textarea><br /><input type='submit' value='Submit'/></form></div>";
	
	//Test comment 
	echo "<div class='drop'><h6> $followupDesc </h6><br /><a class='close'>&nbsp;</a></div>";
?>