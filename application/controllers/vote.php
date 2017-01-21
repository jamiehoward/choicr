<?php
class Vote extends CI_Controller {

	public function index()
	{
			redirect('vote/decision', 'refresh');
	}
	public function decision($post = 0, $ref = 'blank', $place = 1)
	{
		//Verify decision counter is valid
		if ($post < 1 || $post == NULL)
		{
			redirect('home', 'refresh');
		}
		
		//Get decision information
		$PostSQL = "SELECT * FROM Posts WHERE dbPostCnt = '$post';";
		$PostResults = $this->db->query($PostSQL);
		foreach ($PostResults->result() as $post_info)
		{
			//Get category information
			$CategorySQL = "SELECT * FROM Categories WHERE dbCatCnt = " . $post_info->dbCatCnt . ";";
			$CategoryResults = $this->db->query($CategorySQL);
			foreach ($CategoryResults->result() as $category)
			{
				$data['category'] = $category->dbCatCnt;
				$data['category_name'] = strtoupper($category->dbCatName);
			}
			
			//Correct title length issues
			$data['decision_title'] = $post_info->dbPostTitle;
			if (strlen($post_info->dbPostTitle) > 48)
			{
				$subs_title = substr($post_info->dbPostTitle, 0,48);
				$subs_title = $subs_title . "<br /> ...";
				$data['decision_title'] = $post_info->dbPostTitle;
			}
			
			
			//Get first choice's information
			$Choice1SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc1Cnt FROM Posts WHERE dbPostCnt = '$post')";
			$Choice1Results = $this->db->query($Choice1SQL);
			foreach ($Choice1Results->result() as $choice_one)
			{
				//Correct title length issues
				$data['choice1_title'] = $choice_one->dbChcDesc;
                $data['choice1_pic'] = $choice_one->dbChcPic;
				if (strlen($choice_one->dbChcDesc) > 48)
				{
					$substext = $choice_one->dbChcDesc." ";
					$substext = substr($choice_one->dbChcDesc,0,48);
					$substext = substr($substext,0,strrpos($substext,' '));
					$Choice1Title = $substext;
					$data['choice1_title'] = $Choice1Title;
				}
				
				//Get votes
				$C1VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$post' AND dbChcVote = 0";
				$C1VotesResult = $this->db->query($C1VotesSQL);	
				$C1VotesCount = $C1VotesResult->num_rows();
				
				
				$data['choice1_votes'] = $C1VotesCount;
			}
			
			//Get second choice's information
			$Choice2SQL = "SELECT * FROM Choices WHERE dbChcCnt IN (SELECT dbChc2Cnt FROM Posts WHERE dbPostCnt = '$post')";
			$Choice2Results = $this->db->query($Choice2SQL);
			foreach ($Choice2Results->result() as $choice_two)
			{
				//Correct title length issues
				$data['choice2_title'] = $choice_two->dbChcDesc;
                $data['choice2_pic'] = $choice_two->dbChcPic;
				if (strlen($choice_two->dbChcDesc) > 48)
				{
					$substext = $choice_two->dbChcDesc." ";
					$substext = substr($choice_two->dbChcDesc,0,48);
					$substext = substr($substext,0,strrpos($substext,' '));
					$Choice2Title = $substext;
					$data['choice2_title'] = $Choice2Title;
				}
				
				//Get votes
				$C2VotesSQL = "SELECT * FROM Votes WHERE dbPostCnt = '$post' AND dbChcVote = 1";
				$C2VotesResult = $this->db->query($C2VotesSQL);	
				$C2VotesCount = $C2VotesResult->num_rows();
								
				$data['choice2_votes'] = $C2VotesCount;
			}
			
			if ($data['choice1_votes'] > $data['choice2_votes']) {
				$data['winning_choice'] = $data['choice1_title'];
			}
			elseif ($data['choice2_votes'] > $data['choice1_votes']) {
				$data['winning_choice'] = $data['choice2_title'] ;
			}
			else {
				$data['winning_choice'] = "Tied";
			}
			
			//Get decision author's information
			$AuthorSQL = "SELECT * FROM Users WHERE dbUsrCnt IN (SELECT dbUsrCnt FROM Posts WHERE dbPostCnt = '$post')";
			$AuthorResults = $this->db->query($AuthorSQL);
			foreach ($AuthorResults->result() as $author)
			{
				$data['author'] = $author->dbUsrCnt;
				$data['author_name'] = $author->dbUsrName;
                $data['author_pic'] = $author->dbUsrPic;
				
				//Get follower information
				$FollowersSQL = "SELECT * FROM Follows WHERE dbFollowedCnt = " . $author->dbUsrCnt . " AND dbFolType = 2;";
				$FollowersResult = $this->db->query($FollowersSQL); 
				$data['author_followers'] = $FollowersResult->num_rows();
				
				//Get following information
				$FollowingSQL = "SELECT * FROM Follows WHERE dbFollowerCnt = " . $author->dbUsrCnt . " AND dbFolType = 2;";
				$FollowingResults = $this->db->query($FollowingSQL);
				$data['author_following'] = $FollowingResults->num_rows();
				
				//TODO:Check if user is following author
			}

			//Get list of comments
			$CommentSQL = "SELECT * FROM `Comments` WHERE `dbIDGroup` = 1 AND `dbIDCnt` = '$post' ORDER BY `dbAddDate` DESC";
			$CommentResults = $this->db->query($CommentSQL);
			$data['total_comments'] = $CommentResults->num_rows();
			
			//See if user has already voted and get that vote
			$checkVoteSQL = "SELECT * FROM `Votes` WHERE `dbPostCnt` = '$post' AND `dbUsrCnt` = " . $this->session->userdata('userID') . ";";
			$checkVoteResult = $this->db->query($checkVoteSQL);
			$checkVote = $checkVoteResult->num_rows();
			if ($checkVote > 0) {
				foreach ($checkVoteResult->result() as $choiceVote) {
					$alreadyVoted = $choiceVote->dbChcVote; 
				}
			}

		}
		
