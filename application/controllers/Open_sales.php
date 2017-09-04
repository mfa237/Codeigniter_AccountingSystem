<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Open_sales extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model('Purchases_model');
        $this->load->model('Purchase_items_model');
        $this->load->model('Sales_order_model');
        $this->load->model('Sales_order_item_model');
        $this->load->model('Products_model');
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


        $data['title'] = 'Open Sales';
        
        (in_array('12-5',$this->session->user_rights)? 
        $this->load->view('open_sales_view', $data)
        :redirect(base_url('dashboard')));

    }

    function transaction($txn = null,$id_filter=null) {
        switch ($txn){

                case'list2';
                        $m_sales=$this->Sales_order_item_model;
                       

                       $response['data']=$m_sales->get_list_open_sales();
                        echo json_encode($response);
                break;

 
                case'report';
                $m_company=$this->Company_model;
                $company_info=$m_company->get_list();
                $data['company_info']=$company_info[0];



                $m_sales=$this->Sales_order_item_model;
                $data['sales']=$m_sales->get_list_open_sales();

                $data['item']=$m_sales->get_so_no_of_open_sales();


                $this->load->view('template/open_sales_report',$data);
                break;
        }
    }
}


