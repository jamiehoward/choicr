<?php
	include("../scripts/datedifference.php");
	require("../scripts/connect.php");
	include("../scripts/header.php");
?>
	<?php 
	if ($_REQUEST['error'] != NULL)
		{
		include("errors.php");
		}?>
	<div class="content">
    	<div class="ask">
    		<h1>Ask!</h1>
            <h2>What should you do? How should you do it? What should you choose? <b>Ask</b> below. </h2>
            <form enctype="multipart/form-data" action="choiceverify.php" method="POST">
            	<table>
                    <tr>
                        <td>Give your decision a title.<div>
                        <input type="text" class="text" name="DecisionTitle" id="DecisionTitle"/>
                        </div></td>
                    </tr>
                    <tr>
                        <td>Describe the details of your decision.<div>
                        <textarea class="comment" name="details" id="details"></textarea></div></td>
                    </tr>
                    <tr>
                        <td>Your first choice.<div>
                        <input type="text" class="text" name="Choice1Desc" id="Choice1Desc" /></div></td>
                    </tr>
                    <tr>
                        <td>Your second choice.<div>
                        <input type="text" class="text" name="Choice2Desc" id="Choice2Desc" /></div></td>
                    </tr>
                    <tr>
                        <td>Choose a category:<div>
                        <select class="select" name="Category" id="Category" style="width:400px; text-align:center; -moz-border-radius:8px 0 0 8px; -webkit-border-radius:8px 0 0 8px; border-radius:8px 0 0 8px; border:2px solid #d2d2d4;">
								<?php $catquery = "SELECT * FROM Categories ORDER BY dbCatName ASC";
									$catresult = mysql_query ($catquery, $dbconnect);				
									while ($catrow = mysql_fetch_array ($catresult))
										{
										echo "<option value='" . $catrow['dbCatCnt'] . "'>";
										echo $catrow['dbCatName'];
										echo "</option>";
										}
								?>
								</select>                        
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
	<?php include("../scripts/footer.php");?>
