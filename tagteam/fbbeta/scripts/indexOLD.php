<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" /> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<title>DOGVOTICUS!</title>
	<meta name="description" content="" /> 
	<meta name="keywords" content="" />
	<link type="text/css" rel="stylesheet" href="../style/reset.css" />
	<link type="text/css" rel="stylesheet" href="../style/base.css" />
    <link type="text/css" rel="stylesheet" href="../style/colorbox/colorbox.css" />
</head>
<body>
		<div class="header">
		<div><img src="../images/hdr-logo.png" alt="Invoticus" /></div>
		<?php if ($LoggedIn == 0)
		{?>
		<ul class="middle">
			<li><a class="colorbox" href="../form/index.shtml">Signup!</a></li>
			<li>|</li>
			<li><a href="login.php">Login</a></li>
			<li>|</li>
			<li><a href="../about/">About</a></li>
		</ul>
		<?php } else {?>
		<ul class="middle">
			<li><a href="#">Create!</a></li>
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
            <p><i>Logged in</i> as <?php echo $UserInfo['dbUsrName'];?>[<a href="../scripts/logout.php">Log Out</a>]</p>
            <?php }?>
            <div class="clear"></div>
        </div>
	</div><!-- end nav -->
	<div class="content">
		<div class="ask">
		<table>
		<h1>Login here!</h1>
		<form name="login" action="login.php" method="post">
			<tr>
				<td>User Name</td>
			<div><input name="Username" type="text" /></div>
			</tr>
			Password
			<input name="Password" type="password" /> Lost username or password?
			<input name="rememberme" type="checkbox" value="" /> Keep me logged in on this computer
			<input type="submit" value="Login!" />
		</form>
		</table>	
		</div>
	</div>
	</div><!-- end content -->
	<div class="footer">
		<ul class="left">
			<li><a href="#">DOGVOTICUS!</a></li>
			<li>|</li>
			<li><a href="#">Copyright 2010</a></li>
		</ul>
		<ul class="right">
			<li><a href="#">About</a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">Help</a></li>
			<li><a href="#">Terms</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
		<div class="clear"></div>
	<!-- end footer -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.base.js"></script>
	<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ base(); ajax(); });
	</script>
<script type="text/javascript">
var uservoiceOptions = {
  /* required */
  key: 'choicr',
  host: 'choicr.uservoice.com', 
  forum: '92439',
  showTab: true,  
  /* optional */
  alignment: 'left',
  background_color:'#f00', 
  text_color: 'white',
  hover_color: '#06C',
  lang: 'en'
};

function _loadUserVoice() {
  var s = document.createElement('script');
  s.setAttribute('type', 'text/javascript');
  s.setAttribute('src', ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js");
  document.getElementsByTagName('head')[0].appendChild(s);
}
_loadSuper = window.onload;
window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
</script>
</body>
</html>
