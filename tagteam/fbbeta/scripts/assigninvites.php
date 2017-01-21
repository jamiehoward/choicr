<?php 
include("connect.php");
	if ($_REQUEST['id'] == 'tagteam')
		{
			$UsersSQL = "SELECT * FROM Users";
			$UsersResult = mysql_query($UsersSQL,$dbconnect);
			$UsersCount= mysql_num_rows($UsersResult);
			echo "This will assign " . ($UsersCount * 5) . " open beta invites.<br />";
			echo "Are you sure you want to do this?<br />";
			echo "<a href='assigninvites.php?id=stage2process'>Yes</a>";
		}
	if ($_REQUEST['id'] == 'stage2process')
		{
			$UsersSQL = "SELECT * FROM Users";
			$UsersResult = mysql_query($UsersSQL,$dbconnect);
			while ($UsersInfo= mysql_fetch_array($UsersResult))
				{
				$InviterCnt = $UsersInfo['dbUsrCnt'];
				$AssignInviteSQL = "INSERT INTO `Invites` (`dbInviteCnt`, `dbInviterCnt`) VALUES ('','$InviterCnt')";
				mysql_query ($AssignInviteSQL,$dbconnect);
				mysql_query ($AssignInviteSQL,$dbconnect);
				mysql_query ($AssignInviteSQL,$dbconnect);
				mysql_query ($AssignInviteSQL,$dbconnect);
				mysql_query ($AssignInviteSQL,$dbconnect);
				}
			echo "Process complete. Beta invites have been assigned.";
		}
?>

