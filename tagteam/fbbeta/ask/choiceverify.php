<?php
	require("../scripts/connect.php");
	require("../scripts/session.php");

	//Assign variables pulled from previous form
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
	$private = 0;
	$newFileName1 = 0;
	$newFileName2 = 0;

	//Default action is set to allow decision to be created:
	$AllowSQL = 1;

	$expstring = $expdate . " " . $exptime;
	$expdatestamp = strtotime($expstring);
	$ExpDate = date("Y-m-d H:i:s", $expdatestamp);
	
	//Start verfication of choices and posts
	include ("verificationtest.php");

	$controlSQL = "SELECT `dbCtrlNumber` FROM `Choices` ORDER BY `dbCtrlNumber` DESC LIMIT 1";
	$controlResult = mysql_query ($controlSQL, $dbconnect);
	$controlRow = mysql_fetch_array ($controlResult);
	$dbCtrlNumber1 = $controlRow['dbCtrlNumber'] + 1;
	$dbCtrlNumber2 = $dbCtrlNumber1 + 1;
	
	$Choice1SQL = "INSERT INTO `Choices` (`dbChcCnt`, `dbCtrlNumber`, `dbUsrCnt`, `dbChcTitle`, `dbChcDesc`, `dbChcPic`, `dbAddDate`, `dbModDate`) VALUES ('', '$dbCtrlNumber1', '$dbUsrCnt', 'Default', '$Choice1Desc', '$newFileName1', '$timestamp', 'NULL')";
	
	$Choice2SQL = "INSERT INTO `Choices` (`dbChcCnt`, `dbCtrlNumber`, `dbUsrCnt`, `dbChcTitle`, `dbChcDesc`, `dbChcPic`, `dbAddDate`, `dbModDate`) VALUES ('', '$dbCtrlNumber2', '$dbUsrCnt', 'Default', '$Choice2Desc', '$newFileName2', '$timestamp', 'NULL')";
	
	mysql_query ($Choice1SQL, $dbconnect);
	mysql_query ($Choice2SQL, $dbconnect);

	
	$Chc1SQL = "SELECT * FROM `Choices` WHERE `dbCtrlNumber` = $dbCtrlNumber1";
	$Chc1Result = mysql_query ($Chc1SQL, $dbconnect);
	$Chc1Row = mysql_fetch_array ($Chc1Result);
	$Chc2SQL = "SELECT * FROM `Choices` WHERE `dbCtrlNumber` = $dbCtrlNumber2";
	$Chc2Result = mysql_query ($Chc2SQL, $dbconnect);
	$Chc2Row = mysql_fetch_array ($Chc2Result);
	
	$dbChc1Cnt = $Chc1Row['dbChcCnt'];
	$dbChc2Cnt = $Chc2Row['dbChcCnt'];
	
	$PostSQL = "INSERT INTO `Posts` (`dbPostCnt`, `dbUsrCnt`, `dbPostTitle`, `dbChc1Cnt`, `dbChc2Cnt`, `dbChc1Votes`, `dbChc2Votes`, `dbPostDesc`, `dbCatCnt`, `dbOutcome`, `dbAddDate`, `dbModDate`, `dbExpDate`, `dbPrivate`, `dbFlagged`, `dbFlagDate`, `dbBlock`, `dbClearVotes`) VALUES ('', '$dbUsrCnt', '$DecisionTitle', '$dbChc1Cnt', '$dbChc2Cnt', NULL, NULL, '$DecisionDesc', '$Category', NULL, '$timestamp', NULL, '$ExpDate', '$private', '0', NULL, '0', '1')";
	mysql_query ($PostSQL, $dbconnect);
	
	
	$GetPostSQL = "SELECT * FROM Posts WHERE dbUsrCnt = '$dbUsrCnt' AND dbChc1Cnt = '$dbChc1Cnt' AND dbChc2Cnt = '$dbChc2Cnt'";
	$GetPostResults = mysql_query($GetPostSQL, $dbconnect);
	$GetPostCnt = mysql_fetch_array ($GetPostResults);
	$GetPost = $GetPostCnt['dbPostCnt'];
	if ($GetPostCnt == NULL || $GetPostCnt < 1)
		{
		$GetPostCnt = "0";
		}
	if ($GetPostCnt == "0" || $GetPostCnt == NULL)
		{
		header("Location: ../home/?src=ask&id=$GetPost");
		}
	else
		{
		$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$dbUsrCnt', 1, '$GetPost', NULL, '$timestamp')";
		mysql_query($ActivitySQL,$dbconnect);
		header("Location: ../home/?src=ask&id=$GetPost");
		}
?>

