<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Comparative_income extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
                'Account_class_model',
                'Journal_info_model',
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
	        $data['title'] = 'Comparative Income Statement';

	        $cur_start_month = date('Y-m-1');
	        $cur_end_month = date('Y-m-t');

	        $prev_start_month = date('Y-m-j', strtotime('first day of previous month'));
	        $prev_end_month = date('Y-m-j', strtotime('last day of previous month'));

	        $data['departments']=$this->Departments_model->get_list('is_deleted=FALSE');

	        $data['income_accounts']=$this->Journal_info_model->get_cur_prev_balance(4,$prev_start_month,$prev_end_month,$cur_start_month,$cur_end_month);
	        $data['expense_accounts']=$this->Journal_info_model->get_cur_prev_balance(5,$prev_start_month,$prev_end_month,$cur_start_month,$cur_end_month);
        (in_array('9-16',$this->session->user_rights)? 
         $this->load->view('comparative_income_view', $data)
        :redirect(base_url('dashboard')));
	       
		}

		function Report() {
			$cur_start_month = date('Y-m-1');
	        $cur_end_month = date('Y-m-t');

	        $prev_start_month = date('Y-m-j', strtotime('first day of previous month'));
	        $prev_end_month = date('Y-m-j', strtotime('last day of previous month'));

	        $company_info=$this->Company_model->get_list();
	        $data['company_info']=$company_info[0];

	        $data['departments']=$this->Departments_model->get_list('is_deleted=FALSE');

	        $data['income_accounts']=$this->Journal_info_model->get_cur_prev_balance(4,$prev_start_month,$prev_end_month,$cur_start_month,$cur_end_month);
	        $data['expense_accounts']=$this->Journal_info_model->get_cur_prev_balance(5,$prev_start_month,$prev_end_month,$cur_start_month,$cur_end_month);

	        $this->load->view('template/comparative_income_report',$data);
		}
	}
?>