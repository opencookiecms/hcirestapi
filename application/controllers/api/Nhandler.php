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

    public function notes_post()
    {
        $details = [
            'note_title' => $this->post('title'),
            'note_content'=> $this->post('content'),
            //'note_link' => $this->post('linked'),
            //'note_type' => $this->post('typed'),
            'note_userId'=> $this->post('userids')

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

            $this->Nmodel->regNote($details);

            $this->response([
                'status'=> true,
                'message'=> 'new succesfully insert'

           ],REST_Controller::HTTP_CREATED);
        }  
    }
    
    public function notes_get()
    {
        $notes = $this->Nmodel->getNote();
        
        $this->set_response($notes,REST_Controller::HTTP_OK);
    }

    public function notesbyid_get($value="")
    {
        $notebyid = $this->Nmodel->getNotebyid($value);
        $this->set_response($notebyid,REST_Controller::HTTP_OK);
        
    }


}

/* End of file Controllername.php */
