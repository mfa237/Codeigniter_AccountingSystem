<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
            'User_groups_model',
            'Users_model',
            'User_group_right_model'
        ));
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'User Group Management';
        (in_array('6-4',$this->session->user_rights)? 
        $this->load->view('user_group_view', $data)
        :redirect(base_url('dashboard')));
        

    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_user_groups = $this->User_groups_model;
                $response['data'] = $this->get_response_rows();
                echo json_encode($response);
                break;

            case 'create':
                $m_user_groups = $this->User_groups_model;

                $m_user_groups->user_group = $this->input->post('user_group', TRUE);
                $m_user_groups->user_group_desc = $this->input->post('user_group_desc', TRUE);
                $m_user_groups->save();

                $user_group_id = $m_user_groups->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'User group information successfully created.';
                $response['row_added'] = $this->get_response_rows($user_group_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_user_groups = $this->User_groups_model;

                $m_user_group_id = $this->input->post('user_group_id',TRUE);
                $m_user_groups->is_deleted = 1;
                if($m_user_groups->modify($m_user_group_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='User Group successfully Deleted.';
                    echo json_encode($response);
                }
                break;

            case 'update':
                $m_user_groups = $this->User_groups_model;

                $user_group_id=$this->input->post('user_group_id',TRUE);

                $m_user_groups->user_group = $this->input->post('user_group', TRUE);
                $m_user_groups->user_group_desc = $this->input->post('user_group_desc', TRUE);
                $m_user_groups->modify($user_group_id);



                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'User group information successfully updated.';
                $response['row_updated'] = $this->get_response_rows($user_group_id);
                echo json_encode($response);



                break;
            case 'save-rights':
                $m_rights=$this->User_group_right_model;
                $id=$this->input->post('user_group_id',TRUE);


                $m_rights->delete_via_fk($id);

                $link_code=$this->input->post('link_code',TRUE);
                foreach($link_code as $link){
                    if($link!="0"){
                        $m_rights->user_group_id=$id;
                        $m_rights->link_code=$link;
                        $m_rights->save();
                    }
                }


                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'User rights successfully saved.';
                echo json_encode($response);
                break;
        }
    }


    function get_response_rows($criteria=null){
        $m_user_groups = $this->User_groups_model;
        return $m_user_groups->get_list(
            'user_groups.is_deleted=FALSE '.($criteria==null?'':' AND user_groups.user_group_id='.$criteria)
        );
    }


}
