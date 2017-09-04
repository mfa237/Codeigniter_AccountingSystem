<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Check_registry_report extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Journal_info_model',
					'Receivable_payment_model',
					'Company_model',
					'Users_model',
					'Bank_model'
				)
			);
		}

		public function index()
		{	
			$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
	        $data['title'] = 'Check Registry Report';
	        $data['banks'] = $this->Bank_model->get_list('bank.is_active=TRUE AND bank.is_deleted=FALSE');
        (in_array('12-2',$this->session->user_rights)? 
        $this->load->view('check_registry_report_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null) {
			switch($txn) {
				case 'list':
					$m_journal_info=$this->Journal_info_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));
					$bank=$this->input->get('bank', TRUE);
					$response['data']=$m_journal_info->get_check_registry($startDate,$endDate,$bank);
					echo json_encode($response);
				break;


				case 'report':
					$m_journal_info=$this->Journal_info_model;
					$m_company=$this->Company_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));
					$bank=$this->input->get('bank', TRUE);
					$company_info=$m_company->get_list();
					$data['company_info']=$company_info[0];

					$data['report_info']=$m_journal_info->get_check_registry($startDate,$endDate,$bank);
					$data['start']=$startDate;
					$data['end']=$endDate;
					
					$this->load->view('template/check_registry_report_content',$data);

















				break;
			}
		}
	}
?>