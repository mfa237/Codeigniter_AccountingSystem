<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_layout extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
            'Users_model',
            'Check_layout_model',
            'Print_layout_model',
            'Module_layout_model',
            'Company_model'
        ));
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Print Layout';
        // (in_array('6-7',$this->session->user_rights)? 
        $this->load->view('print_layout_view', $data);
        // :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null){
        switch($txn){
            case 'list':
                $m_layout=$this->Print_layout_model;
                $response['data']=$m_layout->get_list(array('print_layout.is_active'=>TRUE,'print_layout.is_deleted'=>FALSE));

                echo json_encode($response);
                break;
                // $response['data']=$this->response_rows(array('check_layout.is_active'=>TRUE,'check_layout.is_deleted'=>FALSE));
                // echo json_encode($response);
                // break;

            case 'create':
                $m_layout=$this->Print_layout_model;
                $m_layout->layout_name=$this->input->post('layout_name',TRUE);
                $m_layout->layout_description=$this->input->post('layout_description',TRUE);
                $m_layout->save();

                $layout_id=$m_layout->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Layout successfully created.';
                $response['row_added']=$m_layout->get_list($layout_id);
                echo json_encode($response);

                break;

            case 'update-page':
                    $m_layout=$this->Print_layout_model;
                    $layout_id=$this->input->post('layout_id',TRUE);

                    $m_layout->layout_name=$this->input->post('layout_name',TRUE);
                    $m_layout->layout_description=$this->input->post('layout_description',TRUE);
                    $m_layout->is_portrait=($this->input->post('is_portrait',TRUE)==1?1:0); //not sure why posted value 0 is NULL is backend
                    $m_layout->modify($layout_id);

                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Print layout successfully updated.';
                    $response['row_updated']=$m_layout->get_list($layout_id);
                    echo json_encode($response);
                break;

            case 'update':

                $layout_id=$this->input->post('layout_id',TRUE);

                $m_module_layout = $this->Module_layout_model;
                $m_module_layout->delete_via_fk($layout_id);

                $display_text = $this->input->post('display_text',TRUE);
                $field_name = $this->input->post('field_name',TRUE);
                $tag = $this->input->post('tag',TRUE);
                $pos_top = $this->input->post('pos_top',TRUE);
                $pos_bottom = $this->input->post('pos_bottom',TRUE);
                $pos_left = $this->input->post('pos_left',TRUE);
                $pos_right = $this->input->post('pos_right',TRUE);
                $font = $this->input->post('font',TRUE);
                $font_color = $this->input->post('font-color',TRUE);
                $font_size = $this->input->post('font-size',TRUE);
                $is_bold = $this->input->post('is_bold',TRUE);
                $is_italic = $this->input->post('is_italic',TRUE);
                $height = $this->input->post('height',TRUE);
                $width = $this->input->post('width',TRUE);
                $parent = $this->input->post('parent',TRUE);

                for($i=0;$i<count($field_name);$i++)
                {
                    $m_module_layout->layout_id = $layout_id;
                    $m_module_layout->display_text = $display_text[$i];
                    $m_module_layout->field_name = $field_name[$i];
                    $m_module_layout->tag = $tag[$i];
                    $m_module_layout->pos_top = $pos_top[$i];
                    $m_module_layout->pos_bottom = $pos_bottom[$i];
                    $m_module_layout->pos_left = $pos_left[$i];
                    $m_module_layout->pos_right = $pos_right[$i];
                    $m_module_layout->font = $font[$i];
                    $m_module_layout->font_color = $font_color[$i];
                    $m_module_layout->font_size = $font_size[$i];
                    $m_module_layout->is_bold = $is_bold[$i];
                    $m_module_layout->is_italic = $is_italic[$i];
                    $m_module_layout->height = $height[$i];
                    $m_module_layout->width = $width[$i];
                    $m_module_layout->parent = $parent[$i];
                    $m_module_layout->save();
                }

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Print layout successfully updated.';

                echo json_encode($response);

                break;

            case 'print':
                    $m_module_layout = $this->Module_layout_model;

                    $layout_id = $this->input->get('layout');

                    $company_info = $this->Company_model->get_list();

                    $data['company_info'] = $company_info[0];
                    
                    $data['module_layouts'] = $m_module_layout->get_list('layout_id='.$layout_id);
                    
                    $this->load->view('template/print_layout_content',$data);
                break;

            case 'delete':
                $m_layout=$this->Print_layout_model;

                $layout_id=$this->input->post('layout_id',TRUE);
                // $m_layout->set('date_deleted','NOW()');
                // $m_layout->deleted_by_user=$this->session->user_id;
                $m_layout->is_deleted=1;
                if($m_layout->modify($layout_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Check layout successfully deleted.';

                    echo json_encode($response);
                }

                break;

        }


    }





}
