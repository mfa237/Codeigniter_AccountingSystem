<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cogs extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model(array(
            'Departments_model',
            'Products_model',
            'Delivery_invoice_model',
            'Delivery_invoice_item_model',
            'Users_model',
            'Company_model'
        ));

    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);

        $data['title'] = 'Cost of Good Sold Report';
        $data['departments']=$this->Departments_model->get_list('is_deleted=0');
        (in_array('9-12',$this->session->user_rights)? 
        $this->load->view('cost_of_good_sold_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    function transaction($txn=null){
        switch($txn){
            case 'print':
                $company_info=$this->Company_model->get_list();
                $params['company_info']=$company_info[0];

                $data['inv_begin']=$this->input->post('inv_begin');
                $data['purchases']=$this->input->post('purchases');
                $data['goodsForSale']=$this->input->post('goodsForSale');
                $data['inv_end']=$this->input->post('inv_end');
                $data['cogs']=$this->input->post('cogs');
                $data['department']=$this->Departments_model->get_list($this->input->post('department'));
                $data['company_header']=$this->load->view('template/company_header',$params,TRUE);

                $this->load->view('template/cogs_report',$data);

                break;

            case 'merchandise-inventory':
                $m_products=$this->Products_model;

                $start=$this->input->get('start',TRUE);
                $end=$this->input->get('end',TRUE);
                $depid=$this->input->get('depid',TRUE);

                $new_date=date('Y-m-d',strtotime ( '-1 day' , strtotime($start) )  );


                $response['data']=$m_products->get_inventory_costing($new_date,$depid);
                echo json_encode($response);

                break;

            case 'merchandise-inventory-ending':
                $m_products=$this->Products_model;

                $start=date('Y-m-d', strtotime($this->input->get('start',TRUE)));
                $end=date('Y-m-d', strtotime($this->input->get('end',TRUE)));
                $depid=$this->input->get('depid',TRUE);

                $response['data']=$m_products->get_inventory_costing($end,$depid);
                echo json_encode($response);

                break;

            case 'purchases':

                $m_purchases=$this->Delivery_invoice_item_model;

                $start=date('Y-m-d',strtotime($this->input->get('start',TRUE)));
                $end=date('Y-m-d',strtotime($this->input->get('end',TRUE)));
                $depid=$this->input->get('depid',TRUE);

                $response['data']=$m_purchases->get_list(

                    "di.date_delivered BETWEEN '".$start."' AND '".$end."'".($depid==1||$depid==null?"":" AND di.department_id=".$depid),

                    array(
                        'p.product_desc',
                        'delivery_invoice_items.dr_qty',
                        'FORMAT(delivery_invoice_items.dr_price,4)as dr_price',
                        'FORMAT(delivery_invoice_items.dr_line_total_price,4)as dr_line_total_price',
                        'di.dr_invoice_no',
                        'DATE_FORMAT(di.date_delivered,"%M %d, %Y")as delivered_date',
                        'di.date_delivered',
                        's.supplier_name'
                    ),
                    array(
                        array( 'delivery_invoice as di','di.dr_invoice_id=delivery_invoice_items.dr_invoice_id','left'),
                        array( 'products as p','p.product_id=delivery_invoice_items.product_id','left'),
                        array( 'suppliers as s','s.supplier_id=di.supplier_id','left')
                    )

                );
                echo json_encode($response);
                break;
        }
    }

}
