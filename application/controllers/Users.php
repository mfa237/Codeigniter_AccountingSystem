<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
        $this->load->model('Company_model');


    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['user_groups']=$this->User_groups_model->get_list(array('is_deleted'=>0));
        $data['title'] = 'User Account Management';

        (in_array('6-5',$this->session->user_rights)? 
            $this->load->view('users_view', $data)
            :redirect(base_url('dashboard')));



    }

    function transaction($txn = null) {

        switch($txn){
            case 'list':
                $m_users=$this->Users_model;
                $response['data']=$m_users->get_user_list();
                echo json_encode($response);
                break;
            case 'create':
                $m_company=$this->Company_model;
                $company=$m_company->get_list('company_id=1');

                $businesstype= $company[0]->business_type;

                if ($businesstype == 1){ $limit = 6; }
                if ($businesstype == 2){ $limit = 11; }
                if ($businesstype == 3){ $limit = 16; }

        
                $m_users=$this->Users_model;
                if(count($m_users->get_user_list()) >= $limit){

                    $response['title']='Error!';
                    $response['stat']='error';
                    $response['msg']='Limit reached.';
                    echo json_encode($response);
                    exit;
                }

                $user_name=$this->input->post('user_name',TRUE);




                if(count($m_users->get_list(array(
                    'user_accounts.user_name'=>$user_name
                )))>0){

                    $response['title']='Error!';
                    $response['stat']='error';
                    $response['msg']='Sorry, username already exist.';
                    echo json_encode($response);
                    exit;
                }


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
                $response['msg']='User account information successfully updated.';
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
            case 'update-profile' :
                $m_users=$this->Users_model;

                $user_account_id=$this->session->user_id;

                $m_users->user_name=$this->input->post('user_name',TRUE);

                if($this->input->post('user_pword',TRUE)!=null){
                    $m_users->user_pword=sha1($this->input->post('user_pword',TRUE));
                }

                $m_users->user_lname=$this->input->post('user_lname',TRUE);
                $m_users->user_fname=$this->input->post('user_fname',TRUE);
                $m_users->user_mname=$this->input->post('user_mname',TRUE);
                $m_users->user_address=$this->input->post('user_address',TRUE);
                $m_users->user_email=$this->input->post('user_email',TRUE);
                $m_users->user_mobile=$this->input->post('user_mobile',TRUE);
                $m_users->user_telephone=$this->input->post('user_telephone',TRUE);
                $m_users->user_bdate=date('Y-m-d',strtotime($this->input->post('user_bdate',TRUE)));
                //$m_users->user_group_id=$this->input->post('user_group_id',TRUE);
                $m_users->photo_path=$this->input->post('photo_path');

                $m_users->set('date_modified','NOW()');
                $m_users->modified_by_user=$this->session->user_id;
                $m_users->modify($user_account_id);


                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Profile successfully updated.';

                echo json_encode($response);

                break;


        }


    }
}
