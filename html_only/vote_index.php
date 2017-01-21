<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	include("./arrows.php");
	
	// Start variable assignment section
	$PostSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$dbPostCnt'";
		$PostResults = mysql_query($PostSQL, $dbconnect);
		$PostInfo = mysql_fetch_array($PostResults);
		if (strlen($PostInfo['dbPostTitle']) > 48)
			{
			$substext1 = $PostInfo['dbPostTitle']." ";
			$substext1 = substr($PostInfo['dbPostTitle'],0,48);
			$PostInfo['dbPostTitle'] = $substext1 . "<br />";
			$substext2 = $PostInfo['dbPostTitle']." ";
			$substext2 = substr($PostInfo['dbPostTitle'],strrpos($substext2,'<br />'),48);
			$PostInfo['dbPostTitle'] = $substext1 . $substext2 . "...";
			}
	$CategorySQL = "SELECT * FROM Categories WHERE dbCatCnt IN (SELECT dbCatCnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$CategoryResults = mysql_query ($CategorySQL, $dbconnect);
		$CategoryInfo = mysql_fetch_array ($CategoryResults);
		$CategoryColor = $CategoryInfo['dbCatColor'];		
	$Choice1SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc1Cnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$Choice1Results = mysql_query ($Choice1SQL, $dbconnect);
		$Choice1Info = mysql_fetch_array ($Choice1Results);
		if (strlen($Choice1Info['dbChcDesc']) > 48)
			{
			$substext = $Choice1Info['dbChcDesc']." ";
			$substext = substr($Choice1Info['dbChcDesc'],0,48);
			$substext = substr($substext,0,strrpos($substext,' '));
			$Choice1Info['dbChcDesc'] = $substext;
			}
	$C1VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND dbChcVote = 0";
		$C1VotesResult = mysql_query ($C1VotesSQL,$dbconnect); 		
		$C1VotesCount = mysql_num_rows ($C1VotesResult);
	$Choice2SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc2Cnt FROM Posts WHERE dbPostCnt = '$dbPostCnt')";
		$Choice2Results = mysql_query ($Choice2SQL, $dbconnect);
		$Choice2Info = mysql_fetch_array ($Choice2Results);
		if (strlen($Choice2Info['dbChcDesc']) > 48)
			{
			$substext = $Choice2Info['dbChcDesc']." ";
			$substext = substr($Choice2Info['dbChcDesc'],0,48);
			$substext = substr($substext,0,strrpos($substext,' '));
			$Choice2Info['dbChcDesc'] = $substext;
			}
	$C2VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND `dbChcVote` = 1";
		$C2VotesResult = mysql_query ($C2VotesSQL,$dbconnect); 		
		$C2VotesCount = mysql_num_rows ($C2VotesResult);
	$TotalVotes = $C1VotesCount + $C2VotesCount;
		if ($C1VotesCount > $C2VotesCount)
			{
			$WinningChoice = $Choice1Info['dbChcDesc'];
			}
		else
			{
			$WinningChoice = $Choice2Info['dbChcDesc'];
			}
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
	if ($AuthorInfo['dbUsrPic'] == NULL)
		{
		$AuthorInfo['dbUsrPic'] = "default.jpg";
		}
	$picture1exist = '../ask/img/' . $Choice1Info['dbChcPic'];
	if ($Choice1Info['dbChcPic'] == 0 || (file_exists($picture1exist) == FALSE))
		{
		$ChoiceImage1 = $CategoryInfo['dbCatName'] . ".JPG";
		}
	else
		{
		$ChoiceImage1 = $Choice1Info['dbChcPic'];
		}
	$picture2exist = '../ask/img/' . $Choice2Info['dbChcPic'];
	if ($Choice2Info['dbChcPic'] == 0 || (file_exists($picture2exist) == FALSE))
		{
		$ChoiceImage2 = $CategoryInfo['dbCatName'] . ".JPG";
		}
	else
		{
		$ChoiceImage2 = $Choice2Info['dbChcPic'];
		}
	//if ($_REQUEST['ref'] != NULL)
	//	{
	//	include ("./arrowsref.php");
	//	$ArrowsAllowed = 1;
	//	}
	//else
	//	{
	//	$ArrowsAllowed = 0;
	//	}
	include("../scripts/header.php");
	if ($_REQUEST['error'] != NULL)
		{
		include("./errors.php");
		}
	if (!isset($_REQUEST['error']))
		{
		include("./followup.php");
		}
	// End variable assignment section
	?>
	
	<!-- Drop-down if the user is the author, or a message to log in. --> 
	<?php if ($PostAuthor == 1 && $_REQUEST['error'] == NULL && $followupexists != 1)
		{?>
		<div class="drop">
			<h6><b>Hey!</b> You are the author of this decision.</h6><br />
			<a class="close">&nbsp;</a>
		</div>
	<?php }?>
	<?php if ($LoggedIn != 1 && $_REQUEST['error'] == NULL)
		{?>
		<div class="drop">
			<h6><b>Hey!</b> You're not logged in!<br />
			<a href="../login/"><b>Login</b></a> or <a href="../signup/"><b>sign up</b></a> to vote and comment on this decision!</h6><br />
			<a class="close">&nbsp;</a>
		</div>
	<?php }?>
	
	<!-- Begin decision header -->
	<div class="content">
		<div class="listing">
        	<div class="circle" style="background-color:#<?php echo $CategoryColor;?>;">
        	<?php echo $TotalVotes;?></div>
   	   <div class="text">
                <h1><span><?php echo strtoupper($CategoryInfo['dbCatName']);?></span>
				<?php if ($PostAuthor == 1){?>
				<a href="edit.php?p=<?php echo $dbPostCnt;?>">(Edit this decision!)</a>
				<?php } ?>
				<br /> "<?php echo $PostInfo['dbPostTitle'];?>"</h1>
                <p><?php echo $PostInfo['dbPostDesc'];?></p>
                <p class="bottom">
                <?php if($IsPromoted==1){
					echo "<span>promoted discussion</span>";}?> 
                by <a href="../profile/?user=<?php echo $AuthorCnt;?>"><?php echo $AuthorInfo['dbUsrName'];?></a> 
				<?php if ($IsExpired != 1)
					{?>
					[expires in <span class="blue">
					<?php echo $RemainingTime;?></span>]
				<?php }
				else
					{?>
					[EXPIRED</span>]
				<?php }?>
                
				<a href="follow.php?p=<?php echo $dbPostCnt;?>&u=<?php echo $_SESSION['dbUsrCnt'];?>&ref=<?php echo $ref;?>&place=<?php echo $place;?>">
				<span class="green"><?php echo $FollowCount;?> Following this decision</span></a>
				<br />
				<?php if ($AllowFacebook == 1){?>
				<iframe src="http://www.facebook.com/plugins/like.php?href=www.choicr.com/vote/?post=<?php echo $PostInfo['dbPostCnt'];?>&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe></p><?php }?>
				<?php if ($IsExpired == 1)
					{?>
				<br />
				<h1>The winning choice was "<b><?php echo $WinningChoice;?></b>"!</h1>
					<?php
					}?>
			
         </div>
		 
		 <!-- The comment bubble -->
         <div class="bubble">
            	<span><?php echo $CommentNumber;?></span>
                <img src="../phpthumb/phpthumb.php?src=../public/img/<?php echo $AuthorInfo['dbUsrPic'];?>&w=50&zc=1" />
         </div>
         <div class="clear"></div>
      </div>
	<!-- End decision header -->
	  
	  <!-- Begin decision pictures listing -->
        	<?php if ($LoggedIn == 0){?>
        	<table>
        	<tr>
        		<td><div class="image">
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage1;?>&w=300&zc=1" height="300px" border="1" alt="<?php echo $Choice1Info['dbChcDesc'];?>"/> </a>
					<h2><span><?php echo $Choice1Info['dbChcDesc'];?></span></h2></td>
					</div>
				<td><div class="image">
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage2;?>&w=300&zc=1"  height="300px" border="1" alt="<?php echo $Choice2Info['dbChcDesc'];?>"/> </a><br />
					<h2><span><?php echo $Choice2Info['dbChcDesc'];?></span></h2>
				</td>
				</div>
			</tr>
			</table>
		<?php } elseif ($PostAuthor == 1 || $IsExpired == 1) {?>
			<table>
			<tr>
				<td><div class="image">
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage1;?>&w=300&zc=1" border="1" height="300px" alt="<?php echo $Choice1Info['dbChcDesc'];?>"/> </a>
					<h2><span><?php echo $Choice1Info['dbChcDesc'];?></span></h2>
				</td>
				</div>
				<td><div class="image">			
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage2;?>&w=300&zc=1" border="1" height="300px" alt="<?php echo $Choice2Info['dbChcDesc'];?>"/> </a><br />
						<h2><span><?php echo $Choice2Info['dbChcDesc'];?></span></h2>
				</td>
				</div>
			</tr>
			<tr><td><div class="voteresults">Votes: <?php echo $C1VotesCount;?></div></td><td><div class="voteresults">Votes: <?php echo $C2VotesCount;?></div></td></tr>
			</table>
		<?php } else {?>
			<table>
			<tr>
				<td><div class="image">
					<a href="choicevote.php?v=0&p=<?php echo $dbPostCnt;?>&u=<?php echo $_SESSION['dbUsrCnt'];?>&ref=<?php echo $ref;?>&place=<?php echo $place;?><?php if  ($ArrowCat != NULL) { echo '&arcat=' . $ArrowCat; }?>">
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage1;?>&w=300&zc=1" border="1" height="300px" alt="<?php echo $Choice1Info['dbChcDesc'];?>"/> </a>
					<h2><span><?php echo $Choice1Info['dbChcDesc'];?></span></h2>
				</td>
				</div>
				<td><div class="image">			
					<a href="choicevote.php?v=1&p=<?php echo $dbPostCnt;?>&u=<?php echo $_SESSION['dbUsrCnt'];?>&ref=<?php echo $ref;?>&place=<?php echo $place;?><?php if  ($ArrowCat != NULL) { echo '&arcat=' . $ArrowCat; }?>">
					<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/ask/img/<?php echo $ChoiceImage2;?>&w=300&zc=1" border="1" height="300px" alt="<?php echo $Choice2Info['dbChcDesc'];?>"/> </a><br />
					<h2><span><?php echo $Choice2Info['dbChcDesc'];?></span></h2>
				</td>
				</div>
			</tr>
			</table>
			<?php }?>
			
		<!-- End decision pictures section -->
		<!-- Previous/Next arrows -->
		<?php if ($PrevArrow == 1){?>
		<a class="prev" href="../vote/?post=<?php echo $PrevPostCnt;?>&ref=<?php echo $ref;?>&place=<?php echo $PrevPlace;?><?php if  ($ArrowCat != NULL) { echo '&arcat=' . $ArrowCat; }?>"></a>
		<?php }?>
		<?php if ($NextArrow == 1) {?>
        	<a class="next" href="../vote/?post=<?php echo $NextPostCnt;?>&ref=<?php echo $ref;?>&place=<?php echo $NextPlace;?><?php if  ($ArrowCat != NULL) { echo '&arcat=' . $ArrowCat; }?>"></a>
		<?php }?>

		<!-- Begin comments section --> 
        <div class="comments">
		<?php if ($LoggedIn == 1){?>
        	<form action="comment.php?p=<?php echo $dbPostCnt;?>&u=<?php echo $_SESSION['dbUsrCnt'];?>&ref=<?php echo $ref;?>&place=<?php echo $place;?><?php if  ($ArrowCat != NULL) { echo '&arcat=' . $ArrowCat; }?>" method ="POST">
            	<h2>Comments?</h2>
               	<textarea name="comment" class="comment"></textarea>
                <input type="submit" class="submit" value="" />
            </form>
      <?php }?>
	  
		<!-- Begin the individual comment -->
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
                	<?php echo $CommentInfo['dbAddDate'];?></p>
                </div>
            </div>
      <?php } ?>
	  <!-- End individual comment -->
        </div>
		<!-- end comments -->
	    
		<!-- Google Ad section -->
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
					</script>
		</div>
        <div class="clear"></div>
	</div>
	<!-- end wrapper -->
	
	<?php include("../scripts/footer.php");?>
