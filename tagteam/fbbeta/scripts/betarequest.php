<?php
	require("./connect.php");

	function Error_msg ($geterror)
		{
			header("Location: http://www.choicr.com/index.php?error=$geterror");
		}
	function Goto_thanks_screen()
		{
			header("Location: http://www.choicr.com/?notification=1;");
		}
	function Send_signup_email ($emailaddress)
		{
		$to = "$emailaddress";
		$subject = "Choicr beta signup confirmation";
		$body = "Hi,\n\nThis e-mail confirms that you've requested a beta invite to choicr.com!\nIf you're selected for beta testing, you will be notified at this e-mail address..";
			$headers = "From: do-not-reply@choicr.com\r\n" . "X-Mailer: php";
		mail($to,$subject,$body,$headers);
		}

	$Email = $_REQUEST['email'];
	$Details = $_REQUEST['details'];
	$TestNumber1 = $_REQUEST['num1'];
	$TestNumber2 = $_REQUEST['num2'];
	$TestResponse = $_REQUEST['test'];
	$TestAnswer = $TestNumber1 + $TestNumber2;
	
	$EmailExistsSQL = "SELECT * FROM Beta_Requests WHERE dbEmailAddress = '$Email'";
	$EmailExistsResults = mysql_query($EmailExistsSQL, $dbconnect);
	$EmailExists = mysql_num_rows($EmailExistsResults);

	// Start entry verification
		if ($TestResponse != $TestAnswer)
			{
			Error_msg(4);
			$stopSQL = 'TRUE';
			}	
	// Check for NULL values


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
			
	//Check to see if e-mail has already been submitted
		elseif ($EmailExists > 0)
			{
			Error_msg (3);
			$stopSQL = 'TRUE';
			}

	// If all entries pass verification, the following script runs:
	// Build variables to insert into database

		if ($stopSQL != 'TRUE')
			{
		$BetaRequestSQL = "INSERT INTO `Beta_Requests` (`dbRequestCnt`, `dbEmailAddress`, `dbRequestReason`, `dbRequestDate`, `dbInviteDate`) VALUES ('', '$Email', '$Details', '$timestamp', NULL)";
		mysql_query ($BetaRequestSQL, $dbconnect);

			// Send signup e-mail and redirect home
			Send_signup_email ($Email);
			Goto_thanks_screen();
			}
			

?>