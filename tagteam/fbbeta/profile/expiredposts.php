	$ExpiredPostSQL = "SELECT * FROM `Posts` WHERE dbExpDate < '$timestamp' AND dbPostCnt NOT IN (SELECT dbActivityID FROM Activity WHERE dbActivityType = 6)";
	$ExpiredPostResults = mysql_query($ExpiredPostSQL, $dbconnect);
	while ($ExpiredPost = mysql_fetch_array($ExpiredPostResults))
		{
		$User = $ExpiredPost['dbUsrCnt'];
		$Post = $ExpiredPost['dbPostCnt'];
		$Time = $ExpiredPost['dbExpDate'];
		$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$User', 6, '$Post', NULL, '$Time)";
		mysql_query($ActivitySQL,$dbconnect);
		}