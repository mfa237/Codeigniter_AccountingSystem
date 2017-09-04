<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Customers_model');
        $this->load->model('Customer_photos_model');
        $this->load->model('Departments_model');
        $this->load->model('RefCustomerType_model');
        $this->load->model('Journal_info_model');
        $this->load->model('Sales_order_model');
        $this->load->model('Sales_invoice_model');
        $this->load->model('Receivable_payment_model');
        $this->load->model('Users_model');
    }
 
    public function index()
    {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);
        $data['title']='Customer Management';

        $data['departments'] = $this->Departments_model->get_list(array('departments.is_deleted'=>FALSE));
        $data['refcustomertype'] = $this->RefCustomerType_model->get_list(array('refcustomertype.is_deleted'=>FALSE));
        (in_array('5-3',$this->session->user_rights)? 
        $this->load->view('customers_view',$data)
        :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null){
        switch($txn){
            //****************************************************************************************************************
            case 'list':
                $m_customers=$this->Customers_model;

                $response['data']=$m_customers->get_list('is_active=TRUE AND is_deleted=FALSE');

                echo json_encode($response);

                break;

            case 'getcustomer':
                $department_id = $this->input->post('department_id', TRUE);
                $get = "";

                if($department_id > 1){
                    $get = array('customers.department_id'=>$department_id,'customers.is_deleted'=>FALSE);
                }else {
                    $get = array('customers.is_deleted'=>FALSE);
                }

                $response['data'] = $this->response_rows($get);
                echo json_encode($response);
                break;

            //****************************************************************************************************************
            case 'create':
                $m_customers=$this->Customers_model;
                $m_photos=$this->Customer_photos_model;

                $m_customers->customer_name=$this->input->post('customer_name',TRUE);
                $m_customers->contact_name=$this->input->post('contact_name',TRUE);
                $m_customers->address=$this->input->post('address',TRUE);
                $m_customers->email_address=$this->input->post('email_address',TRUE);
                $m_customers->contact_no=$this->input->post('contact_no',TRUE);
                $m_customers->tin_no=$this->input->post('tin_no',TRUE);
                $m_customers->refcustomertype_id=$this->input->post('refcustomertype_id',TRUE);
                $m_customers->department_id=$this->input->post('department_id',TRUE);
                $m_customers->photo_path=$this->input->post('photo_path',TRUE);
                $m_customers->term=$this->input->post('term',TRUE);
                $m_customers->credit_limit=$this->input->post('credit_limit',TRUE);

                $m_customers->set('date_created','NOW()');
                $m_customers->posted_by_user=$this->session->user_id;

                $m_customers->save();

                $customer_id=$m_customers->last_insert_id();//get last insert id

                $m_photos->customer_id=$customer_id;
                $m_photos->photo_path=$this->input->post('photo_path',TRUE);
                $m_photos->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Customer Information successfully created.';
                $response['row_added']=$this->response_rows($customer_id);
                echo json_encode($response);

                break;
            //****************************************************************************************************************
            case 'delete':
                $m_customers=$this->Customers_model;
                $m_photos=$this->Customer_photos_model;

                $m_journal=$this->Journal_info_model;
                $m_sales_order=$this->Sales_order_model;
                $m_invoice=$this->Sales_invoice_model;
                $m_payment=$this->Receivable_payment_model;

                $customer_id=$this->input->post('customer_id',TRUE);

                if(count($m_journal->get_list('is_active=1 AND customer_id='.$customer_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This customer still has an active transaction in General Journal.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_sales_order->get_list('is_active=1 AND customer_id='.$customer_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This customer still has an active transaction in Sales Order.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_invoice->get_list('is_deleted=0 AND customer_id='.$customer_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This customer still has an active transaction in Sales Invoice.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_payment->get_list('is_active=1 AND customer_id='.$customer_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This customer still has an active transaction in Collection Entry.';

                    echo json_encode($response);
                    exit;
                }

                else {
                    $m_customers->set('date_deleted','NOW()');
                    $m_customers->deleted_by_user=$this->session->user_id;
                    $m_customers->is_deleted=0;
                    
                    if($m_customers->modify($customer_id)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Customer Information successfully deleted.';

                        echo json_encode($response);
                    }
                }

                break;
                
            //****************************************************************************************************************
            case 'update':
                $m_customers=$this->Customers_model;
                $m_photos=$this->Customer_photos_model;

                $customer_id=$this->input->post('customer_id',TRUE);
                $m_customers->customer_name=$this->input->post('customer_name',TRUE);
                $m_customers->contact_name=$this->input->post('contact_name',TRUE);
                $m_customers->address=$this->input->post('address',TRUE);
                $m_customers->email_address=$this->input->post('email_address',TRUE);
                $m_customers->contact_no=$this->input->post('contact_no',TRUE);
                $m_customers->tin_no=$this->input->post('tin_no',TRUE);
                $m_customers->refcustomertype_id=$this->input->post('refcustomertype_id',TRUE);
                $m_customers->department_id=$this->input->post('department_id',TRUE);
                $m_customers->photo_path=$this->input->post('photo_path',TRUE);
                $m_customers->term=$this->input->post('term',TRUE);
                $m_customers->credit_limit=$this->input->post('credit_limit',TRUE);

                $m_customers->set('date_modified','NOW()');
                $m_customers->modified_by_user=$this->session->user_id;

                $m_customers->modify($customer_id);

                $m_photos->delete_via_fk($customer_id);
                $m_photos->customer_id=$customer_id;
                $m_photos->photo_path=$this->input->post('photo_path',TRUE);
                $m_photos->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Customer Information successfully updated.';
                $response['row_updated']=$this->response_rows($customer_id);
                echo json_encode($response);

                break;

            //****************************************************************************************************************
            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/customer/';

                foreach($_FILES as $file){

                    $server_file_name=uniqid('');
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_path=$directory.$server_file_name.'.'.$extension;
                    $orig_file_name=$file['name'];

                    if(!in_array(strtolower($extension), $allowed)){
                        $response['title']='Invalid!';
                        $response['stat']='error';
                        $response['msg']='Image is invalid. Please select a valid photo!';
                        die(json_encode($response));
                    }

                    if(move_uploaded_file($file['tmp_name'],$file_path)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Image successfully uploaded.';
                        $response['path']=$file_path;
                        echo json_encode($response);
                    }
                }

                break;


            case 'receivables':
                $customer_id=$this->input->get('id',TRUE);
                $m_customers=$this->Customers_model;

                $data['receivables']=$m_customers->get_customer_receivable_list($customer_id);
                $structured_content=$this->load->view('template/customer_receivable_list',$data,TRUE);
                echo $structured_content;

                break;

        }
    }


    function response_rows($filter){
        return $this->Customers_model->get_list(
            $filter,

            'customers.*,departments.department_name,refcustomertype.customer_type',

            array(
                array('departments','departments.department_id=customers.department_id','left'),
                array('refcustomertype','refcustomertype.refcustomertype_id=customers.refcustomertype_id','left')
            )
        );
    }
}