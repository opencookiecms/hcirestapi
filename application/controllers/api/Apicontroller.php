<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Apicontroller extends REST_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Apimodel');
        $this->load->model('Nmodel');
        $this->load->model('Umodel');

    }

    public function users_post()
    {
        $data = [
            'user_username' => $this->post('username'),
            'user_email'=> $this->post('email'),
            'user_password' => $this->post('password'),
            'user_firstname'=> $this->post('firstname')
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

    public function verify_get($username="",$pass="")
    {

        $veri = $this->Umodel->get_verify($username,$pass);

        if($veri)
        {
            $users = $this->Umodel->getUsersbyid($username);
            $notes = $this->Nmodel->getNotebyid($username);
            $countf = $this->Umodel->getFollowingbyid($username);
            $countff = $this->Umodel->getFollowerbyid($username);
            $notecount = $this->Nmodel->countNote($username);
            foreach ($users as $key => $vpost)
            {
                $this->set_response([
                    'user_id' => $vpost['user_id'],
                    'user_firtname' => $vpost['user_firstname'],
                    'user_lastname' => $vpost['user_lastname'],
                    'user_email' =>$vpost['user_email'],
                    'user_username'=>$vpost['user_username'],
                    'user_password'=>$vpost['user_password'],
                    'notes'=>$notes,
                    'follower'=>$countff,
                    'following'=>$countf,
                    'notecount'=>$notecount
                    
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

    public function alluser_get()
    {
        $getall= $this->Apimodel->getall();
        $this->set_response($getall,REST_Controller::HTTP_OK); 
    }

    public function notebyuser_get($value="")
    {
       $getnoteuser = $this->Apimodel->getNotebyuser($value);
       $this->set_response($getnoteuser,REST_Controller::HTTP_OK);
    }

    public function profile_get($value="")
    {
        $getprofile = $this->Apimodel->getuserbyusers($value);
        $this->set_response($getprofile,REST_Controller::HTTP_OK);
    }

    public function followingcount_get($value="")
    {
        $f = $this->Apimodel->countfollowing($value);
        $this->set_response($f,REST_Controller::HTTP_OK);
    }

    public function followercount_get($value="")
    {
        $f = $this->Apimodel->countfollower($value);
        $this->set_response($f,REST_Controller::HTTP_OK);
    }

    public function notecount_get($value="")
    {
        $c = $this->Apimodel->notecounter($value);
        $this->set_response($c,REST_Controller::HTTP_OK);
    }

    public function uploadnote_post()
    {
        $details = [
            'note_title' => $this->post('title'),
            'note_content'=> $this->post('content'),
            'note_username'=> $this->post('username')

        ];

        $config['upload_path'] = APPPATH.'../assets/pdf/';
        $config['allowed_types'] = 'pdf|pptx|docx|doc|otf|jpg|jpeg';
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        
        $this->load->library('upload',$config);

        if(!$this->upload->do_upload('note_link'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->response([
                'status'=> false,
                'message'=> $error

           ],REST_Controller::HTTP_BAD_REQUEST);
        }
        else
        {
            $upload_data = $this->upload->data();
            $details['note_link'] = $upload_data['file_name'];
            $details['note_type'] = $upload_data['file_ext'];

            $this->Apimodel->regnote($details);

            $this->response([
                'status'=> true,
                'message'=> 'new succesfully insert'

           ],REST_Controller::HTTP_CREATED);
        }  
    }

    public function updateprofile_post($value="")
    {
        $details = [
            'user_firstname' => $this->post('userfirstname'),
            'user_email' => $this->post('useremail'),
            'user_caption' => $this->post('usercaption')

        ];

     
            $config['upload_path'] = APPPATH.'../assets/picture/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '30000';
            $config['max_height'] = '30000';
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('user_pic'))
            {


                $this->Apimodel->updateprofiles($details,$value);
                //$error = array('error' => $this->upload->display_errors()); 
                $this->response([
                    'status'=> false,
                    'message'=> "update wihout images"
    
               ],REST_Controller::HTTP_BAD_REQUEST);

            }
            else
            {
                $upload_data = $this->upload->data();
                $details['user_pic'] = $upload_data['file_name'];
          
                $this->Apimodel->updateprofiles($details,$value);
    
                $this->response([
                    'status'=> true,
                    'message'=> 'new succesfully insert'
    
               ],REST_Controller::HTTP_CREATED);
            }
            
        

    }

    public function isfollower_get($value="")
    {
        $flw = $this->Apimodel->thefollows($value);
        $this->set_response($flw,REST_Controller::HTTP_OK);
    }

    public function isfollowing_get($value="")
    {
        $flws= $this->Apimodel->thefollowings($value);
        $this->set_response($flws,REST_Controller::HTTP_OK);
    }


    public function isrequest_get($value="")
    {
        $flws= $this->Apimodel->therequest($value);
        $this->set_response($flws,REST_Controller::HTTP_OK);
    }

}

/* End of file Controllername.php */
