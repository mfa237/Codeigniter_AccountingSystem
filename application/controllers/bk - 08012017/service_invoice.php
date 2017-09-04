<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service_invoice extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();


        $this->load->model('Sales_order_model');
        $this->load->model('Departments_model');
        $this->load->model('Customers_model');
        $this->load->model('Salesperson_model');
        $this->load->model('Service_invoice_model');
        $this->load->model('Service_invoice_item_model');
        $this->load->model('Services_model');

    }

    public function index() {

        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);


        //data required by active view
        $data['departments']=$this->Departments_model->get_list(
            array('departments.is_active'=>TRUE,'departments.is_deleted'=>FALSE)
        );

        $data['salespersons']=$this->Salesperson_model->get_list(
            array('salesperson.is_active'=>TRUE,'salesperson.is_deleted'=>FALSE),
            'salesperson_id, acr_name, CONCAT(firstname, " ", middlename, " ", lastname) AS fullname, firstname, middlename, lastname'
        );

        //data required by active view
        $data['customers']=$this->Customers_model->get_list(
            array('customers.is_active'=>TRUE,'customers.is_deleted'=>FALSE)
        );


        $data['services'] = $this->Services_model->get_list(
            array('services.is_active'=>TRUE,'services.is_deleted'=>FALSE), 
            array(
                
                'services.*',
                'service_unit.*'

                ),

            array(
                array('service_unit','service_unit.service_unit_id=services.service_unit','left')
                )   
            );




        $data['title'] = 'Service Invoice';
        $this->load->view('service_invoice_view', $data);
    }


    function transaction($txn = null,$id_filter=null) {
        switch ($txn){

            //******************************************* Datatable when page loads ****************************************************************
            case 'list-invoice' :
                $m_invoice = $this->Service_invoice_model;
                $response['data']= $this->response_rows_invoice(
                     'service_invoice.is_active=TRUE AND service_invoice.is_deleted=FALSE'.($id_filter==null?'':' AND service_invoice.service_invoice_id='.$id_filter)
                   
                    );
                echo json_encode($response);

                break;

            ////****************************************items/products of selected Items***********************************************
            case 'items-invoice':
                $m_items=$this->Service_invoice_item_model;
                $response['data']=$m_items->get_list(
                    array('service_invoice_id'=>$id_filter),
                    array(
                        'service_invoice_items.*',
                        'services`.service_code',
                        'services.service_desc',
                        'services.service_unit',
                        'service_unit.service_unit_id',
                        'service_unit.service_unit_name'
                    ),
                    array(
                        array('services','services.service_id=service_invoice_items.service_id','left'),
                        array('service_unit','service_unit.service_unit_id=service_invoice_items.service_unit','left')
                    ),
                    'service_invoice_items.service_item_id ASC'
                );


                echo json_encode($response);

                break;


            //***************************************create new Items************************************************
            case 'create-invoice':
                $m_invoice=$this->Service_invoice_model;
                
                $m_invoice->set('date_created','NOW()');
                $m_invoice->customer_id=$this->input->post('customer',TRUE);
                $m_invoice->salesperson_id=$this->input->post('salesperson_id',TRUE);
                $m_invoice->department_id=$this->input->post('department',TRUE);
                $m_invoice->address=$this->input->post('address',TRUE);
                $m_invoice->remarks=$this->input->post('remarks',TRUE);
                $m_invoice->date_due=date('Y-m-d',strtotime($this->input->post('date_due',TRUE)));
                $m_invoice->date_invoice=date('Y-m-d',strtotime($this->input->post('date_invoice',TRUE)));
                $m_invoice->total_amount=$this->get_numeric_value($this->input->post('summary_total_amount',TRUE));
                $m_invoice->posted_by_user=$this->session->user_id;
                $m_invoice->save();


                $service_invoice_id=$m_invoice->last_insert_id();


                $m_invoice_items=$this->Service_invoice_item_model;
                //prepare the items with multiple values for looping statement
                $service_id = $this->input->post('service_id');
                $service_qty = $this->input->post('qty');
                $service_price = $this->input->post('service_price');
                $service_line_total = $this->input->post('line_total');
                $service_unit = $this->input->post('service_unit');
                

                for($i=0;$i<count($service_id);$i++){
                $m_invoice_items->service_invoice_id=$service_invoice_id;
                $m_invoice_items->service_id=$this->get_numeric_value($service_id[$i]);
                $m_invoice_items->service_qty=$this->get_numeric_value($service_qty[$i]);
                $m_invoice_items->service_price=$this->get_numeric_value($service_price[$i]);
                $m_invoice_items->service_line_total=$this->get_numeric_value($service_line_total[$i]);
                $m_invoice_items->service_unit=$this->get_numeric_value($service_unit[$i]);

                $m_invoice_items->save();
                }
                $m_invoice->service_invoice_no='INV-'.date('Ymd').'-'.$service_invoice_id;
                $m_invoice->modify($service_invoice_id);

                if($m_invoice->status()===TRUE){
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Service invoice successfully created.';
                    $response['row_added']=$this->response_rows_invoice($service_invoice_id);

                    echo json_encode($response);
                }

                break;
            



            ////***************************************update Items************************************************
            case 'update-invoice':
                $m_invoice=$this->Service_invoice_model;
                
                $service_invoice_id=$this->input->post('service_invoice_id',TRUE);

                $m_invoice->set('date_created','NOW()');
                $m_invoice->customer_id=$this->input->post('customer',TRUE);
                $m_invoice->salesperson_id=$this->input->post('salesperson_id',TRUE);
                $m_invoice->department_id=$this->input->post('department',TRUE);
                $m_invoice->address=$this->input->post('address',TRUE);
                $m_invoice->remarks=$this->input->post('remarks',TRUE);
                $m_invoice->date_due=date('Y-m-d',strtotime($this->input->post('date_due',TRUE)));
                $m_invoice->date_invoice=date('Y-m-d',strtotime($this->input->post('date_invoice',TRUE)));
                $m_invoice->total_amount=$this->get_numeric_value($this->input->post('summary_total_amount',TRUE));
                $m_invoice->modified_by_user=$this->session->user_id;
                $m_invoice->modify($service_invoice_id);


                $m_invoice_items=$this->Service_invoice_item_model;


                
                $m_invoice_items->delete_via_fk($service_invoice_id); 
                //prepare the items with multiple values for looping statement
                $service_id = $this->input->post('service_id');
                $service_qty = $this->input->post('qty');
                $service_price = $this->input->post('service_price');
                $service_line_total = $this->input->post('line_total');
                $service_unit = $this->input->post('service_unit');
                

                for($i=0;$i<count($service_id);$i++){
                $m_invoice_items->service_invoice_id=$service_invoice_id;
                $m_invoice_items->service_id=$this->get_numeric_value($service_id[$i]);
                $m_invoice_items->service_qty=$this->get_numeric_value($service_qty[$i]);
                $m_invoice_items->service_price=$this->get_numeric_value($service_price[$i]);
                $m_invoice_items->service_line_total=$this->get_numeric_value($service_line_total[$i]);
                $m_invoice_items->service_unit=$this->get_numeric_value($service_unit[$i]);

                $m_invoice_items->save();
                }
                $m_invoice->service_invoice_no='INV-'.date('Ymd').'-'.$service_invoice_id;
                $m_invoice->modify($service_invoice_id);

                if($m_invoice->status()===TRUE){
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Service invoice successfully updated.';
                    $response['row_updated']=$this->response_rows_invoice($service_invoice_id);

                    echo json_encode($response);
                }

                break;


           

            //***************************************************************************************
            case 'delete':

                $m_invoice=$this->Service_invoice_model;
                $service_invoice_id=$this->input->post('service_invoice_id',TRUE);

                //mark Items as deleted
                $m_invoice->set('date_deleted','NOW()'); //treat NOW() as function and not string
                $m_invoice->deleted_by_user=$this->session->user_id;//user that deleted the record
                $m_invoice->is_deleted=1;//mark as deleted
                $m_invoice->modify($service_invoice_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Record successfully deleted.';
                echo json_encode($response);

                break;

            // ******************* Service Invoices for review in Service Journal *************************

            case 'service-for-review' :

            $m_invoice=$this->Service_invoice_model;
            $response['data']=$m_invoice->get_list(

                    array(
                        'service_invoice.is_active'=>TRUE,
                        'service_invoice.is_deleted'=>FALSE,
                        'service_invoice.is_journal_posted'=>FALSE
                    ),

                    array(
                        'service_invoice.service_invoice_id',
                        'service_invoice.service_invoice_no',
                        'service_invoice.remarks',
                        'DATE_FORMAT(service_invoice.date_invoice,"%m/%d/%Y") as date_invoice',
                        'customers.customer_name'
                    ), 
                    array(
                        array('customers','customers.customer_id=service_invoice.customer_id','left')
                    ),

                     'service_invoice.service_invoice_id DESC'

                );
            echo json_encode($response);
            break;

            
        }

    }



//**************************************user defined*************************************************


function response_rows_invoice($filter_value){
          
            return $this->Service_invoice_model->get_list(
                    $filter_value,

                    array(
                    'service_invoice.service_invoice_id',
                    'service_invoice.service_invoice_no',
                    'service_invoice.department_id',
                    'service_invoice.customer_id',
                    'service_invoice.salesperson_id',
                    'service_invoice.service_invoice_no',
                    'service_invoice.address',
                    'service_invoice.remarks',
                    'DATE_FORMAT(service_invoice.date_invoice,"%m/%d/%Y") as date_invoice',
                   'DATE_FORMAT(service_invoice.date_due,"%m/%d/%Y") as date_due',
                    'customers.customer_name',
                    'departments.department_name'
)

                    ,
                    array(
                array('departments','departments.department_id=service_invoice.department_id','left'),
                array('customers','customers.customer_id=service_invoice.customer_id','left')
                        ),
                    'service_invoice.service_invoice_id DESC'


                    );


}





}
