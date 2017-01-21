<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	$TestNumber1 = mt_rand(10,21);
	$TestNumber2 = mt_rand(0,11);
	$TestAnswer = $TestNumber1 + $TestNumber2;
	include("../scripts/header.php");
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}?>
	<div class="content">
		<div class="signup">
    	<form action="register.php" method="post">
        	<table>
            	<tr>
                	<td><label for="username">Username</label></td>
                   	<td><div><input type="text" class="text" name="username" id="username" /></div></td>
              	</tr>
                <tr>
                	<td><label for="password">Password</label></td>
                   	<td><div><input type="password" class="text" name="password" id="password" /></div></td>
              	</tr>
                <tr>
                	<td><label for="email">E-Mail</label></td>
                   	<td><div><input type="text" class="text" name="email" id="email" /></div></td>
              	</tr>
                <tr>
                	<td><label for="test">What is <b><?php echo $TestNumber1;?></b> + <b><?php echo $TestNumber2;?></b>?</label></td>
                   	<td><div>
                   	<input type="hidden" name="num1" value="<?php echo $TestNumber1; ?>" />
                   	<input type="hidden" name="num2" value="<?php echo $TestNumber2; ?>" />
                   	<input type="text" class="text" name="test" id="test" /></div></td>
              	</tr>
                <tr>
                	<td>&nbsp;</td>
                   	<td class="terms"><div class="check"><input type="hidden" value="no" name="terms"/></div><p style="float:left; margin:0px 0 0 16px;">I understand and agree with the<br />Choicr <a href="#">Terms of Service</a>.</p></td>
              	</tr>
                <tr>
                	<td>&nbsp;</td>
                   	<td class="submit"><input type="submit" class="submit" value="" /></td>
              	</tr>
            </table>
        </form></div>
    </div><!-- end wrapper -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.base.js"></script>
	<script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="../js/livevalidation.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ check(); });
		var username = new LiveValidation('username');
		username.add(Validate.Presence);
		var password = new LiveValidation('password');
		password.add(Validate.Presence);
		var email = new LiveValidation('email');
		email.add(Validate.Presence);
		email.add( Validate.Email );
		var test = new LiveValidation('test');
		test.add(Validate.Presence);
		test.add( Validate.Numericality, { minimum: 10, maximum: 32	, onlyInteger: true } );
	</script>
	<script type="text/javascript">
		$(document).ready(function(){ base(); });
	</script>
	<?php include("../scripts/footer.php");?>	