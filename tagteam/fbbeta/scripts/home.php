<?php
	session_start();
	include("scripts/datedifference.php");
	require("scripts/connect.php");
	function Truncate($text) {
        $chars = 85;

        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";

        return $text;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>INVOTICUS | Ask, Decide, Repeat!</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link type="text/css" rel="stylesheet" href="./style/reset.css" />
	<link type="text/css" rel="stylesheet" href="./style/base.css" />
    <link type="text/css" rel="stylesheet" href="./style/colorbox/colorbox.css" />
</head>
<body>
	<div class="feedback"><a href="../feedback/index.shtml" class="colorbox"></a></div>
	<div class="header">
		<div><img src="images/hdr-logo.png" alt="Invoticus" /></div>
		<?php if ($LoggedIn == 0)
		{?>
		<ul class="middle">
			<li><a class="colorbox" href="form/index.shtml">Signup!</a></li>
			<li>|</li>
			<li><a href="login.php">Login</a></li>
			<li>|</li>
			<li><a href="about\index.php">About</a></li>
		</ul>
		<?php } else {?>
		<ul class="middle">
			<li><a href="ask/">Create!</a></li>
			<li>|</li>
			<li><a href="#">Settings</a></li>
			<li>|</li>
			<li><a href="#">Profile</a></li>
		</ul>
		<?php }?>
	</div><!-- end header -->


	<div class="nav">
    	<div>
            <ul>
                <li><a href="#">Everything</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Science</a></li>
                <li><a href="#">Politics</a></li>
                <li><a href="#">Tech</a></li>
                <li><a href="#">Gaming</a></li>
                <li><a href="#">Music</a></li>
				<li><a href="#">Sports</a></li>
                <li><a href="#">Other</a></li>

            </ul>
        <?php if ($LoggedIn == 1)
		{?>
            <p><i>Logged in</i> as <?php echo $UserInfo['dbUsrName'];?>[<a href="scripts/logout.php">Log Out</a>]</p>
            <?php }?>
            <div class="clear"></div>

        </div>
	</div><!-- end nav -->


    <div class="drop">
    	<a class="colorbox" href="form/index.shtml"><span class="big">SIGN UP!</span> By signing up for INVOTICUS you will be able to create decisions, vote on and follow others and gain a following while linking up with friends in the process! <br /><span class="small">It's <b>free</b>, it's <b>easy</b> and it's <b>fast</b>!</span></a>
    	<a class="close">&nbsp;</a>

    </div>
	<div class="content">
    	<div class="top-left">Everything | Your decisions in a blender.</div>
		<div class="top-right">
		  	<ul>
				<li><a href="#">Votes</a></li>
				<li><a href="#">Comments</a></li>
				<li><a href="#">Expiring</a></li>
				<li><a href="#">Recent</a></li>
           	</ul>
		  </div>

		  	<?php
		  		$PostSQL = "SELECT * FROM Posts LEFT JOIN Users ON Posts.dbUsrCnt = Users.dbUsrCnt LIMIT 0, 15";
		  		$PostResult = mysql_query ($PostSQL, $dbconnect);
		  		while ($PostRow = mysql_fetch_array ($PostResult))
		  			{
		  				$dbPostCnt = $PostRow['dbPostCnt'];
		  				$dbCatCnt = $PostRow['dbCatCnt'];
						$C1VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND dbChcVote = 0";
							$C1VotesResult = mysql_query ($C1VotesSQL,$dbconnect); 		
							$C1VotesCount = mysql_num_rows ($C1VotesResult);
						$C2VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$dbPostCnt' AND `dbChcVote` = 1";
							$C2VotesResult = mysql_query ($C2VotesSQL,$dbconnect); 		
							$C2VotesCount = mysql_num_rows ($C2VotesResult);
						$TotalVotes = $C1VotesCount + $C2VotesCount;
		  				$CategorySQL = "SELECT `dbCatName` FROM `Categories` WHERE `dbCatCnt` = '$dbCatCnt'";
		  				$CategoryResult = mysql_query ($CategorySQL, $dbconnect);
		  				$CategoryRow = mysql_fetch_array($CategoryResult);
		  				$PostCategory = strtoupper($CategoryRow['dbCatName']);
		  				$PostDesc = $PostRow['dbPostDesc'];
		  				$PostDescription = Truncate($PostDesc);
		  				$PostTitle = $PostRow['dbPostTitle'];
		  				$PostUsername = $PostRow['dbUsrName'];
		  				$timestamp = date("Y-m-d H:i:s");
		  				$Expiration = $PostRow['dbExpDate'];
						$CommentSQL = "SELECT * FROM Comments WHERE `dbIDGroup` = 1 AND `dbIDCnt` = '$dbPostCnt'";
						$CommentResults = mysql_query($CommentSQL, $dbconnect);
						$CommentNumber = mysql_num_rows($CommentResults);
		  				$RemainingTime = GetTimeDiff($Expiration);


				?>

		<div class="listing">
        	<div class="circle" style="background-color:#000033;"><?php echo $TotalVotes;?></div>
      <div class="text">
                <h1><span><?php echo $PostCategory;?></span><a href="vote/?post=<?php echo $PostRow['dbPostCnt'];?>">
		<?php echo $PostTitle;?></a>  </h1>
                <p><?php echo $PostDescription;?></p>
                <p class="bottom"><span>promoted decision</span> by <a href="#"><?php echo $PostUsername;?></a> [expires in <span class="blue"><?php echo $RemainingTime;?></span>]<span class="green">2003 Followers</span></p>
            </div>
            <div class="bubble">
            	<span><?php echo $CommentNumber;?></span>
                <img src="images/dog-01.jpg" />
            </div>
            <div class="clear"></div>
        </div><!-- end listing -->
   <?php }?>

	</div><!-- end wrapper -->
	<div class="footer">
		<ul class="left">
			<li><a href="#">INVOTICUS!</a></li>
			<li>|</li>
			<li><a href="#">Copyright 2010</a></li>
		</ul>
		<ul class="right">
			<li><a href="#">About</a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">Advertising</a></li>
			<li><a href="#">Help</a></li>
			<li><a href="#">Terms</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
		<div class="clear"></div>
	</div><!-- end footer -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.base.js"></script>
	<script type="text/javascript" src="./js/jquery.colorbox-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ base(); });
	</script>
</body>
</html>