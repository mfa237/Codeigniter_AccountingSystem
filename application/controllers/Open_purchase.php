<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Open_purchase extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model('Delivery_invoice_model');
        $this->load->model('Products_model');
        $this->load->model('Delivery_invoice_item_model');
        $this->load->model('Purchases_model');
        $this->load->model('Purchase_items_model');
        $this->load->model('Departments_model');
        $this->load->model('Users_model');
        $this->load->model('Company_model');

    }

    public function index() {
        $this->Users_model->validate();
        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);


        $data['title'] = 'Open Purchases';
        
        (in_array('12-4',$this->session->user_rights)? 
        $this->load->view('Open_purchase_view', $data)
        :redirect(base_url('dashboard')));

    }

    function transaction($txn = null,$id_filter=null) {
        switch ($txn){

                case'list2';
                        $m_purchases=$this->Purchase_items_model;
                       

                       $response['data']=$m_purchases->get_list_open_purchase();
                        echo json_encode($response);
                break;

 
                case'report';
                $m_company=$this->Company_model;
                $company_info=$m_company->get_list();
                $data['company_info']=$company_info[0];



                $m_purchases=$this->Purchase_items_model;
                $data['purchase']=$m_purchases->get_list_open_purchase();
                $data['item']=$m_purchases->get_po_no_of_open_purchase();


                $this->load->view('template/open_purchase_report',$data);
                break;
        }
    }
}


