<?php
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$dbChcVote = $_REQUEST['v'];
	$VoterCnt = $_REQUEST['u'];
	$timestamp = date("Y-m-d H:i:s");
	$place = $_REQUEST['place'];
	$ref = $_REQUEST['ref'];
	if ($_REQUEST['arcat'] != NULL)
		{
		$ARCat = "&arcat=" . $_REQUEST['arcat'];
		}
	else	{ $ARCat = NULL; }
	
	$VPostSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$dbPostCnt'";
	$VPostResults = mysql_query($VPostSQL, $dbconnect);
	$VPostInfo = mysql_fetch_array($VPostResults);
	
	$AVSQL = "SELECT * FROM `Votes` WHERE `dbPostCnt` = '$dbPostCnt' AND `dbUsrCnt` = '$dbUsrCnt'";
		$AVResult = mysql_query ($AVSQL, $dbconnect);
		$AVRows = mysql_num_rows ($AVResult);
		if ($AVRows > 0)
			{
   			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=1");
			}
		elseif ($dbPostCnt == 0)
			{
			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=2");
			}
		elseif ($dbPostCnt == NULL)
			{
			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=2");
			}
		elseif ($VoterCnt == 0 || $VoterCnt == NULL)
			{
			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=2");
			}		
		elseif ($VoterCnt != $_SESSION['dbUsrCnt'])
			{
			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=2");
			}
		elseif ($VoterCnt == $VPostInfo['dbUsrCnt'])
			{
			header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat&error=3");
			}	
		else
			{
			$VoteSQL = "INSERT INTO `Votes` (`dbVoteCnt`, `dbUsrCnt`, `dbPostCnt`, `dbChcVote`, `dbVoteDate`) VALUES ('','$VoterCnt', '$dbPostCnt', '$dbChcVote', '$timestamp')";  
			mysql_query($VoteSQL, $dbconnect);
			
		$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$VoterCnt', 5, '$dbPostCnt', NULL, '$timestamp')";
		mysql_query($ActivitySQL,$dbconnect);

	   	header("Location: ../vote/?post=$dbPostCnt&ref=$ref&place=$place$ARCat");
			}
?>
