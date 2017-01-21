<?php //Load functions
	function Truncate($text) 
	{
	$chars = 85;

	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text."...";

	return $text;
	}
	
	function GetTimeDiff ($timestamp)
	{
		$now = time();
		$then = strtotime($timestamp); 
		$diff = $then - $now;
		
		//$weeks = floor($diff / (60*60*24*7)); 
		//$diff = $diff - ($weeks * (60*60*24*7)); 
		$days = floor($diff / (60*60*24)); 
		$diff = $diff - ($days * (60*60*24)); 
		$hours = floor($diff / (60*60)); 
		$diff = $diff - ($hours * (60*60)); 
		$minutes = floor($diff / 60); 
		$diff = $diff - ($minutes * 60); 
		$secs = $diff; 

		$out = ''; 
		//if($weeks > 0) 
		//$out .= $weeks . 'w'; 
		if($days > 0) 
			$out .= $days . 'd '; 
		if($hours > 0) 
			$out .= $hours . 'h '; 
		if($minutes > 0) 
			$out .= $minutes . 'm'; 
		//if($secs > 0) 
		//$out .= $secs . 's'; 
		
		if ($then < $now)
			{
			$out = "EXPIRED";
			}
		return $out; 	
	}
	
	$place = 0; 
	
	//Limit the number of posts based upon number of posts and page number
		$posts = $this->db->query($post_sql);
		$NumPostRows = $posts->num_rows();
