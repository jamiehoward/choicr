<?php
class choice_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_choice_by_id($id)
    {
        return $this->db->get_where('Choices', array('dbChcCnt' => $id))->row();
    }
}