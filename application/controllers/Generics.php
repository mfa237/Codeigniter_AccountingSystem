<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generics extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Generics_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'generic Management';

        $this->load->view('generics_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_generics = $this->Generics_model;
                $response['data'] = $m_generics->get_generic_list();
                echo json_encode($response);
                break;

            case 'create':
                $m_generics = $this->Generics_model;

                $m_generics->generic_name = $this->input->post('generic_name', TRUE);
                $m_generics->save();

                $generic_id = $m_generics->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'generic information successfully created.';
                $response['row_added'] = $m_generics->get_generic_list($generic_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_generics=$this->Generics_model;

                $generic_id=$this->input->post('generic_id',TRUE);

                $m_generics->is_deleted=1;
                if($m_generics->modify($generic_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='generic information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_generics=$this->Generics_model;

                $generic_id=$this->input->post('generic_id',TRUE);
                $m_generics->generic_name=$this->input->post('generic_name',TRUE);

                $m_generics->modify($generic_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='generic information successfully updated.';
                $response['row_updated']=$m_generics->get_generic_list($generic_id);
                echo json_encode($response);

                break;
        }
    }
}
