<?php
			include("connect.php");
			include("header.php");
			$UserInfoSQL = "SELECT dbUsrCnt, dbUsrName, dbUsrEmail FROM Users ORDER BY dbUsrName";
			$UserInfoResults = mysql_query($UserInfoSQL, $dbconnect);
			
?>
<div class="content">
	<table>
	<TR>
		<td>&nbsp;</td><TD><b>Username</b></td><td>&nbsp;</td><td><b>E-mail Address</b></td>
	</TR>		
	<?php 
	$i = 1;
	while ($UserInfo = mysql_fetch_array($UserInfoResults))
		{?>
	<TR>
		<td><?php echo $i;?>. </td>
		<td><a href="../profile/?user=<?php echo $UserInfo['dbUsrCnt'];?>">
		<?php echo $UserInfo['dbUsrName'];?></a></td>
		<td>&nbsp;</td>
		<td><?php echo $UserInfo['dbUsrEmail'];?></td>
	</TR>
	<?php 
		$i = $i + 1;
		}?>
	</table>
</div>
		<?php include("footer.php");?>