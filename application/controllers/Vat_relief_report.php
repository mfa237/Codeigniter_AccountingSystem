<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vat_relief_report extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Delivery_invoice_model',
					'Users_model',
					'Company_model'
				)
			);
		}

		public function index()
		{	$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
	        $data['title'] = 'VAT Relief Report';
        (in_array('9-10',$this->session->user_rights)? 
        $this->load->view('vat_relief_report_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null) {
			switch($txn) {
				case 'list':
					$m_delivery_inv=$this->Delivery_invoice_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));

					$response['data']=$m_delivery_inv->get_vat_relief($startDate,$endDate);

					echo json_encode($response);
				break;

				case 'report':
					$m_delivery_inv=$this->Delivery_invoice_model;
					$m_company=$this->Company_model;

					$startDate=date("Y-m-d",strtotime($this->input->get('start',TRUE)));
					$endDate=date("Y-m-d",strtotime($this->input->get('end',TRUE)));

					$company_info=$m_company->get_list();
					$data['company_info']=$company_info[0];
					$data['suppliers']=$m_delivery_inv->get_vat_relief_supplier_list($startDate,$endDate);
					$data['vat_reliefs']=$m_delivery_inv->get_vat_relief($startDate,$endDate);

					$this->load->view('template/vat_relief_report_content',$data);
				break;
			}
		}
	}
?>