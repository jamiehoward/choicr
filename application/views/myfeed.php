<?php 
	// Get profile information
	$profile_info_sql = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$profile_id' LIMIT 0,1;";
	$profile_info_results = $this->db->query($profile_info_sql);
	$profile_info = $profile_info_results->row_array();
	
	//Set user's picture to default if none is being used
	if ($profile_info['dbUsrPic'] == NULL)
		{
			$profile_info['dbUsrPic'] = "default.jpg";
		}
?>
<div class="content">
	<div class="profile">
		<div class="top-left"><?php echo $profile_info['dbUsrName'];?></div>
		<div class="top-right"> 
		<ul> 
		<?php if ($profile_owner == 1)
			{ ?>
			<li><a href="index.php?user=<?=$user_id?>&show=fstream">Following Stream</a></li> 
			<li><a href="index.php?user=<?php echo $_SESSION['dbUsrCnt'];?>&show=mystream">My Stream</a></li>
		<?php }?> 
		</ul> 
		</div>
	</div>

	<!-- Begin the left menu -->
	<div class='leftMenu'>
		<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/public/img/<?php echo $profile_info['dbUsrPic'];?>&w=200&zc=1" alt="Bio goes here?" width="200px"/>
		<?php if ($profile_owner != 1)
			{
			if ($following != 1)
			{?>
				<a href="follow.php?u=<?=$dbUsrCnt?>&p=<?=$profile_id?>"><img src="../images/follow.jpg" Title="Click to follow!" /></a><br />
			<?php }
			}?>
			<?php 
			if ($profile_info['dbUsrFirstName'] != NULL || $profile_info['dbUsrLastName'] != 'NULL')
			{?>
				<h1>Real Name</h1>
				<h2><?=$profile_info['dbUsrFirstName'] . " " . $profile_info['dbUsrLastName']?></h2>
			<?php }?>
			<h1>Decisions</h1>
			<h3><a href="<?=base_url()?>index.php/profile/decisions/<?=$profile_info['dbUsrCnt']?>"><?=$total_decisions_following?></a></h3>
			<h1>Votes</h1>
			<h3><?=$total_votes?></h3>
			<h1>Comments</h1>
			<h3><?=$total_comments?></h3>
			<h1>Decisions Following</h1>
			<h3><?=$total_decisions_following?></h3>
			<h1>Users Following</h1>
			<h3><?=$total_users_following?></h3>
			<?php //Show badge information; ?>

	</div>
	<!-- End left menu -->

	<!--Start the div-->
	<div class="midDiv">
	<?php
	/*
	if ($_REQUEST['show'] == 'mystream' || $ProfileUserCnt != $dbUsrCnt)
	{
	$FeedSQL = "SELECT * FROM `Activity` WHERE `dbUsrCnt` = '$ProfileCnt' AND `dbActivityType` IN (1,2,3,4,5,6,7,8) ORDER BY `dbActivityDate` DESC LIMIT 0, 13";
	$FeedResult = mysql_query($FeedSQL, $dbconnect);
	include("myfeed.php");
	}
	elseif ($_REQUEST['show'] != 'mystream' && $ProfileUserCnt == $dbUsrCnt)
	{
	$FeedSQL = "SELECT * FROM `Activity` WHERE `dbUsrCnt` IN (SELECT dbFollowedCnt FROM Follows WHERE dbFollowerCnt = '$dbUsrCnt') AND `dbActivityType` IN (1,2,3,4,6,7,8) ORDER BY `dbActivityDate` DESC LIMIT 0, 13";
	$FeedResult = mysql_query($FeedSQL, $dbconnect);
	include	("followingfeed.php");
	} */
	?>
	<!--End the div-->
	</div>
	<div class="clear"></div>
	</div>
	<!-- end listing -->
</div>
<!-- end wrapper -->