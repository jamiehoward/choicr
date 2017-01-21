<?php

	function Error_msg ($geterror)
		{
			header("Location: register.php?error=$geterror&id=tagteam");
		}
	function Goto_thanks_screen()
		{
			header("Location: index.php?notification=1");
		}
	function Send_signup_email ($emailaddress,$Username,$Password)
		{
		$to = "$emailaddress";
		$subject = "Welcome to Choicr Beta!";
		$body = "Congratulations, and welcome to the Choicr beta program!\n\nYou signed up with the username and password combination: ".$Username." | ".$Password."\n\nWe need your feedback and your meticulous combing of the site.\n\nYou can give us feedback by accessing the feedback tab on the left hand of the site. By doing this you help us serve you better, and give us insight into how a real user is going to utilize different parts of the site.\n\nThere are many things unfinished and possibly buggy. Let us know when you find these and we will be eternally grateful.\n\n When you are ready go ahead and log in here: www.choicr.com/beta/\n\nFeel free to invite friends and tell others about how fun decision making can be by sending them to www.choicr.com to sign up for an invite!\n\nMany thanks, and we look forward to serving you,\n\nJohn Howard | CEO\nwww.choicr.com\nInvoticus, Inc.";
			$headers = "From: do-not-reply@choicr.com\r\n" .
					"X-Mailer: php";
		mail($to,$subject,$body,$headers);
		}

	$Username = $_REQUEST['username'];
	$Password = $_REQUEST['password'];
	$Email = $_REQUEST['email'];
	$Terms = $_REQUEST['terms'];
	$TestNumber1 = $_REQUEST['num1'];
	$TestNumber2 = $_REQUEST['num2'];
	$TestResponse = $_REQUEST['test'];
	$TestAnswer = $TestNumber1 + $TestNumber2;

	$BetaSQL = "SELECT * FROM Invites WHERE dbInviteeEmail = '$Email'";
	$BetaResults = mysql_query($BetaSQL);
	$BetaCount = mysql_num_rows($BetaResults);
	

	// Start entry verification
		if ($TestResponse != $TestAnswer)
			{
			Error_msg(6);
			$stopSQL = 'TRUE';
			}	
	// Verify user was invited to site
		elseif ($BetaCount == 2)
			{
			Error_msg (7);
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

		elseif (strlen($Password) > 30)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Password) < 5)
			{
			Error_msg (4);
			$stopSQL = 'TRUE';
			}

		// Verify that username is not already in use
		else
			{
			}

		$dbhost = "db2751.perfora.net";
		$db = "db352475153";
		$dbpass = "adr#1n1SQL";
		$dbusr = "dbo352475153";
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
			$newuserquery = "INSERT INTO `Users` (`dbUsrCnt`, `dbUsrID`, `dbUsrFirstName`, `dbUsrLastName`, `dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrPhone`, `dbUsrGender`, `dbUsrBirthday`, `dbUsrPic`, `dbUsrTimezone`, `dbVoteCnt1`, `dbVoteCnt2`, `dbVoteCnt3`, `dbRightAmt`, `dbLastLogin`, `dbAddDate`, `dbModDate`) VALUES ('', '$nextUserID', NULL, NULL, '$Username', '$Password', '$Email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$timestamp', NULL)";
			mysql_query ($newuserquery, $dbconnect);
			
			$UpdateInviteSQL = "UPDATE Invites SET dbAcceptDate = '$timestamp' WHERE dbInviteeEmail = '$Email'";
			mysql_query ($UpdateInviteSQL, $dbconnect);
			
			// Send signup e-mail

			Send_signup_email ($Email,$Username,$Password);
			Goto_thanks_screen();
			}
			}

?>