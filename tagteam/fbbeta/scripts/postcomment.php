<?php
	require("connect.php");
	$dbIDCnt = $_REQUEST['id'];
	$dbIDGroup = $_REQUEST['group'];
	$dbUsrCnt = $_REQUEST['u'];
	$dbCommTxt = $_REQUEST['Comment'];
	$dbPostCnt = $_REQUEST['id'];
	$CommentSQL = "INSERT INTO `Comments` (`dbCommCnt`, `dbIDCnt`, `dbIDGroup`, `dbCommTxt`, `dbUsrCnt`, `dbAddDate`) VALUES ('', '$dbIDCnt', '$dbIDGroup', '$dbCommTxt', '$dbUsrCnt', '$timestamp')";
	
	if ($dbIDCnt == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	elseif ($dbIDGroup == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	elseif ($dbCommTxt == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	elseif ($dbUsrCnt == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	elseif ($dbCommTxt == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	elseif ($dbAddDate == NULL)
		{
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	else
		{
		mysql_query ($CommentSQL, $dbconnect);
		header("Location: http://www.invotic.us/choice.php?post=$dbPostCnt&id=tagteam");
		}
	
?>