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
		