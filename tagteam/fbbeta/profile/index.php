<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	function Truncate($text, $num)
	{
	if ($num == NULL) { $chars = 50; }
	else { $chars = $num; }	
	if (strlen($text) > $chars)
		{
		$textending = "...";
		}
	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text . $textending;
	return $text;
	}
	// Start variable assignment
	$ProfileCnt = $_REQUEST['user'];
	if (ISSET($_REQUEST['user'])) { $ProfileCnt = $_REQUEST['user']; }
	else { $ProfileCnt = $dbUsrCnt; }
	$VotesSQL = "SELECT * FROM Votes WHERE dbUsrCnt = '$ProfileCnt'";
		$VotesResult = mysql_query ($VotesSQL,$dbconnect); 		
		$TotalVotes = mysql_num_rows ($VotesResult);
	$ProfileSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$ProfileCnt'";
		$ProfileResults = mysql_query($ProfileSQL, $dbconnect);
		$ProfileInfo = mysql_fetch_array($ProfileResults);
		$ProfileUserCnt = $ProfileInfo['dbUsrCnt'];
		if ($ProfileInfo['dbUsrCnt'] == $dbUsrCnt)
			{
			$PostAuthor = 1;
			}
		if ($ProfileInfo['dbUsrPic'] == NULL)
			{
			$ProfileInfo['dbUsrPic'] = "default.jpg";
			}
	$DFollowSQL = "SELECT * FROM Follows WHERE dbFollowerCnt = '$ProfileCnt' AND dbFolType = 1";
		$DFollowResult = mysql_query($DFollowSQL);		
		$TotalDFollowing = mysql_num_rows ($DFollowResult);
	$UFollowSQL = "SELECT * FROM Follows WHERE dbFollowerCnt = '$ProfileCnt' AND dbFolType = 2";
		$UFollowResult = mysql_query($UFollowSQL);		
		$TotalUFollowing = mysql_num_rows ($UFollowResult);
	$FollowingSQL = "SELECT * FROM Follows WHERE dbFolType = 2 AND dbFollowerCnt = '$dbUsrCnt' AND dbFollowedCnt = '$ProfileUserCnt'";
		$FollowingResults = mysql_query($FollowingSQL, $dbconnect);
		$FollowingInfo = mysql_fetch_array($FollowingResults);
		if ($FollowingInfo['dbFolCnt'] != NULL) 
			{
			$Following = 1;
			}
	$BadgeDisplaySQL = "SELECT * FROM BadgeDetail WHERE dbBadgeCnt IN (SELECT dbBdgID FROM Badges WHERE dbUsrCnt = '$ProfileCnt')";
		$BadgeDisplayResults = mysql_query($BadgeDisplaySQL);
	//$UnsentInviteSQL = "SELECT * FROM Invites WHERE dbInviterCnt = '$dbUsrCnt' AND dbSentDate IS NULL";
	//	$UnsentInviteResults = mysql_query ($UnsentInviteSQL, $dbconnect);
	//	$UnsentInviteCount = mysql_num_rows ($UnsentInviteResults);
	//	if ($UnsentInviteCount > 0)
	//		{
	//		$Note = 1;
	//		}
	$CommentGroup = 1;
		$CommentID = $dbPostCnt;
		$CommentSQL = "SELECT * FROM Comments WHERE dbUsrCnt = '$ProfileCnt'";
		$CommentResults = mysql_query($CommentSQL, $dbconnect);
		$TotalComments = mysql_num_rows($CommentResults);
	$CurDecSQL = "SELECT * FROM Posts WHERE dbUsrCnt = '$ProfileCnt'";
		$CurDecResults = mysql_query($CurDecSQL, $dbconnect);
		$TotalDecisions = mysql_num_rows($CurDecResults);
	$Expiration = $PostInfo['dbExpDate'];
		$RemainingTime = GetTimeDiff($Expiration);
	
	// Mass database change scripts
	$ExpSQL = "SELECT * FROM `Posts` WHERE dbExpDate < NOW() AND dbPostCnt NOT IN (SELECT dbActivityID FROM Activity WHERE dbActivityType = 6)";
	$ExpResults = mysql_query($ExpSQL,$dbconnect);
	while ($ExpInfo= mysql_fetch_array($ExpResults))
		{
		$ExpUser = $ExpInfo['dbUsrCnt'];
		$ExpPost = $ExpInfo['dbPostCnt'];
		$ExpDate = $ExpInfo['dbExpDate'];
		$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$ExpUser', 6, '$ExpPost', NULL, '$ExpInfo')";
		mysql_query($ActivitySQL,$dbconnect);
		}
	$ClrEmptySQL = "SELECT * FROM Activity WHERE dbActivityType = 1 AND dbActivityID NOT IN (SELECT dbPostCnt FROM Posts)";
	$ClrEmptyResults = mysql_query($ClrEmptySQL,$dbconnect);
	while ($ClrEmptyInfo= mysql_fetch_array($ClrEmptyResults))
		{
		$ClrEmptyCnt = $ClrEmptyInfo['dbActivityCnt'];
		$ClrEmptyRowsSQL = "DELETE FROM `Activity` WHERE dbActivityCnt = '$ClrEmptyCnt'";
		mysql_query($ClrEmptyRowsSQL,$dbconnect);
		}
	// End mass database change scripts
	// Drop-downs
	include("../scripts/header.php");
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}
	elseif ($_REQUEST['note'] != NULL || $Note != NULL && $PostAuthor == 1)
		{
		include("notifications.php");
		}
	elseif ($_REQUEST['followup'] != NULL)
		{
		include("followup.php");
		}
	// End variable assignment section
