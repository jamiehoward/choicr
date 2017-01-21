<?php 
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
	
	$remaining_time = GetTimeDiff($exp_date);
	?>

<div class="widget">
        <h2>CREATOR</h2>
        <div class="creator clearfix">
          <div class="image css3">
          <a href="<?=base_url()?>index.php/profile/view/<?=$author?>/<?=$this->config->item('default_profile_view')?>">
          <?php 
          $filepath = base_url('img/profile/') . '/' . $author_pic;
          if (isset($author_pic) && is_200($filepath)) { ?>
          	<img src="<?=base_url()?>img/profile/<?=!empty($author_pic)?$author_pic:'default.jpg'?>" width="56px" />
          <?php } else { ?>
	      	<img src="<?=base_url()?>img/profile/default.jpg" width="56px" />
          <?php } ?>
          </a>
          </div>
          <div class="details">
            <h3><a href="<?=base_url()?>index.php/profile/view/<?=$author?>/<?=$this->config->item('default_profile_view')?>"><?=$author_name?></a></h3>
            
            <span class="meta-data"><a href="#"><?=$author_followers?> Followers </a>. 
			<a href="#">Following <?=$author_following?></a></span> 
				<?php //Get following information
                if ($author != $this->session->userdata('userID')) {
                if ($this->session->userdata('userID')) {
                    $followTestSQL = "SELECT * FROM `Follows` WHERE dbFollowedCnt = " . $author . " AND dbFollowerCnt = " . $this->session->userdata('userID') . " AND dbFolActive = 1 LIMIT 0,1;";
                    $followTestResults = $this->db->query($followTestSQL);
                    if ($followTestResults->num_rows() > 0) {
                        $followClass = "follow active css3";
                        $followText = "FOLLOWING";
                        $followURL = "#";
                    } else {
                        $followClass = "follow css3";
                        $followText = "FOLLOW";
                        $followURL = base_url() . "index.php/follow/add/" . $this->session->userdata('userID') . "/" . $author . "/vote_u/" . $post; 
                    } ?>
                    <a href="<?=$followURL?>" class="<?=$followClass?>"><?=$followText?></a> 
                <?php } 
				} ?>
          </div>
            <div class="decision-stats clearfix">
            <h2>Decision Stats</h2>
            <span class="meta-data  clearfix"> <a href="#" class="viewers"><?=$remaining_time?></a> <a href="#" class="like"><?=$total_votes?></a> <a href="#" class="comments"><?=$total_comments?></a> </span> 
            <?php if ($remaining_time == "EXPIRED" || $author == $this->session->userdata('userID')) { ?>
            <br />
            <h2>Winning Choice</h2>
            <span class="meta-data  clearfix"><?=$winning_choice?></span>
            <?php } ?>
            </div>
            
        </div>
      </div>