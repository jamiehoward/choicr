<?php
	session_start();
	//check that the user is calling the page from the login form and not accessing it directly 
	//and redirect back to the login form if necessary 
	$username = $_REQUEST['Username'];
	$password = $_REQUEST['Password'];
		
	if (!isset($username) || !isset($password)) 
		{ 
			header( "Location: ../login/"); 
		} 
	//check that the form fields are not empty, and redirect back to the login page if they are 
	elseif (empty($username) || empty($password)) 
		{ 
			header( "Location: ../login/" ); 
		} 
	else
		{ 
			$user = $_POST['Username']; 
			$pass = $_POST['Password']; 
	
	
	//set the database connection variables 
	
		include ("../scripts/connect.php");
	
		$sql = "SELECT * FROM Users WHERE `dbUsrName` = '$user' AND `dbUsrPassword` ='$pass'";
		$result=mysql_query($sql, $dbconnect); 
	
	//check that at least one row was returned 
	
		$rowCheck = mysql_num_rows($result); 
		if($rowCheck > 0)
			{ 
			while($row = mysql_fetch_array($result))
				{ 
				//start the session and register a variable 
			  session_start(); 
			  $_SESSION['dbUsrCnt'] = $row['dbUsrCnt']; 
			  //we will redirect the user to another page if successful
			  header( "Location: ../home/" ); 
			  } 
		  } 
		  else 
		  		{ 
			  //if nothing is returned by the query, unsuccessful login code goes here... 
			  header("Location: ../login?err=1"); 
				} 
	  } 
 ?> 


