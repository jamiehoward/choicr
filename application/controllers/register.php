<?php
class Register extends CI_Controller {

	public function index()
	{
		redirect(base_url());
    }
	
	public function beta($beta_email = 0)
    {
		// Reverse formatting of e-mail address
		$safeEmail = $beta_email;
		$beta_email = str_replace('%40','@',$safeEmail);
			
		// Verify that user isn't already logged in
        if ($this->session->userdata('userID'))
        {
            //redirect('home', 'refresh');
			echo $this->session->userdata('userID');
        }

        // Configure form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('password_conf','Password confirmation','trim|required|min_length[3]|max_length[25]|xss_clean|matches[password]');
		$this->form_validation->set_rules('email','E-mail address','trim|required|min_length[3]|max_length[40]|xss_clean|valid_email');

        // If above validation is not met, then send back to login page with errors
        if ($this->form_validation->run() == FALSE) {
			if ($beta_email != 0) {
				$data['beta_email'] = $beta_email;
			}
			$this->load->view('register');
        }
        else {
			// Get and define form variables
			$username = $this->input->post('username');
            $password = $this->input->post('password');
			$email = $this->input->post('email');
			$gender = $this->input->post('gender');
			$age_group = $this->input->post('age_group');
			$timestamp = date("Y-m-d H:i:s");
			
			// Start out allowing registration
			$registerUser = TRUE;
			
			// test that username isn't already taken
			$testUsernameSQL = "SELECT * FROM `Users` WHERE `dbUsrName` = " . $this->db->escape($username) . ";";
			$testUsernameResults = $this->db->query($testUsernameSQL); 
			if ($testUsernameResults->num_rows() > 0) {
				// username is already taken
				$data['error'] = "Username is already taken.";
				$registerUser = FALSE;
			}
			// Check e-mail has not been used
			$query = "SELECT * FROM `Users` WHERE `dbUsrEmail` = " . $this->db->escape($email) . ";";
			$results = $this->db->query($query); 
			if ($results->num_rows() > 0) {
				// username is already taken
				$data['error'] = "This e-mail address has already claimed its beta invite.";
				$registerUser = FALSE;
			}
			
			//test that the e-mail is on the beta users list
			/*if (!$this->checkBetaEmail($email)) {
				$registerUser = FALSE;
				$data['error'] = "Sorry! You have not been given beta access!";
			}*/
			
			
			// Properly format password by escaping and then encrypting
			$password = $this->db->escape($password);
			$salt = 'chcPass@$#(%!';
			$password = md5($salt . $password);
			
			// If no errors, register user
			if ($registerUser == TRUE) {
				$registerUserSQL = "INSERT INTO `Users` (`dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrGender`, `dbUsrAgeGroup`, `dbAddDate`) VALUES (" . $this->db->escape($username) .  ", '$password', " . $this->db->escape($email) . ", '$gender', '$age_group', '$timestamp');";
				$this->db->query($registerUserSQL);
				
			// Automatically log in the user
			$getUserSQL = "SELECT * FROM `Users` WHERE dbUsrName = " . $this->db->escape($username) . ";";
			$getUserResults = $this->db->query($getUserSQL);
				foreach ($getUserResults->result() as $getUser) {
					$timestamp = date("Y-m-d H:i:s");
					$updateLoginSQL = "UPDATE `Users` SET `dbLastLogin` = '$timestamp' WHERE `dbUsrCnt` = " . $getUser->dbUsrCnt . ";";
					$this->db->query($updateLoginSQL);
	
					//Set the session data for the user
					$this->session->set_userdata('userID', $getUser->dbUsrCnt);
	
					redirect('home');
				}
			}
			else {
				// Send back to registration form
				$this->load->view('register', $data);
			}
		}
    }
    
    public function importEmails ($secret = NULL) {
	    if ($secret == 'tagteam') {
	    	// validate a bit
	    	if ($_FILES['file']['type'] != 'text/csv' || $_FILES['file']['type'] != 0) {
		    	die('Upload failed. Error and client information have been logged; admin have been notified of this attempt.');
	    	}
		    // Parse the file
			$fileName = $_FILES['file']['tmp_name'];
			$listOfEmails = array();
			
			if (($handle = fopen($fileName, "r")) !== FALSE) {
				$row = 1;
			    while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
			        if ($row == 1) {
			            // Get the column concerning e-mail
			            $emailWording = array('EMAIL', 'E-MAIL', 'E - MAIL', 'EMAIL ADDRESS', 'E-MAIL ADDRESS', 'E-MAIL ADDRESSES', 'EMAIL ADDRESSES');
			            
			            // Test each column name to find e-mail column
			            foreach($data as $key => $column) {
			                //die(strtoupper($column));
			                // Check to see if there is an 
			                if (in_array(strtoupper($column) , $emailWording)) {
			                    //If found, set $emailColumnNumber
			                    $emailColumnNumber = $key;
			                    break;
			                }
			            }
			            
			            // Error out if no e-mail column found
			            if (!isset($emailColumnNumber)) {
			               die('No e-mail column found');
			            }
			
			        } elseif ($row > 1) { //Exclude the header
			        	// Verify the e-mail address is legit
			        	if (empty($data[$emailColumnNumber])) {
			                die('Email address is blank');
			            }
			
			        	$listOfEmails[] = $data[$emailColumnNumber];
			        }
			        $row++;
			    }
			    
			    echo "<pre>";
			    echo "array(";
			    foreach ($listOfEmails as $key => $email) {
			    	echo $key . " => '" . $email . "', ";
			    }
			   } else {
			   die('error');
			   }

	    } else {
		    $this->load->view('tagteam/import_emails');
	    }
    }
	
	public function check_email_address($email) {
	  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	  if (preg_match($regex, $email)) {
	    return TRUE;
	  } else {
	    return FALSE;
	  }
	}
	
	
	public function checkBetaEmail ($email = NULL) {
		if (!is_null($email)) {
			$betaEmailAddresses = array('test@choicr.com');
			if (in_array($email, $betaEmailAddresses)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
?>