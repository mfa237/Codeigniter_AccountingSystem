<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model('Sales_order_model');
        $this->load->model('Sales_order_item_model');
        $this->load->model('Salesperson_model');
        $this->load->model('Departments_model');
        $this->load->model('Customers_model');
        $this->load->model('Products_model');
        $this->load->model('Refproduct_model');
        $this->load->model('Users_model');

    }

    public function index() {
        $this->Users_model->validate();
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


        $data['refproducts']=$this->Refproduct_model->get_list(
            'is_deleted=FALSE'
        );

        $data['products']=$this->Products_model->get_list(
            null, //no id filter
            array(
                       'products.product_id',
                       'products.product_code',
                       'products.product_desc',
                       'products.product_desc1',
                       'products.is_tax_exempt',
                       'products.size',
                       'products.sale_price',
                       //'FORMAT(products.sale_price,2)as sale_price',
                       'FORMAT(products.purchase_cost,2)as purchase_cost',
                       'products.unit_id',
                       'products.on_hand',
                       'units.unit_name',
                       'tax_types.tax_type_id',
                       'tax_types.tax_rate'
            ),
            array(
                // parameter (table to join(left) , the reference field)
                array('units','units.unit_id=products.unit_id','left'),
                array('categories','categories.category_id=products.category_id','left'),
                array('tax_types','tax_types.tax_type_id=products.tax_type_id','left')

            )

        );

        $data['title'] = 'Sales Order';
        
        (in_array('3-1',$this->session->user_rights)? 
        $this->load->view('sales_order_view', $data)
        :redirect(base_url('dashboard')));

    }




    function transaction($txn = null,$id_filter=null) {
        switch ($txn){
            case 'list':  //this returns JSON of Issuance to be rendered on Datatable
                $m_sales_order=$this->Sales_order_model;
                $response['data']=$this->response_rows(
                    'sales_order.is_active=TRUE AND sales_order.is_deleted=FALSE'.($id_filter==null?'':' AND sales_order.sales_order_id='.$id_filter),
                    'sales_order.sales_order_id DESC'
                );
                echo json_encode($response);
                break;

            //***********************************************************************************************************
            case 'open':  //this returns PO that are already approved
                $m_sales_order=$this->Sales_order_model;
                //$where_filter=null,$select_list=null,$join_array=null,$order_by=null,$group_by=null,$auto_select_escape=TRUE,$custom_where_filter=null
                $response['data']= $m_sales_order->get_list(

                    'sales_order.is_deleted=FALSE AND sales_order.is_active=TRUE AND (sales_order.order_status_id=1 OR sales_order.order_status_id=3)',

                    array(
                        'sales_order.*',
                        'DATE_FORMAT(sales_order.date_order,"%m/%d/%Y") as date_order',
                        'customers.customer_name',
                        'order_status.order_status',
                        'departments.department_name'
                    ),
                    array(
                        array('customers','customers.customer_id=sales_order.customer_id','left'),
                        array('departments','departments.department_id=sales_order.department_id','left'),
                        array('order_status','order_status.order_status_id=sales_order.order_status_id','left')
                    ),
                    'sales_order.sales_order_id DESC'

                );
                echo json_encode($response);
                break;

            ////****************************************items/products of selected Items***********************************************
            case 'item-balance':
                $m_items=$this->Sales_order_item_model;
                $response['data']=$m_items->get_products_with_balance_qty_so($id_filter);
                echo json_encode($response);

                /*$m_items=$this->Sales_order_item_model;
                $response['data']=$m_items->get_products_with_balance_qty($id_filter);
                echo json_encode($response);*/
                break;

            ////****************************************items/products of selected Items***********************************************
            case 'items': //items on the specific PO, loads when edit button is called
                $m_items=$this->Sales_order_item_model;
                $response['data']=$m_items->get_list(
                    array('sales_order_id'=>$id_filter),
                    array(
                        'sales_order_items.*',
                        'products.product_code',
                        'products.product_desc',
                        'products.size',
                        'units.unit_id',
                        'units.unit_name'
                    ),
                    array(
                        array('products','products.product_id=sales_order_items.product_id','left'),
                        array('units','units.unit_id=sales_order_items.unit_id','left')
                    ),
                    'sales_order_items.sales_order_item_id DESC'
                );


                echo json_encode($response);
                break;


            //***************************************create new Items************************************************
            case 'create':
                $m_sales_order=$this->Sales_order_model;

                /*if(count($m_sales_order->get_list(array('so_no'=>$this->input->post('so_no',TRUE))))>0){
                    $response['title'] = 'Invalid!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'Slip No. already exists.';

                    echo json_encode($response);
                    exit;
                }*/

                $m_sales_order->begin();

                //treat NOW() as function and not string
                $m_sales_order->set('date_created','NOW()'); //treat NOW() as function and not string

                $m_sales_order->department_id=$this->input->post('department',TRUE);
                $m_sales_order->customer_id=$this->input->post('customer',TRUE);
                $m_sales_order->remarks=$this->input->post('remarks',TRUE);
                $m_sales_order->salesperson_id=$this->input->post('salesperson_id',TRUE);
                $m_sales_order->date_order=date('Y-m-d',strtotime($this->input->post('date_order',TRUE)));
                $m_sales_order->total_discount=$this->get_numeric_value($this->input->post('summary_discount',TRUE));
                $m_sales_order->total_before_tax=$this->get_numeric_value($this->input->post('summary_before_discount',TRUE));
                $m_sales_order->total_tax_amount=$this->get_numeric_value($this->input->post('summary_tax_amount',TRUE));
                $m_sales_order->total_after_tax=$this->get_numeric_value($this->input->post('summary_after_tax',TRUE));
                $m_sales_order->posted_by_user=$this->session->user_id;
                $m_sales_order->save();

                $sales_order_id=$m_sales_order->last_insert_id();

                $m_sales_order_items=$this->Sales_order_item_model;

                $prod_id=$this->input->post('product_id',TRUE);
                $so_qty=$this->input->post('so_qty',TRUE);
                $so_price=$this->input->post('so_price',TRUE);
                $so_discount=$this->input->post('so_discount',TRUE);
                $so_line_total_discount=$this->input->post('so_line_total_discount',TRUE);
                $so_tax_rate=$this->input->post('so_tax_rate',TRUE);
                $so_line_total_price=$this->input->post('so_line_total_price',TRUE);
                $so_tax_amount=$this->input->post('so_tax_amount',TRUE);
                $so_non_tax_amount=$this->input->post('so_non_tax_amount',TRUE);

                $batch_no=$this->input->post('batch_no',TRUE);
                $exp_date=$this->input->post('exp_date',TRUE);


                for($i=0;$i<count($prod_id);$i++){

                    $m_sales_order_items->sales_order_id=$sales_order_id;
                    $m_sales_order_items->product_id=$this->get_numeric_value($prod_id[$i]);
                    $m_sales_order_items->so_qty=$this->get_numeric_value($so_qty[$i]);
                    $m_sales_order_items->so_price=$this->get_numeric_value($so_price[$i]);
                    $m_sales_order_items->so_discount=$this->get_numeric_value($so_discount[$i]);
                    $m_sales_order_items->so_line_total_discount=$this->get_numeric_value($so_line_total_discount[$i]);
                    $m_sales_order_items->so_tax_rate=$this->get_numeric_value($so_tax_rate[$i]);
                    $m_sales_order_items->so_line_total_price=$this->get_numeric_value($so_line_total_price[$i]);
                    $m_sales_order_items->so_tax_amount=$this->get_numeric_value($so_tax_amount[$i]);
                    $m_sales_order_items->so_non_tax_amount=$this->get_numeric_value($so_non_tax_amount[$i]);

                    $m_sales_order_items->batch_no=$batch_no[$i];
                    $m_sales_order_items->exp_date=date('Y-m-d', strtotime($exp_date[$i]));

                    $m_sales_order_items->set('unit_id','(SELECT unit_id FROM products WHERE product_id='.(int)$prod_id[$i].')');
                    $m_sales_order_items->save();
                }

                //update so number base on formatted last insert id
                $m_sales_order->so_no='SO-'.date('Ymd').'-'.$sales_order_id;
                $m_sales_order->modify($sales_order_id);



                $m_sales_order->commit();



                if($m_sales_order->status()===TRUE){
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Sales order successfully created.';
                    $response['row_added']=$this->response_rows($sales_order_id);

                    echo json_encode($response);
                }


                break;


            ////***************************************update Items************************************************
            case 'update':
                $m_sales_order=$this->Sales_order_model;
                $sales_order_id=$this->input->post('sales_order_id',TRUE);


                //get sales order id base on SO number
                $m_so=$this->Sales_order_model;
                $arr_so_info=$m_so->get_list(
                    array('sales_order.so_no'=>$this->input->post('so_no',TRUE)),
                    'sales_order.sales_order_id'
                );
                // $sales_order_id=(count($arr_so_info)>0?$arr_so_info[0]->sales_order_id:0);



                $m_sales_order->begin();

                $m_sales_order->department_id=$this->input->post('department',TRUE);
                $m_sales_order->remarks=$this->input->post('remarks',TRUE);
                $m_sales_order->customer_id=$this->input->post('customer',TRUE);
                $m_sales_order->salesperson_id=$this->input->post('salesperson_id',TRUE);
                $m_sales_order->date_order=date('Y-m-d',strtotime($this->input->post('date_order',TRUE)));

                $m_sales_order->total_discount=$this->get_numeric_value($this->input->post('summary_discount',TRUE));
                $m_sales_order->total_before_tax=$this->get_numeric_value($this->input->post('summary_before_discount',TRUE));
                $m_sales_order->total_tax_amount=$this->get_numeric_value($this->input->post('summary_tax_amount',TRUE));
                $m_sales_order->total_after_tax=$this->get_numeric_value($this->input->post('summary_after_tax',TRUE));
                $m_sales_order->modified_by_user=$this->session->user_id;
                $m_sales_order->modify($sales_order_id);


                $m_sales_order_items=$this->Sales_order_item_model;

                $m_sales_order_items->delete_via_fk($sales_order_id); //delete previous items then insert those new

                $prod_id=$this->input->post('product_id',TRUE);
                $so_price=$this->input->post('so_price',TRUE);
                $so_discount=$this->input->post('so_discount',TRUE);
                $so_line_total_discount=$this->input->post('so_line_total_discount',TRUE);
                $so_tax_rate=$this->input->post('so_tax_rate',TRUE);
                $so_qty=$this->input->post('so_qty',TRUE);
                $so_line_total_price=$this->input->post('so_line_total_price',TRUE);
                $so_tax_amount=$this->input->post('so_tax_amount',TRUE);
                $so_non_tax_amount=$this->input->post('so_non_tax_amount',TRUE);

                $batch_no=$this->input->post('batch_no',TRUE);
                $exp_date=$this->input->post('exp_date',TRUE);

                for($i=0;$i<count($prod_id);$i++){

                    $m_sales_order_items->sales_order_id=$sales_order_id;
                    $m_sales_order_items->product_id=$this->get_numeric_value($prod_id[$i]);
                    $m_sales_order_items->so_price=$this->get_numeric_value($so_price[$i]);
                    $m_sales_order_items->so_discount=$this->get_numeric_value($so_discount[$i]);
                    $m_sales_order_items->so_line_total_discount=$this->get_numeric_value($so_line_total_discount[$i]);
                    $m_sales_order_items->so_tax_rate=$this->get_numeric_value($so_tax_rate[$i]);
                    $m_sales_order_items->so_qty=$this->get_numeric_value($so_qty[$i]);
                    $m_sales_order_items->so_line_total_price=$this->get_numeric_value($so_line_total_price[$i]);
                    $m_sales_order_items->so_tax_amount=$this->get_numeric_value($so_tax_amount[$i]);
                    $m_sales_order_items->so_non_tax_amount=$this->get_numeric_value($so_non_tax_amount[$i]);

                    $m_sales_order_items->batch_no=$batch_no[$i];
                    $m_sales_order_items->exp_date=date('Y-m-d', strtotime($exp_date[$i]));

                    $m_sales_order_items->set('unit_id','(SELECT unit_id FROM products WHERE product_id='.(int)$prod_id[$i].')');
                    $m_sales_order_items->save();
                }



                $m_sales_order->commit();



                if($m_sales_order->status()===TRUE){
                    $response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Sales order successfully updated.';
                    $response['row_updated']=$this->response_rows($sales_order_id);

                    echo json_encode($response);
                }


                break;


            //***************************************************************************************
            case 'delete':
                $m_sales_order=$this->Sales_order_model;
                $sales_order_id=$this->input->post('sales_order_id',TRUE);

                //mark Items as deleted
                $m_sales_order->set('date_deleted','NOW()'); //treat NOW() as function and not string
                $m_sales_order->deleted_by_user=$this->session->user_id;//user that deleted the record
                $m_sales_order->is_deleted=1;//mark as deleted
                $m_sales_order->modify($sales_order_id);


                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Record successfully deleted.';
                echo json_encode($response);

                break;

            //***************************************************************************************
        }

    }



//**************************************user defined*************************************************
    function response_rows($filter_value){

        return $this->Sales_order_model->get_list(

            $filter_value,

            array(
                'sales_order.sales_order_id',
                'sales_order.so_no',
                'sales_order.remarks',
                'sales_order.date_created',
                'sales_order.customer_id',
                'sales_order.salesperson_id',
                'DATE_FORMAT(sales_order.date_order,"%m/%d/%Y") as date_order',
                'departments.department_id',
                'departments.department_name',
                'customers.customer_name',
                'order_status.order_status'
            ),

            array(
                array('departments','departments.department_id=sales_order.department_id','left'),
                array('customers','customers.customer_id=sales_order.customer_id','left'),
                array('order_status','order_status.order_status_id=sales_order.order_status_id','left')
            ),
            'sales_order.sales_order_id DESC'


        );

    }





//***************************************************************************************





}
