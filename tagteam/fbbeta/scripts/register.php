<?php

	function Error_msg ($geterror)
		{
			header("Location: http://www.invotic.us/signup.php?err=$geterror&id=tagteam");
		}
	function Goto_thanks_screen()
		{
			header("Location: http://invotic.us/index.php?id=tagteam");
		}
	function Send_signup_email ($emailaddress)
		{
		$to = "$emailaddress";
		$subject = "Welcome to Invoticus!";
		$body = "Hi,\n\nWelcome to Invoticus!
			\nThanks for joining.";
			$headers = "From: do-not-reply@invotic.us\r\n" .
					"X-Mailer: php";

		}

	$dbUsrFirstName = $_REQUEST['firstname'];
	$dbUsrLastName = $_REQUEST['lastname'];
	$dbUsrName = $_REQUEST['username'];
	$dbUsrPass1 = $_REQUEST['password1'];
	$dbUsrPass2 = $_REQUEST['password2'];
	$dbUsrEmail1 = $_REQUEST['email1'];
	$dbUsrEmail2 = $_REQUEST['email2'];
	$birthMonth = $_REQUEST['bmonth'];
	$birthDay = $_REQUEST['bday'];
	$birthYear = $_REQUEST['byear'];
	$dbUsrGender = $_REQUEST['gender'];

	// Start entry verification
	// Check for NULL values


		if ($dbUsrFirstName == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrLastName == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrName == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrPass1 == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrPass2 == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrEmail1 == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrEmail2 == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrGender == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}

		// Check that passwords and e-mails match

		elseif ($dbUsrPass1 != $dbUsrPass2)
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}
		elseif ($dbUsrEmail1 != $dbUsrEmail2)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}

		// Verify that e-mail is legitimate

		elseif (strlen($dbUsrEmail1) < 7)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($dbUsrEmail1) > 40)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($dbUsrEmail1, "@") == FALSE)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($dbUsrEmail1, ".") == FALSE)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}

		// Verify lengths of entries

			// Firstname
		elseif (strlen($dbUsrFirstName) < 2)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($dbUsrFirstName) > 25)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}

			// Lastname

		elseif (strlen($dbUsrLastName) < 2)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($dbUsrLastName) > 40)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}

			// Username

		elseif (strlen($dbUsrName) < 4)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($dbUsrName) > 30)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}

			// Password

		elseif (strlen($dbUsrPass1) > 15)
			{
			Error_msg (6);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($dbUsrPass1) < 7)
			{
			Error_msg (6);
			$stopSQL = 'TRUE';
			}

		// Verify that username is not already in use
		else
			{
			}

		$dbhost = "db2526.perfora.net";
		$db = "db334823716";
		$dbpass = "da6rUqeq";
		$dbusr = "dbo334823716";
		$dbconnect = mysql_connect ($dbhost, $dbusr, $dbpass) or die ("Unable to open database");
		mysql_select_db ($db, $dbconnect);

		$usernamequery = "SELECT * FROM Users WHERE dbUsrName = '$dbUsrName'";
		$usernameresult = mysql_query ($usernamequery,$dbconnect);
		$usernamerows = mysql_num_rows ($usernameresult);

		if ($usernamerows > 0)
			{
			Error_msg (7);
			$stopSQL = 'TRUE';
			}
		else
			{

		// If all entries pass verification, the following script runs:
		// Build variables to insert into database

		$dbUsrBirthday = $birthYear. "-" . $birthMonth . "-" . $birthDay;
		$timestamp = date("Y-m-d");



		// Get next dbUsrID

		$nextUserIDquery = "SELECT dbUsrID FROM Users ORDER BY dbUsrID DESC LIMIT 1";
		$nextUserIDresults = mysql_query ($nextUserIDquery, $dbconnect);
		$nextUserIDrows = mysql_fetch_array($nextUserIDresults);
			if ($nextUserIDrows ['dbUsrID'] < 1)
				{
				$nextUserID = 1;
				}
			else
				{
				$nextUserID = $nextUserIDrows ['dbUsrID']  + 1;
				}

		// Insert user information into database
		if ($stopSQL != 'TRUE')
			{
		$newuserquery = "INSERT INTO `Users` (`dbUsrCnt`, `dbUsrID`, `dbUsrFirstName`, `dbUsrLastName`, `dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrPhone`, `dbUsrGender`, `dbUsrBirthday`, `dbBuildPoints`, `dbVotePoints`, `dbReferrals`, `dbVoteCnt1`, `dbVoteCnt2`, `dbVoteCnt3`, `dbRightAmt`, `dbAddDate`, `dbModDate`) VALUES ('', '$nextUserID', '$dbUsrFirstName', '$dbUsrLastName', '$dbUsrName', '$dbUsrPass1', '$dbUsrEmail1', 'NULL', '1', '$dbUsrBirthday', '0', '0', '0', 'NULL', 'NULL', 'NULL', '0', '$timestamp', '$timestamp')";
		mysql_query ($newuserquery, $dbconnect);

			// Send signup e-mail

			Send_signup_email ($dbUsrEmail1);
			Goto_thanks_screen();
			}
			}

?>