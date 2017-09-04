<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Company_model');
        $this->load->model('Tax_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Company Information';

        $data['tax_type']=$this->Tax_model->get_list(array('is_deleted'=>FALSE));

        $company=$this->Company_model->get_list();
        $data['company']=$company[0];
        (in_array('6-6',$this->session->user_rights)? 
        $this->load->view('company_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    function transaction($txn = null) {

        switch($txn){

            case 'create':
                $m_company=$this->Company_model;

                $m_company->delete(1);

                $m_company->company_id=1;
                $m_company->company_name=$this->input->post('company_name',TRUE);
                $m_company->company_address=$this->input->post('company_address',TRUE);
                $m_company->email_address=$this->input->post('email_address',TRUE);
                $m_company->mobile_no=$this->input->post('mobile_no',TRUE);
                $m_company->landline=$this->input->post('landline',TRUE);
                $m_company->tin_no=$this->input->post('tin_no',TRUE);
                $m_company->registered_to=$this->input->post('registered_to',TRUE);
                $m_company->logo_path=$this->input->post('photo_path',TRUE);
                $m_company->tax_type_id=$this->input->post('tax_type_id',TRUE);
                $m_company->rdo_no=$this->input->post('rdo_no',TRUE);
                $m_company->nature_of_business=$this->input->post('nature_of_business',TRUE);
                $m_company->business_type=$this->input->post('business_type',TRUE);
                $m_company->save();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Company information successfully saved.';
                echo json_encode($response);

                break;
            //****************************************************************************************************************

            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/company/';

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
