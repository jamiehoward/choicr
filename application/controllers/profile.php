<?php
class Profile extends CI_Controller {

	public function index ()
	{
		redirect('view', 'refresh');
	}
	
	
	public function view($profile_id = 0, $profile_view = 'myfeed')
	{
		
		//Redirect if profile_id is invalid
		$check_user = $this->db->query("SELECT `dbUsrCnt` FROM `Users` WHERE `dbUsrCnt` = '$profile_id';");
		if ($check_user->num_rows() != 1)
			{
				redirect('/index.php/home/index/recent/1', 'refresh');
			}
		//Get profile information
		$profile_sql = "SELECT * FROM `Users` WHERE `dbUsrCnt` = '$profile_id';";
		$profile_results = $this->db->query($profile_sql);
		foreach ($profile_results->result() as $profile_info)
		{
			$data['profile_username'] = $profile_info->dbUsrName;
            $data['profile_picture'] = $profile_info->dbUsrPic;
		}
		//Variable assignment
		$votes_sql = $this->db->query("SELECT * FROM `Votes` WHERE `dbUsrCnt` = '$profile_id';");
		$data['total_votes'] = $votes_sql->num_rows();
		$userID = $this->session->userdata('userID');
		
		//Decide whether user and profile owner are same person
		if ($profile_id == $userID)
			{
				$data['profile_owner'] = 1;
			}
		else
			{
				$data['profile_owner'] = 0;
			}
		
		//Allow toggle of profile view
		if ($profile_view == 'myfeed')
			{
				$data['profile_view'] = 'myfeed';
			}
		else
			{
				$data['profile_view'] = 'followingfeed';
			}
		
		//Get number of comments posted by user
		$comment_sql = $this->db->query("SELECT `dbCommCnt` FROM `Comments` WHERE `dbUsrCnt` = '$profile_id';");
		$data['total_comments'] = $comment_sql->num_rows();
					
		//Get total number of decisions by the profile owner
		$decisions_sql = $this->db->query("SELECT `dbPostCnt` FROM `Posts` WHERE `dbUsrCnt` = '$profile_id';");
		$data['total_decisions'] = $decisions_sql->num_rows();
		
		//Get the number of decisions being followed
		$dec_fol_sql = $this->db->query("SELECT `dbFolCnt` FROM `Follows` WHERE `dbFollowerCnt` = '$profile_id' AND `dbFolType` = 1;");
		$data['total_decisions_following'] = $dec_fol_sql->num_rows();
		
		//Get the number of users this user is following
		$users_fol_sql = $this->db->query("SELECT `dbFolCnt` FROM `Follows` WHERE `dbFollowerCnt` = '$profile_id' AND `dbFolType` = 2;");
		$data['total_following'] = $users_fol_sql->num_rows();
		
		//Get the number of users following this user
		$users_fol_sql = $this->db->query("SELECT `dbFolCnt` FROM `Follows` WHERE `dbFollowedCnt` = '$profile_id' AND `dbFolType` = 2;");
		$data['total_followers'] = $users_fol_sql->num_rows();
		
		//Get the number of follow-ups posted by this user
		$followup_sql = "SELECT * FROM `Follow_up` WHERE `dbUsrCnt` = " . $profile_id . ";";
		$followup_results = $this->db->query($followup_sql);
		$data['follow_ups'] = $followup_results->num_rows();
		
		//Determine whether user is following profile owner
		if ($data['profile_owner'] == 0)
			{
				$following_sql = $this->db->query("SELECT `dbFolCnt` FROM `Follows` WHERE `dbFolType` = 2 AND `dbFollowerCnt` = '$userID' AND `dbFollowedCnt` = '$profile_id';");
				$following_count = $following_sql->num_rows();
				if ($following_count > 0)
					{
						$data['following'] = 1;
					}
			}
			
		//Get the count and information for badges
		$badge_sql = "SELECT * FROM `BadgeDetail` WHERE `dbBadgeCnt` IN (SELECT `dbBdgID` FROM `Badges` WHERE `dbUsrCnt` = '$profile_id')";
		$badge_info = $this->db->query($badge_sql);

		//Load recent decisions
		$data['ref'] = 'p_recent';
		$PostSQL = "SELECT * FROM Posts WHERE dbBlock = 0 AND dbUsrCnt = " . $profile_id;
		$PostSQL .= " ORDER BY dbAddDate DESC LIMIT 0, 15";		
			
		//Load view
		$data['post_sql'] = $PostSQL;
		$data['file_include'] = 'profile';
		$data['profile_id'] = $profile_id;
		$this->load->view('main', $data);
	}
}
