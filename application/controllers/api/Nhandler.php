<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Nhandler extends REST_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nmodel');
        //Do your magic here

        //$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        //$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    
    public function notes_get()
    {
        $notes = $this->Nmodel->getNote();
        
        if($notes)
        {
            $this->set_response([
                'notes' => $notes
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
    }


}

/* End of file Controllername.php */
