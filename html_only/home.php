<?php
	//Load functions
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
	
	//Limit the number of posts based upon number of posts and page number
		$post_sql .= " LIMIT ". $RecordStart. "," . $NumberofPosts;
		$posts = $this->db->query($post_sql);
		$NumPostRows = $posts->num_rows();
?>        
	<div class="live">
		<div class="action clearfix">
          <div class="category"><a href="#" class="css3 button"><img src="<?=base_url()?>images/game-icon.png" alt="category" /><span>Category</span></a>
            <div class="child">
              <ul>
                <li><a href="#">Text Here</a></li>
                <li><a href="#">Text Here</a></li>
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
            <div class="image css3"><img src="" alt="battle" class="css3" /></div>
            <div class="details">
              <h3 class="clearfix"><span class="category"><img src="<?=base_url()?>images/game-icon.png" alt="category"  /></span>
			  <a href="<?=base_url()?>index.php/vote/decision/<?=$post->dbPostCnt?>
					<?php if (isset($ref)) { ?>/<?=$ref?><?php }?>
					/<?=$place?>"><?=$PostTitle?></a></h3>
              <p><?=$PostDesc?><a href="<?=base_url()?>index.php/vote/decision/<?=$post->dbPostCnt?>
					<?php if (isset($ref)) { ?>/<?=$ref?><?php }?>
					/<?=$place?>"> Read more</a></p>
              <span class="meta-data clearfix"><a href="#" class="viewers"><?=$RemainingTime?></a><a href="#" class="like"><?=$TotalVotes?></a> <a href="#" class="comments"><?=$CommentNumber?></a> </span></div>
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