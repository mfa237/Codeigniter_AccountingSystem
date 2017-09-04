<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class SOA extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Sales_invoice_model',
					'Customers_model',
					'Users_model',
					'Company_model'
				)
			);
		}

		public function index()
		{
			$this->Users_model->validate();
	        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
	        $data['title'] = 'Statement of Account';

	        $data['customers'] = $this->Customers_model->get_list('is_deleted=FALSE AND is_active=TRUE');

	        $this->load->view('statement_of_account_view',$data);
		}

		function transaction($txn)
		{
			switch ($txn)
			{
				case 'balances':
					$m_sales = $this->Sales_invoice_model;

					$customer_id = $this->input->get('cusid',TRUE);

					$response['previous_balances'] = $m_sales->get_customer_soa_complete('< MONTH(NOW())',$customer_id,null,null);
					// $response['current_balances'] = $m_sales->get_customer_soa('= MONTH(NOW())',$customer_id,null,null);
					$response['current_balances'] = $m_sales->get_customer_soa_complete('= MONTH(NOW())',$customer_id,null,null);
					$response['payments'] = $m_sales->get_customer_soa_payment($customer_id);

					echo json_encode($response);
					break;

				case 'print':
					$m_sales = $this->Sales_invoice_model;

					$customer_id = $this->input->get('cusid',TRUE);

					$company_info = $this->Company_model->get_list();

					$data['company_info'] = $company_info[0];

					$customer_info = $this->Customers_model->get_list($customer_id);

					$data['customer_info'] = $customer_info[0];

					$data['previous_balances'] = $m_sales->get_customer_soa_complete('< MONTH(NOW())',$customer_id,null,null);
					$data['current_balances'] = $m_sales->get_customer_soa_complete('= MONTH(NOW())',$customer_id,null,null);
					$data['payments'] = $m_sales->get_customer_soa_payment($customer_id);

					$this->load->view('template/soa_print',$data);
					break;
			}
		}
	}
?>
