<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apimodel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getall($id)
    {

        $this->db->select('*');
        $this->db->from('hci_users');
        $this->db->where('user_username !=',$id);
        $qr = $this->db->get();
        return $qr->result_array();

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

    public function countfollowing($id)
    {


        $sql = "SELECT SUM(hci_following = ?) as following  FROM `hci_followers` WHERE hci_following = ? and `status` =?";

        $qr = $this->db->query($sql, array($id, $id,'approve'));
        return $qr->result_array();
    }

    public function countfollower($id)
    {
 
        $sql = "SELECT SUM(hci_follower = ?) as follower FROM `hci_followers` WHERE hci_follower = ? and `status` = ?";

        $qr = $this->db->query($sql, array($id, $id,'approve'));
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

    public function updateprofiles($data,$id)
    {
        $this->db->update('hci_users',$data,['user_username'=>$id] );
        return $this->db->affected_rows();
    }

    public function thefollows($username)
    {
        $approve = "approve";
        $this->db->select('hci_followers.hci_fid, hci_users.user_id,hci_users.user_firstname,hci_users.user_lastname,hci_users.user_username,hci_users.user_email,hci_users.user_collage,hci_users.user_posititon,hci_users.user_caption,hci_users.user_pic');
        $this->db->from('hci_users');
        $this->db->join('hci_followers','hci_followers.hci_follower = hci_users.user_username','left');
        $this->db->where('hci_followers.hci_following',$username);
        $this->db->where('hci_followers.status',$approve);


        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function thefollowings($username)
    {
        $approve = "approve";
        $this->db->select('hci_users.user_id, hci_followers.hci_fid ,hci_users.user_firstname,hci_users.user_lastname,hci_users.user_username,hci_users.user_email,hci_users.user_collage,hci_users.user_posititon,hci_users.user_caption,hci_users.user_pic');
        $this->db->from('hci_users');
        $this->db->join('hci_followers','hci_followers.hci_following = hci_users.user_username','left');
        $this->db->where('hci_followers.hci_follower',$username);
        $this->db->where('hci_followers.status',$approve);


        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function therequest($username)
    {
        $approve = "request";
        $this->db->select('hci_users.user_id, hci_followers.hci_fid ,hci_users.user_firstname,hci_users.user_lastname,hci_users.user_username,hci_users.user_email,hci_users.user_collage,hci_users.user_posititon,hci_users.user_caption,hci_users.user_pic');
        $this->db->from('hci_users');
        $this->db->join('hci_followers','hci_followers.hci_following = hci_users.user_username','left');
        $this->db->where('hci_followers.hci_follower',$username);
        $this->db->where('hci_followers.status',$approve);


        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function setapprove($data,$id)
    {
        $this->db->update('hci_followers',$data,['hci_fid'=>$id] );
        return $this->db->affected_rows();
    }

    public function deletenote($id)
    {
        $this->db->delete('hci_note', ['note_id' => $id]);
        return $this->db->affected_rows();
    }

    


    
}

/* End of file ModelName.php */

