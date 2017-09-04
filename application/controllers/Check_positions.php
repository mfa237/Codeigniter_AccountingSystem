<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_positions extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Check_layout_model');

    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Check Scale ';

        $id=$this->input->get('id');
        $layout_info=$this->Check_layout_model->get_list($id);
        $data['layouts']=$layout_info[0];
        $this->load->view('check_scale_view', $data);
    }

}
