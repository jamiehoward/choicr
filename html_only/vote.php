<?php
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
     <h2 class="title">ENTERTAINMENT</h2>
      <div class="games clearfix">
        <h2>Battlefield 3 or Modern Warfare 3?</h2>
        <p>Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed... <a href="#" class="readmore">Read more</a></p>
        <div class="more"><p>Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. Nulla vitae elit libero, a pharetra ayugue. Aenean lacinia bibendum nulla sed. </p></div>
        <ul class="list1 clearfix">
          <li class="css3"> <a href="#"><img src="images/image1.jpg" alt="game" class="css3" /></a> <a href="#" class="button1 css3"><span>Battlefield 3</span></a></li>
          <li class="css3"> <a href="#"><img src="images/image2.jpg" alt="game" class="css3" /></a> <a href="#" class="button1 css3"><span>Modern Warfare 3</span></a> </li>
        </ul>
      </div>
      <div class="comments clearfix">
        <form action="#" method="post">
          <h3>Please vote to leave a comment...</h3>
          <div class="comment-form css3">
            <textarea title="textarea" class="textarea css3"  rows="1" cols="1">&nbsp;</textarea>
            <div class="action clearfix"> <span><span class="checkbox">
              <input title="checkbox" type="checkbox" value="" class="checkbox" />
              </span> Facebook</span> <span><span class="checkbox">
              <input title="checkbox" type="checkbox" value="" class="checkbox" />
              </span> Twitter</span>
              <input type="submit" value="" class="submit" />
            </div>
          </div>
          <ul>
            <li class="clearfix"> <span class="avatar css3">&nbsp;</span>
              <div class="entry">
                <h3><a href="#">Scott Fuller</a> <span>. Option A .</span> <a href="#" class="reply">reply</a></h3>
                <p>Sed posuere consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris que nisl consectetur et lorem ipsum dole todo numero.</p>
              </div>
              <ul>
              </ul>
            </li>
            <li class="clearfix"> <span class="avatar css3">&nbsp;</span>
              <div class="entry">
                <h3><a href="#">John Howard</a><span>. Option B .</span> <a href="#" class="reply">reply</a></h3>
                <p>Sed posuere consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris que nisl consectetur et lorem ipsum dole todo numero.</p>
              </div>
              <ul>
                <li class="clearfix"> <img src="images/avatar1.gif" alt="avatar" class="css3" />
                  <div class="entry">
                    <h3><a href="#">Eric Hoffman </a><span>. Option A .</span> <a href="#" class="reply">reply</a></h3>
                    <p>Consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris.</p>
                  </div>
                </li>
              </ul>
            </li>
            <li class="clearfix"> <span class="avatar css3">&nbsp;</span>
              <div class="entry">
                <h3><a href="#">Dan Meggison</a><span>. Option B .</span> <a href="#" class="reply">reply</a></h3>
                <p>Sed posuere consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris que nisl consectetur et lorem ipsum dole todo numero.</p>
              </div>
              <ul>
              </ul>
            </li>
            <li class="clearfix"> <span class="avatar css3">&nbsp;</span>
              <div class="entry">
                <h3><a href="#">Steve Moynihan</a><span>. Option A .</span> <a href="#" class="reply">reply</a></h3>
                <p>Sed posuere consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris que nisl consectetur et lorem ipsum dole todo numero.</p>
              </div>
              <ul>
              </ul>
            </li>
            <li class="clearfix"> <span class="avatar css3">&nbsp;</span>
              <div class="entry">
                <h3><a href="#">Justin Ellis</a> <span>. Option B.</span> <a href="#" class="reply">reply</a></h3>
                <p>Sed posuere consectetur est at lobortis. Praesent commodo cursus magna, vel sceleris que nisl consectetur et lorem ipsum dole todo numero.</p>
              </div>
            </li>
            <ul>
            </ul>
          </ul>
        </form>
        <a href="#" class="button2 css3">Load more...</a> </div>