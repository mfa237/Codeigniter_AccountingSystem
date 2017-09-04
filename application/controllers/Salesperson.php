<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesperson extends CORE_Controller {

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Salesperson_model');
        $this->load->model('Departments_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);
        $data['title']='Salesperson Management';
        $data['departments']=$this->Departments_model->get_list(array('departments.is_deleted'=>FALSE));
        (in_array('5-4',$this->session->user_rights)? 
        $this->load->view('salesperson_view',$data)
        :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null) {
        switch($txn) {
            case 'list':
                $m_salesperson=$this->Salesperson_model;
                $response['data']=$m_salesperson->get_list(
                    array('salesperson.is_deleted'=>FALSE),
                    'salesperson.*, salesperson_id, acr_name, CONCAT(firstname, " ", middlename, " ", lastname) AS fullname, firstname, middlename, lastname, departments.department_id, departments.department_name',

                    array(
                        array('departments','departments.department_id=salesperson.department_id','left')
                    )
                );
                echo json_encode($response);

                break;

            case 'create':
                $m_salesperson=$this->Salesperson_model;

                $m_salesperson->set('date_created','NOW()');

                $m_salesperson->salesperson_code=$this->input->post('salesperson_code',TRUE);
                $m_salesperson->firstname=$this->input->post('firstname',TRUE);
                $m_salesperson->middlename=$this->input->post('middlename',TRUE);
                $m_salesperson->lastname=$this->input->post('lastname',TRUE);
                $m_salesperson->contact_no=$this->input->post('contact_no',TRUE);
                $m_salesperson->department_id=$this->input->post('department_id',TRUE);
                $m_salesperson->tin_no=$this->input->post('tin_no',TRUE);


                $m_salesperson->posted_by_user=$this->session->user_id;
                $m_salesperson->save();

                $salesperson_id=$m_salesperson->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Salesperson Information successfully created.';
                $response['row_added']= $m_salesperson->get_list(
                    $salesperson_id,

                    'salesperson.*, salesperson_id, acr_name, CONCAT(firstname, " ", middlename, " ", lastname) AS fullname, firstname, middlename, lastname, departments.department_id, departments.department_name',

                    array(
                        array('departments','departments.department_id=salesperson.department_id','left')
                    )
                );
                echo json_encode($response);

                break;

            case 'delete':
                $m_salesperson=$this->Salesperson_model;
                $salesperson_id=$this->input->post('salesperson_id',TRUE);

                $m_salesperson->is_deleted=1;
                if($m_salesperson->modify($salesperson_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Salesperson information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_salesperson=$this->Salesperson_model;
                $salesperson_id=$this->input->post('salesperson_id',TRUE);

                $m_salesperson->salesperson_code=$this->input->post('salesperson_code',TRUE);
                $m_salesperson->firstname=$this->input->post('firstname',TRUE);
                $m_salesperson->middlename=$this->input->post('middlename',TRUE);
                $m_salesperson->lastname=$this->input->post('lastname',TRUE);
                $m_salesperson->contact_no=$this->input->post('contact_no',TRUE);
                $m_salesperson->department_id=$this->input->post('department_id',TRUE);
                $m_salesperson->tin_no=$this->input->post('tin_no',TRUE);
                $m_salesperson->modify($salesperson_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Salesperson Information successfully updated.';
                $response['row_updated']=$m_salesperson->get_list(
                    $salesperson_id,
                    
                    'salesperson.*, salesperson_id, acr_name, CONCAT(firstname, " ", middlename, " ", lastname) AS fullname, firstname, middlename, lastname, departments.department_id, departments.department_name',

                    array(
                        array('departments','departments.department_id=salesperson.department_id','left')
                    )
                );
                echo json_encode($response);

                break;
       	}
    }
}
