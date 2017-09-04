<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->library('excel');
        $this->load->model('Products_model');
        $this->load->model('Categories_model');
        $this->load->model('Units_model');
        $this->load->model('Item_type_model');
        $this->load->model('Account_title_model');
        $this->load->model('Refproduct_model');
        $this->load->model('Suppliers_model');
        $this->load->model('Tax_model');
        $this->load->model('Purchases_model');
        $this->load->model('Purchase_items_model');
        $this->load->model('Sales_order_model');
        $this->load->model('Sales_order_item_model');
        $this->load->model('Sales_invoice_model');
        $this->load->model('Sales_invoice_item_model');
        $this->load->model('Issuance_model');
        $this->load->model('Issuance_item_model');
        $this->load->model('Delivery_invoice_model');
        $this->load->model('Delivery_invoice_item_model');
        $this->load->model('Users_model');
        $this->load->model('Account_integration_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Product Management';

        $data['tax_types']=$this->Tax_model->get_list();
        $data['suppliers']=$this->Suppliers_model->get_list(
            array('suppliers.is_deleted'=>FALSE),
            'suppliers.*,IFNULL(tax_types.tax_rate,0)as tax_rate',
            array(
                array('tax_types','tax_types.tax_type_id=suppliers.tax_type_id','left')
            )
        );
        $data['refproduct'] = $this->Refproduct_model->get_list(array('refproduct.is_deleted'=>FALSE));
        $data['categories'] = $this->Categories_model->get_list(array('categories.is_deleted'=>FALSE));
        $data['units'] = $this->Units_model->get_list(array('units.is_deleted'=>FALSE));
        $data['item_types'] = $this->Item_type_model->get_list(array('item_types.is_deleted'=>FALSE));
        $data['accounts'] = $this->Account_title_model->get_list(null,'account_id,account_title');
        $data['tax_types']=$this->Tax_model->get_list(array('tax_types.is_deleted'=>FALSE));
        (in_array('5-1',$this->session->user_rights)? 
        $this->load->view('products_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_products = $this->Products_model;

                $account_integration =$this->Account_integration_model;
                $a_i=$account_integration->get_list();
                $account =$a_i[0]->sales_invoice_inventory;

                $response['data']=$m_products->product_list($account);
                // $response['data']=$this->response_rows(array('products.is_deleted'=>FALSE));
                echo json_encode($response);
                break;

            case 'getproduct':
                $refproduct_id = $this->input->post('refproduct_id', TRUE);
                $get = "";

                if($refproduct_id == 1){
                    $get = array('products.refproduct_id'=>$refproduct_id,'products.is_deleted'=>FALSE);
                }

                elseif($refproduct_id == 2){
                    $get = array('products.refproduct_id'=>$refproduct_id,'products.is_deleted'=>FALSE);
                }

                else {
                    $get = array('products.is_deleted'=>FALSE);
                }

                $response['data'] = $this->response_rows($get);
                echo json_encode($response);
                break;

            case 'create':
                $m_products = $this->Products_model;

                $m_products->set('date_created','NOW()');
                $m_products->created_by_user = $this->session->user_id;

                $m_products->product_code = $this->input->post('product_code', TRUE);
                $m_products->product_desc = $this->input->post('product_desc', TRUE);
                $m_products->product_desc1 = $this->input->post('product_desc1', TRUE);
                $m_products->size = $this->input->post('size', TRUE);
                $m_products->supplier_id = $this->input->post('supplier_id', TRUE);
                $m_products->category_id = $this->input->post('category_id', TRUE);
                $m_products->refproduct_id = $this->input->post('refproduct_id', TRUE);
                $m_products->item_type_id = $this->input->post('item_type_id', TRUE);
                $m_products->income_account_id = $this->input->post('income_account_id', TRUE);
                $m_products->expense_account_id = $this->input->post('expense_account_id', TRUE);
                $m_products->unit_id = $this->input->post('unit_id', TRUE);

                $m_products->tax_type_id = $this->input->post('tax_type_id', TRUE);
                //$m_products->is_inventory = $this->input->post('inventory',TRUE);

                 //im not sure, why posted checkbox post value of 0 when checked
                $m_products->is_tax_exempt =($this->input->post('is_tax_exempt',TRUE)==null?0:1);

                $m_products->equivalent_points = $this->get_numeric_value($this->input->post('equivalent_points', TRUE));
                $m_products->product_warn =$this->get_numeric_value( $this->input->post('product_warn', TRUE));
                $m_products->product_ideal =$this->get_numeric_value( $this->input->post('product_ideal', TRUE));
                //$m_products->markup_percent = $this->input->post('markup_percent', TRUE);
                $m_products->sale_price =$this->get_numeric_value($this->input->post('sale_price', TRUE));
                $m_products->purchase_cost =$this->get_numeric_value($this->input->post('purchase_cost', TRUE));
                $m_products->purchase_cost_2 =$this->get_numeric_value($this->input->post('purchase_cost_2', TRUE));
                $m_products->discounted_price =$this->get_numeric_value($this->input->post('discounted_price', TRUE));
                $m_products->dealer_price =$this->get_numeric_value($this->input->post('dealer_price', TRUE));
                $m_products->distributor_price =$this->get_numeric_value($this->input->post('distributor_price', TRUE));
                $m_products->public_price =$this->get_numeric_value($this->input->post('public_price', TRUE));

                $m_products->save();

                $product_id = $m_products->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Product Information successfully created.';

                $response['row_added'] = $this->response_rows($product_id);
                echo json_encode($response);

                break;

            case 'update':
                $account_integration =$this->Account_integration_model;
                $a_i=$account_integration->get_list();
                $account =$a_i[0]->sales_invoice_inventory;


                $m_products=$this->Products_model;


                $product_id=$this->input->post('product_id',TRUE);

                $m_products->set('date_modified','NOW()');
                $m_products->modified_by_user = $this->session->user_id;

                $m_products->product_code = $this->input->post('product_code', TRUE);
                $m_products->product_desc = $this->input->post('product_desc', TRUE);
                $m_products->product_desc1 = $this->input->post('product_desc1', TRUE);
                $m_products->size = $this->input->post('size', TRUE);
                $m_products->supplier_id = $this->input->post('supplier_id', TRUE);
                $m_products->category_id = $this->input->post('category_id', TRUE);
                $m_products->refproduct_id = $this->input->post('refproduct_id', TRUE);
                $m_products->item_type_id = $this->input->post('item_type_id', TRUE);
                $m_products->income_account_id = $this->input->post('income_account_id', TRUE);
                $m_products->expense_account_id = $this->input->post('expense_account_id', TRUE);
                $m_products->unit_id = $this->input->post('unit_id', TRUE);
                $m_products->tax_type_id = $this->input->post('tax_type_id', TRUE);
                //$m_products->is_inventory = $this->input->post('inventory',TRUE);

                //im not sure, why posted checkbox post value of 0 when checked
                $m_products->is_tax_exempt =($this->input->post('is_tax_exempt',TRUE)==null?0:1);


                $m_products->equivalent_points = $this->get_numeric_value($this->input->post('equivalent_points', TRUE));
                $m_products->product_warn =$this->get_numeric_value( $this->input->post('product_warn', TRUE));
                $m_products->product_ideal =$this->get_numeric_value( $this->input->post('product_ideal', TRUE));
                //$m_products->markup_percent = $this->input->post('markup_percent', TRUE);
                $m_products->sale_price =$this->get_numeric_value($this->input->post('sale_price', TRUE));
                $m_products->purchase_cost =$this->get_numeric_value($this->input->post('purchase_cost', TRUE));
                $m_products->purchase_cost_2 =$this->get_numeric_value($this->input->post('purchase_cost_2', TRUE));
                $m_products->discounted_price =$this->get_numeric_value($this->input->post('discounted_price', TRUE));
                $m_products->dealer_price =$this->get_numeric_value($this->input->post('dealer_price', TRUE));
                $m_products->distributor_price =$this->get_numeric_value($this->input->post('distributor_price', TRUE));
                $m_products->public_price =$this->get_numeric_value($this->input->post('public_price', TRUE));


                $m_products->modify($product_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Product information successfully updated.';
                $response['row_updated']=$m_products->product_list($account,$as_of_date=null,$product_id);
                echo json_encode($response);

                break;


            case 'delete':
                $m_products=$this->Products_model;

                $m_purchases=$this->Purchases_model;
                $m_purchase_items=$this->Purchase_items_model;
                $m_sales_order=$this->Sales_order_model;
                $m_order_items=$this->Sales_order_item_model;
                $m_invoice=$this->Sales_invoice_model;
                $m_invoice_items=$this->Sales_invoice_item_model;
                $m_issuance=$this->Issuance_model;
                $m_issuance_items=$this->Issuance_item_model;
                $m_delivery_invoice=$this->Delivery_invoice_model;
                $m_deliver_items=$this->Delivery_invoice_item_model;

                $product_id=$this->input->post('product_id',TRUE);

                if(count($m_purchase_items->get_list(

                    'purchase_order.is_deleted=0 AND product_id='.$product_id,

                    'purchase_order_items.product_id',

                    array(
                        array('purchase_order','purchase_order.purchase_order_id=purchase_order_items.purchase_order_id','left')
                    )

                ))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This product still has an active transaction in Purchase Order.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_order_items->get_list(

                    'sales_order.is_deleted=0 AND product_id='.$product_id,

                    'sales_order_items.product_id',

                    array(
                        array('sales_order','sales_order.sales_order_id=sales_order_items.sales_order_id','left')
                    )

                ))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This product still has an active transaction in Sales Order.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_invoice_items->get_list(

                    'sales_invoice.is_deleted=0 AND product_id='.$product_id,

                    'sales_invoice_items.product_id',

                    array(
                        array('sales_invoice','sales_invoice.sales_invoice_id=sales_invoice_items.sales_invoice_id','left')
                    )

                ))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This product still has an active transaction in Sales Invoice.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_issuance_items->get_list(

                    'issuance_info.is_deleted=0 AND product_id='.$product_id,

                    'issuance_items.product_id',

                    array(
                        array('issuance_info','issuance_info.issuance_id=issuance_items.issuance_id','left')
                    )

                ))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This product still has an active transaction in Item Issuance';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_deliver_items->get_list(

                    'delivery_invoice.is_deleted=0 AND product_id='.$product_id,

                    'delivery_invoice_items.product_id',

                    array(
                        array('delivery_invoice','delivery_invoice.dr_invoice_id=delivery_invoice_items.dr_invoice_id','left')
                    )

                ))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This product still has an active transaction in Purchase Invoice.';

                    echo json_encode($response);
                    exit;
                }

                else {
                    $m_products->set('date_deleted','NOW()');
                    $m_products->deleted_by_user = $this->session->user_id;
                    $m_products->is_deleted=1;
                    if($m_products->modify($product_id)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Product information successfully deleted.';

                        echo json_encode($response);
                    }
                }

                break;

            case 'product-history':
                $account_integration =$this->Account_integration_model;
                $a_i=$account_integration->get_list();

                $account =$a_i[0]->sales_invoice_inventory;


                $product_id=$this->input->get('id');
                $department_id=($this->input->get('depid')==null||$this->input->get('depid')==0?0:$this->input->get('depid'));
                $as_of_date=$this->input->get('date');

                if($as_of_date==null){
                    $date = null;
                }else{
                    $date = date('Y-m-d',strtotime($as_of_date));
                }

                $m_products=$this->Products_model;
                $data['products']=$m_products->get_product_history($product_id,$department_id,$date,$account);
                $data['product_id']=$product_id;
                //$this->load->view('Template/product_history_menus',$data);

                $this->load->view('template/product_history',$data);
                break;
                
            // case 'export-product-history':
            //     $excel=$this->excel;
            //     $product_id=$this->input->get('id');
            //     $m_products=$this->Products_model;

            //     $product_info=$m_products->get_list($product_id);



            //     $excel->setActiveSheetIndex(0);


            //     //name the worksheet
            //     $excel->getActiveSheet()->setTitle($product_info[0]->product_desc."  History");

            //     $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
            //     $excel->getActiveSheet()->setCellValue('A1',$product_info[0]->product_desc."  History")
            //         ->setCellValue('A2',"As of Date ".date('m/d/Y'));


            //     //create headers
            //     $excel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(TRUE);
            //     $excel->getActiveSheet()->setCellValue('A4', 'Txn Date')
            //                             ->setCellValue('B4', 'Reference')
            //                             ->setCellValue('C4', 'Txn Type')
            //                             ->setCellValue('D4', 'Description')
            //                             ->setCellValue('E4', 'Exp Date')
            //                             ->setCellValue('F4', 'Batch #')
            //                             ->setCellValue('G4', 'In')
            //                             ->setCellValue('H4', 'Out')
            //                             ->setCellValue('I4', 'Balance');




            //     $transaction=$m_products->get_product_history($product_id);
            //     $rows=array();
            //     foreach($transaction as $x){
            //         $rows[]=array(
            //             $x->txn_date,
            //             $x->ref_no,
            //             $x->type,
            //             $x->Description,
            //             $x->exp_date,
            //             $x->batch_no,
            //             $x->in_qty,
            //             $x->out_qty,
            //             $x->balance
            //         );
            //     }


            //     $excel->getActiveSheet()->getStyle('A4:I4')->getFill()
            //         ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            //         ->getStartColor()->setARGB('07700e');

            //     $styleArray = array(
            //         'font'  => array(
            //             'bold'  => true,
            //             'color' => array('rgb' => 'FFFFF'),
            //             'size'  => 10,
            //             'name'  => 'Tahoma'
            //         ));

            //     $excel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($styleArray);

            //     $excel->getActiveSheet()->fromArray($rows,NULL,'A5');
            //     //autofit column
            //     foreach(range('A','I') as $columnID)
            //     {
            //         $excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(TRUE);
            //     }





            //     $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);



            //     // Redirect output to a client’s web browser (Excel2007)
            //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //     header('Content-Disposition: attachment;filename="'.$product_info[0]->product_desc."  History.xlsx".'"');
            //     header('Cache-Control: max-age=0');
            //     // If you're serving to IE 9, then the following may be needed
            //     header('Cache-Control: max-age=1');

            //     // If you're serving to IE over SSL, then the following may be needed
            //     header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            //     header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            //     header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            //     header ('Pragma: public'); // HTTP/1.0

            //     $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            //     $objWriter->save('php://output');

            //     break;
        }
    }





    function response_rows($filter){
        return $this->Products_model->get_list(
            $filter,

            'products.*,categories.category_name,suppliers.supplier_name,refproduct.product_type,units.unit_name,item_types.item_type,account_titles.account_title',

            array(
                array('suppliers','suppliers.supplier_id=products.supplier_id','left'),
                array('refproduct','refproduct.refproduct_id=products.refproduct_id','left'),
                array('categories','categories.category_id=products.category_id','left'),
                array('units','units.unit_id=products.unit_id','left'),
                array('item_types','item_types.item_type_id=products.item_type_id','left'),
                array('account_titles','account_titles.account_id=products.income_account_id','left')
            )
        );
    }







}
