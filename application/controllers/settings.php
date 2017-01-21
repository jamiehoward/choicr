<?php
class Settings extends CI_Controller {

	public function index()
		{
				// Get user data
				$settingsID = $this->session->userdata('userID');
				$userInfoSQL = "SELECT * FROM `Users` WHERE dbUsrCnt = $settingsID;";
				$userInfoResults = $this->db->query($userInfoSQL);
				foreach ($userInfoResults->result() as $userInfo) {
					$data['settings_user'] = $userInfo->dbUsrName;
					$data['first_name'] = $userInfo->dbUsrFirstName;
					$data['last_name'] = $userInfo->dbUsrLastName;
					$data['email'] = $userInfo->dbUsrEmail;
					$data['gender'] = $userInfo->dbUsrGender;
					$data['profile_pic'] = $userInfo->dbUsrPic;
					$data['age_group'] = $userInfo->dbUsrAgeGroup;
					$data['timezone'] = $userInfo->dbUsrTimezone;
                    $data['picture'] = $userInfo->dbUsrPic;
                    $data['about'] = $userInfo->dbUsrAbout;
				}
				
				// Test valid data
				if ($data['settings_user'] == NULL || $settingsID < 1) {
					redirect('home', 'refresh');
				}
				else {
					// Load view
					$data['file_include'] = 'settings';
					$this->load->view('main', $data);
				}
			
		}
		
	public function submit() {
		// Get the form submissions
		$firstName = $this->input->post('first_name');
		$lastName = $this->input->post('last_name');
		$emailAddress = $this->input->post('email');
		$gender = $this->input->post('gender');
		$ageGroup = $this->input->post('age_group');
		$timeZone = $this->input->post('timezones');
        $about = $this->input->post('details');
		
		// Update the user's information
		$updateUserSQL = "UPDATE `Users` SET `dbUsrAbout` = ". $this->db->escape($about) .", `dbUsrFirstName` = " . $this->db->escape($firstName) . ", `dbUsrLastName` = ". $this->db->escape($lastName) . ", `dbUsrEmail` = " . $this->db->escape($emailAddress) . ", `dbUsrGender` = " . $this->db->escape($gender) . ", `dbUsrAgeGroup` = ". $this->db->escape($ageGroup) . ", `dbUsrTimezone` = " . $this->db->escape($timeZone) . " WHERE `dbUsrCnt` = " . $this->session->userdata('userID') . ";";
		
		if ($this->session->userdata('userID')) {
			$this->db->query($updateUserSQL);
			redirect('settings/index', 'refresh');
		}
		else {
			redirect('settings/index', 'refresh');
		}
	}
	
	public function image($type) {
		$this->load->library('upload_lib');
		$result = $this->upload_lib->do_upload($type);
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
}

/* End of file settings.php */
/* Location: application/controllers/settings.php */