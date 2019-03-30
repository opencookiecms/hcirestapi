<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getNote()
    {
        $this->db->select('*');
		$this->db->from('hci_note');

		$qr = $this->db->get();
		return $qr->result_array();
    }

    public function getNotebyid($id)
    {
        $this->db->select('*');
        $this->db->from('hci_note');
        $this->db->where('note_username',$id);

        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function countNote($id)
    {
        $this->db->select('count(note_username) as notecount');
        $this->db->from('hci_note');
        $this->db->where('note_username',$id);

        $qr = $this->db->get();
        return $qr->result_array();
    }

    public function regNote($data)
    {
        $this->db->insert('hci_note',$data);
        return $this->db->affected_rows();
    }

    public function delNote()
    {

    }
    

}


