<?php

class upload_lib {
	
	private $_ci;
	
	function __construct()
	{
		$this->_ci = & get_instance();
	}
	
	function do_upload($type = 'profile')
	{
		require_once(APPPATH.'libraries/ajaxupload.php');
		
		$this->_ci->load->config('upload_config');
		$this->_ci->load->library('encryption');
		
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowed_extensions = $this->_ci->config->item('allowed_extension');
		
		// max file size in bytes
		$size_limit = $this->_ci->config->item('size_limit');
		
		// uploadpath
 		$temp_path = $this->_ci->config->item('temp_upload_path');
		if($type == 'profile')
		{
			$original_path = $this->_ci->config->item('profile_140_path');
			$thumb_path = $this->_ci->config->item('profile_22_path');
		}
		else
		{
			$original_path = $this->_ci->config->item('post_300_path');
			$thumb_path = $this->_ci->config->item('post_94_path');
		}
		
		//encrypted file name
		// Here time used() to avoid duplicate naming
		// If user amount is huge then we can add user_id in name too for more safety
		$file_name = $this->_ci->encryption->encrypt(time());
		
 		//ensure upload path exist:
		// if path not exists then create path 
 		if(! file_exists($temp_path) ) {
 			mkdir($temp_path);
 		}
		
 		
		$uploader = new qqFileUploader($allowed_extensions, $size_limit);
		$result = $uploader->handleUpload($temp_path,$file_name);
		if(isset($result['success']) && $result['success'] == true){
			$this->_ci->load->library('simple_image');
			if($type == 'profile')
			{
				$this->_ci->simple_image->square_crop($temp_path.$result['file_name'], $original_path.$result['file_name'], 140);
				$this->_ci->simple_image->square_crop($temp_path.$result['file_name'], $thumb_path.$result['file_name'], 22);
				// Here You can run your database operation for profile
				
				//
			}
			else
			{
				$this->_ci->simple_image->square_crop($temp_path.$result['file_name'], $original_path.$result['file_name'], 300);
				$this->_ci->simple_image->resize_to_width($temp_path.$result['file_name'], $thumb_path.$result['file_name'], 90);
				$this->_ci->simple_image->resize($thumb_path.$result['file_name'], $thumb_path.$result['file_name'], 90, 74);
				// Here you can run your database operation for posts
				
				//
			}
			
			// deleting from temp folder
			unlink($temp_path.$result['file_name']);
				
		}
		// to pass data through iframe you will need to encode all html tags
		return $result;
	}
}