<?php
	//Load functions
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
	
	//Limit the number of posts based upon number of posts and page number
		$posts = $this->db->query($post_sql);
		$NumPostRows = $posts->num_rows();
?>        
	<div class="live">
		<div class="action clearfix">
          <div class="category"><a href="#" class="css3 button"><img src="<?=base_url()?>images/game-icon.png" alt="category" /><span>Category</span></a>
            <div class="child">
              <ul>
				<?php $catSQL = "SELECT dbCatName FROM `Categories` ORDER BY dbCatName;";
				$catResult = $this->db->query($catSQL);
				foreach ($catResult->result() as $category) { ?>
                <li><a href="#"><img src="<?=base_url()?>images/categories/<?=$category->dbCatName?>_icon.png" alt="category" /> <?=$category->dbCatName?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="sort"><a href="#" class="css3 button"><span>Sort by</span></a>
            <div class="child">
              <ul>
				<li><a href="<?=base_url()?>index.php/home/index/votes/1">Votes</a></li>
				<li><a href="<?=base_url()?>index.php/home/index/comments/1">Comments</a></li>
				<li><a href="<?=base_url()?>index.php/home/index/expiring/1">Expiring</a></li>
				<li><a href="<?=base_url()?>index.php/home/index/recent/1">Recent</a></li>
              </ul>
            </div>
          </div>
        </div>
        <h2 class="clearfix">Live Feed <a href="#" class="refresh"><img src="<?=base_url()?>images/refresh.png" alt="Refresh" /></a></h2>
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
			$PostDesc = character_limiter($post->dbPostDesc, 70);
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
			$CategorySQL = "SELECT dbCatCnt, dbCatName, dbCatColor FROM `Categories` WHERE `dbCatCnt` = " . $post->dbCatCnt . ";";
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
            
            	<?php if ($choice1->dbChcPic && $choice2->dbChcPic) { ?>
                <img class="image1" src="<?=base_url()?>img/post/94x70/<?=$choice1->dbChcPic?>" class="css3" style="z-index: 9; position: absolute; left: 0; top: 0;" />
                <img class="image2" src="<?=base_url()?>img/post/94x70/<?=$choice2->dbChcPic?>" class="css3" style="z-index: 10; position: absolute; left: 0; top: 0; display: none;" />
                
                <?php } else { ?>
                <img class="image1" src="<?=base_url()?>img/default_thumb.png" class="css3" style="z-index: 9; position: absolute; left: 0; top: 0;" />
                <img class="image2" src="<?=base_url()?>img/default_thumb.png" class="css3" style="z-index: 10; position: absolute; left: 0; top: 0; display: none;" />	
                <?php }?>
                
            </div>
            <div class="details">
              <h3 class="clearfix"><span class="category"><img src="<?=base_url()?>images/categories/<?=$category->dbCatName?>_icon.png" alt="category" /></span>
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
				  <a href="<?=base_url()?>index.php/profile/view/<?=$AuthorCnt?>/<?=$this->config->item('default_profile_view')?>" class="user">posted by <?=$AuthorUsername?></a> 
			  </span>
			</div>
          </li>
		<!-- End decision listing -->
		<?php 
		}?>
		</ul>
		<?php {
		//Generate page next/prev arrows
		if ($RecordStart == 0) 	{ $NumPostRows = $NumPostRows;	}
		else { $NumPostRows = ($NumPostRows - $RecordStart); }
		if ($NumPostRows > $NumberofPosts) { $PageNumber = $_REQUEST['pg'];?>
			<div class="NextArrow">
			<a href="#" class="button2 css3">Load more...</a> 
			</div>
		<?php }
		} 
	}?>
	</div>

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