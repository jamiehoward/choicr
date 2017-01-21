<?php
	// TYPE OF ACTIVITY GUIDE
	//1. A decision is created
	//2. Followed a user
	//3. Badge is awarded
	//4. Comment is added
	//5. Vote is added
	//6. Decision Expired
	//7. Post is followed

	function LogActivity ($User, $Type, $ID, $Detail)
		{
			$Date = $timestamp;
			$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$User', '$Type', '$ID', '$Detail', '$Date')";
			mysql_query($ActivitySQL,$dbconnect);
		}
?>