<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sales_report extends CORE_Controller 
	{
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();
			$this->load->model(
				array
				(
					'Sales_invoice_model',
					'Sales_invoice_item_model',
					'Customers_model'
				)
			);
		}

		public function index() {
	        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
	        $data['title'] = 'Sales Report';

	        $this->load->view('sales_report_view',$data);
		}
	}
?>