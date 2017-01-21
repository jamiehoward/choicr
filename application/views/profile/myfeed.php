<?php 
	foreach ($feed_sql->result() as $feed_info)
		{?>
			<div class="text">
			<img src=""/>
				<p class='statuses'>
			<?php
			$ActivityType = $feed_info['dbActivityType'];
			$ActivityID = $feed_info['dbActivityID'];
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
				$FeedItemSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 5)
				{
				$FeedItemSQL = "SELECT * FROM Votes WHERE dbVoteCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 6)
				{
				$FeedItemSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 7)
				{
				$FeedItemSQL = "SELECT * FROM Follows WHERE dbFolCnt = '$ActivityID'";
				}
			elseif ($ActivityType == 8)
				{
				$FeedItemSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
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
				echo "\"" . Truncate($FeedItem['dbPostTitle'], 50) . "\"";
				echo "</a>";
				$FeedItemPic = "newdecision.jpg";
				}
			elseif ($ActivityType == 2)
				{
				$FollowCnt = $FeedItem['dbFolCnt'];
				$FollowedSQL = "SELECT * FROM Users WHERE dbUsrCnt = '$ActivityID'";
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
				$BadgeSQL = "SELECT * FROM `BadgeDetail` WHERE dbBadgeCnt IN (SELECT dbBdgID FROM Badges WHERE dbBdgCnt = '$ActivityID')";
				$BadgeResults = mysql_query($BadgeSQL,$dbconnect);
				$BadgeInfo = mysql_fetch_array($BadgeResults);
				echo "earned the " . $BadgeInfo['dbBadgeTitle'] . " badge! ";
				echo "<img src='../images/badges/" . $BadgeInfo['dbBadgeImg'];
				echo "' Title='" . $BadgeInfo['dbBadgeDesc'] . "' width='30px'/>";
				$FeedItemPic = "newbadge.jpg";
				}
			elseif ($ActivityType == 4)
				{
				echo "commented on the "; 
				echo "<a href='../vote/?post=" . $FeedItem['dbPostCnt'] . "'>";
				echo "\"" . Truncate($FeedItem['dbPostTitle'], 50) . "\"";
				echo "</a> decision";
				$FeedItemPic = "newnote.jpg";
				}
			elseif ($ActivityType == 5)
				{
				$VoteUserCnt = $feed_info['dbUsrCnt'];
				$VoteSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				$VoteResults = mysql_query($VoteSQL,$dbconnect);
				$VoteInfo = mysql_fetch_array($VoteResults);
				echo "voted on the ";
				echo "<a href='../vote/?post=" . $VoteInfo['dbPostCnt'] . "'>\"";
				echo Truncate($VoteInfo['dbPostTitle'], 50) . "\"</a> decision."; 
				$FeedItemPic = "newvote.jpg";
				}
			elseif ($ActivityType == 6)
				{
				echo "'s decision "; 
				echo "<a href='../vote/?post=" . $FeedItem['dbPostCnt'] . "'>";
				echo "\"" . Truncate($FeedItem['dbPostTitle'], 50) . "\"";
				echo "</a> expired.";
				$FeedItemPic = "newcompletion.jpg";
				}
			elseif ($ActivityType == 7)
				{
				$FollowedSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$ActivityID'";
				$FollowedResults = mysql_query($FollowedSQL,$dbconnect);
				$FollowedInfo = mysql_fetch_array($FollowedResults,$dbconnect);
				echo "started following the ";
				echo "<a href='../vote/?post=" . $FollowedInfo['dbPostCnt'] . "'>\"";
				echo Truncate($FollowedInfo['dbPostTitle'], 50);
				echo "\"</a> decision.";
				$FeedItemPic = "newfollow.jpg";
				}
			elseif ($ActivityType == 8)
				{
				echo "posted a follow up message on the <br />"; 
				echo "<a href='../vote/?post=" . $FeedItem['dbPostCnt'] . "'>";
				echo "\"" . Truncate($FeedItem['dbPostTitle'], 50) . "\"";
				echo "</a> decision.";
				$FeedItemPic = "newdecision.jpg";
				}
				?>
				</p>
			<img src="../images/<?php echo $FeedItemPic;?>" class='icon' />
            		</div>
		<?php }?>