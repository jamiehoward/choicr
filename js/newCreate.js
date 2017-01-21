$(function() {

	$('.createChoiceContent').hide();
	$('#thumbnails1').hide();
	$('#thumbnails2').hide();
	
	$('.expander').click(function() {
		if($(this).parent().parent().children('.createChoiceContent').is(":visible")) {
			$(this).parent().parent().children('.createChoiceContent').slideUp('fast');
			$(this).text('+');
		} else {
			$(this).parent().parent().children('.createChoiceContent').slideDown('fast');
			$(this).text('-');
		}
		return false;
	});
	
	$('#DecisionTitle').focus();
	
	var d = new Date();
	var min = d.getTime()+3600000;
	var max = d.getTime()+1209600000;
	var minInt = Math.ceil(min/900000)*900000;
	var maxInt = Math.ceil(max/900000)*900000;
	var dmin = new Date(minInt);
	var dmax = new Date(maxInt);
	
	$("#createExpireDatetime").datetimepicker({
		ampm: true,
		stepHour: 1,
		stepMinute: 15,
		minDate: dmin,
		maxDate: dmax
	});
	
	$('.newCreateTable:not(:first)').hide();
	
	$('#DecisionTitle').bind('keyup mouseup', function() {
		if($(this).val().length>=2) {
			$(this).parent().parent().next().slideDown('fast');
		}
	});
	
	$('#details').bind('keyup mouseup', function() {
		if($(this).val().length>=2) {
			$(this).parent().parent().next().slideDown('fast');
		}
	});
	
	$('#Category').bind('change', function() {
		if($(this).val()!='') {
			$(this).parent().parent().next().slideDown('fast');
		}
	});
	
	$('#createChoice1Description').bind('keyup mouseup', function() {
		if($(this).val().length>0) {
			$('#createChoice1Label').text($(this).val());
		} else {
			$('#createChoice1Label').text('Choice 1');
		}
		if($(this).val().length>=2) {
			$(this).parent().parent().parent().parent().parent().next().slideDown('fast');
		}
	});
	
	$('#createChoice2Description').bind('keyup mouseup', function() {
		if($(this).val().length>0) {
			$('#createChoice2Label').text($(this).val());
		} else {
			$('#createChoice2Label').text('Choice 2');
		}
		if($(this).val().length>=2) {
			$(this).parent().parent().parent().parent().parent().next().slideDown('fast');
		}
		$('#createChoice1').children('.createChoiceContent').slideUp('fast');
		$('#createChoice1').children('.createChoiceLabel').children('.expander').text('+');
		$('#createChoice1Label').css({bottom: '10px', right: '10px'});
		$('#thumbnails1').fadeIn('slow');
	});
	
	
	$('#createExpireDatetime').bind('keyup mouseup', function() {
		if($(this).val().length>=2) {
			$(this).parent().parent().next().slideDown('fast');
			$(this).parent().parent().next().next().slideDown('fast');
		}
	});
	
	$('#ui-datepicker-div').bind('click blur', function() {
		if($('#createExpireDatetime').val().length>=2) {
			$('#createExpireDatetime').parent().parent().next().slideDown('fast');
			$('#createExpireDatetime').parent().parent().next().next().slideDown('fast');
		}
		$('#createChoice2').children('.createChoiceContent').slideUp('fast');
		$('#createChoice2').children('.createChoiceLabel').children('.expander').text('+');
		$('#createChoice2Label').css({bottom: '10px', right: '10px'});
		$('#thumbnails2').fadeIn('slow');
	});
	

	$('#swfUploadControl1').swfupload({
        // Backend Settings
        upload_url: "createUpload.php", // Relative to the SWF file
        
        // File Upload Settings
        file_size_limit : "2048", // 2MB
        file_types : "*.jpg", //JPGs only
        file_types_description : "All Files",
        file_upload_limit : "10",
        file_queue_limit : "0",
    
        // Button Settings
		button_placeholder_id : "spanButtonPlaceholder1",
		button_width: 100,
		button_height: 100,
		button_text : '<span class="button">Replace?</span>',
		button_text_style : '.button { text-align: center; }',
		button_text_top_padding: 60,
		button_text_left_padding: 0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,
        
        // Flash Settings
        flash_url : "../js/swfUpload/swfupload.swf"
        
    });
    
    
    // assign our event handlers
    $('#swfUploadControl1')
        .bind('fileQueued', function(event, file){
            // start the upload once a file is queued
            $(this).swfupload('startUpload');
        })
        .bind('uploadComplete', function(event, file){
            alert('Upload completed - '+file.name+'!');
            // start the upload (if more queued) once an upload is complete
            $(this).swfupload('startUpload');
        });
		
 $('#swfUploadControl2').swfupload({
        // Backend Settings
        upload_url: "createUpload.php", // Relative to the SWF file
        
        // File Upload Settings
        file_size_limit : "2048", // 2MB
        file_types : "*.jpg", //JPGs only
        file_types_description : "All Files",
        file_upload_limit : "10",
        file_queue_limit : "0",
    
        // Button Settings
		button_placeholder_id : "spanButtonPlaceholder2",
		button_width: 100,
		button_height: 100,
		button_text : '<span class="button">Replace?</span>',
		button_text_style : '.button { text-align: center; }',
		button_text_top_padding: 60,
		button_text_left_padding: 0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,
        
        // Flash Settings
        flash_url : "../js/swfUpload/swfupload.swf"
        
    });
    
    
    // assign our event handlers
    $('#swfUploadControl2')
        .bind('fileQueued', function(event, file){
            // start the upload once a file is queued
            $(this).swfupload('startUpload');
        })
        .bind('uploadComplete', function(event, file){
            alert('Upload completed - '+file.name+'!');
            // start the upload (if more queued) once an upload is complete
            $(this).swfupload('startUpload');
        });
	
	});



