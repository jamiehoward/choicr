<?php
	function Error_msg ($geterror)
		{
			header("Location: http://www.invotic.us/login.php?err=$geterror");
		}
	function Goto_Index()
		{
		header("Location: http://invotic.us/home.php");
	}
	//include("connect.php");

	$dbUsrName = $_REQUEST['Username'];
	$dbUsrPassword = $_REQUEST['Password'];

	$dbconnect = mysql_connect ($dbhost, $dbusr, $dbpass) or die ("Unable to open database");
	mysql_select_db ($db, $dbconnect);

	$usernamequery = "SELECT * FROM Users WHERE dbUsrName = '$dbUsrName'";
	$usernameresult = mysql_query ($usernamequery,$dbconnect);
	$row = mysql_fetch_array ($usernameresult);

	if ($dbUsrPassword = NULL)
		{
		Error_msg (1);
		}
	elseif ($row['dbUsrPassword'] = NULL)
		{
		Error_msg (1);
		}
	elseif ($dbUsrName = NULL)
		{
		Error_msg (1);
		}
	elseif ($row['dbUsrName'] = NULL)
		{
		Error_msg (1);
		}
	elseif ($dbUsrPassword != $row['dbUsrPassword'])
		{
		Error_msg (1);
		}
	else
		{
		session_start();				
		$_SESSION['dbUsrCnt'] = $row['dbUsrCnt'];
		$dbUsrCnt = $_SESSION['dbUsrCnt'];
		session_register(dbUsrCnt);
		if (ISSET($_SESSION['dbUsrCnt']))
				{
				$UserCnt = $_SESSION['dbUsrCnt'];
				$UserInfoSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$UserCnt'";
				$UserInfoResults = mysql_query($UserInfoSQL, $dbconnect);
				$UserInfo = mysql_fetch_array($UserInfoResults);	
				Goto_Index();
				}
			else
				{
				$_SESSION['LoggedIn'] = 0; 
				}	

		}

