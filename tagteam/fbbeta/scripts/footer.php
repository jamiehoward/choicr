	<div class="footer">
		<ul class="left">
			<li><a href="../home/">Choicr&trade;</a></li>
			<li>|</li>
			<li>All rights reserved &copy;2011</li>
		</ul>
		<ul class="right">
			<li><a href="../about/">About</a></li>
			<li><a href="../blog/">Blog</a></li>
			<li><a href="../about/">Advertising</a></li>
			<li><a href="#">Help</a></li>
			<li><a href="../terms/">Terms</a></li>
			<li><a href="../privacy/">Privacy</a></li>
		</ul>
		<div class="clear"></div>
	
		<?php if ($UserInfo['dbUsrName'] == "JamieHoward" || $UserInfo['dbUsrName'] == "johnhoward" || $UserInfo['dbUsrName'] == "musicalgenius"  )
			{
			$BetaCountSQL = "SELECT * FROM Beta_Requests WHERE dbEmailAddress NOT IN (SELECT dbUsrEmail FROM Users) AND dbEmailAddress NOT IN (SELECT dbInviteeEmail FROM Invites)";
			$BetaCountResults = mysql_query($BetaCountSQL, $dbconnect);
			$BetaCount = mysql_num_rows($BetaCountResults);
			$UserCountSQL = "SELECT * FROM Users";
			$UserCountResults = mysql_query($UserCountSQL, $dbconnect);
			$UserCount = mysql_num_rows($UserCountResults);
			$InviteCountSQL = "SELECT * FROM Invites WHERE dbAcceptDate IS NULL";
			$InviteCountResults = mysql_query($InviteCountSQL, $dbconnect);
			$InviteCount = mysql_num_rows($InviteCountResults);
			?>
			<div class="admin"><?php
			echo "<b>ADMIN INFO:</b><a href='../scripts/showbetarequests.php'> | Pending BetaRequests: <b>" . $BetaCount . "</a></b><a href='../scripts/showusers.php'> | Users: <b>" . $UserCount . "</b></a> | Invites: <b>" . $InviteCount ."</b> | " . $timestamp;
			?></div>
			<?php }?>
	</div><!-- end footer --><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script><script type="text/javascript" src="../js/jquery.base.js"></script><script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
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