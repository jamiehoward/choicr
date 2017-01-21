<?php
	require("../scripts/connect.php");
	include("../scripts/datedifference.php");
	include("../scripts/header.php");
?>
	<div class="content">
		<div class="ask">
			<form action="login.php" method="POST">
	        	<h1>Login here!</h1>
	        	<table>
	            	<tr>
	                	<td><label for="User Name">User Name</label></td>
	                   	<td><div><input type="text" class="text" name="Username" id="Username" /></div></td>
	              	</tr>
	                <tr>
	                	<td><label for="Password">Password</label></td>
	                  <td><div><input type="password" class="text" name="Password" id="Password" /></div></td>
	              	</tr>
	               <tr>
	               	<td>&nbsp;</td>
	                  <td class="submit"><input type="submit" class="submit" value="" /></td>
	              	</tr>
	            </table>
	        </form>
		</div>
	</div>
	</div><!-- end content -->
	<?php include("../scripts/footer.php");?>
