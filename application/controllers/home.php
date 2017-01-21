<?php
class Home extends CI_Controller {

	public function index($sort = 'recent', $page = 1)
	{
        $this->load->model('choice_model');
		
		//AJAX Check
		//Check for unsent invites
		$UnsentInviteSQL = "SELECT * FROM Invites WHERE dbInviterCnt = '" . $this->session->userdata('userID') . "' AND dbSentDate IS NULL";
		$UnsentInviteResults = $this->db->query($UnsentInviteSQL);
		if ($UnsentInviteResults->num_rows() > 0)
		{
			//Include notice of unsent invites
		}
		//Errors
		//Notifications
		//Initialize list of decisions
		if (!isset($sort)) { $sort = 'recent'; }
		$NumberofPosts = 15;
		if (!isset($page)) {	$RecordStart = 0; }
		else  
		{
			$RecordStart = ($page * 15 - 15);
		}
		
		//Build SQL query based upon list
		if ($sort == 'recent')
		{
			$data['ref'] = 'b_recent';
			$data['sortTitle'] = 'Blender! | Sorting by the most recent';
			$PostSQL = "SELECT * FROM Posts WHERE dbExpDate > NOW() AND dbBlock = 0";
			$PostSQL .= " ORDER BY dbAddDate DESC";
		}
		elseif ($sort == 'comments')
		{
			$data['ref'] = "b_comments";
			$data['sortTitle'] = 'Blender! | Sorting by the most comments';
			$PostSQL = "SELECT * FROM Posts p LEFT OUTER JOIN 
			(SELECT c.dbIDCnt, c.dbIDGroup, COUNT(*) AS comment_count 
			FROM Comments c WHERE c.dbIDGroup = 1 GROUP BY c.dbIDCnt ) agg
			ON p.dbPostCnt = agg.dbIDCnt 
			WHERE p.dbExpDate > Now() AND p.dbBlock = 0";
			$PostSQL .= " ORDER BY agg.comment_count DESC";
		}
		elseif ($PostSort == 'expiring')
		{
			$data['ref'] = 'b_expiring';
			$data['sortTitle'] = 'Blender! | Sorting by expiring soonest';
			$PostSQL = "SELECT * FROM Posts LEFT JOIN Users ON Posts.dbUsrCnt = Users.dbUsrCnt WHERE Posts.dbExpDate > NOW() AND Posts.dbBlock = 0";
			$PostSQL .= " ORDER BY Posts.dbExpDate ASC";
		}
		else
		{
			$data['ref'] = 'b_votes';
			$SortTitle = 'Blender! | Sorting by the most votes';
			$PostSQL = "SELECT p.*, COUNT(v.dbPostCnt) AS numvotes 
				FROM Posts AS p LEFT JOIN Votes AS v
				ON p.dbPostCnt= v.dbPostCnt	INNER JOIN (
				SELECT p2.dbPostCnt AS dbPostCnt, COUNT(v2.dbPostCnt) AS numvotes
				FROM Posts AS p2 LEFT JOIN Votes AS v2
				ON p2.dbPostCnt=v2.dbPostCnt
				GROUP BY p2.dbPostCnt) AS x ON x.dbPostCnt=p.dbPostCnt
				WHERE p.dbExpDate > Now() AND p.dbBlock = 0";
			$PostSQL .= " GROUP BY p.dbPostCnt ORDER BY x.numvotes DESC";
		}
		
		
		
		//Send results to view
		$data['NumberofPosts'] = $NumberofPosts;
		$data['RecordStart'] = $RecordStart;
		$data['place'] = -1;
		$data['sort'] = $sort;
		$data['post_sql'] = $PostSQL;


		
		//Load view
		$data['file_include'] = 'home';
		$this->load->view('main', $data);
	}

}
	
/* End of file home.php */
/* Location: application/controllers/home.php */