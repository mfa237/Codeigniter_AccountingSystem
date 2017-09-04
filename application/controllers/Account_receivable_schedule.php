<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_receivable_schedule extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model(
            array(
                'Journal_info_model',
                'Journal_account_model',
                'Account_title_model',
                'Users_model',
                'Account_integration_model'
            )
        );

    }

    public function index() {
        $this->Users_model->validate();
        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);

        $data['title'] = 'Accounts Receivable Schedule';
        $m_account_integration=$this->Account_integration_model;

        $ar_id=$m_account_integration->get_list();
        $data['accounts']=$this->Account_title_model->get_list('is_active=TRUE AND is_deleted=FALSE');
        $data['ar_account']=$ar_id[0]->receivable_account_id;
        (in_array('9-4',$this->session->user_rights)? 
        $this->load->view('accounts_receivable_schedule_view', $data)
        :redirect(base_url('dashboard')));
    }


    function transaction($txn=null){
        switch($txn){
            case 'ar-list':
                $m_journal_accounts=$this->Journal_account_model;

                $account_id=$this->input->post('account_id');
                $date=$this->input->post('date');

                $response['data']=$m_journal_accounts->get_account_schedule($account_id,$date);
                echo json_encode($response);

                break;
        }
    }





}
