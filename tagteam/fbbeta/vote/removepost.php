<?php
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p']; 
	$PostOwnerSQL = "SELECT * FROM `Posts` WHERE `dbPostCnt` = '$dbPostCnt'";
	$PostOwnerResults = mysql_query($PostOwnerSQL, $dbconnect);
	$PostOwnerInfo = mysql_fetch_array($PostOwnerResults);
	
	if ($_REQUEST['step'] == 1)
		{
		if ($dbPostCnt == NULL)
			{
			header("Location: ../home/?error='c2'");
			}
		elseif ($dbUsrCnt != $PostOwnerInfo['dbUsrCnt'])
			{
			header("Location: ../home/?error='c3'");
			}
		else
			{
			include ("../scripts/header.php");?>
			<div class="content">
			<h6>Are you sure you want to remove this post?</h6><br/>
			This cannot be undone or reversed!<br />
			<a href="./removepost.php?p=<?php echo $dbPostCnt;?>&step=2">Yes</a> 
			<a href="./edit.php?p=<?php echo $dbPostCnt;?>">No</a>
			</div>
		<?php 	include ("../scripts/footer.php");
			}
		}
	elseif ($_REQUEST['step'] == 2)
			{
			$DelChcSQL = "DELETE FROM `Choices` WHERE `dbPostCnt` = '$dbPostCnt'";
			$DelPostSQL = "DELETE FROM `Posts` WHERE `dbPostCnt` = '$dbPostCnt'";
			mysql_query($DelPostSQL, $dbconnect);
			mysql_query($DelChcSQL, $dbconnect);
			header("Location: ../home/?notification=v2");
			}
	else
		{
		header("Location: ../home/?error='c1'");
		}

?>
