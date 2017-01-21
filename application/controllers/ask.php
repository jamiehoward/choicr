<?php
class Ask extends CI_Controller {

	public function index()
		{
			//Enable caching
			//$this->output->cache(30);
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			//Open form validation and set rules
			$this->form_validation->set_rules('title', 'title', 'trim|required|min_length[3]|max_length[45]');
			$this->form_validation->set_rules('details', 'details', 'trim|required|min_length[3]|max_length[300]');
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_rules('choice1desc', 'choice one', 'trim|max_length[300]|required');
			$this->form_validation->set_rules('choice2desc', 'choice two', 'trim|max_length[300]|required');
			$this->form_validation->set_rules('expdate', 'expiration date', 'required');
			$this->form_validation->set_rules('exptime', 'expiration time', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				//Build category list
				$sql = "SELECT dbCatCnt, dbCatName FROM Categories ORDER BY dbCatName ASC";
				$data['catQuery'] = $this->db->query($sql);	
				
				// Load view
				$data['file_include'] = 'ask';
				$this->load->view('main', $data);
			}
			else
			{
				//Assign variables pulled from previous form
				$userID = $this->session->userdata('userID');
				$timestamp = date("Y-m-d H:i:s");
				$DecisionTitle = $this->input->post('title');
				$DecisionDesc = $this->input->post('details');
				if ($this->input->post('choice1desc'))
				{
					$Choice1Desc = $this->input->post('choice1desc');
				}
				if ($this->input->post('choice2desc'))
				{
					$Choice2Desc = $this->input->post('choice2desc');
				}
				$Category = $this->input->post('category');
				$expdate = $this->input->post('expdate');
				$exptime = $this->input->post('exptime');
				$private = 0;
				$newFileName1 = $this->input->post('choice1file');
				$newFileName2 = $this->input->post('choice2file');

				//Default action is set to allow decision to be created:
				$AllowSQL = 1;
				
				//Build the expiration date
				$expdatetime = $expdate . " " . $exptime;
				$expdatestamp = strtotime($expdatetime);
				$ExpDate = date("Y-m-d H:i:s", $expdatestamp);

				//We are using a control number to "grab" the counter so that simultaneous decisions will not hi-jack each other.
				$controlSQL = "SELECT `dbCtrlNumber` FROM `Choices` ORDER BY `dbCtrlNumber` DESC LIMIT 1";
				$controlQuery = $this->db->query($controlSQL);
				foreach ($controlQuery->result() as $control)
					{
					$dbCtrlNumber1 = $control->dbCtrlNumber + 1;
					$dbCtrlNumber2 = $dbCtrlNumber1 + 1;
					}


				//Insert both choices into the database
				$Choice1SQL = "INSERT INTO `Choices` (`dbChcCnt`, `dbCtrlNumber`, `dbUsrCnt`, `dbChcTitle`, `dbChcDesc`, `dbChcPic`, `dbAddDate`, `dbModDate`) VALUES ('', '$dbCtrlNumber1', '$userID', 'Default', ".$this->db->escape($Choice1Desc).", '$newFileName1', '$timestamp', 'NULL')";

				$Choice2SQL = "INSERT INTO `Choices` (`dbChcCnt`, `dbCtrlNumber`, `dbUsrCnt`, `dbChcTitle`, `dbChcDesc`, `dbChcPic`, `dbAddDate`, `dbModDate`) VALUES ('', '$dbCtrlNumber2', '$userID', 'Default', ".$this->db->escape($Choice2Desc).", '$newFileName2', '$timestamp', 'NULL')";

				$this->db->query($Choice1SQL);
				$this->db->query($Choice2SQL);

				//Build decision (post) query
				$Chc1SQL = "SELECT dbChcCnt FROM `Choices` WHERE `dbCtrlNumber` = $dbCtrlNumber1";
				$Chc1Query = $this->db->query($Chc1SQL);
				foreach ($Chc1Query->result() as $choice)
					{
					$choice1 = $choice->dbChcCnt;
					}
				$Chc2SQL = "SELECT dbChcCnt FROM `Choices` WHERE `dbCtrlNumber` = $dbCtrlNumber2";
				$Chc2Query = $this->db->query($Chc2SQL);
				foreach ($Chc2Query->result() as $choice)
					{
					$choice2 = $choice->dbChcCnt;
					}

				//Insert the decision into the database
				$PostSQL = "INSERT INTO `Posts` (`dbPostCnt`, `dbUsrCnt`, `dbPostTitle`, `dbChc1Cnt`, `dbChc2Cnt`, `dbChc1Votes`, `dbChc2Votes`, `dbPostDesc`, `dbCatCnt`, `dbOutcome`, `dbAddDate`, `dbModDate`, `dbExpDate`, `dbPrivate`, `dbFlagged`, `dbFlagDate`, `dbBlock`, `dbClearVotes`) VALUES ('', '$userID', ".$this->db->escape($DecisionTitle).", '$choice1', '$choice2', NULL, NULL, ".$this->db->escape($DecisionDesc).", '$Category', NULL, '$timestamp', NULL, '$ExpDate', '$private', '0', NULL, '0', '1')";
				
				$this->db->query($PostSQL);

				//Build notification message to send user back to their created decision
				$GetPostSQL = "SELECT dbPostCnt FROM Posts WHERE dbUsrCnt = '$userID' AND dbChc1Cnt = '$choice1' AND dbChc2Cnt = '$choice2'";
				$GetPostQuery = $this->db->query($GetPostSQL);
				foreach ($GetPostQuery->result() as $getpost)
					{
					if ($getpost->dbPostCnt)
						{
						//Log decision creation in Activity table 
						$ActivitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$userID', 1, '" . $getpost->dbPostCnt . "', NULL, '$timestamp')";
						$this->db->query($ActivitySQL);
						
						//Set flash data for notification
						$this->session->set_flashdata('new_post', $getpost->dbPostCnt);
						$this->session->set_flashdata('ref', 'ask');
						redirect('home/index/recent/1', 'refresh'); 
						}
					else
						{
						redirect('home/index/recent/1', 'refresh'); 
						}
					}
			}
			
		}
}

/* End of file ask.php */
/* Location: application/controllers/ask.php */