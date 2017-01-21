<?php
	session_start();
	$dbhost = "db2856.perfora.net";
	$db = "db359883992";
	$dbpass = "tagteam#ChC";
	$dbusr = "dbo359883992";
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
	function LogActivity ($User, $Type, $ID, $Detail)
		{	
			$Date = $timestamp;
			$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$User', '$Type', '$ID', '$Detail', '$Date')";
			mysql_query($ActivitySQL,$dbconnect);
		}
?>
