<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CORE_Controller {
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
        $data['title'] = 'Bank Management';
        (in_array('4-6',$this->session->user_rights)? 
        $this->load->view('bank_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_bank = $this->Bank_model;
                $response['data'] = $m_bank->get_list(array('bank.is_deleted'=>0));
                echo json_encode($response);
                break;

            case 'create':
                $m_bank = $this->Bank_model;

                $m_bank->bank_code = $this->input->post('bank_code', TRUE);
                $m_bank->bank_name = $this->input->post('bank_name', TRUE);
                $m_bank->account_number = $this->input->post('account_number', TRUE);
                $m_bank->account_type = $this->input->post('account_type', TRUE);
                $m_bank->save();

                $bank_id = $m_bank->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Bank information successfully created.';
                $response['row_added'] = $m_bank->get_list($bank_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_bank=$this->Bank_model;

                $bank_id=$this->input->post('bank_id',TRUE);

                $m_bank->is_deleted=1;
                if($m_bank->modify($bank_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Bank information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_bank=$this->Bank_model;

                $bank_id=$this->input->post('bank_id',TRUE);
                $m_bank->bank_code = $this->input->post('bank_code', TRUE);
                $m_bank->bank_name = $this->input->post('bank_name', TRUE);
                $m_bank->account_number = $this->input->post('account_number', TRUE);
                $m_bank->account_type = $this->input->post('account_type', TRUE);

                $m_bank->modify($bank_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Bank information successfully updated.';
                $response['row_updated']=$m_bank->get_list($bank_id);
                echo json_encode($response);

                break;
        }
    }
}
