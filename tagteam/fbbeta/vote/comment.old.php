<?php
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$dbComment= $_REQUEST['comment'];
	$PostUser = $_REQUEST['u'];
	$timestamp = date("Y-m-d H:i:s");
	$AllowCommenting = 1;
	if ($dbPostCnt == NULL)
		{
   		header("Location: ../vote/?post=$dbPostCnt");
   		}
	elseif ($dbComment == NULL || $dbComment == "")
		{
   		header("Location: ../vote/?post=$dbPostCnt");
   		} 
	elseif ($PostUser != $_SESSION['dbUsrCnt'])
		{
   		header("Location: ../vote/?post=$dbPostCnt");
   		}
	else
		{
	$CommentSQL = "INSERT INTO `Comments` (`dbCommCnt`, `dbIDCnt`, `dbIDGroup`, `dbCommTxt`, `dbUsrCnt`, `dbAddDate`) VALUES ('', '$dbPostCnt', '1', '$dbComment', '$PostUser', '$timestamp')";	
	mysql_query($CommentSQL, $dbconnect);
	$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$dbUsrCnt', 4, '$dbPostCnt', NULL, '$timestamp')";
	mysql_query($ActivitySQL,$dbconnect);;
   	header("Location: ../vote/?post=$dbPostCnt");
		}

?>
