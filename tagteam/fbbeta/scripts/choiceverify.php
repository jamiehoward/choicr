<?php
	require("connect.php");
	require("session.php");

	$dbUsrCnt = $_SESSION['dbUsrCnt'];
	$timestamp = date("Y-m-d H:i:s");
	$DecisionTitle = $_REQUEST['DecisionTitle'];
	$DecisionDesc = $_REQUEST['details'];
	$Choice1Desc = $_REQUEST['Choice1Desc'];
	$Choice2Desc = $_REQUEST['Choice2Desc'];
	$Photo1 = $_REQUEST['Photo1'];
	$Photo2 = $_REQUEST['Photo2'];
	//$Category = $_REQUEST['Category'];
	$Category = 'Example';	
	$expmonth = $_REQUEST['expmonth'];
	$expday = $_REQUEST['expday'];
	$expyear = $_REQUEST['expyear'];
	//$exphour = $_REQUEST['exphour'];
	$exphour = 12;
	//$expminute = $_REQUEST['expminute'];
	$expminute = 00;
	//$private = $_REQUEST['private'];
	$private = 1;
	
	//Start image upload//////////////////////////////////////////////
			$target_path = "..public/img/";		
			//Check file extension 
		  $allowedExtensions = array("jpg","jpeg","gif","png"); 
		  foreach ($_FILES as $file) { 
		    if ($file['tmp_name'] > '') { 
		      if (!in_array(end(explode(".", 
		            strtolower($file['name']))), 
		            $allowedExtensions)) { 
		       die($file['name'].' is an invalid file type!<br/>'. 
		        '<a href="javascript:history.go(-1);">'. 
		        '&lt;&lt Go Back</a>'); 
		      } 
		    } 
		  } 
			//End check file extension
		
		//Rename image
			$imgstamp = date("ymdHis");
			$newFileName1 = "1" . $imgstamp . $dbUsrCnt . ".jpg";
			$newFileName2 = "2" . $imgstamp . $dbUsrCnt . ".jpg";
		//End rename image
		
		$target_path1 = $target_path . $newFileName1;
		if(move_uploaded_file($_FILES['image1']['tmp_name'], $target_path1)) {
			$PicErr1 = 0;
		} else{
			$PicErr1 = $_FILES['image1']['error'];
		}
		$target_path2 = $target_path . $newFileName2;
		if(move_uploaded_file($_FILES['image2']['tmp_name'], $target_path2)) {
			$PicErr2 = 0;
		} else{
			$PicErr2 = $_FILES['image2']['error'];
		}
	//End image upload////////////////////////////////////
		  
	$expstring = $expyear . "-" . $expmonth . "-" . $expday . " " . $exphour . ":" . $expminute . ":00";
	$expdatestamp = strtotime($expstring);
	$ExpDate = date("Y-m-d H:i:s", $expdatestamp);

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
	
	$PostSQL = "INSERT INTO `Posts` (`dbPostCnt`, `dbUsrCnt`, `dbPostTitle`, `dbChc1Cnt`, `dbChc2Cnt`, `dbChc1Votes`, `dbChc2Votes`, `dbPostDesc`, `dbCatCnt`, `dbOutcome`, `dbAddDate`, `dbModDate`, `dbExpDate`, `dbPrivate`, `dbFlagged`, `dbFlagDate`, `dbBlock`) VALUES ('', '$dbUsrCnt', 'Default', '$dbChc1Cnt', '$dbChc2Cnt', NULL, NULL, '$DecisionDesc', '$Category', NULL, '$timestamp', NULL, '$ExpDate', '$private', '0', NULL, '0')";

	mysql_query ($PostSQL, $dbconnect);
	echo "File 1: " . $newFileName1 . " Error: " . $PicErr1 . "<br />";
	echo "File 2: " . $newFileName2 . " Error: " . $PicErr2 . "<br />";
?>

