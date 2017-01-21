<!DOCTYPE html>
<?php if ($this->session->userdata('userID')) {
  redirect('home');
} ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Home | Choicr</title>
<!-- META TAGS -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/html; charset=utf-8" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>css/style.css" />
<link rel="stylesheet" href="<?=base_url()?>css/browser.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/bodycss.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/fonts.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>css/css3.css" type="text/css" media="screen" />
</head>
<body class="home">
<!-- Container -->
<div id="container">
  <div id="page">
    <div id="header">
      <div id="menu">
        <div class="wrapper clearfix">
          <div class="users"> <span class="existing">Existing User?</span> <span class="login clearfix"> <a href="#" class="click-btn">&nbsp;</a></span>
            <div class="login-area clearfix">
              <?=validation_errors()?>
    			     <?=form_open('login')?>
                <ul>
                  <li> <span class="textbox">
                    <input type="text" name="username" value="username" onblur="if(this.value=='') this.value='username';" onfocus="if(this.value=='username') this.value='';" />
                    </span> </li>
                  <li> <span class="textbox">
                    <input type="password" name="password" value="password" onblur="if(this.value=='') this.value='password';" onfocus="if(this.value=='password') this.value='';" />
                    </span> </li>
                  <li> <span class="submit">
                    <input type="submit" value="" />
                    </span> </li>
                  <li class="half">
                    <span class="checkbox"><input type="checkbox" /></span>
                    Keep me logged in </li>
                  <li class="half clearfix"> <a href="#">Forgot your password?</a> </li>
                </ul>
              </form>
            </div>
          </div>
          <ul>
            <li class="about"><a href="#">About</a>
              <div class="inner"> <img class="logo" src="images/logo-small.png" alt="Logo" />
                <p>Choicr revolutionizes the way the world sees decision-making. Launched in 2010, Choicr has taken on two iterations. In it's most recent build, it takes your decisions and hands them off to those in the community. Ask, Decide, Repeat!</p>
              </div>
            </li>
            <li class="press"><a href="http://press.choicr.com/company" target="_blank">Press</a>
            </li>
            <li class="team"><a href="#">Team</a>
              <div class="inner">
                <ul>
                  <li class="clearfix">
                    <div class="frame"><img src="<?=base_url()?>images/john-ceo.jpg" alt="John Howard | CEO" /></div>
                    <div class="details">
                      <h2>John Howard | CEO</h2>
                      <a href="http://twitter.com/#!/freeosin" target="new"><img src="<?=base_url()?>images/twitter.png" alt="Twitter" /></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="frame"><img src="<?=base_url()?>images/jamie-vp.jpg" alt="Jamie Howard | VP" /></div>
                    <div class="details">
                      <h2>Jamie Howard | VP</h2>
                      <a href="http://twitter.com/#!/JamieHoward" target="new"><img src="<?=base_url()?>images/twitter.png" alt="Twitter" /></a></div>
                  </li>
                  <li class="clearfix">
                    <div class="frame"><img src="<?=base_url()?>images/chad-cfo.jpg" alt="Chad Conley | CFO" /></div>
                    <div class="details">
                      <h2>Chad Conley | CFO</h2>
                      <a href="http://twitter.com/#!/ChadMusicalGenius" target="new"><img src="<?=base_url()?>images/twitter.png" alt="Twitter" /></a></div>
                  </li>
              </li>
                </ul>
              </div>
            </li>
            <li class="register"><a href="<?=base_url()?>register/beta" target="_blank">Register</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div id="signup">
      <div class="wrapper">
        <div class="logo"> <a href="#">Choicr </a><span>&nbsp;</span>
          <p class="tagline"> </p>
        </div>
        <div class="sign-up-form clearfix"> 
          <script src="<?=base_url()?>js/4qvp5few.htm" id="MyBetaList" type="text/javascript"></script> 
        </div>
      </div>
    </div>
    <div id="content">
      <div class="wrapper">
        <div class="two-column-layout clearfix">
          <h2>Waiting for an invite? Follow us on<br />
            Facebook and Twitter to keep up<br />
            with what's going on at Choicr!</h2>
          <a href="https://www.facebook.com/pages/Choicr/170069306364967" target="_blank"><div class="box1 flL css3"> <img src="<?=base_url()?>images/choicr-facebook.jpg" alt="facebook" /><span><img src="<?=base_url()?>images/facebook.jpg" alt="twitter" /></span></a> </div>
          <a href="https://twitter.com/choicr" target="_blank"><div class="box1 flR css3"> <img src="<?=base_url()?>" alt="twitter" /><span><img src="<?=base_url()?>images/twitter.jpg" alt="facebook" /></span></a> </div>
        </div>
      </div>
    </div>
    <div class="push">&nbsp;</div>
  </div>
  <div id="footer">
    <div class="wrapper">
      <p>Copyright &copy; 2010-2013 Invoticus Inc.</p>
    </div>
  </div>
</div>
<!--/Container --> 
<!-- JAVASCRIPTS --> 
<script src="<?=base_url()?>js/jquery-1.7.1.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/custom-form-elements-home.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/home.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/browser.js" type="text/javascript"></script> 
<script src="<?=base_url()?>js/selectivizr-min.js" type="text/javascript"></script>
</body>
</html>