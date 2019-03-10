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

    public function regNote()
    {

    }

    public function delNote()
    {

    }
    

}


