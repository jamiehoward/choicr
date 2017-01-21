<?php
	require("../scripts/connect.php");
	include("../scripts/header.php");
?>
	<div class="content">
    	<ul class="int-nav">
			<li><a href="#" id="about">About</a></li>
			<?php if ($EnableStaff == 1){?>
			<li><a href="#" id="staff">Staff</a></li>
			<?php }?>
			<li><a href="#" id="press">Press</a></li>
			<li><a href="#" id="advertising">Advertising</a></li>
		</ul>
		<div class="right" id="about">
			<h1>About</h1>
			<h2>What is Choicr?</h2>
			<p><i>"Life is the sum of all your choices." -Albert Camus</i><br /><br /><b>Choicr</b> is a networking community in which its members work together to make decisions. The decisions are real. The choices are yours. As a user, you can create decisions based on anything from Fashion to Food, from Lifestyle to Sports. The red dress or the blue? Take her for fast food or fine dining? Name him Jack or Jude? Should I? Can we? When and where? Whatever the decision, your followers and fellow users will help you to choose. Every decision has an appropriate time limit (up to fourteen days), so vote quickly before the decisions expire. <b>Choicr</b> is not a polling site. It is decision making in real time. Life is full of tough choices. Let's make them together.</p>
			<h2>Contact Us:</h2>
			<a href="http://www.facebook.com/Choicr#!/pages/Choicr/170069306364967" target="_blank"><img src="../phpthumb/phpthum.php?src=../images/facebook.jpg&w=55&zc=1" border="0"/></a>
			<a href="http://twitter.com/choicrs" target="_blank"><img src="../phpthumb/phpthum.php?src=../images/twitter.jpg&w=55&zc=1" border="0"/></a><br />
			<br /><b>Choicr</b><br />Ask. Decide. Repeat.
		</div>
		<?php if ($EnableStaff == 1){?>
		<div class="right" id="staff">
			<h1>Staff</h1>
			<h2>John Howard | CEO</h2>
			<p>Twitter: @freeosin </p>
			<img src="../images/john.jpg" />
			
			<h2>Jamie Howard | VP</h2>
			<p>Twitter: @jamiehoward</p>
			<img src="../images/jamie.jpg" />
				
			<h2>Chad Conley | CFO</h2>
			<p>Twitter: @chadmusicgenius </p>
		</div><?php }?>
		<div class="right" id="press">
			<h1>Press</h1>
			<h2>How do I contact choicr?</h2>
			<p>You can reach us by contacting us at press@choicr.com<br><br>
		</div>
		<div class="right" id="advertising">
			<h1>Advertising</h1>
			<h2>How can I contact choicr about advertising?</h2>
			<p>To inquire about advertising contact us at advertising@choicr.com</p>
					</div>
      <div class="clear"></div>
	</div><!-- end content -->
	<?php include("../scripts/footer.php");?>