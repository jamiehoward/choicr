<?php
	require("../scripts/connect.php");
	include("../scripts/datedifference.php");
	include("../scripts/header.php");
?>
		<?php if ($LoggedIn == 1 && $_REQUEST['src'] == 'ask')
				{ ?>
				<div class="drop">
					<a href="../vote/?post=<?php echo $_REQUEST['id'];?>"><span class="big">CONGRATS!</span><br /=true /> You've created a decision for others to vote on. <br /=true /><span class="small">Click <b>here</b> to view it!</span></a>
					<a class="close">&nbsp;</a>
				</div>				
				<?php }?>
<?php if ($LoggedIn == 0)
	{?>
    <div class="drop">
    	<a href="../signup/"><span class="big">SIGN UP!</span> By signing up for INVOTICUS you will be able to create decisions, vote on and follow others and gain a following while linking up with friends in the process! <br /=true /><span class="small">It's <b>free</b>, it's <b>easy</b> and it's <b>fast</b>!</span></a>
    	<a class="close">&nbsp;</a>
    </div>
<?php }
				$NumberofPosts = 10;
				if ($_REQUEST['pg'] == NULL)
					{
					$RecordStart = 0;
					}
				else
					{
					$RecordStart = ($_REQUEST['pg'] * 15);
					}
		  		$PostSort = $_REQUEST['sort'];
		  		if ($PostSort == 'recent')
		  			{ 
		  			$SortTitle = "Blender! | Sorting by the most recent";
		  			$PostSQL = "SELECT * FROM Posts WHERE dbExpDate > NOW() ORDER BY dbAddDate DESC LIMIT 0,15";
		  			}
		  		elseif ($PostSort == 'comments')
		  			{
		  			$SortTitle = "Blender! | Sorting by the most comments";
		  			$PostSQL = "SELECT * FROM Posts p LEFT OUTER JOIN 
					(SELECT c.dbIDCnt, c.dbIDGroup, COUNT(*) AS comment_count 
					FROM Comments c WHERE c.dbIDGroup = 1 GROUP BY c.dbIDCnt ) agg
					ON p.dbPostCnt = agg.dbIDCnt 
					WHERE p.dbExpDate > Now()
					ORDER BY agg.comment_count DESC LIMIT 0,15";
  					}
		  		elseif ($PostSort == 'expiring')
		  			{
		  			$SortTitle = "Blender! | Sorting by expiring soonest";
		  			$PostSQL = "SELECT * FROM Posts LEFT JOIN Users ON Posts.dbUsrCnt = Users.dbUsrCnt WHERE Posts.dbExpDate > NOW() ORDER BY Posts.dbExpDate ASC LIMIT 0,15";
  					}
				else
		  			{
		  			$SortTitle = "Blender! | Sorting by the most votes";
					$PostSQL = "SELECT p.*, COUNT(v.dbPostCnt) AS numvotes 
					FROM Posts AS p 
					LEFT JOIN
					Votes AS v
					ON p.dbPostCnt= v.dbPostCnt
					INNER JOIN
						(
						SELECT
						p2.dbPostCnt AS dbPostCnt, COUNT(v2.dbPostCnt) AS numvotes
						FROM Posts AS p2
						LEFT JOIN
						Votes AS v2
						ON p2.dbPostCnt=v2.dbPostCnt
						GROUP BY p2.dbPostCnt
						) AS x
					ON
					x.dbPostCnt=p.dbPostCnt
					WHERE p.dbExpDate > Now()
					GROUP BY p.dbPostCnt
					ORDER BY x.numvotes DESC LIMIT 0,15";
  					}
		  		$PostResult = mysql_query ($PostSQL, $dbconnect);?>
		  		
	<div class="content">
    	<div class="top-left"><?php echo $SortTitle;?></div>
		<div class="top-right">
		  	<ul>
				<li><a href="index.php?sort=votes">Votes</a></li>
				<li><a href="index.php?sort=comments">Comments</a></li>
				<li><a href="index.php?sort=expiring">Expiring</a></li>
				<li><a href="index.php?sort=recent">Recent</a></li>
           	</ul>
		  </div>

		  	
		  	<?php	
					function Truncate($text) 
						{
						$chars = 85;
					
						$text = $text." ";
						$text = substr($text,0,$chars);
						$text = substr($text,0,strrpos($text,' '));
						$text = $text."...";
					
						return $text;
						}
					while ($PostRow = mysql_fetch_array ($PostResult))
		  			{
			  			//Author information
						$AuthorCnt = $PostRow['dbUsrCnt'];
		  				$AuthorSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$AuthorCnt'";
						$AuthorResults = mysql_query($AuthorSQL, $dbconnect);
						$AuthorInformation = mysql_fetch_array($AuthorResults);
						$AuthorCnt =  $AuthorInformation['dbUsrCnt'];
						$AuthorUsername = $AuthorInformation['dbUsrName'];
						if ($AuthorInformation['dbUsrPic'] == NULL)
							{
							$AuthorInformation['dbUsrPic'] = "default.jpg";
							}

						//Post information
		  				$dbPostCnt = $PostRow['dbPostCnt'];
		  				$PostDesc = $PostRow['dbPostDesc'];
		  				$PostDescription = Truncate($PostDesc);
		  				$PostTitle = $PostRow['dbPostTitle'];
		  				$Expiration = $PostRow['dbExpDate'];	
						
						//Vote information
						$VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt'";
						$VotesResult = mysql_query ($VotesSQL,$dbconnect); 		
						$TotalVotes = mysql_num_rows ($VotesResult);
						
						//Category information
						$dbCatCnt = $PostRow['dbCatCnt'];
		  				$CategorySQL = "SELECT * FROM `Categories` WHERE `dbCatCnt` = '$dbCatCnt'";
		  				$CategoryResult = mysql_query ($CategorySQL, $dbconnect);
		  				$CategoryRow = mysql_fetch_array($CategoryResult);
		  				$PostCategory = strtoupper($CategoryRow['dbCatName']);
		  				$CategoryColor = $CategoryRow['dbCatColor'];

						//Comment information
						$CommentSQL = "SELECT * FROM Comments WHERE `dbIDGroup` = 1 AND `dbIDCnt` = '$dbPostCnt'";
						$CommentResults = mysql_query($CommentSQL, $dbconnect);
						$CommentNumber = mysql_num_rows($CommentResults);
		  				$RemainingTime = GetTimeDiff($Expiration);


				?>

		<div class="listing">
        	<div class="circle" style="background-color:#<?php echo $CategoryColor;?>">
        	<?php echo $TotalVotes;?></div>
      <div class="text">
                <h1><span><?php echo $PostCategory;?></span> <a href="../vote/?post=<?php echo $PostRow['dbPostCnt'];?>"> "<?php echo $PostTitle;?>"</a>  </h1>
                <p><?php echo $PostDescription;?></p>
                <p class="bottom">
                <?php if ($PromotedPost == 1){?>
                <span>promoted decision</span> 
                <?php }?> 
				by <a href="../profile/?user=<?php echo $AuthorCnt;?>"><?php echo $AuthorUsername;?></a> [expires in<span class="blue"><?php echo $RemainingTime;?></span>]</p>
            </div>
            <div class="bubble">
            	<span><?php echo $CommentNumber;?></span>
                <img src="../images/<?php echo $AuthorInformation['dbUsrPic'];?>" /=true width="30px" />
            </div>
            <div class="clear"></div>
        </div><!-- end listing -->
   <?php }?>

	</div><!-- end wrapper -->
	<?php $PageNumber = $_REQUEST['pg'];?>
	<a href="index.php?pg=<?php echo $PageNumber+ 1;?>">NEXT</a>
	<?php include("../scripts/footer.php");?>	

