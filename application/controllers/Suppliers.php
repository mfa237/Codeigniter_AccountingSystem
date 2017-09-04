<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CORE_Controller {

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Suppliers_model');
        $this->load->model('Supplier_photos_model');
        $this->load->model('Tax_model');
        $this->load->model('Journal_info_model');
        $this->load->model('Delivery_invoice_model');
        $this->load->model('Payable_payment_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);
        $data['suppliers']=$this->Suppliers_model->get_list(array('suppliers.is_deleted'=>FALSE));
        $data['title']='Supplier Management';


        $data['tax_types']=$this->Tax_model->get_list(array('tax_types.is_deleted'=>FALSE));
        (in_array('5-2',$this->session->user_rights)? 
        $this->load->view('suppliers_view',$data)
        :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null) {
        switch($txn) {
            case 'list':
                $m_suppliers=$this->Suppliers_model;
                $response['data']=$m_suppliers->get_list(
                        array('suppliers.is_deleted'=>FALSE),
                        'suppliers.*,tax_types.tax_type,tax_types.tax_rate',

                        array(
                            array('tax_types','tax_types.tax_type_id=suppliers.tax_type_id','left')
                        )

                );
                echo json_encode($response);

                break;

            case 'create':
                $m_suppliers=$this->Suppliers_model;
                $m_photos=$this->Supplier_photos_model;

                $m_suppliers->set('date_created','NOW()');
                
                $m_suppliers->supplier_name=$this->input->post('supplier_name',TRUE);
                $m_suppliers->contact_name=$this->input->post('contact_name',TRUE);
                $m_suppliers->address=$this->input->post('address',TRUE);
                $m_suppliers->email_address=$this->input->post('email_address',TRUE);
                $m_suppliers->contact_no=$this->input->post('contact_no',TRUE);
                $m_suppliers->tin_no=$this->input->post('tin_no',TRUE);
                $m_suppliers->photo_path=$this->input->post('photo_path',TRUE);

                $m_suppliers->tax_type_id=$this->input->post('tax_type_id',TRUE);
                $m_suppliers->posted_by_user=$this->session->user_id;
                $m_suppliers->save();

                $supplier_id=$m_suppliers->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Supplier Information successfully created.';
                $response['row_added']= $m_suppliers->get_list(

                    $supplier_id,

                    'suppliers.*,tax_types.tax_type,tax_types.tax_rate',

                    array(
                        array('tax_types','tax_types.tax_type_id=suppliers.tax_type_id','left')

                    )

                );
                echo json_encode($response);

                break;

            case 'delete':
                $m_suppliers=$this->Suppliers_model;
                $m_photos=$this->Supplier_photos_model;

                $m_payment=$this->Payable_payment_model;
                $m_delivery_invoice=$this->Delivery_invoice_model;
                $m_journal=$this->Journal_info_model;

                $supplier_id=$this->input->post('supplier_id',TRUE);

                if(count($m_delivery_invoice->get_list('is_deleted=0 AND supplier_id='.$supplier_id))>0){

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This supplier still has an active transaction in Purchase Invoice.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_payment->get_list('is_active=1 AND supplier_id='.$supplier_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This supplier still has an active transaction in Record Payments.';

                    echo json_encode($response);
                    exit;
                }

                else if(count($m_journal->get_list('is_active=1 AND supplier_id='.$supplier_id))>0){
                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This supplier still has an active transaction in General Journal.';

                    echo json_encode($response);
                    exit;
                }

                else {
                    $m_suppliers->set('date_deleted','NOW()');
                    $m_suppliers->deleted_by_user = $this->session->user_id;
                    $m_suppliers->is_deleted=1;

                    if($m_suppliers->modify($supplier_id)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Supplier information successfully deleted.';

                        echo json_encode($response);
                    }
                }

                break;

            case 'update':
                $m_suppliers=$this->Suppliers_model;
                $m_photos=$this->Supplier_photos_model;

                $supplier_id=$this->input->post('supplier_id',TRUE);
                $m_suppliers->supplier_name=$this->input->post('supplier_name',TRUE);
                $m_suppliers->contact_name=$this->input->post('contact_name',TRUE);
                $m_suppliers->address=$this->input->post('address',TRUE);
                $m_suppliers->email_address=$this->input->post('email_address',TRUE);
                $m_suppliers->contact_no=$this->input->post('contact_no',TRUE);
                $m_suppliers->tin_no=$this->input->post('tin_no',TRUE);
                $m_suppliers->photo_path=$this->input->post('photo_path',TRUE);
                $m_suppliers->tax_type_id=$this->input->post('tax_type_id',TRUE);
                $m_suppliers->modify($supplier_id);

                $m_photos->delete_via_fk($supplier_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Supplier Information successfully updated.';
                $response['row_updated']=$m_suppliers->get_list(
                    $supplier_id,
                        'suppliers.*,tax_types.tax_type,tax_types.tax_rate',

                        array(
                            array('tax_types','tax_types.tax_type_id=suppliers.tax_type_id','left')

                        ));
                echo json_encode($response);

                break;

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/supplier/';

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
                
            case 'payables':
                $supplier_id=$this->input->get('id',TRUE);
                $m_suppliers=$this->Suppliers_model;

                $data['payables']=$m_suppliers->get_supplier_payable_list($supplier_id);
                $structured_content=$this->load->view('template/supplier_payables_list',$data,TRUE);
                echo $structured_content;

                break;
        }
    }
}
