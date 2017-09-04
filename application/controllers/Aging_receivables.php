<?php
	defined('BASEPATH') OR exit('No direct script access allowed.');

	class Aging_receivables extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Sales_invoice_model',
					'Users_model',
					'Company_model'
				)
			);
		}

		public function index()
		{
			$this->Users_model->validate();
	        //default resources of the active view
	        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
	        $data['title'] = "Aging of Receivables";

	        $this->load->view('aging_receivables_view',$data);
		}

		function transaction($txn)
		{
			switch ($txn) {
				case 'list':
					$m_sales = $this->Sales_invoice_model;

					$response['data'] = $m_sales->get_aging_receivables();

					echo json_encode($response);
					break;

				case 'print':
					$m_sales = $this->Sales_invoice_model;
					$m_company = $this->Company_model;

					$company_info = $m_company->get_list();

					$data['company_info'] = $company_info[0];
					$data['receivables'] = $m_sales->get_aging_receivables();

					$this->load->view('template/aging_receivables_report',$data);
					break;
				
				default:
					# code...
					break;
			}
		}
	}
?>