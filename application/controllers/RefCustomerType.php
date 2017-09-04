<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RefCustomerType extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('RefCustomerType_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'RefCustomerType';

        $this->load->view('refcustomertype_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data'] = $this->RefCustomerType_model->get_list(array('refcustomertype.is_deleted'=>FALSE));
                echo json_encode($response);
                break;

            case 'create':
                $m_refcustomertype = $this->RefCustomerType_model;

                $m_refcustomertype->customer_type = $this->input->post('customer_type', TRUE);
                $m_refcustomertype->description = $this->input->post('description', TRUE);
                $m_refcustomertype->save();

                $refcustomertype_id = $m_refcustomertype->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Customer Type Information Successfully created.';
                $response['row_added'] = $m_refcustomertype->get_list($refcustomertype_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_refcustomertype=$this->RefCustomerType_model;

                $refcustomertype_id=$this->input->post('refcustomertype_id',TRUE);

                $m_refcustomertype->is_deleted=1;
                if($m_refcustomertype->modify($refcustomertype_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Customer Type Information Successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_refcustomertype=$this->RefCustomerType_model;

                $refcustomertype_id=$this->input->post('refcustomertype_id',TRUE);
                $m_refcustomertype->customer_type = $this->input->post('customer_type', TRUE);
                $m_refcustomertype->description = $this->input->post('description', TRUE);

                $m_refcustomertype->modify($refcustomertype_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Customer Type Information Successfully updated.';
                $response['row_updated']=$m_refcustomertype->get_list($refcustomertype_id);
                echo json_encode($response);

                break;
        }
    }
}
