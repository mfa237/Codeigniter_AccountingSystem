<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
    }

    public function index() {

        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['user_groups']=$this->User_groups_model->get_list();
        $data['title'] = 'My Profile';

        $user_info=$this->Users_model->get_list(
            array(
                'user_accounts.user_id'=>$this->session->user_id
            ),
            array(
                'user_accounts.*',
                'DATE_FORMAT(user_accounts.user_bdate,"%m/%d/%Y") as birth_date'
            )
        );
        $data['user_info']=$user_info[0];

        $this->load->view('profile_view', $data);
    }

    function transaction($txn = null) {

        switch($txn){
            case 'list':
                $m_users=$this->Users_model;
                $response['data']=$m_users->get_user_list();
                echo json_encode($response);
                break;
            case 'create':
                $m_users=$this->Users_model;

                $m_users->user_name=$this->input->post('user_name',TRUE);
                $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                $m_users->user_lname=$this->input->post('user_lname',TRUE);
                $m_users->user_fname=$this->input->post('user_fname',TRUE);
                $m_users->user_mname=$this->input->post('user_mname',TRUE);
                $m_users->user_address=$this->input->post('user_address',TRUE);
                $m_users->user_email=$this->input->post('user_email',TRUE);
                $m_users->user_mobile=$this->input->post('user_mobile',TRUE);
                $m_users->user_telephone=$this->input->post('user_telephone',TRUE);
                $m_users->user_bdate=date('Y-m-d',strtotime($this->input->post('user_bdate',TRUE)));
                $m_users->user_group_id=$this->input->post('user_group_id',TRUE);
                $m_users->photo_path=$this->input->post('photo_path',TRUE);

                $m_users->set('date_created','NOW()');
                $m_users->posted_by_user=$this->session->user_id;

                $m_users->save();

                $user_account_id=$m_users->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='User account information successfully created.';
                $response['row_added']=$m_users->get_user_list($user_account_id);
                echo json_encode($response);

                break;
            //****************************************************************************************************************
            case 'update' :
                $m_users=$this->Users_model;

                $user_account_id=$this->input->post('user_id',TRUE);
                $m_users->user_name=$this->input->post('user_name',TRUE);
                $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                $m_users->user_lname=$this->input->post('user_lname',TRUE);
                $m_users->user_fname=$this->input->post('user_fname',TRUE);
                $m_users->user_mname=$this->input->post('user_mname',TRUE);
                $m_users->user_address=$this->input->post('user_address',TRUE);
                $m_users->user_email=$this->input->post('user_email',TRUE);
                $m_users->user_mobile=$this->input->post('user_mobile',TRUE);
                $m_users->user_telephone=$this->input->post('user_telephone',TRUE);
                $m_users->user_bdate=date('Y-m-d',strtotime($this->input->post('user_bdate',TRUE)));
                $m_users->user_group_id=$this->input->post('user_group_id',TRUE);
                $m_users->photo_path=$this->input->post('photo_path');

                $m_users->set('date_modified','NOW()');
                $m_users->modified_by_user=$this->session->user_id;

                $m_users->modify($user_account_id);


                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='User account information successfully created.';
                $response['row_updated']=$m_users->get_user_list($user_account_id);
                echo json_encode($response);

                break;
            //****************************************************************************************************************
            case 'delete':
                $m_users=$this->Users_model;
                $user_account_id=$this->input->post('user_id',TRUE);

                $m_users->set('date_deleted','NOW()');
                $m_users->deleted_by_user=$this->session->user_id;
                $m_users->is_deleted=1;
                if($m_users->modify($user_account_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='User account information successfully deleted.';
                    echo json_encode($response);
                }
                break;
            case 'upload':
                $allowed = array('png', 'jpg', 'jpeg','bmp');

                $data=array();
                $files=array();
                $directory='assets/img/user/';

                foreach($_FILES as $file){

                    $server_file_name=uniqid('');
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_path=$directory.$server_file_name.'.'.$extension;
                    $orig_file_name=$file['name'];

                    if(!in_array(strtolower($extension), $allowed)){
                        $response['title']='Invalid!';
                        $response['stat']='error';
                        $response['msg']='Image is invalid. Please select a valid photo!';
                        die(json_encode($response));
                    }

                    if(move_uploaded_file($file['tmp_name'],$file_path)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Image successfully uploaded.';
                        $response['path']=$file_path;
                        echo json_encode($response);
                    }
                }
                break;

        }


    }
}
