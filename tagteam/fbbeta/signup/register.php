<?php

	function Error_msg ($geterror)
		{
			header("Location: ../signup/index.php?error=$geterror");
		}
	function Goto_thanks_screen()
		{
			header("Location: ../home/");
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

	$Username = $_REQUEST['username'];
	$Password = $_REQUEST['password'];
	$Email = $_REQUEST['email'];
	$Terms = $_REQUEST['terms'];
	$TestNumber1 = $_REQUEST['num1'];
	$TestNumber2 = $_REQUEST['num2'];
	$TestResponse = $_REQUEST['test'];
	$TestAnswer = $TestNumber1 + $TestNumber2;
	

	// Start entry verification
		if ($TestResponse != $TestAnswer)
			{
			Error_msg(6);
			$stopSQL = 'TRUE';
			}	
	// Check for NULL values


		elseif ($Username == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($Password == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($Email == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($TestResponse == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
		elseif ($Terms == NULL)
			{
			Error_msg (1);
			$stopSQL = 'TRUE';
			}
			
		// Verify that e-mail is legitimate

		elseif (strlen($Email) < 7)
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Email) > 40)
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, "@") == FALSE)
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, ".") == FALSE)
			{
			Error_msg (2);
			$stopSQL = 'TRUE';
			}

		// Verify lengths of entries

			// Username

		elseif (strlen($Username) < 4)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Username) > 30)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}

			// Password

		elseif (strlen($Password) > 15)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Password) < 7)
			{
			Error_msg (4);
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

		$usernamequery = "SELECT * FROM Users WHERE dbUsrName = '$Username'";
		$usernameresult = mysql_query ($usernamequery,$dbconnect);
		$usernamerows = mysql_num_rows ($usernameresult);

		if ($usernamerows > 0)
			{
			Error_msg (5);
			$stopSQL = 'TRUE';
			}
		else
			{

		// If all entries pass verification, the following script runs:
		// Build variables to insert into database

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
		$newuserquery = "INSERT INTO `Users` (`dbUsrCnt`, `dbUsrID`, `dbUsrFirstName`, `dbUsrLastName`, `dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrPhone`, `dbUsrGender`, `dbUsrBirthday`, `dbBuildPoints`, `dbVotePoints`, `dbReferrals`, `dbVoteCnt1`, `dbVoteCnt2`, `dbVoteCnt3`, `dbRightAmt`, `dbAddDate`, `dbModDate`) VALUES ('', '$nextUserID', 'NULL', 'NULL', '$Username', '$Password', '$Email', 'NULL', '1', 'NULL', '0', '0', '0', 'NULL', 'NULL', 'NULL', '0', '$timestamp', '$timestamp')";
		mysql_query ($newuserquery, $dbconnect);

			// Send signup e-mail

			Send_signup_email ($Email);
			Goto_thanks_screen();
			}
			}

?>