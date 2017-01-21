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
			$out .= $days . 'd'; 
		if($hours > 0) 
			$out .= $hours . 'h'; 
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
<div class="content">
	<div class="top-left"><?=$sortTitle?></div>
	<div class="top-right">
		<ul>
		<li><a href="<?=base_url()?>index.php/home/index/votes/1">Votes</a></li>
		<li><a href="<?=base_url()?>index.php/home/index/comments/1">Comments</a></li>
		<li><a href="<?=base_url()?>index.php/home/index/expiring/1">Expiring</a></li>
		<li><a href="<?=base_url()?>index.php/home/index/recent/1">Recent</a></li>
		</ul>
	</div>

	<!-- Begin decision listing -->
	<?php
	if ($NumPostRows > 0)
	{
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
		
		<div class="listing">
			<div class="circle" style="background-color:#<?=$CategoryColor?>"><?=$TotalVotes?></div>
			<div class="text">
				<h1>
					<span><?=$PostCategory?></span>
					<a href="<?=base_url()?>vote/?post=<?=$post->dbPostCnt?>
					<?php if (isset($ref)) { ?>&ref=<?=$ref?><?php }?>
					&place=<?=$place?>"> 
					"<?=$PostTitle?>"</a>
				</h1>
				<p><?=$PostDesc?></p>
				<p class="bottom">
					by <a href="<?=base_url()?>profile/?user=<?=$AuthorCnt?>"><?=$AuthorUsername?></a> 
					[expires in<span class="blue"><?=$RemainingTime?></span>]
				</p>
			</div>
			<div class="bubble">
				<span><?=$CommentNumber?></span>
				<img src="<?=base_url()?>img/profile/<?=$AuthorPic?>" />
			</div>
			<div class="clear"></div>
		</div>
		<!-- End decision listing -->
		<?php 
		}
		//Generate page next/prev arrows
		if ($RecordStart == 0) 	{ $NumPostRows = $NumPostRows;	}
		else { $NumPostRows = ($NumPostRows - $RecordStart); }
		if ($NumPostRows > $NumberofPosts) { $PageNumber = $_REQUEST['pg'];?>
			<div class="NextArrow">
				<a href="<?=base_url()?>index.php/home/<?=$sort?>/<?=($PageNumber + 1)?>">
				<img src="<?=base_url()?>/img/nexthome.jpg"></a>
			</div>
		<?php }
	}?>
</div>