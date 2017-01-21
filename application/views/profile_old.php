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
	
	$userID = $this->session->userdata('userID');
?>
<div class="content">
	<div class="profile">
		<div class="top-left"><?=$profile_info['dbUsrName']?></div>
		<div class="top-right"> 
			<ul> 
			<?php if ($profile_owner == 1)
				{ ?>
				<li><a href="<?=base_url()?>index.php/profile/<?=$userID?>/myfeed">Following Stream</a></li> 
				<li><a href="<?=base_url()?>index.php/profile/<?=$userID?>/followingfeed">My Stream</a></li>
			<?php }?> 
			</ul> 
		</div>
	</div>

	<!-- Begin the left menu -->
	<div class='leftMenu'>
		<img src="" alt="Bio goes here?" width="200px"/>
		<?php if ($profile_owner != 1)
			{
				if ($following != 1)
				{?>
					<a href=""><img src="<?=base_url()?>img/follow.jpg" Title="Click to follow!" /></a><br />
				<?php }
			}?>
			<?php 
			if ($profile_info['dbUsrFirstName'] != NULL || $profile_info['dbUsrLastName'] != 'NULL')
			{?>
				<h1>Real Name</h1>
				<h2><?=$profile_info['dbUsrFirstName'] . " " . $profile_info['dbUsrLastName']?></h2>
			<?php }?>
			<h1>Decisions</h1>
			<h3>
				<a href="<?=base_url()?>index.php/profile/decisions/<?=$profile_info['dbUsrCnt']?>"> <?=$total_decisions_following?></a>
			</h3>
			<h1>Votes</h1>
			<h3><?=$total_votes?></h3>
			<h1>Comments</h1>
			<h3><?=$total_comments?></h3>
			<h1>Decisions Following</h1>
			<h3><?=$total_decisions_following?></h3>
			<h1>Users Following</h1>
			<h3><?=$total_users_following?></h3>
			<?php //Show badge information;?>


	</div>
	<!-- End left menu -->

	<!--Start the div-->
	<div class="midDiv">
	<?php
		if ($profile_view == 'myfeed')
		{
			$feed['feed_sql'] = $this->db->query("SELECT * FROM `Activity` WHERE `dbUsrCnt` = '$userID' AND `dbActivityType` IN (1,2,3,4,5,6,7,8) ORDER BY `dbActivityDate` DESC LIMIT 0, 13;");
			$this->load->view('profile/myfeed', $feed);
		}
		elseif ($profile_view == 'followingfeed')
		{
			$feed['feed_sql'] = $this->db->query("SELECT * FROM `Activity` WHERE `dbUsrCnt` IN (SELECT dbFollowedCnt FROM Follows WHERE dbFollowerCnt = '$userID') AND `dbActivityType` IN (1,2,3,4,6,7,8) ORDER BY `dbActivityDate` DESC LIMIT 0, 13;");
			$this->load->view('profile/followingfeed', $feed);
		} 
	?>
	<!--End the div-->
	</div>
	<div class="clear"></div>
	</div>
	<!-- end listing -->
</div>
<!-- end wrapper -->