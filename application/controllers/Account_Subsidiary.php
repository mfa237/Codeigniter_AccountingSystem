<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Account_Subsidiary extends CORE_Controller 
	{
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();
			$this->load->model(
				array
				(
					'Journal_account_model',
					'Journal_info_model',
					'Customers_model',
					'Suppliers_model',
					'Account_title_model',
					'Account_class_model',
					'Account_type_model',
					'Users_model'
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
	        $data['title'] = 'Per Account Subsidiary';
	        $data['account_titles'] = $this->Account_title_model->get_list('account_titles.is_deleted=FALSE AND account_titles.is_active=TRUE',null,null,'account_title');
        (in_array('9-8',$this->session->user_rights)? 
        $this->load->view('account_subsidiary_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null){
			switch($txn){
				case 'get-account-subsidiary':

					$account_Id=$this->input->get('accountId',TRUE);
					$start_Date=date('Y-m-d',strtotime($this->input->get('startDate',TRUE)));
					$end_Date=date('Y-m-d',strtotime($this->input->get('endDate',TRUE)));
                    $includeChild=$this->input->get('includeChild',TRUE);

					$m_journal_info=$this->Journal_info_model;

					$response['data']=$m_journal_info->get_account_subsidiary($account_Id,$start_Date,$end_Date,$includeChild);
					echo json_encode($response);

				break;
			}
		}
	}
?>