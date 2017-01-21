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
<div id="container"> 
  <div id="left-pannel">
    <div class="top-strip"></div>
    <div id="header" class="clearfix">	
      <div class="logo"><a href="<?=base_url()?>"></a></div>
        <div id="menu">
          <ul class="clearfix">
            <li></li>
            <li></li>
            <li></li>
          </ul>
        </div>
    </div>
    <div id="content" class="clearfix live">
      <!-- End navigation bar -->
      <?php if (isset($error)) { echo $error; } ?>
      <div class="create-profile">
        <h1 class="create-profile-header">Register!</h1>

        <?=validation_errors()?>
        <div class="stylish-form">
          <form action="<?=base_url()?>register/beta" method="post" accept-charset="utf-8">
            <ul>
              <li class="clearfix">
                  <input id="username-field" type="text" placeholder="Username" class="textbox jq_watermark" name="username" />
                  <span id="username-field-counter" class="count css3"></span>
              </li>
              <li class="clearfix">
                  <input id="password-field" type="text" placeholder="Password" class="textbox jq_watermark" name="password" />
                  <span id="password-field-counter" class="count css3"></span>
              </li>
              <li class="clearfix">
                  <input id="password-conf-field" type="text" placeholder="Password" class="textbox jq_watermark" name="password_conf" />
                  <span id="password-conf-field-counter" class="count css3"></span>
              </li>
              <li class="clearfix">
                  <input id="email-field" type="text" placeholder="Password" class="textbox jq_watermark" name="email" />
                  <span id="email-field-counter" class="count css3"></span>
              </li>
              <li class="clearfix">
                <select class="selectbox" name="name">
                    <option value="">Select your gender</option>
                    <option value="0" >Male</option>
                    <option value="1" >Female</option>
                </select>
              </li>
              <li class="clearfix">
                <select class="selectbox" name="age_group">
                  <option value="">Select your age</option>
                    <option value="1" >17 or under</option>
                    <option value="2" >18-24</option>
                    <option value="3" >25-34</option>
                    <option value="4" >35-44</option>
                    <option value="5" >45-54</option>
                    <option value="6" >55+</option>
                </select>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="right-pannel">
    <div class="top-strip"></div>
	
    <div class="search-form">
      <form action="#" method="post">
        <p></p>
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
      </div>
        <h2></h2>
        <ul class="list2">
          <li>
            <h3></h3>
          <li>
        </ul>
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
        <p>&copy;2013 Copyright Choicr<br />
          All rights reserved.</p>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
  $('#username-field-counter').textCounter({
    target: '#username-field',
    count: 25,
    alertAt: 5,
    warnAt: 10,
    stopAtLimit: true
  });
  $('#email-field-counter').textCounter({
    target: '#email-field',
    count: 45,
    alertAt: 20,
    warnAt: 10,
    stopAtLimit: true
  });
  $('#password-field-counter').textCounter({
    target: '#password-field',
    count: 45,
    alertAt: 20,
    warnAt: 10,
    stopAtLimit: true
  });
  $('#password-conf-field-counter').textCounter({
    target: '#password-conf-field',
    count: 45,
    alertAt: 20,
    warnAt: 10,
    stopAtLimit: true
  });
</script>
</html>