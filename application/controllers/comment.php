<?php
class Comment extends CI_Controller {

	public function index() {
			redirect('vote/decision', 'refresh');
	}
	
	public function new_comment($post = 0) 	{
		
		//Verify proper user is posting
		if (!($this->session->userdata('userID'))) {
			// User isn't legit
		}
		else {
			$commenter = $this->session->userdata('userID');
		}
		
		// Ensure decision/post is legit
		$checkPostSQL = "SELECT dbPostCnt FROM `Posts` WHERE dbPostCnt = '$post';";
		$checkPostResults = $this->db->query($checkPostSQL);
		if ($checkPostResults->num_rows() !== 1) {
			//post isn't legit
		}
		
		//Clean up the comment text
		if ($this->input->post('comment_text', TRUE) !== FALSE) {
			$commentText = $this->input->post('comment_text', TRUE);
		}
		else {
			// comment isn't legit
		}
		
		//Submit to the database
		$timeStamp = date("Y-m-d H:i:s");
		$commentSQL = "INSERT INTO `Comments` (`dbCommCnt`, `dbIDCnt`, `dbIDGroup`, `dbCommTxt`, `dbUsrCnt`, `dbAddDate`) VALUES ('', '$post', '1', " . $this->db->escape($commentText) . ", '$commenter', '$timeStamp')";	
		$this->db->query($commentSQL);
		
		// Add comment activity for user
		$activitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$commenter', 4, '$post', NULL, '$timeStamp')";
		$this->db->query($activitySQL);
		
		//Re-direct to the post
		$redirectURI = 'vote/decision/' . $post;
		redirect($redirectURI, 'refresh');
    }
	
	public function new_reply($post = 0, $replyTo = 0) 	{
		$allowComment = TRUE;
		//Verify proper user is posting
		if (!($this->session->userdata('userID'))) {
			$allowComment = FALSE;
		}
		else {
			$commenter = $this->session->userdata('userID');
		}
		
		// Ensure decision/post is legit
		$checkPostSQL = "SELECT dbPostCnt FROM `Posts` WHERE dbPostCnt = '$post';";
		$checkPostResults = $this->db->query($checkPostSQL);
		if ($checkPostResults->num_rows() !== 1) {
			$allowComment = FALSE;
		}
		
		// Ensure parent comment is legit
		$checkReplySQL = "SELECT dbCommCnt FROM `Comments` WHERE dbCommCnt = '$replyTo';";
		$checkReplyResults = $this->db->query($checkReplySQL);
		if ($checkReplyResults->num_rows() < 1) {
			$allowComment = FALSE;
		}
		
		//Clean up the comment text
		if ($this->input->post('comment_text', TRUE) !== FALSE) {
			$commentText = $this->input->post('comment_text', TRUE);
		}
		else {
			$allowComment = FALSE;
		}
		
		// Verify it isn't a blank comment
		$commentText = $this->input->post('comment_text', TRUE);
		$commentText = trim($commentText);
		if ($commentText == '' || $commentText == NULL || strlen($commentText) < 2) {
			$allowComment = FALSE;
		}
		
		if ($allowComment == TRUE) {
			//Submit to the database
			$timeStamp = date("Y-m-d H:i:s");
			$commentSQL = "INSERT INTO `Comments` (`dbCommCnt`, `dbIDCnt`, `dbIDGroup`, `dbCommTxt`, `dbUsrCnt`, `dbAddDate`, `dbCommReply`) VALUES ('', '$post', '1', " . $this->db->escape($commentText) . ", '$commenter', '$timeStamp', '$replyTo')";	
			$this->db->query($commentSQL);
			
			// Add comment activity for user
			$activitySQL = "INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES ('', '$commenter', 4, '$post', NULL, '$timeStamp')";
			$this->db->query($activitySQL);
			
			//Re-direct to the post
			$redirectURI = 'vote/decision/' . $post;
			redirect($redirectURI, 'refresh');
		}
		else {
			//Error out
		}
    }
}
	
/* End of file comment.php */
/* Location: application/controllers/comment.php */