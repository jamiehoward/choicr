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
	$BadgeDisplaySQL = "SELECT * FROM Badges JOIN BadgeDetail ON Badges.dbBdgCnt = BadgeDetail.dbBadgeCnt WHERE Badges.dbUsrCnt = '$ProfileUserCnt'";
		$BadgeDisplayResults = mysql_query($BadgeDisplaySQL);		
	$CommentGroup = 1;
		$CommentID = $dbPostCnt;
		$CommentSQL = "SELECT * FROM Comments WHERE dbUsrCnt = '$ProfileCnt'";
		$CommentResults = mysql_query($CommentSQL, $dbconnect);
		$TotalComments = mysql_num_rows($CommentResults);
	$CurDecSQL = "SELECT * FROM Posts WHERE dbUsrCnt = '$dbUsrCnt'";
		$CurDecResults = mysql_query($CurDecSQL, $dbconnect);
		$TotalDecisions = mysql_num_rows($CurDecResults);
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
	<div class="content">
		<div class="profile">
			<div class="top-left"><?php echo $ProfileInfo['dbUsrName'];?> | "Bio"</div>
			<div class="top-right"> 
		  	<ul> 
				<li><a href="index.php?sort=votes">Following Stream</a></li> 
				<li><a href="index.php?sort=comments">My Stream</a></li> 
			</ul> 
		 	 </div>
		</div>
		 <div class='leftMenu'>
			<img src="../images/default.jpg" alt="Bio goes here?" />
			<h1> <a href="follow.php?u=<?php echo $dbUsrCnt;?>&p=<?php echo $ProfileCnt;?>"><img src="../images/follow.jpg" Title="Click to follow!" /></a></h1><br />
		<?php 
		if ($ProfileInfo['dbUsrFirstName'] != NULL || $ProfileInfo['dbUsrLastName'] != 'NULL')
			{?>
			<h2>Real Name</h2>
			<strong><?php echo $ProfileInfo['dbUsrFirstName'] . " " . $ProfileInfo['dbUsrLastName'];?></strong>
			<?php }?>
			<h1>Decisions</h1>
			<strong><?php echo $TotalDecisions;?></strong>
			<h1>Votes</h1>
			<strong><?php echo $TotalVotes;?></strong>
			<h1>Comments</h1>
			<strong><?php echo $TotalComments;?></strong>
			<h1>Decisions Following</h1>
			<strong><?php echo $TotalDFollowing;?></strong>
			<h1>Users Following</h1>
			<strong><?php echo $TotalUFollowing;?></strong>
			<h1>Badges</h1>
			<?php while ($BadgeDisplay = mysql_fetch_array($BadgeDisplayResults))
				{?><img src="../images/badges/<?php echo $BadgeDisplay['dbBadgeImg'];?>" Title="<?php echo $BadgeDisplay['dbBadgeDesc'];?>" />
				<?php }?>
			
		 </div>
        <div class="midDiv">
		<!--Start the div-->
			<?php
			function Truncate($text)
			{
			$chars = 40;
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
		$ProfileCnt = $ProfileInfo['dbUsrCnt'];
		$FeedSQL = "SELECT * FROM `Activity` WHERE `dbUsrCnt` = '$ProfileCnt' and `dbActivityType` IN (1,2,3,4,5,6,7) ORDER BY `dbActivityDate` DESC";
		$FeedResult = mysql_query($FeedSQL, $dbconnect);

	while ($FeedInfo = mysql_fetch_array($FeedResult))
		{?>
			<div class="text">
			<img src='../images/<?php echo $ProfileInfo['dbUsrPic'];?>' class='identifier' width="30px"/>
				<p class='statuses'>
			<?php
			$ActivityType = $FeedInfo['dbActivityType'];
			$ActivityID = $FeedInfo['dbActivityID'];
			if ($ActivityType == 1)
				{
				$FeedItemSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 2)
				{
				$FeedItemSQL = "SELECT * FROM Follows WHERE dbFolCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 3)
				{
				$FeedItemSQL = "SELECT * FROM Badges WHERE dbBdgCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 4)
				{
				$FeedItemSQL = "SELECT * FROM Comments WHERE dbCommCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 5)
				{
				$FeedItemSQL = "SELECT * FROM Votes WHERE dbVoteCnt = '$ActivityID'";
				}
			if ($ActivityType == 6)
				{
				$FeedItemSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 7)
				{
				$FeedItemSQL = "SELECT * FROM Follows WHERE dbFolCnt = '$ActivityID'";
				}	
			$FeedItemResults = mysql_query($FeedItemSQL, $dbconnect);
			$FeedItem = mysql_fetch_array($FeedItemResults);
			?>
			<a href='#'><strong><?php echo $ProfileInfo['dbUsrName'];?></strong></a>
			<?php
			if ($ActivityType == 1)
				{
				echo "created a decision called <br />"; 
				echo "<a href='../vote/?post=" . $FeedItem['dbPostCnt'] . "'>";
				echo "\"" . Truncate($FeedItem['dbPostTitle']) . "\"";
				echo "</a>";
				$FeedItemPic = "newdecision.jpg";
				}
			elseif ($ActivityType == 2)
				{
				$FollowCnt = $FeedItem['dbFolCnt'];
				$FollowedSQL = "SELECT * FROM Users WHERE dbUsrCnt IN (SELECT dbFollowedCnt FROM Follows WHERE dbFolCnt = '$FollowCnt' AND dbFolType = 2)";
				$FollowedResults = mysql_query($FollowedSQL,$dbconnect);
				$FollowedInfo = mysql_fetch_array($FollowedResults,$dbconnect);
				echo "started following ";
				echo "<a href='../profile/?user=" . $FollowedInfo['dbUsrCnt'] . "'>";
				echo $FollowedInfo['dbUsrName'];
				echo "</a>.";
				$FeedItemPic = "newfollow.jpg";
				}
			elseif ($ActivityType == 3)
				{
				$BadgeUserCnt = $FeedInfo['dbUsrCnt'];
				$BadgeSQL = "SELECT * FROM Badges JOIN BadgeDetail ON Badges.dbBdgCnt = BadgeDetail.dbBadgeCnt WHERE Badges.dbUsrCnt = '$BadgeUserCnt'";
				$BadgeResults = mysql_query($BadgeSQL,$dbconnect);
				$BadgeInfo = mysql_fetch_array($BadgeResults);
				echo "earned the " . $BadgeInfo['dbBadgeTitle'] . " badge!"; 
				$FeedItemPic = "newbadge.jpg";
				}
			elseif ($ActivityType == 4)
				{
				$CommentCnt = $FeedItem['dbCommCnt'];
				$CommentSQL = "SELECT * FROM Comments JOIN Posts ON Comments.dbIDCnt = Posts.dbPostCnt WHERE Comments.dbCommCnt = '$CommentCnt' AND Comments.dbIDGroup = 1";
				$CommentResults = mysql_query($CommentSQL,$dbconnect);
				$CommentInfo = mysql_fetch_array($CommentResults);
				echo "commented on the ";
				echo "<a href='../vote/?post=" . $CommentInfo['dbPostCnt'] . "'>\"";
				echo Truncate($CommentInfo['dbPostTitle']) . "\"</a> decision."; 
				$FeedItemPic = "newnote.jpg";
				}
			elseif ($ActivityType == 5)
				{
				$VoteUserCnt = $FeedInfo['dbUsrCnt'];
				$VoteSQL = "SELECT * FROM Votes JOIN Posts ON Votes.dbPostCnt = Posts.dbPostCnt WHERE Votes.dbUsrCnt = '$VoteUserCnt'";
				$VoteResults = mysql_query($VoteSQL,$dbconnect);
				$VoteInfo = mysql_fetch_array($VoteResults);
				echo "voted on the ";
				echo "<a href='../vote/?post=" . $VoteInfo['dbPostCnt'] . "'>";
				echo Truncate($VoteInfo['dbPostTitle']) . "</a> decision."; 
				$FeedItemPic = "newdecision.jpg";
				}
			elseif ($ActivityType == 6)
				{
				echo "'s decision "; 
				echo "<a href='../vote/?post=" . $FeedItem['dbPostCnt'] . "'>";
				echo "\"" . Truncate($FeedItem['dbPostTitle']) . "\"";
				echo "</a> expired.";
				$FeedItemPic = "newcompletion.jpg";
				}
			elseif ($ActivityType == 7)
				{
				$FollowedSQL = "SELECT * FROM Posts WHERE dbPostCnt IN (SELECT dbFollowedCnt FROM Follows WHERE dbFolCnt = '$ActivityID' AND dbFolType = 1)";
				$FollowedResults = mysql_query($FollowedSQL,$dbconnect);
				$FollowedInfo = mysql_fetch_array($FollowedResults,$dbconnect);
				echo "started following the ";
				echo "<a href='../vote/?post=" . $FollowedInfo['dbPostCnt'] . "'>";
				echo Truncate($FollowedInfo['dbPostTitle']);
				echo "</a> decision.";
				$FeedItemPic = "newfollow.jpg";
				}
				?>
			
				</p>
			<img src="../images/<?php echo $FeedItemPic;?>" class='icon' />
            		</div>
		<?php }?>
		<!--End the div-->
	</div>
            <div class="clear"></div>
        </div><!-- end listing -->
	</div><!-- end wrapper -->
	<?php include("../scripts/footer.php");?>
