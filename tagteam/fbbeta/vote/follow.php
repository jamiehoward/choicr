<?php
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$Follower = $_REQUEST['u'];
	$place = $_REQUEST['place'];
	$ref = $_REQUEST['ref'];
	
	//Posts have a follow type of 1. Users have a follow type of 2
	$FollowType = 1;	
	
	$AlreadyFollowingSQL = "SELECT * FROM Follows WHERE dbFolType = '$FollowType' AND dbFollowerCnt = '$Follower' AND dbFollowedCnt = '$dbPostCnt'";
	$AlreadyFollowingResults = mysql_query ($AlreadyFollowingSQL, $dbconnect);
	$AlreadyFollowingRows = mysql_num_rows ($AlreadyFollowingResults);
	

	//Posts have a follow type of 1. Users have a follow type of 2
	$FollowType = 1;
	
	if ($dbPostCnt == NULL)
		{
   header("Location: index.php?post=$dbPostCnt&error=f1&ref=$ref&place=$place");
   	}
	elseif ($Follower == NULL)
		{
   header("Location: index.php?post=$dbPostCnt&error=f1&ref=$ref&place=$place");
   	}
	elseif ($AlreadyFollowingRows != 0)
		{
	header("Location: index.php?post=$dbPostCnt&error=f2&ref=$ref&place=$place");
		}
	else
		{
	$FollowSQL = "INSERT INTO `Follows` (`dbFolCnt`, `dbFolType`, `dbFolActive`, `dbFollowerCnt`, `dbFollowedCnt`, `dbAddDate`, `dbBlock`, `dbBlockDate`) VALUES ('', '$FollowType', '1', '$Follower', '$dbPostCnt', '$timestamp', '0', NULL)";	
	mysql_query($FollowSQL, $dbconnect);

	$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$Follower', 7, '$dbPostCnt', NULL, '$timestamp')";
	mysql_query($ActivitySQL,$dbconnect);

   	header("Location: index.php?post=$dbPostCnt&ref=$ref&place=$place");
		}

?>
