<?php
	require("../scripts/connect.php");
	$ProfileCnt = $_REQUEST['p'];
	$Follower = $_REQUEST['u'];
	
	//s have a follow type of 1. Users have a follow type of 2
	$FollowType = 2;	
	
	$AlreadyFollowingSQL = "SELECT * FROM Follows WHERE dbFolType = '$FollowType' AND dbFollowerCnt = '$Follower' AND dbFollowedCnt = '$ProfileCnt'";
	$AlreadyFollowingResults = mysql_query ($AlreadyFollowingSQL, $dbconnect);
	$AlreadyFollowingRows = mysql_num_rows ($AlreadyFollowingResults);
	
	if ($ProfileCnt == NULL)
		{
   header("Location: index.php?user=$ProfileCnt&error=1");
   	}
	elseif ($Follower == NULL)
		{
   header("Location: index.php?user=$ProfileCnt&error=1");
   	}
	elseif ($Follower != $dbUsrCnt)
		{
   header("Location: index.php?user=$ProfileCnt&error=1");
   	}
	elseif ($AlreadyFollowingRows != 0)
		{
	header("Location: index.php?user=$ProfileCnt&error=2");
		}
	else
		{
	$FollowSQL = "INSERT INTO `Follows` (`dbFolCnt`, `dbFolType`, `dbFolActive`, `dbFollowerCnt`, `dbFollowedCnt`, `dbAddDate`, `dbBlock`, `dbBlockDate`) VALUES ('', '$FollowType', '1', '$Follower', '$ProfileCnt', '$timestamp', '0', NULL)";	
	mysql_query($FollowSQL, $dbconnect);
	
	$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$Follower', 2, '$ProfileCnt', NULL, '$timestamp')";
	mysql_query($ActivitySQL,$dbconnect);
   header("Location: index.php?user=$ProfileCnt");
		}

?>
