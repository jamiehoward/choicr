<?php
	$dbUsrCnt = $_SESSION['dbUsrCnt'];
	$timestamp = date("Y-m-d H:i:s");
	$DecisionTitle = $_REQUEST['DecisionTitle'];
	$DecisionDesc = $_REQUEST['details'];
	$Choice1Desc = $_REQUEST['Choice1Desc'];
	$Choice2Desc = $_REQUEST['Choice2Desc'];
	$Photo1 = $_REQUEST['Photo1'];
	$Photo2 = $_REQUEST['Photo2'];
	$Category = $_REQUEST['Category'];
	$expdate = $_REQUEST['expdate'];
	$exptime = $_REQUEST['exptime'];

	if ($dbUsrCnt == NULL || $dbUsrCnt != $_SESSION['dbUsrCnt'])
		{
		$AllowSQL = 0;
		header ("../ask/?error=1");
		}
	elseif ($Category == NULL || $expdate == NULL || $exptime == NULL)
		{
		$AllowSQL = 0;
		header ("../ask/?error=1");
		}
	elseif ($ExpDate < $timestamp)
		{
		$AllowSQL = 0;
		header ("../ask/?error=2");
		}
	elseif (strlen($Choice1Desc) > 48 || strlen($Choice2Desc) > 48)
		{
		$AllowSQL = 0;
		header ("../ask/?error=3");
		}
?>