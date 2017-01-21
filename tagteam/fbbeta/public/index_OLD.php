<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	$ProfileCnt = $_REQUEST['user'];
	$VotesSQL = "SELECT * FROM Votes WHERE dbUsrCnt = '$ProfileCnt'";
		$VotesResult = mysql_query ($VotesSQL,$dbconnect); 		
		$TotalVotes = mysql_num_rows ($VotesResult);
	$ProfileSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$ProfileCnt'";
		$ProfileResults = mysql_query($ProfileSQL, $dbconnect);
		$ProfileInfo = mysql_fetch_array($ProfileResults);
		$ProfileUserCnt = $ProfileInfo['dbUsrCnt'];
	$DFollowSQL = "SELECT * FROM Follows WHERE dbFollowerCnt = '$ProfileCnt' AND dbFolType = 1";
		$DFollowResult = mysql_query($DFollowSQL);		
		$TotalDFollowing = mysql_num_rows ($DFollowResult);
	$UFollowSQL = "SELECT * FROM Follows WHERE dbFollowerCnt = '$ProfileCnt' AND dbFolType = 2";
		$UFollowResult = mysql_query($UFollowSQL);		
		$TotalUFollowing = mysql_num_rows ($UFollowResult);
	$CommentGroup = 1;
		$CommentID = $dbPostCnt;
		$CommentSQL = "SELECT * FROM Comments WHERE dbUsrCnt = '$ProfileCnt'";
		$CommentResults = mysql_query($CommentSQL, $dbconnect);
		$TotalComments = mysql_num_rows($CommentResults);
	$CurDecSQL = "SELECT * FROM Posts WHERE dbUsrCnt = '$dbUsrCnt'";
		$CurDecResults = mysql_query($CurDecSQL, $dbconnect);
	$Expiration = $PostInfo['dbExpDate'];
		$RemainingTime = GetTimeDiff($Expiration);
	if ($ProfileInfo['dbUsrPic'] == NULL)
		{
		$ProfileInfo['dbUsrPic'] = "default.jpg";
		}
	if ($AuthorInfo['dbUsrCnt'] == $dbUsrCnt)
		{
			$PostAuthor = 1;
		}
	if ($Choice1Info['dbChcPic'] == 0)
		{
		$ChoiceImage1 = $CategoryInfo['dbCatName'] . ".jpg";
		$ChoiceImage2 = $CategoryInfo['dbCatName'] . ".jpg";
		}
	else
		{
		$ChoiceImage1 = $Choice1Info['dbChcPic'];
		$ChoiceImage2 = $Choice2Info['dbChcPic'];
		}
	include("../scripts/header.php");
?>
	<?php 
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}?>
	<div class="content">
		<div class="profile">
			<div class="top-left"><?php echo $ProfileInfo['dbUsrName'];?> | "Bio"</div>
			<div class="top-right"> 
		  	<ul> 
				<li><a href="index.php?sort=votes">Following Stream</a></li> 
				<li><a href="index.php?sort=comments">My Stream</a></li> 
			</ul> 
		  </div>
		<h2>
<div class="stats">
<img src="../images/default.jpg" alt="Bio goes here?" />
<h1> <a href="follow.php?u=<?php echo $dbUsrCnt;?>&p=<?php echo $ProfileCnt;?>"><img src="../images/follow.jpg" Title="Click to follow!" /></a>
		</h1><br />
		<?php 
		if ($ProfileInfo['dbUsrFirstName'] != NULL || $ProfileInfo['dbUsrLastName'] != 'NULL')
			{?>
			<h2>Real Name</h2>
			<h3> <?php echo $ProfileInfo['dbUsrFirstName'] . " " . $ProfileInfo['dbUsrLastName'];?></h3><br />
			<?php }?>
		<h2>Decision