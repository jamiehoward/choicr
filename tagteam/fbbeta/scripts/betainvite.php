<?php
	require("./connect.php");

	function Error_msg ($User, $geterror)
		{
			header("Location: ../profile/?user=$User&error=$geterror");
		}
	function Goto_thanks_screen($User)
		{
			header("Location: ../home/?note=i2");
		}
	function Send_invite_email ($emailaddress)
		{
		$subject = "Choicr.com | Official beta invite!";
		$body = "Greetings!\nYou have been invited to participate in the beta program for Choicr!\n\nYou can get started here: www.choicr.com/beta/register.php?id=tagteam\n\nIn order to register, you must use this e-mail address.\n\nGo ahead and sign up and start creating decisions. Give us feedback by accessing the feedback bar on the left hand of the site!\n\nYou can follow others as well as vote on others' decisions.\n\nWe would love your feedback and help fixing the little 'bugs' that have snuck in on the site.\n\nThanks again for your participation and welcome to the choicr community!\n\nJohn C. Howard | CEO\nwww.choicr.com\nInvoticus, Inc.";
		$headers = "From: beta_invites@choicr.com\r\n" . "X-Mailer: php";
		mail($emailaddress,$subject,$body,$headers);
		}

	$Email = $_REQUEST['email'];
	
	$EmailExistsSQL = "SELECT * FROM Invites WHERE dbInviteeEmail = '$Email'";
	$EmailExistsResults = mysql_query($EmailExistsSQL, $dbconnect);
	$EmailExists = mysql_num_rows($EmailExistsResults);
	
	if ($_REQUEST['id'] != "phileasfogg")
	{
	$UnsentInviteSQL = "SELECT * FROM Invites WHERE dbInviterCnt = '$dbUsrCnt' AND dbSentDate IS NULL LIMIT 0,1";
	$UnsentInviteResults = mysql_query ($UnsentInviteSQL, $dbconnect);
	$UnsentInviteInfo = mysql_fetch_array($UnsentInviteResults);
	$UnsentInviteCount = mysql_num_rows ($UnsentInviteResults);
	}	

	// Start entry verification
	// Check for NULL values


		if ($Email == NULL)
			{
			Error_msg ($dbUsrCnt, i1);
			$stopSQL = 'TRUE';
			}
		elseif ($_SESSION['dbUsrCnt'] == NULL)
			{
			Error_msg ($dbUsrCnt, i1);
			$stopSQL = 'TRUE';
			}
	
		// Verify that e-mail is legitimate

		elseif (strlen($Email) < 7)
			{
			Error_msg ($dbUsrCnt, i2);
			$stopSQL = 'TRUE';
			}
		elseif (strlen($Email) > 40)
			{
			Error_msg ($dbUsrCnt, i2);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, "@") == FALSE)
			{
			Error_msg ($dbUsrCnt, i2);
			$stopSQL = 'TRUE';
			}
		elseif (strpos($Email, ".") == FALSE)
			{
			Error_msg ($dbUsrCnt, i2);
			$stopSQL = 'TRUE';
			}
			
	//Check to see if e-mail has already been submitted
		elseif ($EmailExists > 0)
			{
			Error_msg ($dbUsrCnt, i3);
			$stopSQL = 'TRUE';
			}
		elseif ($UnsentInviteCount < 1 && $_REQUEST['id'] != "phileasfogg")
			{
			Error_msg ($dbUsrCnt, i4);
			$stopSQL = 'TRUE';
			}

	// If all entries pass verification, the following script runs:
	// Build variables to insert into database

		if ($stopSQL != 'TRUE')
			{
			if ($_REQUEST['id'] == "phileasfogg")
				$BetaInviteSQL = "INSERT INTO `Invites` (`dbInviteCnt`, `dbInviterCnt`, `dbInviteeEmail`, `dbSentDate`, `dbAcceptDate`) VALUES ('', 0, '$Email', '$timestamp', NULL)";
			else
				{
				$BetaInviteCnt = $UnsentInviteInfo['dbInviteCnt'];
				$BetaInviteSQL = "UPDATE `Invites` SET `dbInviteeEmail` = '$Email', `dbSentDate` = '$timestamp' WHERE dbInviteCnt = $BetaInviteCnt";
				}
			mysql_query ($BetaInviteSQL, $dbconnect);

			// Send signup e-mail and redirect home
			Send_invite_email ($Email);
			if ($_REQUEST['id'] == "phileasfogg")
				header("Location: ./Showbetarequests.php");
			else
				{
				Goto_thanks_screen($dbUsrCnt);
				}
			}
			

?>