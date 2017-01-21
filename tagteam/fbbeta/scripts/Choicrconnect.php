<?php
	session_start();
	$dbhost = "db2751.perfora.net";
	$db = "db352475153";
	$dbpass = "adr#1n1SQL";
	$dbusr = "dbo352475153";
	$dbconnect = mysql_connect ($dbhost, $dbusr, $dbpass) or die ("Unable to open database");
	mysql_select_db ($db);
	$timestamp = date("Y-m-d H:i:s");
	if (ISSET($_SESSION['dbUsrCnt']))
		{
		$LoggedIn = 1;
		$dbUsrCnt = $_SESSION['dbUsrCnt'];
		$UserInfoSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$dbUsrCnt'";
		$UserInfoResults = mysql_query($UserInfoSQL, $dbconnect);
		$UserInfo = mysql_fetch_array($UserInfoResults);
		}
	else
		{
		$LoggedIN = 0;
		}
?>
