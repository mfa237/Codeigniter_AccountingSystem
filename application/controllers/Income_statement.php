<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_statement extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
                'Account_class_model',
                'Journal_info_model',
                'Journal_account_model',
                'Users_model',
                'Departments_model'
            )
        );
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Income Statement';

        $data['departments']=$this->Departments_model->get_list('is_deleted=FALSE');
        $data['income_accounts']=$this->Journal_info_model->get_account_balance(4);
        $data['expense_accounts']=$this->Journal_info_model->get_account_balance(5);
        (in_array('9-2',$this->session->user_rights)? 
        $this->load->view('income_statement_view', $data)
        :redirect(base_url('dashboard')));
        
    }




}
