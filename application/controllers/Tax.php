<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CORE_Controller {

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Suppliers_model');
        $this->load->model('Supplier_photos_model');
        $this->load->model('Tax_types_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);
        $data['title']='Tax Management';
        $data['tax_type']=$this->Tax_types_model->get_list();
        (in_array('6-1',$this->session->user_rights)? 
        $this->load->view('tax_view',$data)
        :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null) {
        switch($txn) {
            case 'list':
                $m_tax=$this->Tax_types_model;
                $response['data']=$m_tax->get_list(
                    array('tax_types.is_deleted'=>FALSE)
                );
                echo json_encode($response);

                break;

            case 'create':
                $m_tax=$this->Tax_types_model;

                $m_tax->tax_type=$this->input->post('tax_type',TRUE);
                $m_tax->tax_rate=$this->input->post('tax_rate',TRUE);
                $m_tax->description=$this->input->post('description',TRUE);
                $m_tax->save();

                $tax_type_id=$m_tax->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Tax information successfully created.';
                $response['row_added']=$m_tax->get_list($tax_type_id);
                echo json_encode($response);
                break;

            case 'delete':
                $m_tax=$this->Tax_types_model;
                $tax_type_id=$this->input->post('tax_type_id',TRUE);

                $m_tax->is_deleted=1;
                if($m_tax->modify($tax_type_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Tax information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_tax=$this->Tax_types_model;
                $tax_type_id=$this->input->post('tax_type_id',TRUE);
                $m_tax->tax_type=$this->input->post('tax_type',TRUE);
                $m_tax->tax_rate=$this->input->post('tax_rate',TRUE);
                $m_tax->description=$this->input->post('description',TRUE);
                $m_tax->modify($tax_type_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Tax information successfully updated.';
                $response['row_updated']=$m_tax->get_list($tax_type_id);
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
        }
    }
}
