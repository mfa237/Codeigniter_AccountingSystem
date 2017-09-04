<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TAccount extends CORE_Controller
{
    function __construct()
    {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(
            array
            (
                'Journal_account_model',
                'Departments_model',
                'Users_model',
                'Company_model'
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
        $data['title'] = 'T-Accounts Report';

        $data['departments']=$this->Departments_model->get_list(array('is_deleted'=>FALSE,'is_active'=>TRUE));

        (in_array('9-14',$this->session->user_rights)? 
        $this->load->view('book_of_accounts_view',$data)
        :redirect(base_url('dashboard')));
    }



    public function transaction($txn=null){
        switch($txn){
            case 'get-journal-list':
                $m_journal = $this->Journal_account_model;

                $start =date('Y-m-d', strtotime($this->input->post('start',TRUE)));
                $end = date('Y-m-d', strtotime($this->input->post('end',TRUE)));
                $book = $this->input->post('book',TRUE);

                $response['data'] = $m_journal->get_t_account($book,$start,$end);
                echo json_encode($response);
                break;

            case 'journal-report':
                $m_journal=$this->Journal_account_model;
                $m_company=$this->Company_model;

                $start=date('Y-m-d', strtotime($this->input->get('s',TRUE)));
                $end=date('Y-m-d', strtotime($this->input->get('e',TRUE)));
                $book=$this->input->get('b',TRUE);
                $company_info=$m_company->get_list();
                $data['company_info']=$company_info[0];

                switch ($book) {
                    case 'GJE':
                            $data['title']='GENERAL JOURNAL';
                        break;

                    case 'CDJ':
                            $data['title']='CASH DISBURSEMENT';
                        break;

                    case 'PJE':
                            $data['title']='PURCHASE JOURNAL';
                        break;

                    case 'SJE':
                            $data['title']='SALES JOURNAL';
                        break;

                    case 'PCF':
                            $data['title']='PETTY CASH VOUCHER';
                        break;

                    case 'CRJ':
                            $data['title']='CASH RECEIPT';
                        break;
                    
                    default:
                            $data['title']='T-Accounts';
                        break;
                }

                $data['journal_list'] = $m_journal->get_t_account($book,$start,$end);
                $this->load->view('template/book_of_accounts_report',$data);
                break;
        }
    }







}
?>