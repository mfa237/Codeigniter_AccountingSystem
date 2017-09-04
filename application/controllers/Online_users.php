<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_users extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Bank_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Online Users';
    
        $this->load->view('online_users_view', $data);

        
    }

    function transaction ($txn=null){
        switch($txn){
            case 'list':
            $m_users=$this->Users_model;
            $response['data']=$m_users->Online_users();
            echo json_encode($response);
            break;


        }



    }


}