?>

	<div class="content">
		<div class="profile">
			<div class="top-left"><?php echo $ProfileInfo['dbUsrName'];?></div>
			<div class="top-right"> 
		  	<ul> 
				<?php if ($PostAuthor == 1){?>
				<li><a href="index.php?user=<?php echo $_SESSION['dbUsrCnt'];?>&show=fstream">Following Stream</a></li> 
				
				<li><a href="index.php?user=<?php echo $_SESSION['dbUsrCnt'];?>&show=mystream">My Stream</a></li>
				<?php }?> 
			</ul> 
		 	 </div>
		</div>
		
		<!-- Begin the left menu -->
		<div class='leftMenu'>
			<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/public/img/<?php echo $ProfileInfo['dbUsrPic'];?>&w=200&zc=1" alt="Bio goes here?" width="200px"/>
		<?php if ($PostAuthor != 1)
			{
			 if ($Following != 1)
				{?>
			<a href="follow.php?u=<?php echo $dbUsrCnt;?>&p=<?php echo $ProfileUserCnt;?>"><img src="../images/follow.jpg" Title="Click to follow!" /></a><br />
				<?php }
				}?>
		<?php 
		if ($ProfileInfo['dbUsrFirstName'] != NULL || $ProfileInfo['dbUsrLastName'] != 'NULL')
			{?>
			<h1>Real Name</h1>
			<h2><?php echo $ProfileInfo['dbUsrFirstName'] . " " . $ProfileInfo['dbUsrLastName'];?></h2>
			<?php }?>
			<h1>Decisions</h1>
			<h3><a href="./decisions.php?user=<?php echo $ProfileInfo['dbUsrCnt'];?>"><?php echo $TotalDecisions;?></a></h3>
			<h1>Votes</h1>
			<h3><?php echo $TotalVotes;?></h3>
			<h1>Comments</h1>
			<h3><?php echo $TotalComments;?></h3>
			<h1>Decisions Following</h1>
			<h3><?php echo $TotalDFollowing;?></h3>
			<h1>Users Following</h1>
			<h3><?php echo $TotalUFollowing;?></h3>
			<h1>Badges</h1>
			<div class="badge">
				<?php while ($BadgeDisplay = mysql_fetch_array($BadgeDisplayResults))
				{?>
					<img src="../images/badges/<?php echo $BadgeDisplay['dbBadgeImg'];?>" Title="<?php echo $BadgeDisplay['dbBadgeTitle'] . "! " .$BadgeDisplay['dbBadgeDesc'];?>" />
				<?php }?>
			</div>
			
		</div>
		<!-- End left menu -->
		
        <!--Start the div-->
		<div class="midDiv">
		<?php
		$ProfileUserCnt = $_SESSION['dbUsrCnt'];
		
		
		if ($_REQUEST['show'] == 'fstream' && $ProfileCnt == $ProfileUserCnt)
			{
			$FeedSQL = "SELECT * FROM `Activity` WHERE `dbUsrCnt` IN (SELECT dbFollowedCnt FROM Follows WHERE dbFollowerCnt = '$ProfileUserCnt') AND `dbActivityType` IN (1,2,3,4,6,7) ORDER BY `dbActivityDate` DESC LIMIT 0, 13";
			$FeedResult = mysql_query($FeedSQL, $dbconnect);
			include	("followingfeed.php");
			}
		else
			{
			$FeedSQL = "SELECT * FROM `Activity` WHERE `dbUsrCnt` = '$ProfileCnt' AND `dbActivityType` IN (1,2,3,4,5,6,7) ORDER BY `dbActivityDate` DESC LIMIT 0, 13";
			$FeedResult = mysql_query($FeedSQL, $dbconnect);
			include("myfeed.php");
			}?>
		<!--End the div-->
	</div>
            <div class="clear"></div>
        </div>
		<!-- end listing -->
	</div>
	<!-- end wrapper -->
	<?php include("../scripts/footer.php");?>
