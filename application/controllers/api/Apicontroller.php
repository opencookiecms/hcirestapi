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

    public function followcount_get($value="")
    {
        $f = $this->Apimodel->countfollows($value);
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

    public function isfollower_get()
    {

    }

    public function isfollowing_get()
    {
        
    }

}

/* End of file Controllername.php */
