<?php
	require("./scripts/connect.php");
	include_once "fbmain.php";
	$TestNumber1 = mt_rand(10,21);
	$TestNumber2 = mt_rand(0,11);
	$TestAnswer = $TestNumber1 + $TestNumber2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>CHOICR | Ask, Decide, Repeat!</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link type="text/css" rel="stylesheet" href="./style/reset.css" />
	<link type="text/css" rel="stylesheet" href="./style/index.css" />
    <link type="text/css" rel="stylesheet" href="./style/colorbox/colorbox.css" />
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
<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.init({appId: '<?=$fbconfig['appid' ]?>', status: true, cookie: true, xfbml: true});

		/* All the events registered */
		FB.Event.subscribe('auth.login', function(response) {
			// do something with response
			login();
		});
		FB.Event.subscribe('auth.logout', function(response) {
			// do something with response
			logout();
		});
	};
	(function() {
		var e = document.createElement('script');
		e.type = 'text/javascript';
		e.src = document.location.protocol +
			'//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());

	function login(){
		document.location.href = "<?=$config['baseurl'].'user-process.php'?>";
	}
	function logout(){
		document.location.href = "<?=$config['baseurl']?>";
	}
</script>
</head>
<body>
	<?php if ($_REQUEST['notification'] == 1 && $_REQUEST['error'] == NULL)
		{?>
		<div class="drop">
			<h6><b>Thanks for registering!</b><br />
			A confirmation e-mail has been sent to your inbox. If you are selected for beta testing, the invite will be sent there as well!</h6>
			<a class="close">&nbsp;</a>
		</div>
	<?php }?>
	<?php if ($_REQUEST['error'] != NULL)
		{
		include ("errors.php");
		}?>
<br>
<br>
	<img src="./ask/img/logo.jpg"/>
		<div class="content"> 
    	<div class="ask"> 
		<h1><i>choicr</i> is currently in closed-beta.</h1> 
		<h2>Fill out the form below to have a chance at receiving a beta invite to choicr.</h2> 
		<form enctype="multipart/form-data" action="./scripts/betarequest.php" method="POST">
            	<table> 
			<tr> 
				<td>Please provide us with a valid e-mail address. <br />We're not big fans of fake ones.<div> 
				<input type="text" class="text" name="email" id="email"/> 
				</div></td> 
			</tr> 
			<tr> 
				<td>Tell us why you think you should get an <br />invite to be one of our beta testers. Be creative!<div> 
				<textarea class="comment" name="details" id="details"></textarea></div></td> 
			</tr>
			<tr>
				<td>What is <b><?php echo $TestNumber1;?></b> + <b><?php echo $TestNumber2;?></b>?
				<div>
				<input type="hidden" name="num1" value="<?php echo $TestNumber1; ?>" />
				<input type="hidden" name="num2" value="<?php echo $TestNumber2; ?>" />
				<input type="text" class="text" name="test" id="test" /></div></td>
			</tr>
                    </table>
			<table> 
                        <tr>
                        <td><input type="submit" class="submit" value="" />&nbsp;<fb:login-button autologoutlink="true" perms="email" size="medium" onlogin="Log.info('onlogin callback')"></td> 
                    </tr> 
                </table> 
            </form> 
        </div><!-- end ask --> 
	</div><!-- end content -->
    </div><!-- end wrapper -->
		</div>
<div class="footer">
		<ul class="left">
			<li><a href="#">Choicr</a></li>
			<li>|</li>
			<li><a href="#">Copyright 2010</a></li>
			<li><a href="http://www.twitter.com/choicrs"><img src="./images/twitter.png" /></a></li>
		</ul>
		<div class="clear"></div>
	</div><!-- end footer -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.base.js"></script>
	<script type="text/javascript" src="./js/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="./js/livevalidation.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ check(); });
		var email = new LiveValidation('email');
		email.add(Validate.Presence);
		email.add( Validate.Email );
		var test = new LiveValidation('test');
		test.add(Validate.Presence);
		test.add( Validate.Numericality, { onlyInteger: true } );
	</script>
	<script type="text/javascript">
		$(document).ready(function(){ base(); });
	</script>
<a title="Web Analytics" href="http://getclicky.com/66365173"></a>
<script src="http://static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(66365173); }catch(err){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="http://in.getclicky.com/66365173ns.gif" /></p></noscript>
</body>
</html>

