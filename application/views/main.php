<?php
	//Set variable constants
	$CatListSQL = "SELECT dbCatCnt, dbCatName FROM Categories ORDER BY dbCatName";
	$CatList = $this->db->query($CatListSQL);
	if ($this->session->userdata('userID'))
	{
		$header['loggedIn'] = 1;
		$header['userID'] = $this->session->userdata('userID');
		$header['username'] = $this->session->userdata('username');
        $q = "SELECT * FROM `Users` WHERE `dbUsrCnt` = ?";
        $user_data = $this->db->query($q, $header['userID'])->row();
	}
	else
	{
		$header['loggedIn'] = 0;
		if (!isset($allow_access) || $allow_access == 0)
		{
			//Prevent infinite loop if user is already on login page
			if (uri_string() != 'login') { redirect('/'); }
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<title>Choicr | Ask, Decide, Repeat!</title>
<!-- META TAGS -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="<?=base_url()?>img/favicon.ico" />
<!-- CSS -->
<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?=base_url()?>css/stylish-form.css" type="text/css" media="screen"  />
<link rel="stylesheet" href="<?=base_url()?>css/browser.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/fonts.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/css3.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/timePicker.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/stylish-select.css" type="text/css" media="screen" />
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.8.20.custom.css" rel="stylesheet" />


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
    <script src='http://connect.facebook.net/en_US/all.js'></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.base.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery.colorbox-min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.20/jquery-ui.min.js"></script>
   	<script type="text/javascript" src="<?=base_url()?>js/jquery.timePicker.min.js"></script>
    <script src="<?=base_url()?>js/jQueryRotateCompressed.2.1.js" type="text/javascript"></script> 
	<script src="<?=base_url()?>js/main.js" type="text/javascript"></script> 
    <script src="<?=base_url()?>js/browser.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/custom-form-elements.js" type="text/javascript"></script> 
    <script src="<?=base_url()?>js/TextAreaExpander.js" type="text/javascript"></script> 
    <script src="<?=base_url()?>js/selectivizr-min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/jquery.stylish-select.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/jquery.textCounter-min.js" type="text/javascript"></script>
    <script type="text/javascript"> $(document).ready(function(){ base(); ajax(); }); </script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd", minDate:"+0d", maxDate: "+2w" });
	});
    </script>
    <script>
  	$(function() {
    	$( "#timePicker" ).timePicker(); }); 
    </script>
</head>
<body>
<!-- Container -->
<div id="container"  <?php if (ismobile()) { echo "style='position:relative;left:15em;width:100%'" ; } ?> > 
  <div id="left-pannel">
    <div class="top-strip"></div>
    <div id="header" class="clearfix">
      
	  <?php //Display if user IS logged in
			if ($header['loggedIn'] == 1)
			{?>
	  <div class="user css3"> <a class="css3"> 
	  <?php 
	  $filepath = base_url('img/profile') . '/' . $user_data->dbUsrPic;
	  if (isset($user_data->dbUsrPic) && is_200($filepath)) { ?>
	  <img src="<?=base_url()?>img/profile/thumbs/<?=$user_data->dbUsrPic?>" alt="user" class="css3" /> 
	  <?php } else { ?>
	  <img src="<?=base_url()?>img/profile/default.jpg" alt="user" class="css3" /> 
	  <?php } ?>
	  </a>
        <div class="child css3">
          <ul class="user_links">
          	<?php $profilePath = 'profile/view/' . $header['userID'] . '/' . $this->config->item('default_profile_view'); ?>
            <li><a href="<?=base_url($profilePath)?>">Profile</a></li>
            <li><a href="<?=base_url('settings')?>">Settings</a></li>
            <li><a href="<?=base_url('login/logout')?>">Logout</a></li>
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
				$this->load->view($file_include, $header);
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
	  <?php 
			// Load the widget
			if (isset($widget_include))
			{
				$this->load->view($widget_include);
			}
		?>
        <!--<h2>POPULAR DECISIONS</h2>
        <ul class="list2">
          <li>
            <h3>Apple iPad or Samsung?</h3>
            Everyone seems to have an... <a href="#">Read more</a></li>
          <li>
        </ul>-->
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
            <li><a href="http://press.choicr.com/company" target="_blank">About</a></li>
            <li><a href="http://choicr.tumblr.com/" target="_blank">Blog</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Privacy</a></li>
			<li><a href="#">Terms</a></li>
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

</body>
</html>

<?php 
		function is_200($url)
		{
		// Account for developing locally
		if(strpos($url, 'choicr/')) {
			$url = 'localhost:8888' . $url;
		}
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// $retcode > 400 -> not found, $retcode = 200, found.
		if ($retcode == 200) {
			return TRUE;
		} else {
			return FALSE;
		}
		curl_close($ch);
		}
		
		function ismobile() {
		    $is_mobile = '0';
		
		    if(preg_match('/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		        $is_mobile=1;
		    }
		
		    if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		        $is_mobile=1;
		    }
		
		    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
		    $mobile_agents = array('w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');
		
		    if(in_array($mobile_ua,$mobile_agents)) {
		        $is_mobile=1;
		    }
		    if (isset($_SERVER['ALL_HTTP'])) {
		        if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
		            $is_mobile=1;
		        }
		    }
		    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
		        $is_mobile=0;
		    }
		    return $is_mobile;
		}
	?>
	