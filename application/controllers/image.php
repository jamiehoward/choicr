<?php

class Image extends CI_Controller {
	
	public function index () {
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = '../img/profile/default.jpg';
	$config['new_image'] = '../img/profile/thumbs/default.jpg';
	$config['create_thumb'] = TRUE;
	$config['width'] = 40;
	$config['height'] = 40;

	$this->load->library('image_lib', $config);
	$this->image_lib->resize();
	} 
	
}