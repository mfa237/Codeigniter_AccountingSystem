<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_detailed_summary extends CORE_Controller {

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
            'Sales_invoice_model',
            'Company_model',
            'Users_model',
            'Customers_model'
        ));

    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);

        $data['customers']=$this->Customers_model->get_customer_list_for_sales_report();

        $data['title']='Sales Report';
        

        (in_array('8-1',$this->session->user_rights)? 
        $this->load->view('sales_detailed_summary_view',$data)
        :redirect(base_url('dashboard')));
    }


    function transaction($txn=null){
        switch($txn){
            case 'per-sales-detailed':
                $m_sales_invoice=$this->Sales_invoice_model;
                $start=date("Y-m-d",strtotime($this->input->get('startDate',TRUE)));
                $end=date("Y-m-d",strtotime($this->input->get('endDate',TRUE)));

                $response['data']=$m_sales_invoice->get_sales_detailed_list($start,$end);

                echo(
                json_encode($response)
                );
            break;

            case 'per-sales-summary':
                $m_sales_invoice=$this->Sales_invoice_model;
                $start=date("Y-m-d",strtotime($this->input->get('startDate',TRUE)));
                $end=date("Y-m-d",strtotime($this->input->get('endDate',TRUE)));

                $response['data']=$m_sales_invoice->get_sales_summary_list($start,$end);

                echo(
                json_encode($response)
                );
            break;

            case 'product-sales-summary':   
                $m_sales_invoice=$this->Sales_invoice_model;
                $start=date("Y-m-d",strtotime($this->input->get('startDate',TRUE)));
                $end=date("Y-m-d",strtotime($this->input->get('endDate',TRUE)));

                $response['data']=$m_sales_invoice->get_sales_product_summary_list($start,$end);

                echo(
                json_encode($response)
                );
            break;

            case 'summary-report-smc':
                $m_company_info=$this->Company_model;
                $m_sales_invoice=$this->Sales_invoice_model;

                $company_info=$m_company_info->get_list();
                $data['company_info']=$company_info[0];

                $startDate=date('Y-m-d',strtotime($this->input->get('startDate')));
                $endDate=date('Y-m-d',strtotime($this->input->get('endDate')));
                $type=$this->input->get('type',TRUE);

                $data['sales_summaries']=$m_sales_invoice->get_sales_summary_list($startDate,$endDate);

                $data['product_summaries']=$m_sales_invoice->get_sales_product_summary_list($startDate,$endDate);

                if ($type == 'c') {
                    $this->load->view('template/sales_report_customer_summary',$data);
                } else if ($type == 'sp') {
                    $this->load->view('template/sales_report_salesperson_summary',$data);
                } else if ($type == 'p') {
                    $this->load->view('template/sales_report_product_summary',$data);
                }
            break;

            case 'detailed-report-smcp': 
                $m_company_info=$this->Company_model;
                $m_sales_invoice=$this->Sales_invoice_model;

                $company_info=$m_company_info->get_list();
                $data['company_info']=$company_info[0];

                $startDate=date('Y-m-d',strtotime($this->input->get('startDate')));
                $endDate=date('Y-m-d',strtotime($this->input->get('endDate')));
                $type=$this->input->get('type',TRUE);

                $data['customers']=$m_sales_invoice->get_list(
                    'date_invoice BETWEEN "'.$startDate.'" AND "'.$endDate.'"  AND sales_invoice.is_deleted=FALSE',
                    'c.customer_id, c.customer_name',
                    array(
                        array('customers as c','c.customer_id=sales_invoice.customer_id','left')
                    )
                );

                $data['salespersons']=$m_sales_invoice->get_list(
                    'date_invoice BETWEEN "'.$startDate.'" AND "'.$endDate.'" AND sales_invoice.is_deleted=FALSE',
                    'sp.salesperson_id, 
                    sp.salesperson_code, 
                    CONCAT(sp.firstname," ",sp.lastname) AS salesperson_name',
                    array(
                        array('salesperson as sp','sp.salesperson_id=sales_invoice.salesperson_id','left')
                    )
                );

                $data['sales_details']=$m_sales_invoice->get_sales_detailed_list($startDate,$endDate);

                if ($type == 'c') {
                    $this->load->view('template/sales_report_customer_detailed',$data);
                } else if ($type == 'sp') {
                    $this->load->view('template/sales_report_salesperson_detailed',$data);
                } else {
                    $this->load->view('template/sales_report_product_detailed',$data);
                }
            break;
        }
    }



}
