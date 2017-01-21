<link type="text/css" href="<?=base_url()?>css/fileuploader.css" rel="stylesheet" />
<?=validation_errors(); ?>
<div class="main-profile clearfix">
    <div class="avatar"><img src="<?=base_url()?>img/profile/<?=$picture?>" width=114px alt="<?=$settings_user?>" /> </div>
    
    <div class="info">
    <?php if (isset($error)) { echo $error; }?>
      <h2><?=$settings_user?></h2>
      <p /> </div>
      

</div>
<div class="create-profile">
    <div class="stylish-form">
        <?=form_open('settings/submit')?>
        <ul>
            <li id="upload-main-button" class="clearfix file">
                <div id="file-uploader"></div>
            </li>

            <li class="file" id="upload-progressbar" style="display: none;">
                    <span class="upload clearfix">
                    <span class="progress-bar" style="width:0;"><span class="inner"  style="width:0;"></span></span> </span>
            </li>


        	<li class="clearfix">
        		
              		<!--<input type="text" onfocus="if(this.value=='First name') this.value='';" onblur="if(this.value=='') this.value='First name';" value="<?php /*if (isset($first_name)) { echo $first_name; } */?>" name="first_name" />-->
                <input id="first-name" type="text" placeholder="First name" class="textbox jq_watermark"  value="<?=isset($first_name)? $first_name:'' ?>" name="first_name" />
                <span id="first-name-counter" class="count css3"></span>
			</li>
            <li class="clearfix">
        		
              		<!--<input type="text" onfocus="if(this.value=='Last name') this.value='';" onblur="if(this.value=='') this.value='Last name';" value="<?php /*if (isset($last_name)) { echo $last_name; } */?>" name="last_name" />-->
                <input id="last-name" type="text" placeholder="Last name" class="textbox jq_watermark"  value="<?=isset($last_name)? $last_name:'' ?>" name="last_name" />
                <span id="last-name-counter" class="count css3"></span>
			</li>
            <li class="clearfix">
        		
              		<!--<input type="text" onfocus="if(this.value=='E-mail') this.value='';" onblur="if(this.value=='') this.value='E-mail';" value="<?php /*if (isset($email)) { echo $email; } */?>" name="email" />-->
                <input id="email" type="text" placeholder="E-mail" class="textbox jq_watermark"  value="<?=isset($email)? $email:'' ?>" name="email" />
                <span id="email-counter" class="count css3"></span>
			</li>
            <li class="clearfix">
            <?php if (isset($gender)) {
				$selected = $gender;
			}
			else {
				$selected = 2;
			} ?>
        		
              	<select name="gender" class="selectbox">
                	<option value="">Select your gender</option>
                    <option value="0" <?php if ($selected == 0) { echo "selected = 'selected'"; } ?>>Male</option>
                    <option value="1" <?php if ($selected == 1) { echo "selected = 'selected'"; } ?>>Female</option>
                </select>
              	
			</li>
            <li class="clearfix">
            <?php if (isset($age_group)) {
				$selected_ag = $age_group;
			}
			else {
				$selected_ag = 0;
			} ?>
        		
              	<select name="age_group" class="selectbox">
                	<option value="0">Select your age</option>
                    <option value="1" <?php if ($selected_ag == 1) { echo "selected = 'selected'"; } ?>>17 or under</option>
                    <option value="2" <?php if ($selected_ag == 2) { echo "selected = 'selected'"; } ?>>18-24</option>
                    <option value="3" <?php if ($selected_ag == 3) { echo "selected = 'selected'"; } ?>>25-34</option>
                    <option value="4" <?php if ($selected_ag == 4) { echo "selected = 'selected'"; } ?>>35-44</option>
                    <option value="5" <?php if ($selected_ag == 5) { echo "selected = 'selected'"; } ?>>45-54</option>
                    <option value="6" <?php if ($selected_ag == 6) { echo "selected = 'selected'"; } ?>>55+</option>
                </select>
              	
			</li>
            
            <li class="clearfix">
            <?php if (isset($age_group)) {
				$selected_ag = $age_group;
			}
			else {
				$selected_ag = 0;
			} ?>
        		
           		<select name="timezones" class="selectbox">
					<option value='UM12' <?php if (isset($timezone) && $timezone == 'UM12') { echo "selected='selected'"; } ?>>(UTC -12:00) Baker/Howland Island</option>
					<option value='UM11' <?php if (isset($timezone) && $timezone == 'UM11') { echo "selected='selected'"; } ?>>(UTC -11:00) Samoa Time Zone, Niue</option>
					<option value='UM10' <?php if (isset($timezone) && $timezone == 'UM10') { echo "selected='selected'"; } ?>>(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti</option>
					<option value='UM95' <?php if (isset($timezone) && $timezone == 'UM95') { echo "selected='selected'"; } ?>>(UTC -9:30) Marquesas Islands</option>
					<option value='UM9' <?php if (isset($timezone) && $timezone == 'UM9') { echo "selected='selected'"; } ?>>(UTC -9:00) Alaska Standard Time, Gambier Islands</option>
					<option value='UM8' <?php if (isset($timezone) && $timezone == 'UM8') { echo "selected='selected'"; } ?>>(UTC -8:00) Pacific Standard Time, Clipperton Island</option>
					<option value='UM7' <?php if (isset($timezone) && $timezone == 'UM7') { echo "selected='selected'"; } ?>>(UTC -7:00) Mountain Standard Time</option>
					<option value='UM6' <?php if (isset($timezone) && $timezone == 'UM6') { echo "selected='selected'"; } ?>>(UTC -6:00) Central Standard Time</option>
					<option value='UM5' <?php if (isset($timezone) && $timezone == 'UM5') { echo "selected='selected'"; } ?>>(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time</option>
					<option value='UM45' <?php if (isset($timezone) && $timezone == 'UM45') { echo "selected='selected'"; } ?>>(UTC -4:30) Venezuelan Standard Time</option>
					<option value='UM4' <?php if (isset($timezone) && $timezone == 'UM4') { echo "selected='selected'"; } ?>>(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time</option>
					<option value='UM35' <?php if (isset($timezone) && $timezone == 'UM35') { echo "selected='selected'"; } ?>>(UTC -3:30) Newfoundland Standard Time</option>
					<option value='UM3' <?php if (isset($timezone) && $timezone == 'UM3') { echo "selected='selected'"; } ?>>(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay</option>
					<option value='UM2' <?php if (isset($timezone) && $timezone == 'UM2') { echo "selected='selected'"; } ?>>(UTC -2:00) South Georgia/South Sandwich Islands</option>
					<option value='UM1' <?php if (isset($timezone) && $timezone == 'UM1') { echo "selected='selected'"; } ?>>(UTC -1:00) Azores, Cape Verde Islands</option>
					<option value='UTC' <?php if (isset($timezone) && $timezone == 'UTC') { echo "selected='selected'"; } ?>>(UTC) Greenwich Mean Time, Western European Time</option>
					<option value='UP1' <?php if (isset($timezone) && $timezone == 'UP1') { echo "selected='selected'"; } ?>>(UTC +1:00) Central European Time, West Africa Time</option>
					<option value='UP2' <?php if (isset($timezone) && $timezone == 'UP2') { echo "selected='selected'"; } ?>>(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time</option>
					<option value='UP3' <?php if (isset($timezone) && $timezone == 'UP3') { echo "selected='selected'"; } ?>>(UTC +3:00) Moscow Time, East Africa Time</option>
					<option value='UP35' <?php if (isset($timezone) && $timezone == 'UP35') { echo "selected='selected'"; } ?>>(UTC +3:30) Iran Standard Time</option>
					<option value='UP4' <?php if (isset($timezone) && $timezone == 'UP4') { echo "selected='selected'"; } ?>>(UTC +4:00) Azerbaijan Standard Time, Samara Time</option>
					<option value='UP45' <?php if (isset($timezone) && $timezone == 'U45') { echo "selected='selected'"; } ?>>(UTC +4:30) Afghanistan</option>
					<option value='UP5' <?php if (isset($timezone) && $timezone == 'UP5') { echo "selected='selected'"; } ?>>(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time</option>
					<option value='UP55' <?php if (isset($timezone) && $timezone == 'UP55') { echo "selected='selected'"; } ?>>(UTC +5:30) Indian Standard Time, Sri Lanka Time</option>
					<option value='UP575' <?php if (isset($timezone) && $timezone == 'UP575') { echo "selected='selected'"; } ?>>(UTC +5:45) Nepal Time</option>
					<option value='UP6' <?php if (isset($timezone) && $timezone == 'UP6') { echo "selected='selected'"; } ?>>(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time</option>
					<option value='UP65' <?php if (isset($timezone) && $timezone == 'UP65') { echo "selected='selected'"; } ?>>(UTC +6:30) Cocos Islands, Myanmar</option>
					<option value='UP7' <?php if (isset($timezone) && $timezone == 'UP7') { echo "selected='selected'"; } ?>>(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</option>
					<option value='UP8' <?php if (isset($timezone) && $timezone == 'UP8') { echo "selected='selected'"; } ?>>(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time</option>
					<option value='UP875' <?php if (isset($timezone) && $timezone == 'UP875') { echo "selected='selected'"; } ?>>(UTC +8:45) Australian Central Western Standard Time</option>
					<option value='UP9' <?php if (isset($timezone) && $timezone == 'UP9') { echo "selected='selected'"; } ?>>(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time</option>
					<option value='UP95' <?php if (isset($timezone) && $timezone == 'UP95') { echo "selected='selected'"; } ?>>(UTC +9:30) Australian Central Standard Time</option>
					<option value='UP10' <?php if (isset($timezone) && $timezone == 'UP10') { echo "selected='selected'"; } ?>>(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time</option>
					<option value='UP105' <?php if (isset($timezone) && $timezone == 'UP105') { echo "selected='selected'"; } ?>>(UTC +10:30) Lord Howe Island</option>
					<option value='UP11' <?php if (isset($timezone) && $timezone == 'UP11') { echo "selected='selected'"; } ?>>(UTC +11:00) Magadan Time, Solomon Islands, Vanuatu</option>
					<option value='UP115' <?php if (isset($timezone) && $timezone == 'UP115') { echo "selected='selected'"; } ?>>(UTC +11:30) Norfolk Island</option>
					<option value='UP12' <?php if (isset($timezone) && $timezone == 'UP12') { echo "selected='selected'"; } ?>>(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time</option>
					<option value='UP1275' <?php if (isset($timezone) && $timezone == 'UP1275') { echo "selected='selected'"; } ?>>(UTC +12:45) Chatham Islands Standard Time</option>
					<option value='UP13' <?php if (isset($timezone) && $timezone == 'UP13') { echo "selected='selected'"; } ?>>(UTC +13:00) Phoenix Islands Time, Tonga</option>
					<option value='UP14' <?php if (isset($timezone) && $timezone == 'UP14') { echo "selected='selected'"; } ?>>(UTC +14:00) Line Islands</option>
				</select>
              	
			</li>

            <li class="textarea clearfix">
                <textarea name="details" id="user-details" cols="1" rows="1" placeholder="About" class="textarea jq_watermark" ><?=!empty($about)?$about:''?></textarea>
                <span id="user-details-counter" class="count css3"></span>
            </li>
            
            <li class="clearfix">
              <input type="submit" class="next-btn" value="Submit" />
              <?php /* <a href="#" class="prev-btn"></a> 
			   <span class="checkbox">
              <input type="checkbox" />
              </span>I agree to the terms.*/?> 
            </li> 
            
        </ul>
        <?=form_close()?>
    </div>
</div>
<script src="<?=base_url()?>js/fileuploader.js" type="text/javascript"></script>
<script type="text/javascript">
    function createUploader(){
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '<?php echo site_url('upload/profile');?>/<?=$this->session->userdata('userID')?>',
            debug: true,
            allowedExtensions: ['jpeg', 'jpg', 'png', 'gif'],
            //button: 'Upload Choice#1 Picture',
            params: {
                sizeLimit:  2 * 1024 * 1024, // max size
                minSizeLimit: 1, // min size
                multiple: false
            },
            onComplete: function(id, fileName, responseJSON){
                if(responseJSON.success == true){
                    var file = responseJSON.file_name;
                    var html = '<img src="<?=base_url()?>img/profile/'+ file +'" width=114px alt="<?=$settings_user?>" />';

                    $('#upload-progressbar').hide();

                    $('.main-profile .avatar').html(html);
                    //$('#upload-thumbnail1').show();
                    return true;
                }
            },

            onSubmit: function(id, fileName){
                //$('#upload-main-button1').hide();
                //$('#upload-success1 .file').text(fileName);
                //$('#upload-progressbar1 .progress-bar').text(fileName);
                $('#upload-progressbar').show();
                return true;
            },
            onProgress: function(id, fileName, loaded, total){
                var percent = parseInt((loaded / total) * 100);
                $('#upload-progressbar .progress-bar').css('width', percent);
                $('#upload-progressbar .inner').css('width', percent);
            }
        });

    }

    $(document).ready(function() {
        createUploader();
        $('.selectbox').sSelect();

        $('#first-name-counter').textCounter({
            target: '#first-name',
            count: 50,
            alertAt: 10,
            warnAt: 5,
            stopAtLimit: true
        });

        $('#last-name-counter').textCounter({
            target: '#last-name',
            count: 50,
            alertAt: 10,
            warnAt: 5,
            stopAtLimit: true
        });

        $('#email-counter').textCounter({
            target: '#email',
            count: 50,
            alertAt: 10,
            warnAt: 5,
            stopAtLimit: true
        });

        $('#user-details-counter').textCounter({
            target: '#user-details',
            count: 140,
            alertAt: 30,
            warnAt: 10,
            stopAtLimit: true
        });

    });
</script>