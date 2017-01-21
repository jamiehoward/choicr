<?php
	require("../scripts/connect.php");
	require("../scripts/session.php");
	include("../scripts/datedifference.php");

	$dbUsrCnt = $_SESSION['dbUsrCnt'];
	$timestamp = date("Y-m-d H:i:s");
	$DecisionTitle = $_REQUEST['DecisionTitle'];
	$DecisionDesc = $_REQUEST['details'];
	$Choice1Desc = $_REQUEST['Choice1Desc'];
	$Choice2Desc = $_REQUEST['Choice2Desc'];
	$Photo1 = $_REQUEST['Photo1'];
	$Photo2 = $_REQUEST['Photo2'];
	$Category = $_REQUEST['Category'];
	$expdate = $_REQUEST['expdate'];
	$exptime = $_REQUEST['exptime'];
	$private = 0;
	$expstring = $expdate . " " . $exptime;
	$expdatestamp = strtotime($expstring);
	$ExpDate = date("Y-m-d H:i:s", $expdatestamp);
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
		<div><a href="../home.php"><img src="../images/hdr-logo.png" alt="Invoticus" /></a></div>
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
			<li><a href="../profile/">Profile</a></li>
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
            <p><i>Logged in</i> as <b><?php echo $UserInfo['dbUsrName'];?></b> [<a href="../scripts/logout.php">Log Out</a>]</p>
            <?php }?>
            <div class="clear"></div>
        </div>
	</div><!-- end nav -->
	<?php 
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}?>
	<div class="content">
    	<div class="ask">
    		<h1>Ask!</h1>
            <h2>Here's what your choice looks like so far. You're welcome to change anything here. </h2>
            <form enctype="multipart/form-data" action="choiceverify.php" method="POST">
            	<table>
                    <tr>
                        <td>Give your decision a title.<div>
                        <input type="text" class="text" name="DecisionTitle" id="DecisionTitle" value="<?php echo $DecisionTitle;?>"/>
                        </div></td>
                    </tr>
                    <tr>
                        <td>Describe the details of your decision.<div>
                        <textarea class="comment" name="details" id="details" value="<?php echo $details;?>"></textarea></div></td>
                    </tr>
                    <tr>
                        <td>Your first choice.<div>
                        <input type="text" class="text" name="Choice1Desc" id="Choice1Desc" value="<?php echo $Choice1Desc;?>"/></div></td>
                    </tr>
                    <tr>
                        <td>Your second choice.<div>
                        <input type="text" class="text" name="Choice2Desc" id="Choice2Desc" value="<?php echo $Choice2Desc;?>"/></div></td>
                    </tr>
                    <tr>
                        <td>Choose a category:<div>
                        <b><?php echo $Category;?></b>                        
                        </div></td>
                    </tr>                    
                    <tr>
                    	<td>Set a date to expire.
                    	                    	
                        	<table>
                            	<tr>
                                	<td>
                                        <select name="expdate" class="select" style="width:300px; text-align:center; -moz-border-radius:8px 0 0 8px; -webkit-border-radius:8px 0 0 8px; border-radius:8px 0 0 8px; border:2px solid #d2d2d4;"> 
												<?php
					                    		$t = time();
													$i = 0;
													$seconds = -86400;
													while ($i < 15)
														{
													$seconds = $seconds + 86400;
													$fourteenDate[$i] = $t + $seconds;
													$fourteenDays[$i] = date("M jS, Y", $fourteenDate[$i]);
													$fourteenValue[$i] = date("Y-m-d", $fourteenDate[$i]);
														?>                                            
                                            <option value='<?php echo $fourteenValue[$i];?>'><?php echo $fourteenDays[$i];?></option>
                                          <?php 
                                          $i = $i + 1;
                                          }?> 
                                        </select>
                                    </td>
                                 	<td>
                                        <select name="exptime" class="select" style="width:200px; text-align:center; -moz-border-radius:8px 0 0 8px; -webkit-border-radius:8px 0 0 8px; border-radius:8px 0 0 8px; border:2px solid #d2d2d4;"> 
														<?php 
															$hourstamp = mktime(0,0,0);	
															$timecount = 0;
															$seconds = -900;
															while ($timecount < 96)
																{
																$seconds = $seconds + 900;
																$hourMark[$i] = $hourstamp + $seconds;
																$hourChoice[$i] = date("g:i A", $hourMark[$i]);
																$hourValue[$i] = date("H:i:s", $hourMark[$i]);
																?>
																<option value="<?php echo $hourValue[$i];?>">
																<?php echo $hourChoice[$i];?></option>
																<?php
																$timecount = $timecount + 1;		
																}	
														?>                                        		
                                        </select>
                                    </td>
                                 </tr>
                            </table>
                        </td>
                 	</tr>
                        <td><input type="submit" class="submit" value="" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- end ask -->
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
	</div><!-- end footer -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.base.js"></script>
	<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ base(); });
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

