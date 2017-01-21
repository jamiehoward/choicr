<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	$dbPostCnt = $_REQUEST['p'];
	$PostSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$dbPostCnt'";
		$PostResults = mysql_query($PostSQL, $dbconnect);
		$PostInfo = mysql_fetch_array($PostResults);	
	$CategorySQL = "SELECT * FROM Categories WHERE dbCatCnt IN (SELECT dbCatCnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$CategoryResults = mysql_query ($CategorySQL, $dbconnect);
		$CategoryInfo = mysql_fetch_array ($CategoryResults);
		$CategoryColor = $CategoryInfo['dbCatColor'];		
	$Choice1SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc1Cnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$Choice1Results = mysql_query ($Choice1SQL, $dbconnect);
		$Choice1Info = mysql_fetch_array ($Choice1Results);
	$C1VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND dbChcVote = 0";
		$C1VotesResult = mysql_query ($C1VotesSQL,$dbconnect); 		
		$C1VotesCount = mysql_num_rows ($C1VotesResult);
	$Choice2SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc2Cnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$Choice2Results = mysql_query ($Choice2SQL, $dbconnect);
		$Choice2Info = mysql_fetch_array ($Choice2Results);
	$C2VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND `dbChcVote` = 1";
		$C2VotesResult = mysql_query ($C2VotesSQL,$dbconnect); 		
		$C2VotesCount = mysql_num_rows ($C2VotesResult);
	$TotalVotes = $C1VotesCount + $C2VotesCount;
	$AuthorSQL = "SELECT * FROM Users WHERE dbUsrCnt IN (SELECT dbUsrCnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$AuthorResults = mysql_query($AuthorSQL, $dbconnect);
		$AuthorInfo = mysql_fetch_array($AuthorResults);
		$AuthorCnt = $AuthorInfo['dbUsrCnt'];
	$FollowSQL = "SELECT * FROM Follows WHERE dbFollowedCnt = '$dbPostCnt' AND dbFolType = 1";
		$FollowResult = mysql_query($FollowSQL);		
		$FollowCount = mysql_num_rows ($FollowResult);
	$CommentGroup = 1;
		$CommentID = $dbPostCnt;
		$CommentSQL = "SELECT * FROM Comments WHERE `dbIDGroup` = '$CommentGroup' AND `dbIDCnt` = '$CommentID' ORDER BY `dbAddDate` DESC";
		$CommentResults = mysql_query($CommentSQL, $dbconnect);
		$CommentNumber = mysql_num_rows($CommentResults);
	$Expiration = $PostInfo['dbExpDate'];
		$RemainingTime = GetTimeDiff($Expiration);
		if ($Expiration < $timestamp)
			{
			$IsExpired = 1;
			}
	if ($AuthorInfo['dbUsrCnt'] == $dbUsrCnt)
		{
			$PostAuthor = 1;
		}
	if ($Choice1Info['dbChcPic'] == 0)
		{
		$ChoiceImage1 = $CategoryInfo['dbCatName'] . ".jpg";
		}
	else
		{
		$ChoiceImage1 = $Choice1Info['dbChcPic'];
		}
	if ($Choice2Info['dbChcPic'] == 0)
		{
		$ChoiceImage2 = $CategoryInfo['dbCatName'] . ".jpg";
		}
	else
		{
		$ChoiceImage2 = $Choice2Info['dbChcPic'];
		}
	include("../scripts/header.php");
