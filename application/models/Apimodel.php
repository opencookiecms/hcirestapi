<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apimodel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getProfiles()
    {

    }

    public function getNotebyuser($id)
    {
        $this->db->select('*');
        $this->db->from('hci_note');
        $this->db->where('note_username',$id);

        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function getuserbyusers($id)
    {
        $this->db->select('*');
        $this->db->from('hci_users');
        $this->db->where('user_username',$id);

        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function countfollows($id)
    {
        // $this->db->select('SUM(hci_following) as Following',$id,'SUM(hci_follower) as Follower',$id);
        // $this->db->from('hci_followers');
        // $this->db->where('hci_following',$id);

        $sql = "SELECT SUM(hci_following = ?) as following ,SUM(hci_follower = ?) as follower FROM `hci_followers` WHERE hci_following = ? or hci_follower = ?";

        $qr = $this->db->query($sql, array($id, $id,$id,$id));
        return $qr->result_array();
    }

    public function notecounter($id)
    {
         $sql = "SELECT SUM(note_username = ?) as notecounting FROM `hci_note` WHERE note_username = ?";
         $qr = $this->db->query($sql, array($id, $id));
         return $qr->result_array();
    }

    public function regnote($data)
    {
        $this->db->insert('hci_note',$data);
        return $this->db->affected_rows();
    }


    
}

/* End of file ModelName.php */

