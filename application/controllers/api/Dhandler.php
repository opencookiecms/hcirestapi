<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Dhandler extends REST_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Umodel');

    }
    

    public function users_get()
    {
        $users = $this->Umodel->getUsers();
        
        if($users)
        {
            $this->set_response([
                'Users' => $users
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function myprofile_get($value = "")
    {
        $myprofile = $this->Umodel->getUsersbyid($value);

        if($myprofile)
        {
            $this->set_response([
                'Myprofile' => $myprofile
            ],REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response([
                'Myprofile' => $myprofile,
                'message' => 'User could not be found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }


}

/* End of file Controllername.php */
