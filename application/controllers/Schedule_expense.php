<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_expense extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
                'Account_title_model',
                'Departments_model',
                'Sched_expense_integration',
                'Users_model',
                'Company_model'
            )
        );
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Schedule of Expense';
        $data['departments'] = $this->Departments_model->get_list('is_deleted=0 AND is_active=1');
        (in_array('9-11',$this->session->user_rights)? 
        $this->load->view('schedule_expense_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    public function transaction($txn=nul){
        switch($txn){
            case 'schedule-expenses':
                $m_schedule=$this->Sched_expense_integration;
                $date=date('Y-m-d',strtotime($this->input->get('date',TRUE)));
                $depid=$this->input->get('depid',TRUE);


                $response['date']=$date;
                $response['data']=$m_schedule->get_schedule_expense($date,$depid);
                echo json_encode($response);
                break;
            case 'print-schedule-expense':
                $company_info=$this->Company_model->get_list();
                $params['company_info']=$company_info[0];


                $data['department']=$this->Departments_model->get_list($this->input->post('department'));
                $data['company_header']=$this->load->view('template/company_header',$params,TRUE);

                $this->load->view('template/schedule_expense_report',$data);
                break;

        }
    }




}
