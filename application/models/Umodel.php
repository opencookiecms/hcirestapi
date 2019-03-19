<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Umodel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function createUsers($data)
    {
             //$this->Umodel->createUsers();
        $this->db->insert('hci_users',$data);
        return $this->db->affected_rows();
    }


    public function createFollow($data)
    {
             //$this->Umodel->createUsers();
        $this->db->insert('hci_followers',$data);
        return $this->db->affected_rows();
    }

    public function getUsers()
    {
        $this->db->select('*');
		$this->db->from('hci_users');

		$qr = $this->db->get();
		return $qr->result_array();
    }

    public function getUserN()
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
        $this->db->where('user_username',$id);
		$qr = $this->db->get();
		return $qr->result_array();
    }

    public function get_verify($u="null",$p="null")
    {
      $this->db->select('*');
      $this->db->from('hci_users');
      $this->db->where('user_username', $u);
      $this->db->where('user_password', $p);
      $this->db->limit(1);
  
      $get_data = $this->db->get();
      return $get_data->result_array();
 
    }

    public function getuserall()
    {
        $this->db->select('*');
		$this->db->from('hci_users');

		$qr = $this->db->get();
		return $qr->result_array();
    }
    
    

}

