<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discounts extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Discounts_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Discount Management';

        $this->load->view('discounts_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_discounts = $this->Discounts_model;
                $response['data'] = $m_discounts->get_discount_list();
                echo json_encode($response);
                break;

            case 'create':
                $m_discounts = $this->Discounts_model;

                $m_discounts->discount_code = $this->input->post('discount_code', TRUE);
                $m_discounts->discount_type = $this->input->post('discount_type', TRUE);
                $m_discounts->discount_desc = $this->input->post('discount_desc', TRUE);
                $m_discounts->discount_percent = $this->input->post('discount_percent', TRUE);
                $m_discounts->discount_amount = $this->input->post('discount_amount', TRUE);
                $m_discounts->save();

                $discount_id = $m_discounts->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Discount information successfully created.';
                $response['row_added'] = $m_discounts->get_discount_list($discount_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_discounts=$this->Discounts_model;

                $discount_id=$this->input->post('discount_id',TRUE);

                $m_discounts->is_deleted=1;
                if($m_discounts->modify($discount_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Discount information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_discounts=$this->Discounts_model;

                $discount_id=$this->input->post('discount_id',TRUE);
                $m_discounts->discount_code = $this->input->post('discount_code', TRUE);
                $m_discounts->discount_type = $this->input->post('discount_type', TRUE);
                $m_discounts->discount_desc = $this->input->post('discount_desc', TRUE);
                $m_discounts->discount_percent = $this->input->post('discount_percent', TRUE);
                $m_discounts->discount_amount = $this->input->post('discount_amount', TRUE);

                $m_discounts->modify($discount_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Discount information successfully updated.';
                $response['row_updated']=$m_discounts->get_discount_list($discount_id);
                echo json_encode($response);

                break;
        }
    }
}
