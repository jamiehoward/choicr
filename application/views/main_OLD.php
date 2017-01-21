<?php 
	//Set variable constants
	$CatListSQL = "SELECT dbCatCnt, dbCatName FROM Categories ORDER BY dbCatName";
	$CatList = $this->db->query($CatListSQL);
	if ($this->session->userdata('userID'))
	{
		$LoggedIn = 1;
		$userID = $this->session->userdata('userID');
		$username = $this->session->userdata('username');
	}
	else
	{
		$LoggedIn = 0;
		if (!isset($allow_access))
		{
			redirect('beta/login', 'refresh');
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" /=true />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" /=true />
	<title>CHOICR | Ask, Decide, Repeat!</title>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/reset.css" /=true />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/base.css" /=true />
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>css/colorbox.css" /=true />
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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.base.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.colorbox-min.js"></script>
	<script type="text/javascript"> $(document).ready(function(){ base(); ajax(); }); </script>
	<script src='http://connect.facebook.net/en_US/all.js'></script>
	<?php if ($file_include == 'decision_create')
	{ ?>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.6.custom.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.11.custom.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/livevalidation.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.flash.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.swfupload.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/swfUpload/handlers.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/swfUpload/swfupload.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/newCreate.js"></script>
	<?php } 
	elseif ($file_include == 'home' OR $file_include == 'browse') { ?>
	<script type="text/javascript" src="<?=base_url()?>js/autoBlender.js"></script>
	<?php } ?>

</head>
<body>
	<!-- Begin header -->
	<div class="header">
		<div class="header_wrapper">
			<div id="logo">
				<a href="<?=base_url()?>index.php/home/index/recent/1"><img src="<?=base_url()?>img/hdr-logo.png" alt="Choicr"></a>
			</div>
			<?php //Display if user is NOT logged in
			if ($LoggedIn == 0)
			{?>
				<div id="top_navi">
					<ul class="middle">
					<li><a href="<?=base_url()?>index.php/signup/">Signup!</a></li>
					<li>|</li>
					<li><a href="<?=base_url()?>index.php/login/">Login</a></li>
					<li>|</li>
					<li><a href="<?=base_url()?>index.php/about/">About</a></li>
					</ul>
				</div>
			<?php }
			// Display if user IS logged in
			else {?>
				<div id="top_navi">
					<ul class="middle">
					<li><a href="<?=base_url()?>index.php/ask/">Create!</a></li>
					<li><a href="<?=base_url()?>index.php/settings/">Settings</a></li>
					<li><a href="<?=base_url()?>index.php/profile/<?=$userID?>/<?=$this->config->item('default_profile_view')?>">Profile</a></li>
					</ul>
				</div>
			<?php }?>
		</div>
	</div>
	<!-- End header -->
	<!-- Begin navigation bar-->
	<div class="nav">
		<div>
			<ul>
			<li><a href="<?=base_url()?>index.php/home/index/recent/1">Blender!</a></li>
			<?php 
				// Populate navigation's category list
				foreach ($CatList->result() as $cat)
				{?>
				<li><a href="<?=base_url()?>index.php/browse/index/recent/<?=$cat->dbCatCnt?>/1"><?=$cat->dbCatName?></a></li>
				<?php }?>
			</ul>
			<?php // If user is logged in, show username and logout
			if ($LoggedIn == 1)
			{?>
			<p>
				<b><a href="<?=base_url()?>index.php/profile/<?=$userID?>/<?=$this->config->item('default_profile_view')?>"><?=$username?></a></b> 
				[<a href="<?=base_url()?>index.php/logout">Log Out</a>]
			</p>
			<?php }?>
			<div class="clear"></div>
		</div>
	</div>
	<!-- End navigation bar -->
	
	<?php 
		// Load the page content
		if (isset($file_include))
		{
			$this->load->view($file_include);
		}
	?>
	
	<!-- Begin footer-->
	<div class="footer">
		<!-- Begin footer links -->
		<ul class="left">
			<li><a href="home">Choicr&trade;</a></li>
			<li>|</li>
			<li>All rights reserved &copy; 2011 - 2012</li>
		</ul>
		<ul class="right">
			<li><a href="<?=base_url()?>index.php/about">About</a></li>
			<li><a href="<?=base_url()?>index.php/blog">Blog</a></li>
			<li><a href="<?=base_url()?>index.php/about">Advertising</a></li>
			<li><a href="<?=base_url()?>index.php/help">Help</a></li>
			<li><a href="<?=base_url()?>index.php/terms">Terms</a></li>
			<li><a href="<?=base_url()?>index.php/privacy">Privacy</a></li>
		</ul>
		<!-- End footer links -->
		<div class="clear"></div>
	</div>
	<!-- End footer -->
	<!-- Feedback button -->
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
<!-- End feedback button -->
</body>
</html>