?>
	<?php 
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}
	?>

	<?php if ($Choice1Info['dbChcPic'] == 0 && $_REQUEST['error'] == NULL)
		{?>
		<div class="drop">
			<h6><b>Hey!</b> Looks like you don't have images attached to this decision. Upload two images to help people decide!</h6><br />
			<a class="close">&nbsp;</a>
		</div>
	<?php }?>
	<div class="content">
		<div class="listing">
        	<div class="circle" style="background-color:#<?php echo $CategoryColor;?>;">
        	<?php echo $TotalVotes;?></div>
   	   <div class="text">
                <h1><span><?php echo strtoupper($CategoryInfo['dbCatName']);?></span>
		<a href="removepost.php?step=1&p=<?php echo $dbPostCnt;?>">(Delete this decision)</a>
				<br /> <a href="../vote/?post=<?php echo $PostInfo['dbPostCnt'];?>">"<?php echo $PostInfo['dbPostTitle'];?>"</h1></a>
                <p><?php echo $PostInfo['dbPostDesc'];?></p>
                <p class="bottom">
                <?php if($IsPromoted==1){?>
					<span>promoted discussion</span>
				<?php }?> 
                by <a href="../profile/?user=<?php echo $AuthorCnt;?>"><?php echo $AuthorInfo['dbUsrName'];?></a> 
				<?php if ($IsExpired != 1)
					{?>
					[expires in <span class="blue">
					<?php echo $RemainingTime;?></span>]
				<?php }?>
				<?php if ($IsExpired == 1)
					{?>
					[EXPIRED</span>]
				<?php }?>
                
				<a href="#"><span class="green"><?php echo $FollowCount;?> Following this decision</span></a>
				<br />
         </div>
         <div class="bubble">
            	<span><?php echo $CommentNumber;?></span>
                <img src="../phpthumb/phpthumb.php?src=../public/img/<?php echo $AuthorInfo['dbUsrPic'];?>&w=50&zc=1" />
         </div>
         <div class="clear"></div>
      </div><!-- end listing -->
			<table>
			<tr>
				<td><div class="image">
				<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage1;?>" width="300" border="1" height="300px" alt="<?php echo $Choice1Info['dbChcDesc'];?>"/> </a>
				<h2><span><?php echo $Choice1Info['dbChcDesc'];?></span></h2></td>
				</div>
				<td><div class="image">			
				<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage2;?>" width="300" border="1" height="300px" alt="<?php echo $Choice2Info['dbChcDesc'];?>"/> </a><br />
				<h2><span><?php echo $Choice2Info['dbChcDesc'];?></span></h2></td>
				</div>
			</tr>
			<tr>
				<td><div class="voteresults">Votes: <?php echo $C1VotesCount;?></div></td>
				<td><div class="voteresults">Votes: <?php echo $C2VotesCount;?></div></td>
			</tr>
			<tr>
				<td><div class="voteresults"><a href="./img/index.php?c=<?php echo $Choice1Info['dbChcCnt'];?>" class="colorbox">Upload Image</a></div></td>
				<td><div class="voteresults">
				<a href="./img/index.php?c=<?php echo $Choice2Info['dbChcCnt'];?>" class="colorbox">Upload Image</a></div></td>
			</tr>
			</table>
			
		<?php if ($ArrowsAllowed == 1){?>
		<a class="prev" href="../vote/?post=<?php echo $PrevPostCnt;?>&ref=<?php echo $ref;?>"></a>
        	<a class="next" href="../vote/?post=<?php echo $NextPostCnt;?>&ref=<?php echo $ref;?>"></a>
		<?php }?>

        <div class="comments">
		<?php while($CommentInfo = mysql_fetch_array($CommentResults))
				{
					$CommentInfo['dbCommTxt'];
					$CommentInfo['dbAddDate'];
					$CommUserCnt = $CommentInfo['dbUsrCnt'];
					$UserSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$CommUserCnt'";
					$UserResults = mysql_query($UserSQL, $dbconnect);
					$UserInformation = mysql_fetch_array($UserResults);
					if ($UserInformation['dbUsrPic'] == NULL)
						{
						$UserInformation['dbUsrPic'] = "default.jpg";
						}
				?>
            <div class="clear"></div>
            <div class="dogspeak" style="background:url(../phpthumb/phpthumb.php?src=../public/img/<?php echo $UserInformation['dbUsrPic'];?>&w=50&zc=1) no-repeat left;">
            	<div class="blue">
             		<div></div>
                	<p><?php echo $CommentInfo['dbCommTxt'];?><br />
                	by <a href="../profile/?user=<?php echo $UserInformation['dbUsrCnt'];?>">
                	<?php echo $UserInformation['dbUsrName'];?></a>
                	<?php echo $CommentInfo['dbAddDate'];?></p><br />
					<a href="deletecomment.php?id=<?php echo $CommentInfo['dbCommCnt']?>&p=<?php echo $dbPostCnt;?>">DELETE</a>
                </div>
            </div><!-- end comment -->
      <?php } ?>
        </div><!-- end comments -->
	        <div class="google">
					<script type="text/javascript"><!--
					google_ad_client = "ca-pub-9647325782117000";
					/* Ask-Right */
					google_ad_slot = "2708904107";
					google_ad_width = 120;
					google_ad_height = 600;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script></div>
        <div class="clear"></div>
	</div><!-- end wrapper -->
	<?php include("../scripts/footer.php");?>
