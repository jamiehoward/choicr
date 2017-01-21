<?php
require("../../connect.php");

if ($_REQUEST['action'] == "resetusersdb")
	{
	$query = "DELETE FROM Users";
	$query2 = "ALTER TABLE Users AUTO_INCREMENT = 1";
	mysql_query ($query, $dbconnect);
	mysql_query ($query2, $dbconnect);
	echo "All users have been deleted and auto_increment has been reset successfully.";
	}

elseif ($_REQUEST['action'] == "displayallusers")
	{
	$query = "SELECT * FROM Users;";
	$queryresults = mysql_query ($query, $dbconnect);
	$queryrows = mysql_fetch_array ($queryresults);
		
	echo $queryrows['dbUsrCnt'];
	}

elseif ($_REQUEST['action'] == "addtestuser")
	{
	$dbUsrBirthday = date("Y-m-d");
	$timestamp = date("Y-m-d");
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
	$newuserquery = "INSERT INTO `Users` (`dbUsrCnt`, `dbUsrID`, `dbUsrFirstName`, `dbUsrLastName`, `dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrPhone`, `dbUsrGender`, `dbUsrBirthday`, `dbBuildPoints`, `dbVotePoints`, `dbReferrals`, `dbVoteCnt1`, `dbVoteCnt2`, `dbVoteCnt3`, `dbRightAmt`, `dbAddDate`, `dbModDate`) VALUES ('', '$nextUserID', 'TESTFirstName', 'TESTLastName', 'TESTUsrName', 'TEST123', 'test@invotic.us', '555-555-1234', '1', '$dbUsrBirthday', '0', '0', '0', 'NULL', 'NULL', 'NULL', '0', '$timestamp', '$timestamp')";
	mysql_query ($newuserquery, $dbconnect);
	echo "Test user added successfully!";
	}
elseif ($_REQUEST['action'] == "nextuserid")
	{
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
	echo "The next dbUserID is $nextUserID";
	}
elseif ($_REQUEST['action'] == "betarequests")
	{
		$BetaRequestsSQL = "SELECT * FROM Beta_Requests";
		$BetaRequestsResults = mysql_query($BetaRequestsSQL, $dbconnect);
		?>
		<table border=1>
			<tr>
				<td>dbRequestCnt</td>
				<td>dbEmailAddress</td>
				<td>dbRequestReason</td>
				<td>dbRequestDate</td>
				<td>dbInviteDate</td>
			</tr>
		<?php
		while ($RequestInfo = mysql_fetch_array($BetaRequestResults))
			{?>
			<tr>
				<td><?php echo $RequestInfo['dbRequestCnt'];?></td>
				<td><?php echo $RequestInfo['dbEmailAddress'];?></td>
				<td><?php echo $RequestInfo['dbRequestReason'];?></td>
				<td><?php echo $RequestInfo['dbRequestDate'];?></td>
				<td><?php echo $RequestInfo['dbInviteDate'];?></td>			
			</tr>
		<?php }?>
		</table>
	<?php }?>
	
<?php
echo "<br /><a href='index.php?id=tagteam'>BACK</a>";
?>