?>
	  <div class="main-profile clearfix">
	  	<?php 
    	$filepath = base_url('img/profile/') . '/' . $profile_picture;
    	if (isset($profile_picture) && is_200($filepath)) { ?>
        <div class="avatar"><img src="<?=base_url()?>img/profile/<?=!empty($profile_picture)?$profile_picture:'default.jpg'?>" width=114px alt="John Howard" /> </div>
        <?php } else { ?>
	    <div class="avatar"><img src="<?=base_url()?>img/profile/default.jpg" width=114px alt="John Howard" /> </div>    
        <?php } ?>
        <div class="info">
          <h2><?=$profile_username?></h2>
          <p>Description of profile.</p>
          <?php if ($profile_id !== $this->session->userdata('userID')) {
	                if ($this->session->userdata('userID')) {
	                    $followTestSQL = "SELECT * FROM `Follows` WHERE dbFollowedCnt = " . $profile_id . " AND dbFollowerCnt = " . $this->session->userdata('userID') . " AND dbFolActive = 1 LIMIT 0,1;";
	                    $followTestResults = $this->db->query($followTestSQL);
	                    if ($followTestResults->num_rows() > 0) {
	                        $followClass = "follow active css3";
	                        $followText = "FOLLOWING";
	                        $followURL = "#";
	                    } else {
	                        $followClass = "follow css3";
	                        $followText = "FOLLOW";
	                        $followURL = base_url() . "index.php/follow/add/" . $this->session->userdata('userID') . "/" . $profile_id . "/profile_u/" . $profile_id; 
	                    } ?>
	                    <a href="<?=$followURL?>" class="<?=$followClass?>"><?=$followText?></a> 
	                <?php } 
					} ?>
          </div>
        <div class="stats">
          <div class="inner">
            <ul class="clearfix">
              <li> <a href="#" rel="followers"><?=$total_followers?><span>Followers</span><span class="arrow"></span></a> </li>
              <li> <a href="#" rel="following"><?=$total_following?><span>Following</span><span class="arrow"></span></a> </li>
              <li> <a href="#" rel="decisions"><?=$total_decisions?><span>Decisions</span><span class="arrow"></span></a> </li>
              <li> <a href="#" rel="followups"><?=$follow_ups?><span>Follow-Ups</span><span class="arrow"></span></a> </li>
            </ul>
          </div>
          <br class="clear" />
          <div class="stats-content">
            <div id="followers" class="stats-inner">
              <h2>Followers</h2>
              <div class="wrap">
                <ul class="list4 clearfix">
					<?php //Get list of followers
					$followers_sql = "SELECT u.dbUsrCnt, u.dbUsrName, u.dbUsrFirstName, u.dbUsrLastName, u.dbUsrPic FROM `Follows` f LEFT JOIN `Users` u ON f.dbFollowerCnt = u.dbUsrCnt WHERE f.dbFolActive = 1 AND f.dbFolType = 2 AND f.dbFollowedCnt = " . $profile_id . ";";
					$followers_results = $this->db->query($followers_sql);
					foreach ($followers_results->result() as $follower)
					{?>
					<li>
                    <div class="avatar">
                    	<?php 
                    	$filepath = base_url('img/profile/') . '/' .$follower->dbUsrPic;
                    	if ($follower->dbUsrPic && is_200($filepath)) { ?>
							<img src="<?=base_url()?>img/profile/<?=!empty($follower->dbUsrPic)?$follower->dbUsrPic:'default.jpg'?>" width=48px alt="<?=$follower->dbUsrName?>" />
						<?php } else { ?>
							<img src="<?=base_url()?>img/profile/default.jpg" width=48px alt="<?=$follower->dbUsrName?>" />
						<?php } ?>
					</div>
                    <p>
						<a href="<?=base_url()?>index.php/profile/view/<?=$follower->dbUsrCnt?>/<?=$this->config->item('default_profile_view')?>"><?=$follower->dbUsrName?>
						</a>
					</p>
						<a class="plus" href="<?=base_url()?>index.php/profile/view/<?=$follower->dbUsrCnt?>/<?=$this->config->item('default_profile_view')?>">
						</a> 
					</li>
					<?php }?>
                </ul>
              </div>
            </div>
            <div id="following" class="stats-inner">
              <h2>Following</h2>
              <div class="wrap">
                <ul class="list4 clearfix">
                    <?php //Get list of users profile owner is following
					$following_sql = "SELECT u.dbUsrCnt, u.dbUsrName, u.dbUsrFirstName, u.dbUsrLastName, u.dbUsrPic FROM `Follows` f LEFT JOIN `Users` u ON f.dbFollowedCnt = u.dbUsrCnt WHERE f.dbFolActive = 1 AND f.dbFolType = 2 AND f.dbFollowerCnt = " . $profile_id . ";";
					$following_results = $this->db->query($following_sql);
					foreach ($following_results->result() as $following)
					{?>
					<li>
                    <div class="avatar">
						<?php 
                    	$filepath = base_url('img/profile/') . '/' .$following->dbUsrPic;
                    	if ($following->dbUsrPic && is_200($filepath)) { ?>
							<img src="<?=base_url()?>img/profile/<?=!empty($following->dbUsrPic)?$following->dbUsrPic:'default.jpg'?>" width=48px alt="<?=$following->dbUsrName?>" />
						<?php } else { ?>
							<img src="<?=base_url()?>img/profile/default.jpg" width=48px alt="<?=$following->dbUsrName?>" />
						<?php } ?>
					</div>
                    <p>
						<a href="<?=base_url()?>index.php/profile/view/<?=$following->dbUsrCnt?>/<?=$this->config->item('default_profile_view')?>"><?=$following->dbUsrName?>
						</a>
					</p>
						<a class="plus" href="<?=base_url()?>index.php/profile/view/<?=$following->dbUsrCnt?>/<?=$this->config->item('default_profile_view')?>">
						</a> 
					</li>
					<?php }?>
                </ul>
              </div>
            </div>
            <div id="decisions" class="stats-inner">
              <h2>Decisions</h2>
              <div class="wrap">
               <!-- Begin decision listing -->
			<?php
	if ($NumPostRows > 0)
	{ ?>
		<ul class="list3">
		<?php 
		foreach ($posts->result() as $post)
		{
            //Get choice data
            $choice_sql = "SELECT * FROM `Choices` WHERE dbChcCnt = ?";
            $choice1 = $this->db->query($choice_sql, $post->dbChc1Cnt)->row();
            $choice2 = $this->db->query($choice_sql, $post->dbChc2Cnt)->row();

			//Get the decision author's information
			$AuthorSQL = "SELECT dbUsrCnt, dbUsrName, dbUsrPic FROM `Users` WHERE dbUsrCnt = " . $post->dbUsrCnt . ";";
			$AuthorInfo = $this->db->query($AuthorSQL);
			foreach ($AuthorInfo->result() as $author)
			{
				$AuthorCnt = $author->dbUsrCnt;
				$AuthorUsername = $author->dbUsrName;
				if ($author->dbUsrPic)
				{
					$AuthorPic = $author->dbUsrPic;						
				}
				else
				{
					//Load the default profile picture.
					$AuthorPic = "default_small.png";
				}
			}
			
			//Get the decision information
			$PostDesc = Truncate($post->dbPostDesc);
			$PostTitle = $post->dbPostTitle;
			$RemainingTime = GetTimeDiff($post->dbExpDate);
			
			if (strlen($PostTitle) > 48)
			{
				$substext = $PostTitle." ";
				$substext = substr($PostTitle,0,48);
				$PostTitle = $substext . "...";
			}							
				
			//Get the number of votes on the decision
			$VotesSQL = "SELECT dbVoteCnt FROM Votes WHERE dbPostCnt = " . $post->dbPostCnt . ";";
			$VotesQuery = $this->db->query($VotesSQL);
			$TotalVotes = $VotesQuery->num_rows();

			//Get category information for the decision
			$CategorySQL = "SELECT dbCatName, dbCatColor FROM `Categories` WHERE `dbCatCnt` = " . $post->dbCatCnt . ";";
			$CategoryResult = $this->db->query($CategorySQL);
			foreach ($CategoryResult->result() as $category)
			{
				$PostCategory = strtoupper($category->dbCatName);
				$CategoryColor = $category->dbCatColor;
			}

			//Get number of comments
			$CommentSQL = "SELECT dbCommCnt FROM Comments WHERE `dbIDGroup` = 1 AND `dbIDCnt` = " . $post->dbPostCnt . ";";
			$CommentResults = $this->db->query($CommentSQL);
			$CommentNumber = $CommentResults->num_rows();
			
			$place = $place + 1;
		?>
		
          <li class="clearfix css3">
              <div class="image css3 image-switch" style="position: relative;">
              <?php
             	$filepath = base_url('img/post/94x70') . '/' .$choice1->dbChcPic;
                if ($choice1->dbChcPic && $choice2->dbChcPic && is_200($filepath)) { ?>
                <img class="image1" src="<?=base_url()?>img/post/94x70/<?=$choice1->dbChcPic?>" class="css3" style="z-index: 9; position: absolute; left: 0; top: 0;" />
                <img class="image2" src="<?=base_url()?>img/post/94x70/<?=$choice2->dbChcPic?>" class="css3" style="z-index: 10; position: absolute; left: 0; top: 0; display: none;" />
                
                <?php } else { ?>
                <img class="image1" src="<?=base_url()?>img/default_thumb.png" class="css3" style="z-index: 9; position: absolute; left: 0; top: 0;" />
                <img class="image2" src="<?=base_url()?>img/default_thumb.png" class="css3" style="z-index: 10; position: absolute; left: 0; top: 0; display: none;" />	
                <?php }?>
              </div>
            <div class="details">
              <h3 class="clearfix"><span class="category"><img src="<?=base_url()?>images/game-icon.png" alt="category"  /></span>
			  <a href="<?=base_url()?>index.php/vote/decision/<?=$post->dbPostCnt?>
					<?php if (isset($ref)) { ?>/<?=$ref?><?php }?>
					/<?=$place?>"><?=$PostTitle?></a></h3>
              <p><?=$PostDesc?><a href="<?=base_url()?>index.php/vote/decision/<?=$post->dbPostCnt?>
					<?php if (isset($ref)) { ?>/<?=$ref?><?php }?>
					/<?=$place?>"> Read more</a></p>
              <span class="meta-data clearfix">
				  <a href="#" class="viewers"><?=$RemainingTime?></a>
				  <a href="#" class="like"><?=$TotalVotes?></a> 
				  <a href="#" class="comments"><?=$CommentNumber?></a>
				  <a href="<?=base_url()?>index.php/profile/<?=$AuthorCnt?>/<?=$this->config->item('default_profile_view')?>" class="user">posted by <?=$AuthorUsername?></a> 
			  </span>
			</div>
          </li>
		<!-- End decision listing -->
		<?php }?>
		</ul>
		<?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="button2 css3" href="#">Load more...</a>


<script type="text/javascript">
    $(document).ready(function(){
        $('.image-switch').hover(
            function(){
                $(this).children('.image1').fadeOut();
                $(this).children('.image2').fadeIn();
            },
            function(){
                $(this).children('.image2').fadeOut();
                $(this).children('.image1').fadeIn();
            }
        );
    })
</script>