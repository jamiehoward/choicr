<?php if ($LoggedIn != 1)
	{
	if ($AllowAccess == 1)
		{
		}
	else
		{
		header("Location: http://www.choicr.com/beta/");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" /=true />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /=true />
	<title>CHOICR | Ask, Decide, Repeat!</title>
	<meta name="description" content="" /=true />
	<meta name="keywords" content="" /=true />
	<link type="text/css" rel="stylesheet" href="../style/reset.css" /=true />
	<link type="text/css" rel="stylesheet" href="../style/base.css" /=true />
    <link type="text/css" rel="stylesheet" href="../style/colorbox/colorbox.css" /=true />
	<!--For Google Analytics tracking-->
	<script type="text/javascript">
	
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-130873-18']);
	_gaq.push(['_trackPageview']);
	
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	
	</script>

</head>
<body>
		<div class="header">
		<div><a href="../home/index.php"><img src="../images/hdr-logo.png" alt="Choicr" /=true /></a></div>
		<?php if ($LoggedIn == 0)
		{?>
		<ul class="middle">
			<li><a href="../signup/">Signup!</a></li>
			<li>|</li>
			<li><a href="../login/">Login</a></li>
			<li>|</li>
			<li><a href="../about/">About</a></li>
		</ul>
		<?php } else {?>
		<ul class="middle">
			<li><a href="../ask/">Create!</a></li>
			<li>|</li>
			<li><a href="../settings/">Settings</a></li>
			<li>|</li>
			<li><a href="../profile/?user=<?php echo $dbUsrCnt;?>">Profile</a></li>
		</ul>
		<?php }?>
	</div><!-- end header -->

	<?php 
		$CategoryListSQL = "SELECT * FROM Categories ORDER BY dbCatName";
		$CategoryListResults = mysql_query($CategoryListSQL, $dbconnect);
	?> 
	<div class="nav">
    	<div>
            <ul>
                <li><a href="../home/index.php">Blender!</a></li>
		<?php while ($CategoryListInfo = mysql_fetch_array($CategoryListResults))
			{?>
		<li><a href="../home/browse.php?cat=<?php echo $CategoryListInfo['dbCatCnt'];?>"><?php echo $CategoryListInfo['dbCatName'];?></a></li>
                <?php }?>

            </ul>
        <?php if ($LoggedIn == 1)
		{?>
            <p><i>Logged in</i> as <b><a href="../profile/?user=<?php echo $dbUsrCnt;?>"><?php echo $UserInfo['dbUsrName'];?></a></b> [<a href="../scripts/logout.php">Log Out</a>]</p>
            <?php }?>
            <div class="clear"></div>
        </div>
	</div><!-- end nav -->
