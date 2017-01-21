<link type="text/css" href="<?=base_url()?>css/fileuploader.css" rel="stylesheet" />
<div class="create-profile">
	<?=validation_errors(); ?>
    <h1 class="create-profile-header">Create a Decision!</h1>

    <p>
    	Create a decision! A few examples are <em>'Where should I go on my date?'</em>,<br />
		<em>'Which tie should I wear to the interview?'</em>, or <em>'Which song <br />
		should my band open up with at our next show?'</em>.The possibilities are<br /> endless!
	</p>

    <div class="stylish-form">
	
        <?=form_open('ask'); ?>

            <ul>
                <li class="clearfix">
                    <!--<span>
                        <input type="text" onfocus="if(this.value=='Decision Title') this.value='';" onblur="if(this.value=='') this.value='Decision Title';" value="Decision Title" name="title" />
                    </span>-->
                    <input id="decision-title" type="text" placeholder="Decision Title" class="textbox jq_watermark" name="title" />
                    <span id="decision-title-counter" class="count css3"></span>
                </li>
                <li class="textarea clearfix">
                    <!--<span class="textarea">
                        <textarea rows="1" cols="1" onfocus="if(this.value=='Decision Summary/Story') this.value='';" onblur="if(this.value=='') this.value='Decision Summary/Story';" name="details" >Decision Summary/Story</textarea>
                    </span>-->
                    <textarea name="details" id="decision-summary" cols="1" rows="1" placeholder="Decision Summary/Story" class="textarea jq_watermark" ></textarea>
                    <span id="decision-summary-counter" class="count css3"></span>
                </li>
                <li class="clearfix">
                    <!--<span class="textbox">
                        <input type="text" onfocus="if(this.value=='Choice #1') this.value='';" onblur="if(this.value=='') this.value='Choice #1';" value="Choice #1" name="choice1desc" />
                    </span>-->
                    <input name="choice1desc" id="choice-title1" type="text" placeholder="Choice #1" class="textbox jq_watermark" />
                    <span id="choice-title-counter1" class="count css3"></span>
                    <input id="choice1file" type="hidden" name="choice1file" value="0" />
                </li>
                <li id="upload-main-button1" class="clearfix file">
                    <div id="file-uploader"></div>
                </li>
                <li id="upload-success1" class="clearfix file success" style="display: none;">
                    <span class="file">  </span> <span class="file-btn"> &nbsp; </span>
                </li>
                <li class="file" id="upload-progressbar1" style="display: none;">
                    <span class="upload clearfix">
                    <span class="progress-bar" style="width:0;"><span class="inner"  style="width:0;"></span></span> </span>
                </li>
                <li class="clearfix" id="upload-thumbnail1">

                </li>
                <li class="clearfix">
                    <!--<span class="textbox">
                        <input type="text" onfocus="if(this.value=='Choice #2') this.value='';" onblur="if(this.value=='') this.value='Choice #2';" value="Choice #2" name="choice2desc" />
                    </span>-->
                    <input name="choice2desc" id="choice-title2" type="text" placeholder="Choice #2" class="textbox jq_watermark" />
                    <span id="choice-title-counter2" class="count css3"></span>
                    <input id="choice2file" type="hidden" name="choice2file" value="0" />
                </li>


                <li id="upload-main-button2" class="clearfix file">
                    <div id="file-uploader2"></div>
                </li>
                <li id="upload-success2" class="clearfix file success" style="display: none;">
                    <span class="file">  </span> <span class="file-btn"> &nbsp; </span>
                </li>
                <li class="file" id="upload-progressbar2" style="display: none;">
                    <span class="upload clearfix">
                    <span class="progress-bar" style="width:0;"><span class="inner"  style="width:0;"></span></span> </span>
                </li>
                <li class="clearfix" id="upload-thumbnail2">

                </li>


                <!--<li class="clearfix file">
                    <input type="file" class="browse" />
                </li>-->
                <li class="clearfix">
                  <select class="selectbox" name="category">
                    <?php $catSQL = "SELECT * FROM `Categories` ORDER BY dbCatName;";
                    $catResult = $this->db->query($catSQL);
                    foreach ($catResult->result() as $category) { ?>
                    <option value="<?=$category->dbCatCnt?>">
                    <a href="#"><img src="<?=base_url()?>images/categories/<?=$category->dbCatName?>_icon.png" alt="category" />
                    <?=$category->dbCatName?></a>
                    </option>
                    <?php } ?>
                  </select>
                </li>
                <li class="clearfix">
                    <!--<span class="textbox">
                    <p>
                        <input type="text" onfocus="if(this.value=='Expiration date') this.value='';" onblur="if(this.value=='') this.value='Expiration date';" value="Expiration date" id="datepicker" name="expdate"></p>
                    </span>-->
                    <input id="datepicker" name="expdate" type="text" placeholder="Day to Expire?" class="textbox jq_watermark" />
                    <span class="count css3"><img src="<?=base_url()?>images/calendar-icon.png" alt="calendar" /></span>
                </li>
                <li class="clearfix">
                    <!--<span class="textbox">
                        <p>
                            <input type="text" onfocus="if(this.value=='Time to expire') this.value='';" onblur="if(this.value=='') this.value='Time to expire';" value="Time to expire"  id="timePicker" length=30 name="exptime" />
                        </p>
                    </span>-->
                    <input id="timePicker" length=30 name="exptime" type="text" placeholder="Time to Expire?" class="textbox jq_watermark" />
                    <span class="count css3"><img src="<?=base_url()?>images/time-icon.png" alt="icon" /></span>
                </li>
                <li class="clearfix">
                  <input type="submit" class="next-btn" value="Submit" />
                  <?php /* <a href="#" class="prev-btn"></a>
                   <span class="checkbox">
                  <input type="checkbox" />
                  </span>I agree to the terms.*/?>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="<?=base_url()?>js/fileuploader.js" type="text/javascript"></script>
