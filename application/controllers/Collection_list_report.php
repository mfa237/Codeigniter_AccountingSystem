<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Collection_list_report extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Journal_info_model',
					'Receivable_payment_model',
					'Users_model',
					'Company_model'
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
	        $data['title'] = 'Collection List Report';
        (in_array('12-3',$this->session->user_rights)? 
        $this->load->view('Collection_list_report_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null) {
			switch($txn) {
				case 'list':
					$m_journal_info=$this->Receivable_payment_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));

					$response['data']=$m_journal_info->get_receivable_payment($startDate,$endDate);
					echo json_encode($response);
				break;


				case 'report':
					$m_journal_info=$this->Receivable_payment_model;
					$m_company=$this->Company_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));

					$company_info=$m_company->get_list();
					$data['company_info']=$company_info[0];

					$report_info=$m_journal_info->get_receivable_payment($startDate,$endDate);
					$data['start']=$startDate;
					$data['end']=$endDate;
					$data['report_info']=$report_info;

					$this->load->view('template/collection_list_report_content',$data);
				break;
			}
		}
	}
?>