		//Send results to view
		if (isset($alreadyVoted)) { $data['already_voted'] = $alreadyVoted; } 
		$data['exp_date'] = $post_info->dbExpDate;
		$data['total_votes'] = $C1VotesCount + $C2VotesCount;
		$data['description'] = $post_info->dbPostDesc;
		$data['ref'] = $ref;
		$data['place'] = $place;
		$data['fb_twit'] = 0;
		$data['comment_group'] = 1;
		$data['post'] = $post;
		
		//Load view
		$data['file_include'] = 'vote';
		$data['widget_include'] = 'widgets/decision_info';
		$this->load->view('main', $data);
	}

    public function submit_vote($decision = 0, $vote = 0, $voter = 0)
    {
		$allowVote = TRUE;
		// Verify a valid function call
		if ($decision < 1 || $vote < 0 || $vote > 1 || $voter < 1) {
			$allowVote = FALSE;
		}
		
		//Verify that voter is not the author
		$checkAuthorSQL = "SELECT * FROM `Posts` WHERE `dbPostCnt` = '$decision';";
		$checkAuthorResults = $this->db->query($checkAuthorSQL);
		foreach ($checkAuthorResults->result() as $checkAuthor) {
			if ($voter == $checkAuthor->dbUsrCnt) {
			//Deny vote
			$allowVote = FALSE;
			}
		}
		
		// Verify that user has not already voted
        $checkVoteSQL = "SELECT * FROM `Votes` WHERE `dbPostCnt` = '$decision' AND `dbUsrCnt` = '$voter';";
        $checkVoteResult = $this->db->query($checkVoteSQL);
        $checkVote = $checkVoteResult->num_rows();
		
		if ($checkVote > 0) {
            //User has already voted
            $allowVote = FALSE;
        }
		
		if ($allowVote == FALSE) {
			// Kill the vote process
		}
		else {
            //User's vote is recorded
            $timestamp = date("Y-m-d H:i:s");
			$voteSQL = "INSERT INTO `Votes` (`dbVoteCnt`, `dbUsrCnt`, `dbPostCnt`, `dbChcVote`, `dbVoteDate`) VALUES ('','$voter', '$decision', '$vote', '$timestamp')";
            $this->db->query($voteSQL);

            //User's activity is recorded
			$activitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$voter', 5, '$decision', NULL, '$timestamp')";
			$this->db->query($activitySQL);
        }
    }
}
	
/* End of file vote.php */
/* Location: application/controllers/vote.php */