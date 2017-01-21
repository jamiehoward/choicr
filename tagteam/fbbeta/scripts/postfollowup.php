<?php
	require("connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$dbFolUpText = $_REQUEST['followuptext'];
	$CommentSQL = "INSERT INTO `Follow_up` (`dbPostCnt`, `dbUsrCnt`, `dbFolUpText`, `dbFolUpDate`) VALUES ('$dbPostCnt', '$dbUsrCnt', '$dbFolUpText', '$timestamp')";
	mysql_query ($CommentSQL, $dbconnect);
	header("Location: ../profile/");
?>