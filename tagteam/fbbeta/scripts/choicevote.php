<?php
	require("connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$dbChcVote = $_REQUEST['v'];
	$dbUsrCnt = $_REQUEST['u'];
	$timestamp = date("Y-m-d H:i:s");
	
	$AVSQL = "SELECT * FROM `Votes` WHERE `dbPostCnt` = '$dbPostCnt' AND `dbUsrCnt` = '$dbUsrCnt'";
		$AVResult = mysql_query ($AVSQL, $dbconnect);
		$AVRows = mysql_num_rows ($AVResult);
		if ($AVRows > 0)
			{
			$AlreadyVoted = 1;
			}
		else
			{
			$AlreadyVoted = 0;
			}
	if ($AlreadyVoted == 0)
		{
	$VoteSQL = "INSERT INTO `Votes` (`dbVoteCnt`, `dbUsrCnt`, `dbPostCnt`, `dbChcVote`, `dbVoteDate`) VALUES ('','$dbUsrCnt', '$dbPostCnt', '$dbChcVote', '$timestamp')";  
	mysql_query($VoteSQL, $dbconnect);
   header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	else
		{
   header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam&error=1");
   	}
?>
