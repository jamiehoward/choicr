<?php
	require("../scripts/connect.php");
	function Error_msg ($geterror)
		{
			header("Location: index.php?error=$geterror");
		}
	function Verify_Pass()
		{
			header("Location: index.php?note=1");
		}

	$ProfileSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$dbUsrCnt'";
	$ProfileResults = mysql_query($ProfileSQL, $dbconnect);
	$ProfileInfo = mysql_fetch_array($ProfileResults);


	if ($_REQUEST['newspassword1'] != $ProfileInfo['dbUsrPassword'] && $_REQUEST['newspassword1'] != NULL)
		{
		if ($_REQUEST['newpassword1'] != $_REQUEST['newpassword2'])
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($_REQUEST['oldpassword'] != $ProfileInfo['dbUsrPassword'])
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Password) > 30)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Password) < 5)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}
		}
	else 
		{
		$Password = $ProfileInfo['dbUsrPassword'];
		}
	if ($_REQUEST['email'] != NULL && $_REQUEST['email'] != $ProfileInfo['dbUsrEmail'])
		{
		if (strlen($Email) < 7)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Email) > 40)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, "@") == FALSE)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, ".") == FALSE)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		}
	else 
		{
		$Email = $ProfileInfo['dbUsrEmail'];
		}
	if ($_REQUEST['firstname'] && $_REQUEST['firstname'] != $ProfileInfo['dbUsrFirstName'])
		{
		$FirstName = $_REQUEST['firstname'];
		}
	else 
		{
		$FirstName = $ProfileInfo['dbUsrFirstName'];
		}
	if ($_REQUEST['lastname'] && $_REQUEST['lastname'] != $ProfileInfo['dbUsrLastNamel'])
		{
		$LastName = $_REQUEST['lastname'];
		}
	else 
		{
		$LastName = $ProfileInfo['dbUsrLastName'];
		}
	if ($_REQUEST['agegroup'] != $ProfileInfo['dbUsrAgeGroup'])
		{
		$AgeGroup = $_REQUEST['agegroup'];
		}
	else 
		{
		$AgeGroup = $ProfileInfo['dbUsrAgeGroup'];
		}
	if ($_REQUEST['gender'] != NULL && $_REQUEST['gender'] != $ProfileInfo['dbUsrGender'])
		{
		$Gender = $_REQUEST['gender'];
		}
	else 
		{
		$Gender = $ProfileInfo['dbUsrGender'];
		}

		// Update user information
	if ($stopSQL != 'TRUE')
		{
		$UpdateUserSQL = "UPDATE `Users` SET dbUsrFirstName = '$FirstName', dbUsrLastName = '$LastName', dbUsrPassword = '$Password', dbUsrEmail = '$Email', dbUsrGender = '$Gender', dbUsrAgeGroup = '$AgeGroup', dbModDate = '$timestamp' WHERE dbUsrCnt = '$dbUsrCnt'";
		mysql_query ($UpdateUserSQL, $dbconnect);
		
		Verify_Pass();
		}
?>