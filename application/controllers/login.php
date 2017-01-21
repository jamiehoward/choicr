<?php
class Login extends CI_Controller {

	public function index()
	{
		//Verify that user isn't already logged in
        if ($this->session->userdata('userID'))
        {
            redirect('home', 'refresh');
        }

        //Configure form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]|max_length[30]|xss_clean');

        //If above validation is not met, then send back to login page with errors
        if ($this->form_validation->run() == FALSE)
        {
            redirect(base_url());
        }
        else
        {
			$allowLogin = FALSE;
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //Encrypt password to test
            //$password_enc = sha1(sha1($password).sha1("chcPass@$#(%!"));

            $checkUserSQL = "SELECT * FROM `Users` WHERE `dbUsrName` = " . $this->db->escape($username) . ";";
            $checkUser = $this->db->query($checkUserSQL);
			if ($checkUser->num_rows() > 0) {
				foreach ($checkUser->result() as $user)
				{	
					$salt = 'chcPass@$#(%!';
					$loginFix = $this->db->get_where('Login_fixes', array('user_id' => $user->dbUsrCnt));
					if ($loginFix->num_rows() > 0 ) {
						// If user has completed the login fix process, log them in normally (checking credentials)
						if ($user->dbUsrPassword == md5($salt . $password)) {
							$allowLogin = TRUE;
						} else {
							$allowLogin = FALSE;
						}
					} else {
						// Else, let them log in and start the process
						
						$data = array(
							'user_id' => $user->dbUsrCnt,
							'ip_address' => $_SERVER['REMOTE_ADDR'],
							'password' => md5($salt . $password),
							'date' => date("Y-m-d H:i:s")
						);
						
						$this->db->insert('Login_fixes', $data);
						
						// Update the user's password
						$userData = array(
							'dbUsrPassword' => md5($salt.$password)
						);
						
						$this->db->where('dbUsrCnt', $user->dbUsrCnt);
						$this->db->update('Users', $userData);
						// Finally, allow login
						$allowLogin = TRUE; 
					}
					//Check to see if user is blocked
					if ($user->dbUsrBlocked == 1) {
						$allowLogin = FALSE;
					}
					
					//If no errors, login user
					if ($allowLogin == TRUE) {
						//Update last login information for the user
						$timestamp = date("Y-m-d H:i:s");
						$updateLoginSQL = "UPDATE `Users` SET `dbLastLogin` = '$timestamp' WHERE `dbUsrCnt` = " . $user->dbUsrCnt . ";";
						$this->db->query($updateLoginSQL);
	
						//Set the session data for the user
						$this->session->set_userdata('userID', $user->dbUsrCnt);
	
						redirect('home');
					}
					else {
						redirect ('/');
					}
				}
			} else {
				redirect('/');
			}
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
?>