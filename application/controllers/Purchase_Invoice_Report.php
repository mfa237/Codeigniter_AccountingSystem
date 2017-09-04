<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Purchase_Invoice_Report extends CORE_Controller
	{
		
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();
			$this->load->model(
				array(
					'Delivery_invoice_model',
					'Suppliers_model',
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
	        $data['title'] = 'Purchase Invoice Report';
        (in_array('8-4',$this->session->user_rights)? 
        $this->load->view('purchase_invoice_report_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null){
			switch($txn){
				case 'summary':

					$start_Date=date('Y-m-d',strtotime($this->input->get('startDate',TRUE)));
					$end_Date=date('Y-m-d',strtotime($this->input->get('endDate',TRUE)));
					$m_delivery_invoice=$this->Delivery_invoice_model;

					$response['data']=$m_delivery_invoice->get_report_summary($start_Date,$end_Date);
					echo json_encode($response);

				break;

				case 'detailed':

					$start_Date=date('Y-m-d',strtotime($this->input->get('startDate',TRUE)));
					$end_Date=date('Y-m-d',strtotime($this->input->get('endDate',TRUE)));
					$m_delivery_invoice=$this->Delivery_invoice_model;

					$response['data']=$m_delivery_invoice->get_report_detailed($start_Date,$end_Date);
					echo json_encode($response);

				break;

	            case 'purchase-invoice':
	                $m_company_info=$this->Company_model;

	                $company_info=$m_company_info->get_list();
	                $data['company_info']=$company_info[0];

	                $m_delivery_invoice=$this->Delivery_invoice_model;

	                $type=$this->input->get('type');
	                $startDate=date('Y-m-d',strtotime($this->input->get('startDate')));
	                $endDate=date('Y-m-d',strtotime($this->input->get('endDate')));


	                if ($type=='summary') {

                        $data['suppliers']=$m_delivery_invoice->get_list(
                            'date_delivered BETWEEN "'.$startDate.'" AND "'.$endDate.'" AND delivery_invoice.is_active=TRUE AND delivery_invoice.is_deleted=FALSE',
                            'DISTINCT(suppliers.supplier_name), delivery_invoice.supplier_id',
                            array(
                                array('suppliers','suppliers.supplier_id=delivery_invoice.supplier_id','left')
                            )
                        );

                        $data['purchase_invoice_summary']=$m_delivery_invoice->get_report_summary($startDate,$endDate);
	                	$this->load->view('template/purchase_invoice_summary',$data);
	                } 

	                if ($type=='detailed') {


                        $data['invoice_numbers']=$m_delivery_invoice->get_list(
                            'date_delivered BETWEEN "'.$startDate.'" AND "'.$endDate.'" AND  delivery_invoice.is_active=TRUE AND delivery_invoice.is_deleted=FALSE',
                            'DISTINCT(delivery_invoice.dr_invoice_no), delivery_invoice.supplier_id,delivery_invoice.dr_invoice_id,delivery_invoice.supplier_id,suppliers.supplier_name',
                            array(
                                array('suppliers','suppliers.supplier_id=delivery_invoice.supplier_id','left')
                            )
                        );



                        $data['purchase_invoice_detailed']=$m_delivery_invoice->get_report_detailed($startDate,$endDate);
	                	$this->load->view('template/purchase_invoice_detailed',$data);
	                }
	            break;
			}
		}
	}
?>