<script type="text/javascript">

    function createUploader(){
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '<?php echo site_url('upload/post');?>',
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
                    var html = '<div class="img"> <img src="<?=base_url()?>img/post/'+ file +'" alt="avatat" /> <a href="<?=site_url('upload/delete')?>/'+ file +'/post" class="avatar-hover ajax">&nbsp;</a> </div>';
                    $('#choice1file').val(file);
                    $('#upload-progressbar1').hide();
                    $('#upload-success1').show();
                    $('#upload-thumbnail1').html(html);
                    $('#upload-thumbnail1').show();
                    return true;
                }
            },

            onSubmit: function(id, fileName){
                $('#upload-main-button1').hide();
                $('#upload-success1 .file').text(fileName);
                //$('#upload-progressbar1 .progress-bar').text(fileName);
                $('#upload-progressbar1').show();
                return true;
            },
            onProgress: function(id, fileName, loaded, total){
                var percent = parseInt((loaded / total) * 100);
                $('#upload-progressbar1 .progress-bar').css('width', percent);
                $('#upload-progressbar1 .inner').css('width', percent);
                return true;
            }
        });


        var uploader2 = new qq.FileUploader({
            element: document.getElementById('file-uploader2'),
            action: '<?php echo site_url('upload/post');?>',
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
                    var html = '<div class="img"> <img src="<?=base_url()?>img/post/'+ file +'" alt="avatat" /> <a href="<?=site_url('upload/delete')?>/'+ file +'/post" class="avatar-hover ajax">&nbsp;</a> </div>';
                    $('#choice2file').val(file);
                    $('#upload-progressbar2').hide();
                    $('#upload-success2').show();
                    $('#upload-thumbnail2').html(html);
                    $('#upload-thumbnail2').show();
                    return true;
                }
            },

            onSubmit: function(id, fileName){
                $('#upload-main-button2').hide();
                $('#upload-success2 .file').text(fileName);
                //$('#upload-progressbar1 .progress-bar').text(fileName);
                $('#upload-progressbar2').show();
                return true;
            },
            onProgress: function(id, fileName, loaded, total){
                var percent = parseInt((loaded / total) * 100);
                $('#upload-progressbar2 .progress-bar').css('width', percent);
                $('#upload-progressbar2 .inner').css('width', percent);
                return true;
            }
        });
    }

    // in your app create uploader as soon as the DOM is ready
    // don't wait for the window to load
    $(document).ready(function(){
        createUploader();
        $('#upload-thumbnail1 .ajax').live('click', function(event){
            event.preventDefault();
            var url = $(this).attr('href');
            $.post(
                url,
                {},
                function(data){
                    if(data.status == 1)
                    {
                        $('#upload-progressbar1').hide();
                        $('#upload-success1').hide();
                        $('#upload-thumbnail1').hide();
                        $('#upload-main-button1').show();
                    }
                },
                'json'
            )
        });

        $('#upload-thumbnail2 .ajax').live('click', function(event){
            event.preventDefault();
            var url = $(this).attr('href');
            $.post(
                url,
                {},
                function(data){
                    if(data.status == 1)
                    {
                        $('#upload-progressbar2').hide();
                        $('#upload-success2').hide();
                        $('#upload-thumbnail2').hide();
                        $('#upload-main-button2').show();
                    }
                },
                'json'
            )
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.selectbox').sSelect();

        $('#decision-summary-counter').textCounter({
            target: '#decision-summary',
            count: 100,
            alertAt: 20,
            warnAt: 10,
            stopAtLimit: true
        });

        $('#decision-title-counter').textCounter({
            target: '#decision-title',
            count: 45,
            alertAt: 20,
            warnAt: 10,
            stopAtLimit: true
        });

        $('#choice-title-counter1').textCounter({
            target: '#choice-title1',
            count: 45,
            alertAt: 20,
            warnAt: 10,
            stopAtLimit: true
        });

        $('#choice-title-counter2').textCounter({
            target: '#choice-title2',
            count: 45,
            alertAt: 20,
            warnAt: 10,
            stopAtLimit: true
        });

    });
</script>