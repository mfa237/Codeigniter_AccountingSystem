<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_settings extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Email_settings_model');
        $this->load->model('Users_model');

    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Email Settings';

        $company=$this->Email_settings_model->get_list();
        $data['company']=$company[0];
        (in_array('6-6',$this->session->user_rights)? 
        $this->load->view('email_settings_view', $data)
        :redirect(base_url('dashboard')));
    }

    function transaction($txn = null) {

        switch($txn){

            case 'get-email':
                $m_email=$this->Email_settings_model;

                $email = $m_email->get_list();

                $response['data']=$email[0];

                echo json_encode($response);
                break;

            case 'create':
                $m_email=$this->Email_settings_model;

                $m_email->delete(1);

                $m_email->email_id=1;
                $m_email->email_provider=$this->input->post('email_provider',TRUE);
                $m_email->email_address=$this->input->post('email_address',TRUE);
                $m_email->password=$this->input->post('password',TRUE);
                $m_email->name_from=$this->input->post('name_from',TRUE);
                $m_email->default_message=$this->input->post('default_message',TRUE);
                $m_email->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Email Settings Saved.';
                echo json_encode($response);

                break;
            //****************************************************************************************************************

            // case 'upload':
            //     $allowed = array('png', 'jpg', 'jpeg','bmp');

            //     $data=array();
            //     $files=array();
            //     $directory='assets/img/company/';

            //     foreach($_FILES as $file){

            //         $server_file_name=uniqid('');
            //         $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            //         $file_path=$directory.$server_file_name.'.'.$extension;
            //         $orig_file_name=$file['name'];

            //         if(!in_array(strtolower($extension), $allowed)){
            //             $response['title']='Invalid!';
            //             $response['stat']='error';
            //             $response['msg']='Image is invalid. Please select a valid photo!';
            //             die(json_encode($response));
            //         }

            //         if(move_uploaded_file($file['tmp_name'],$file_path)){
            //             $response['title']='Success!';
            //             $response['stat']='success';
            //             $response['msg']='Image successfully uploaded.';
            //             $response['path']=$file_path;
            //             echo json_encode($response);
            //         }
            //     }
            //     break;

        }


    }
}
