<?php
class Beta extends CI_Controller {

	public function index() {
		$this->load->view('splash');
	}
	
	public function login() {
		// Allow an un-logged in user to see this page
		$data['allow_access'] = 0;
		
		//Open form validation
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['file_include'] = 'beta_login';
			$this->load->view('main', $data);
		}
		else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			// Test to see if username exists
			$sql = "SELECT dbUsrCnt, dbUsrName, dbUsrPassword, dbUsrBlocked FROM `Users` WHERE dbUsrName = '" . $username . "';";
			$query = $this->db->query($sql);
				
			if ($query->num_rows() > 0)
				{
					foreach ($query->result() as $user)
					{
						//Make sure user is not blocked
						if ($user->dbUsrBlocked == 1) 
						{
							$data['file_include'] = 'beta_login';
							$data['error'] = 'We\'re sorry, but your account has been blocked. Please check your e-mail for more details.';
							$this->load->view('main', $data);
						}	
						//Check to see if password matches actual password in db
						elseif ($password == $user->dbUsrPassword) 					
						{
							$timestamp = date("Y-m-d H:i:s");
							$this->session->set_userdata('userID', $user->dbUsrCnt);
							$this->session->set_userdata('username', $user->dbUsrName);
							
							//Update last login timestamp
							$UpdateLoginSQL = "UPDATE Users SET dbLastLogin = '$timestamp' WHERE dbUsrCnt = '" . $user->dbUsrCnt . "';";
							$this->db->query($UpdateLoginSQL);
							
							//Send to home
							redirect('home/index/recent/1', 'refresh');
						}
						//Check to see if password matches SHA1 password in db
						elseif (sha1(sha1($password).sha1("chcPass@$#(%!")) == $user->dbUsrPassword)
						{
							$timestamp = date("Y-m-d H:i:s");
							$this->session->set_userdata('userID', $user->dbUsrCnt);
							$this->session->set_userdata('username', $user->dbUsrName);
							
							//Update last login timestamp
							$UpdateLoginSQL = "UPDATE Users SET dbLastLogin = '$timestamp' WHERE dbUsrCnt = '" . $user->dbUsrCnt . "';";
							$this->db->query($UpdateLoginSQL);
							
							//Send to home
							redirect('home/index/recent/1', 'refresh');
						}
						else //Wrong Password
						{
							$data['error'] = '<b>Sorry!</b> This password you entered is incorrect, please try again.';
							$data['file_include'] = 'beta_login';
							$this->load->view('main', $data); 
						}				
					}
				}
		}
	}
	
	public function tagteam() {
		// Verify that user is an admin
		if ($this->session->userdata('userID') == 1 || $this->session->userdata('userID') == 2) {

			$data['file_include'] = 'tagteam/dashboard';
			$this->load->view('main', $data);
		}
		else {
			redirect ('home');
		}
	}
	
	public function tagteamInvite() {
		// Verify that user is an admin
		if ($this->session->userdata('userID') == 1 || $this->session->userdata('userID') == 2) {
			$betaEmail = $this->input->post('email');
			$timestamp = date("Y-m-d H:i:s");
			$createInviteSQL = "INSERT INTO `Invites` (dbInviteCnt, dbInviterCnt, dbInviteeEmail, dbSentDate, dbAcceptDate) VALUES ('', ". $this->session->userdata('userID'). ", " . $this->db->escape($betaEmail) . ", '" . $timestamp . "', '');";
			$this->db->query($createInviteSQL);
			
			$flashdata = 'Email address: ' . $betaEmail . ' has been added to the inivite queue.';
			$this->session->set_flashdata('tagteam_message', $flashdata);
			redirect ('beta/tagteam');
		}
		else {
			redirect ('home');
		}
	}
}
