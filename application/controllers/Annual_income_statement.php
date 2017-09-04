<?php
	defined('BASEPATH') OR exit('No direct script access allowed.');

	class Annual_income_statement extends CORE_Controller
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

		public function index()
		{	$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
	        $data['title'] = 'Annual Income Statement';

	        $data['income_accounts']=$this->Journal_info_model->get_annual_income_statement(4);
	        $data['expense_accounts']=$this->Journal_info_model->get_annual_income_statement(5);
        (in_array('9-9',$this->session->user_rights)? 
        $this->load->view('annual_income_statement_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function Report() 
		{
			$m_company_info = $this->Company_model;
			$company_info=$m_company_info->get_list();

			$data['company_info']=$company_info[0];
			$data['income_accounts']=$this->Journal_info_model->get_annual_income_statement(4);
	        $data['expense_accounts']=$this->Journal_info_model->get_annual_income_statement(5);

	        $this->load->view('template/annual_income_statement_report',$data);
		}	
	}
?>