<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refproducts extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(
            'Refproduct_model'
        );
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Product Types';

        $this->load->view('refproducts_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data'] = $this->Refproduct_model->get_list(array('refproduct.is_deleted'=>FALSE));
                echo json_encode($response);
                break;

            case 'create':
                $m_refproduct = $this->Refproduct_model;

                $m_refproduct->product_type = $this->input->post('product_type', TRUE);
                $m_refproduct->description = $this->input->post('description', TRUE);
                $m_refproduct->save();

                $refproduct_id = $m_refproduct->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Product Type Information Successfully created.';
                $response['row_added'] = $m_refproduct->get_list($refproduct_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_refproduct=$this->Refproduct_model;

                $refproduct_id=$this->input->post('refproduct_id',TRUE);

                $m_refproduct->is_deleted=1;
                if($m_refproduct->modify($refproduct_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Product Type Information Successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_refproduct=$this->Refproduct_model;

                $refproduct_id=$this->input->post('refproduct_id',TRUE);
                $m_refproduct->product_type = $this->input->post('product_type', TRUE);
                $m_refproduct->description = $this->input->post('description', TRUE);

                $m_refproduct->modify($refproduct_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Product Type Information Successfully updated.';
                $response['row_updated']=$m_refproduct->get_list($refproduct_id);
                echo json_encode($response);

                break;
        }
    }
}
