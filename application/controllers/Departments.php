<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Departments_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Department Management';
        (in_array('4-3',$this->session->user_rights)? 
        $this->load->view('departments_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_departments = $this->Departments_model;
                $response['data'] = $m_departments->get_list(array('is_deleted'=>FALSE,'is_active'=>TRUE));
                echo json_encode($response);
                break;

            case 'create':
                $m_departments = $this->Departments_model;

                $m_departments->department_name = $this->input->post('department_name', TRUE);
                $m_departments->department_desc = $this->input->post('department_desc', TRUE);
                $m_departments->delivery_address = $this->input->post('delivery_address', TRUE);
                $m_departments->default_cost = $this->input->post('default_cost', TRUE);
                $m_departments->save();

                $department_id = $m_departments->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Department Information successfully created.';
                $response['row_added'] = $m_departments->get_department_list($department_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_departments=$this->Departments_model;

                $department_id=$this->input->post('department_id',TRUE);

                $m_departments->is_deleted=1;
                if($m_departments->modify($department_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Department Information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_departments=$this->Departments_model;

                $department_id=$this->input->post('department_id',TRUE);
                $m_departments->department_name=$this->input->post('department_name',TRUE);
                $m_departments->department_desc=$this->input->post('department_desc',TRUE);
                $m_departments->delivery_address = $this->input->post('delivery_address', TRUE);
                $m_departments->default_cost = $this->input->post('default_cost', TRUE);
                $m_departments->modify($department_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Department Information successfully updated.';
                $response['row_updated']=$m_departments->get_department_list($department_id);
                echo json_encode($response);

                break;
        }
    }
}
