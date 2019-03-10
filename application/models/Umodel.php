<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Umodel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getUsers()
    {
        $this->db->select('*');
		$this->db->from('hci_users');

		$qr = $this->db->get();
		return $qr->result_array();
    }

    public function getUsersbyid($id="null")
    {
        $this->db->select('*');
		$this->db->from('hci_users');
        $this->db->where('user_id',$id);
		$qr = $this->db->get();
		return $qr->result_array();
    }
    
    

}

