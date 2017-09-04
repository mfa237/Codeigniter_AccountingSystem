<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_positions extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(
            array(
                'Print_layout_model',
                'Module_layout_model'
            )
        );
        $this->load->library('M_pdf');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Print Scale ';

        $id=$this->input->get('id');
        $layout_info=$this->Print_layout_model->get_list($id);
        $data['module_layouts'] = $this->Module_layout_model->get_list('layout_id = '.$id);
        $data['layouts']=$layout_info[0];

        $this->load->view('print_scale_view', $data);
    }




    function Transaction($txn=null){

        switch($txn){

            case 'print':

                

            $id=$this->input->get('id');
            $layout_info=$this->Print_layout_model->get_list($id);
            $data['layouts']=$layout_info[0];

          $this->load->view('template/print_layout_content',$data);

            

            break;

        }



    }

}
