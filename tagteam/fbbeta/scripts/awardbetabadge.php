<?php 
include("connect.php");
	$UsersSQL = "SELECT * FROM Users WHERE dbUsrCnt NOT IN (SELECT dbUsrCnt FROM Badges WHERE dbBdgID = 1)";
	$UsersResult = mysql_query($UsersSQL,$dbconnect);
	while ($UsersAward = mysql_fetch_array($UsersResult))
		{
		$BadgeID = 1;
		$BetaUserCnt = $UsersAward['dbUsrCnt'];
		$AwardBetaSQL = "INSERT INTO `Badges` (`dbBdgCnt`, `dbBdgID`, `dbUsrCnt`, `dbAddDate`) VALUES ('', '$BadgeID', '$BetaUserCnt', '$timestamp')";
		mysql_query ($AwardBetaSQL,$dbconnect);

		$GetAwardCntSQL = "SELECT * FROM Badges WHERE dbBdgID = '$BadgeID' AND dbUsrCnt = '$BetaUserCnt'";
		$GetAwardCntResults = mysql_query($GetAwardCntSQL,$dbconnect);
		$GetAwardCnt = mysql_fetch_array($GetAwardCntResults);
		$AwardCnt = $GetAwardCnt['dbBdgCnt'];
		
		$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$BetaUserCnt', 3, '$AwardCnt', NULL, '$timestamp')";
		mysql_query($ActivitySQL,$dbconnect);
		}

?>

