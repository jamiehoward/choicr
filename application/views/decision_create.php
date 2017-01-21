<?php if (validation_errors())
	{ ?>
	<div class='drop'><h6><?=validation_errors()?></h6><br /><a class='close'>&nbsp;</a></div>
	<?php } 
	elseif (isset($error)) {?>
	<div class='drop'><h6><?=$error?></h6><br /><a class='close'>&nbsp;</a></div>
	<?php } 
?>
	
	<div class="content">
    	<div class="ask">
    		<h1>Ask!</h1>
            <h2>What should you do? How should you do it? What should you choose? <b>Ask</b> below. </h2>
            <?=form_open('ask')?>
            	<table>
                    <tr class='newCreateTable'>
                        <td>
							<label for='DecisionTitle'>Give your decision a title.</label>
							<input type="text" class="text" name="title" id="DecisionTitle" autocomplete='off' />
						</td>
                    </tr>
                    <tr class='newCreateTable'>
                        <td>
							<label for='details'>Describe the details of your decision.</label>
							<textarea class="comment" name="details" id="details"></textarea>
						</td>
                    </tr>
                    <tr class='newCreateTable'>
                        <td>
							<label for='Category'>Choose a category:</label>
							<select class="select" name="category" id="Category" style="width:400px; text-align:center; -moz-border-radius:8px 0 0 8px; -webkit-border-radius:8px 0 0 8px; border-radius:8px 0 0 8px; border:2px solid #d2d2d4;">
								<option value=''>Select</option>
								<?php foreach ($catQuery->result() as $cat) { ?>
										<option value="<?=$cat->dbCatCnt?>"><?=$cat->dbCatName?></option>
								<?php } ?>
							</select>
						</td>
                    </tr>
                    <tr class='newCreateTable'>
						<td>
							<div id='createChoice1' class='createChoice' style='border: 2px solid #D2D2D4; padding: 0px;'>
								<div class='createChoiceLabel' style='position: relative; padding: 5px; height: 53px;'>
									<div id="thumbnails1" style='width: 50px; height: 50px; border: solid 1px #7FAAFF; background-color: #C5D9FF; float: left;'></div>
									<span id='createChoice1Label' style='position: absolute; bottom: 15px; right: 190px;'>Choice 1</span>
									<a href='#' class='expander' style='text-decoration: none; position: absolute; top 5px; right: 10px;'>+</a>
								</div>
								<div class='createChoiceContent' style='border-top: 1px solid #D2D2D4; padding: 10px 0px;'>
									<div style='position: relative;'>
										<div id='swfUploadControl1' style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px; left: 10px; bottom: 6px; position: absolute; width: 100px; height: 100px;">
											<span id="spanButtonPlaceholder1"></span>
										</div>
										<p class='createInfo' style='margin: 0px 5px;'>Choice 1 Description</p>
										<textarea name='choice1desc' id='createChoice1Description' class='createChoiceDescription' style='width: 50%; height: 100px; display: block; margin: 10px 10px 10px auto;'></textarea>
									</div>
								</div>
							</div>
						</td>
                    </tr>
                    <tr class='newCreateTable'>
						<td>
							<div id='createChoice2' class='createChoice' style='border: 2px solid #D2D2D4; padding: 0px;'>
								<div class='createChoiceLabel' style='position: relative; padding: 5px; height: 53px;'>
									<div id="thumbnails2" style='width: 50px; height: 50px; border: solid 1px #7FAAFF; background-color: #C5D9FF; float: left;'></div>
									<span id='createChoice2Label' style='position: absolute; bottom: 15px; right: 190px;'>Choice 2</span>
									<a href='#' class='expander' style='text-decoration: none; position: absolute; top 5px; right: 10px;'>+</a>
								</div>
								<div class='createChoiceContent' style='border-top: 1px solid #D2D2D4; padding: 10px 0px;'>
									<div style='position: relative;'>
										<div id='swfUploadControl2' style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px; left: 10px; bottom: 6px; position: absolute; width: 100px; height: 100px;">
											<span id="spanButtonPlaceholder2"></span>
										</div>
										<p class='createInfo' style='margin: 0px 5px;'>Choice 2 Description</p>
										<textarea name='choice2desc' id='createChoice2Description' class='createChoiceDescription' style='width: 50%; height: 100px; display: block; margin: 10px 10px 10px auto;'></textarea>
									</div>
								</div>
							</div>
						</td>
                    </tr>
                    <tr class='newCreateTable'>
						<td>
							<label for='createExpireDatetime'>Need an answer by?</label>
							<input name='expiration' id="createExpireDatetime" readonly='readyonly' autocomplete='off' />
						</td>
                 	</tr>
                    <tr class='newCreateTable' style='text-align: center;'>
						<td>
							<label for='createPrivateCheckbox'>
								Private?
								<input type='checkbox' name='private' id='createPrivateCheckbox' />
								<span>(Only shown to mutual followers.)</span>
							</label>
						</td>
                 	</tr>
					<tr class='newCreateTable'>
                        <td>
							<input type="submit" class="submit" value="" />
						</td>
                    </tr>
                </table>
            <?=form_close()?>
        </div><!-- end ask -->
	</div><!-- end content -->