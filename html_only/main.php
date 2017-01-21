<?php
	$allow_access = 1;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Choicr | Ask, Decide, Repeat!</title>
<!-- META TAGS -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/html; charset=utf-8" />
<!-- CSS -->
<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?=base_url()?>css/browser.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/fonts.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/css3.css" type="text/css" media="screen" />
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
	<?php if (isset($file_include)) { if ($file_include == 'decision_create')
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
	<?php } }
	elseif (isset($file_include)) { if($file_include == 'home' OR $file_include == 'browse') { ?>
	<script type="text/javascript" src="<?=base_url()?>js/autoBlender.js"></script>
	<?php } } ?>
</head>
<body>
<!-- Container -->
<div id="container"> 
  <div id="left-pannel">
    <div class="top-strip"></div>
    <div id="header" class="clearfix">
      
	  <?php //Display if user IS logged in
			if ($LoggedIn != 0)
			{?>
	  <div class="user css3"> <a href="<?=base_url()?>index.php/profile/<?=$userID?>/<?=$this->config->item('default_profile_view')?>" class="css3"> <img src="images/user.jpg" alt="user" class="css3" /> </a>
        <div class="child css3">
          <ul>
            <li><a href="<?=base_url()?>index.php/profile/<?=$userID?>/<?=$this->config->item('default_profile_view')?>">Profile</a></li>
            <li><a href="<?=base_url()?>index.php/settings/">Settings</a></li>
            <li><a href="<?=base_url()?>index.php/logout">Logout</a></li>
          </ul>
        </div>
      </div>
	  <?php }
	  // Display if user IS NOT logged in
			else { }?>
			
      <div class="logo"><a href="<?=base_url()?>index.php/home/index/recent/1">choicr</a></div>
      <div id="menu">
        <ul class="clearfix">
          <li><a href="<?=base_url()?>index.php/home/index/recent/1" class="feed">Feed</a></li>
          <li><a href="<?=base_url()?>index.php/home/index/recent/1" class="dashboard">Dashboard</a></li>
          <li><a href="<?=base_url()?>index.php/ask/" class="create">Create</a></li>
        </ul>
      </div>
    </div>
    <div id="content" class="clearfix live">
		
		<!-- End navigation bar -->
		<?php 
			// Load the page content
			if (isset($file_include))
			{
				$this->load->view($file_include);
			}
		?>		  
    </div>
  </div>
  <div id="right-pannel">
    <div class="top-strip"></div>
	
    <div class="search-form">
      <form action="#" method="post">
        <p>
		<?php
	//Toggle search bar on/off
	if (isset($search_on)) {?> 
          <input title="textbox" type="text" value="Search..." class="textbox" onfocus="if(this.value=='Search...') this.value='';" onblur="if(this.value=='') this.value='Search...';" />
        </p>
	<?php }?>
      </form>
    </div>
	
    <div id="sidebar">
      <div class="widget">
        <h2>POPULAR DECISIONS</h2>
        <ul class="list2">
          <li>
            <h3>Apple iPad or Samsung?</h3>
            Everyone seems to have an... <a href="#">Read more</a></li>
          <li>
        </ul>
      </div>
      <div id="footer">
        <div class="widget sociable">
          <h2>GET SOCIAL</h2>
          <ul class="clearfix">
            <li> <a href="http://www.twitter.com/choicr" target="_blank" class="twitter">&nbsp;</a> </li>
            <li> <a href="https://www.facebook.com/pages/Choicr/170069306364967" target="_blank" class="facebook">&nbsp;</a> </li>
            <li> <a href="https://plus.google.com/112469017057007186104" target="_blank" class="google">&nbsp;</a> </li>
          </ul>
        </div>
        <div class="menu clearfix">
          <ul>
            <li><a href="<?=base_url()?>index.php/about">About</a></li>
            <li><a href="<?=base_url()?>index.php/blog">Blog</a></li>
            <li><a href="<?=base_url()?>index.php/help">Help</a></li>
            <li><a href="<?=base_url()?>index.php/privacy">Privacy</a></li>
			<li><a href="<?=base_url()?>index.php/terms">Terms</a></li>
          </ul>
        </div>
        <p>&copy; 2012 Copyright Choicr.<br />
          All rights reserved.</p>
      </div>
    </div>
  </div>
</div>
</div>
<!--/Container -->
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
<!-- JAVASCRIPTS --> 
<script src="<?=base_url()?>js/jquery-1.7.1.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/jQueryRotateCompressed.2.1.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/main.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/browser.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/custom-form-elements.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/TextAreaExpander.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/selectivizr-min.js" type="text/javascript"></script>
</body>
</html>