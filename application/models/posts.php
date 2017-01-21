<?php
class Posts extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getById($postId = NULL) {
    	if (!is_null($postId)) {
    		$post = $this->db->get_where('Posts', array('dbPostCnt' => $postId), 1);
    		if ($post->num_rows() > 0) {
    			return $post->result();
    		} else {
    			return FALSE;
    		}
    	} else {
    		return FALSE;
    	}
    }
}