/*

			var swfu, swfub;

			window.onload = function () {

				swfu = new SWFUpload({

					// Backend Settings

					upload_url: "createUpload.php",

					post_params: {"PHPSESSID": "taiu1ftbqjpr4atpm4puaf4nb4"},



					// File Upload Settings

					file_size_limit : "2 MB",	// 2MB

					file_types : "*.jpg",

					file_types_description : "JPG Images",

					file_upload_limit : "0",



					// Event Handler Settings - these functions as defined in Handlers.js

					//  The handlers are not part of SWFUpload but are part of my website and control how

					//  my website reacts to the SWFUpload events.

					file_queue_error_handler : fileQueueError,

					file_dialog_complete_handler : fileDialogComplete,

					upload_progress_handler : uploadProgress,

					upload_error_handler : uploadError,

					upload_success_handler : uploadSuccess,

					upload_complete_handler : uploadComplete,



					// Button Settings

					button_placeholder_id : "spanButtonPlaceholder1",

					button_width: 50,

					button_height: 50,

					button_text : '<span class="button">Replace?</span>',

					button_text_style : '.button { text-align: center; }',

					button_text_top_padding: 30,

					button_text_left_padding: 0,

					button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,

					button_cursor: SWFUpload.CURSOR.HAND,



					// Flash Settings

					flash_url : "../js/swfUpload/swfupload.swf",



					custom_settings : {

						upload_target : "divFileProgressContainer1"

					},



					// Debug Settings

					debug: false

				});

				swfub = new SWFUpload({

					// Backend Settings

					upload_url: "createUpload.php",

					post_params: {"PHPSESSID": "taiu1ftbqjpr4atpm4puaf4nb4"},



					// File Upload Settings

					file_size_limit : "2 MB",	// 2MB

					file_types : "*.jpg",

					file_types_description : "JPG Images",

					file_upload_limit : "0",



					// Event Handler Settings - these functions as defined in Handlers.js

					//  The handlers are not part of SWFUpload but are part of my website and control how

					//  my website reacts to the SWFUpload events.

					file_queue_error_handler : fileQueueError,

					file_dialog_complete_handler : fileDialogComplete,

					upload_progress_handler : uploadProgress,

					upload_error_handler : uploadError,

					upload_success_handler : uploadSuccess,

					upload_complete_handler : uploadComplete,



					// Button Settings

					button_placeholder_id : "spanButtonPlaceholder2",

					button_width: 50,

					button_height: 50,

					button_text : '<span class="button">Replace?</span>',

					button_text_style : '.button { text-align: center; }',

					button_text_top_padding: 30,

					button_text_left_padding: 0,

					button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,

					button_cursor: SWFUpload.CURSOR.HAND,



					// Flash Settings

					flash_url : "../js/swfUpload/swfupload.swf",



					custom_settings : {

						upload_target : "divFileProgressContainer2"

					},



					// Debug Settings

					debug: false

				});

			};
*/