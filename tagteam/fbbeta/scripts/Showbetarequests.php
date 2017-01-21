<?php
			include("connect.php");
			include("header.php");
			$BetaInfoSQL = "SELECT * FROM Beta_Requests WHERE dbEmailAddress NOT IN (SELECT dbUsrEmail FROM Users) AND dbEmailAddress NOT IN (SELECT dbInviteeEmail FROM Invites)";
			$BetaInfoResults = mysql_query($BetaInfoSQL, $dbconnect);
			
?>
<div class="content">
	<table>
	<TR><TD><b>dbEmailAddress</b></TD><td><b>dbRequestReason</b></td><td><b>dbRequestDate</b></td></TR>
	<?php while ($BetaInfo = mysql_fetch_array($BetaInfoResults)){?>
	<TR>
		<TD><a href="./betainvite.php?email=<?php echo $BetaInfo['dbEmailAddress'];?>&id=phileasfogg">
		<?php echo $BetaInfo['dbEmailAddress'];?></a></TD>
		<td><?php echo $BetaInfo['dbRequestReason'];?></td>
		<td><?php echo $BetaInfo['dbRequestDate'];?></td>
	</TR>
	<?php }?>
	</table>
</div>
		<?php include("footer.php");?>