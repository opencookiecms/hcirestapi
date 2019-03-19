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
        $this->load->model('Nmodel');

    }
    

    public function users_get($value = "")
    {
        $users = $this->Umodel->getUsersbyid($value);
        $notes = $this->Nmodel->getNotebyid($value);
       
            if($users)
            {
                foreach ($users as $key => $vpost)
                {
                    $this->set_response([
                        'user_id' => $vpost['user_id'],
                        'user_firtname' => $vpost['user_firstname'],
                        'user_lastname' => $vpost['user_lastname'],
                        'user_email' =>$vpost['user_email'],
                        'notes'=>$notes,
                        'ff' =>'this is folloer section array'
                    ],REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

                }
            }
            else
            {
                $this->set_response([
                 'status'=>false,
                 'message' => 'User could not be found'
              ],REST_Controller::HTTP_NOT_FOUND);

            }       
             
    }

    public function getalluser_get()
    {
        $alluser = $this->Umodel->getuserall();
        $this->set_response($alluser,REST_Controller::HTTP_OK);
    }

    public function verify_get($username="",$pass="")
    {
        $veri = $this->Umodel->get_verify($username,$pass);

        if($veri)
        {
            $users = $this->Umodel->getUsersbyid($username);
            $notes = $this->Nmodel->getNotebyid($username);
            foreach ($users as $key => $vpost)
            {
                $this->set_response([
                    'user_id' => $vpost['user_id'],
                    'user_firtname' => $vpost['user_firstname'],
                    'user_lastname' => $vpost['user_lastname'],
                    'user_email' =>$vpost['user_email'],
                    'notes'=>$notes,
                    'ff' =>'this is folloer section array'
                ],REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

            }
        }
        else 
        {
            $this->response([
                'status'=> false,
                'message'=> 'usernotfound'

           ],REST_Controller::HTTP_BAD_REQUEST);
        }

    }

  

    public function users_post()
    {
        $data = [
            'user_username' => $this->post('username'),
            'user_email'=> $this->post('email'),
            'user_password' => $this->post('password')
        ];

        $userreg = $this->Umodel->createUsers($data);
        if($userreg > 0 )
        {
            $this->response([
                'status'=> true,
                'message'=> 'new succesfully insert'

           ],REST_Controller::HTTP_CREATED);
        }
        else
        {
            $this->response([
                'status'=> false,
                'message'=> 'there is no data was insert'

           ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function users_put()
    {
        
    }


    ///foollower funciton

    public function follow_post()
    {
        $data = [
            'hci_following' => $this->post('following'),
            'hci_follower'=> $this->post('follower'),
            'status' => $this->post('status')
        ];

        $userreg = $this->Umodel->createFollow($data);
        if($userreg > 0 )
        {
            $this->response([
                'status'=> true,
                'message'=> 'new succesfully insert'

           ],REST_Controller::HTTP_CREATED);
        }
        else
        {
            $this->response([
                'status'=> false,
                'message'=> 'there is no data was insert'

           ],REST_Controller::HTTP_BAD_REQUEST);
        }
    }    

    public function follow_get($value="")
    {
        $notebyid = $this->Umodel->followby($value);
        $this->set_response($notebyid,REST_Controller::HTTP_OK);
    }

}

/* End of file Controllername.php */
