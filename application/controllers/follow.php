<?php
class Follow extends CI_Controller {

	public function index() {
			redirect('follow/add');
	}
	
	public function add($follower = 0, $followed = 0, $ref = 'blank', $id = 0) {
		// $ref variable denotes type of follow. Posts are 1, users are 2
		// $id is the identifier where the follow was called from, maybe profile or vote page (either vote_u or vote_p) 
		// Weed out bad calls to the script:
		if ($follower == 0 || $followed == 0 || $ref == 'blank') {
			redirect('home', 'location');
		}
		else {
			// Verify that follow doesn't already exist (how did they get here?!)
			$alreadyFollowSQL = "SELECT * FROM `Follows` WHERE dbFollowerCnt  = " . $follower . " AND dbFollowedCnt = " . $followed . ";";
			$alreadyFollowResults = $this->db->query($alreadyFollowSQL);
			if ($alreadyFollowResults->num_rows() > 0) { // You shall not pass!
				redirect('home', 'location');
			}
			else {
				if ($ref == 'vote_u' || $ref == 'profile_u') {
					$folType = 2;
				} else {
					$folType = 1;
				}
				
				$addFollowSQL = "INSERT INTO `Follows` (dbFolType, dbFollowerCnt, dbFollowedCnt, dbBlock) VALUES ($folType, $follower, $followed, 0)";
				$this->db->query($addFollowSQL);
			}
		}
		
		if ($ref == 'vote_u') {
			$url = '/index.php/vote/decision/' . $id;
			redirect($url, 'location');
		} elseif ($ref == 'profile_u') {
			$url = '/index.php/profile/view/' . $id;
			redirect($url, 'location');
		}
		
	}
		
}

/* End of file follow.php */
/* Location: application/controllers/follow.php */