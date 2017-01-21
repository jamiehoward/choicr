<?php
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p']; 
	$dbCommCnt = $_REQUEST['id'];
	$PostOwnerSQL = "SELECT * FROM `Posts` WHERE `dbPostCnt` IN (SELECT `dbPostCnt` FROM `Comments` WHERE `dbCommCnt` = '$dbCommCnt')";
	$PostOwnerResults = mysql_query($PostOwnerSQL, $dbconnect);
	$PostOwnerInfo = mysql_fetch_array($PostOwnerResults);
	
	if ($dbPostCnt == NULL)
		{
		header("Location: ../home/?error='c1'");
		}
	elseif ($dbCommCnt == NULL)
		{
		header("Location: ../home/?error='c2'");
		}
	else
		{
		$CommentSQL = "DELETE FROM `Comments` WHERE `dbCommCnt` = '$dbCommCnt'";	
		mysql_query($CommentSQL, $dbconnect);
		header("Location: ../vote/edit.php?p=$dbPostCnt");
		}

?>
