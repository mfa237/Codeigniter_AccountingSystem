<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Customer_Subsidiary extends CORE_Controller 
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
					'Account_title_model',
					'Account_class_model',
					'Account_type_model',
					'Users_model',
					'Customer_subsidiary_model',
                    'Account_integration_model'
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


	        $data['title'] = 'Customer Subsidiary';

            $m_integration=$this->Account_integration_model;
	        $data['customers'] = $this->Customers_model->get_list('is_active=TRUE AND is_deleted=FALSE AND customer_name!=""',"customers.*",null,'customer_name');
	        $data['account_titles'] = $this->Account_title_model->get_list('account_titles.is_deleted=FALSE AND account_titles.is_active=TRUE',null,null,'account_title');
            $ar_account=$m_integration->get_list();
            $data['ar_account']=$ar_account[0]->receivable_account_id;
	        

        (in_array('9-6',$this->session->user_rights)? 
        $this->load->view('customer_subsidiary_view',$data)
        :redirect(base_url('dashboard')));
		}

		function transaction($txn=null){
			switch($txn){
				case 'get-customer-subsidiary':

					$customer_Id=$this->input->get('customerId',TRUE);
					$account_Id=$this->input->get('accountId',TRUE);
					$start_Date=date('Y-m-d',strtotime($this->input->get('startDate',TRUE)));
					$end_Date=date('Y-m-d',strtotime($this->input->get('endDate',TRUE)));
					$m_customer_subsidiary=$this->Customer_subsidiary_model;


					$response['data']=$m_customer_subsidiary->get_customer_subsidiary($customer_Id,$account_Id,$start_Date,$end_Date);

					echo json_encode($response);

				break;
			}
		}
	}

?>