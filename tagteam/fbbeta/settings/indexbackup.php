<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	$ProfileCnt = $_SESSION['dbUsrCnt'];
	$ProfileSQL = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$ProfileCnt'";
		$ProfileResults = mysql_query($ProfileSQL, $dbconnect);
		$ProfileInfo = mysql_fetch_array($ProfileResults);
		$ProfileUserCnt = $ProfileInfo['dbUsrCnt'];
		if ($ProfileInfo['dbUsrCnt'] == $dbUsrCnt)
			{
			$PostAuthor = 1;
			}
		if ($ProfileInfo['dbUsrPic'] == NULL)
			{
			$ProfileInfo['dbUsrPic'] = "default.jpg";
			}
	include("../scripts/header.php");
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}
	elseif ($_REQUEST['note'] != NULL || $Note != NULL && $PostAuthor == 1)
		{
		include("notifications.php");
		}
?>
	<div class="content">
		<div class="ask">
			<div class="top-left"><?php echo $ProfileInfo['dbUsrName'];?></div>
			<div class="top-right"> 
	 		</div>
		</div>
		 <div class='leftMenu'> 
			<img src="../phpthumb/phpthumb.php?src=http://www.choicr.com/public/img/<?php echo $ProfileInfo['dbUsrPic'];?>&w=200&zc=1" alt="Bio goes here?"/>

		<form  enctype="multipart/form-data" action="uploadimage.php" method="POST">
			<table>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<tr><td>&nbsp;</td><TD><br /><input type="file" name="profileimg" size=15/></TD></tr>
				<tr><td>&nbsp;</td><TD><input type="submit" value="Upload!" /></TD></tr>
			</table>
		</form><br />
		 </div>
        <div class="midDiv">
		<!--Start the div-->
		<form action="verifysettings.php" method="POST">
			<table>
			<tr><td><b>Change Password:</b></td><td>New:<br /><input type="password" name="newpassword1"/></td></tr>
			<tr><td>&nbsp;</td><td>Re-type:<br /><input type="password" name="newpassword2"/></td></tr>
			<tr><td>&nbsp;</td><td>Original Password:<br /><input type="password" name="oldpassword"/></td></tr>
			<tr><td><b>Email:</b></td><td><input type="text" name="email" value="<?php echo $ProfileInfo['dbUsrEmail'];?>"/></td></tr>
			<tr><td><b>First name:</b></td><td><input type="text" name="firstname" value="<?php echo $ProfileInfo['dbUsrFirstName'];?>"/></td></tr>
			<tr><td><b>Last name:</b></td><td><input type="text" name="lastname" value="<?php echo $ProfileInfo['dbUsrLastName'];?>"/></td></tr>
			<tr><td><b>Age:</b></td>
				<td>
					<select name="agegroup">
					<?php if ($ProfileInfo['dbUsrAgeGroup'] != NULL)
						{
						$AgeSelected[$ProfileInfo['dbUsrAgeGroup']] = "selected='selected'";
						}?>	
					<option value="0">Select an age group!</option>
					<option value="1" <?php echo $AgeSelected['1'];?>>13-17</option>
					<option value="2" <?php echo $AgeSelected['2'];?>>18-24</option>
					<option value="3" <?php echo $AgeSelected['3'];?>>25-34</option>
					<option value="4" <?php echo $AgeSelected['4'];?>>35-44</option>
					<option value="5" <?php echo $AgeSelected['5'];?>>45-54</option>
					<option value="6" <?php echo $AgeSelected['6'];?>>55-64</option>
					<option value="7" <?php echo $AgeSelected['7'];?>>65+</option>
					</select>
				</td></tr>
			<tr><td><b>Gender:</b></td>
				<td>
					<select name="gender">
					<?php if ($ProfileInfo['dbUsrGender'] != NULL)
						{
						$GenderSelected[$ProfileInfo['dbUsrGender']] = "selected='selected'";
						}?>	
					<option>Prefer not to say</option>
					<option value="0" <?php echo $GenderSelected['0'];?>>Male</option>
					<option value="1" <?php echo $GenderSelected['1	'];?>>Female</option>
					</select>
				</td></tr>
			<tr><td>&nbsp;</td><td><br /><input type="submit" value="Save Changes" /></td></tr>
			</table>
		</form>
		<!--End the div-->
	</div>
            <div class="clear"></div>
        </div><!-- end listing -->
	</div><!-- end wrapper -->
	<?php include("../scripts/footer.php");?>
