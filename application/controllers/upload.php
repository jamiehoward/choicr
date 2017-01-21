<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	function post()
	{
		$this->load->library('upload_lib');
		//Detecting if the image for profile or for post
		$type = 'post';
		$result = $this->upload_lib->do_upload($type);
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}

    function profile($userId)
    {
        $this->load->library('upload_lib');
        //Detecting if the image for profile or for post
        $type = 'profile';
        $result = $this->upload_lib->do_upload($type);
        if(isset($result['success']) && isset($result['file_name']))
        {
            $this->load->config('upload_config');

            $q = "select `dbUsrPic` from `Users` where `dbUsrCnt` = ?";
            $r = $this->db->query($q, $userId)->row();
            is_file($this->config->item('profile_140_path').$r->dbUsrPic)?unlink($this->config->item('profile_140_path').$r->dbUsrPic):'';
            is_file($this->config->item('profile_22_path').$r->dbUsrPic)?unlink($this->config->item('profile_22_path').$r->dbUsrPic):'';

            $q = "UPDATE `Users` SET `dbUsrPic` = ? WHERE `dbUsrCnt` = ?";
            $this->db->query($q, array($result['file_name'], $userId));
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

    function delete($filename, $type){
        $this->load->config('upload_config');
        if($type == 'profile')
        {
            $original_path = $this->config->item('profile_140_path');
            $thumb_path = $this->config->item('profile_22_path');
        }
        else
        {
            $original_path = $this->config->item('post_300_path');
            $thumb_path = $this->config->item('post_94_path');
        }

        if(unlink($original_path.'/'.$filename) && unlink($thumb_path.'/'.$filename))
            echo json_encode(array('status' => 1));
        else
            echo json_encode(array('status' => 0));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */