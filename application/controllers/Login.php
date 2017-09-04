<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CORE_Controller {
    public $token_id;
    function __construct()
    {
        parent::__construct('');

        $this->load->model('Users_model');
        $this->load->model('User_groups_model');
        $this->load->model('Tax_types_model');
        $this->load->model('Approval_status_model');
        $this->load->model('Order_status_model');
        $this->load->model('Account_type_model');
        $this->load->model('Departments_model');
        $this->load->model('Item_type_model');
        $this->load->model('Payment_method_model');
        $this->load->model('Account_class_model');
        $this->load->model('Account_title_model');
        $this->load->model('Rights_link_model');
        $this->load->model('User_group_right_model');
        $this->load->model('Refproduct_model');
        $this->load->model('Journal_account_model');
        $this->load->model('Journal_info_model');
        $this->load->model('Asset_property_status_model');
        $this->load->model('Company_model');
        $this->load->model('Suppliers_model');
        $this->load->model('Email_settings_model');

    }


    public function index()
    {
        $data['company_info']=$this->Company_model->get_list(array('company_info'));
        
        $this->create_required_default_data();

        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);

        //WORKAROUND FOR LOGIN REDIRECTION TO DASHBOARD (if user session is ACTIVE)
        if($this->session->userdata('logged_in') == 1) {
            redirect(base_url('Dashboard'));
        } else {
            $company=$this->Company_model->get_list();
            $data['company']=$company[0];
            $this->load->view('login_view',$data); 
        }
        //END WORKAROUND FOR LOGIN REDIRECTION TO DASHBOARD (if user session is ACTIVE)

    }

    function get_expense($month){

        $m_journal=$this->Journal_account_model;
        $month=(strlen($month)==1?'0'.$month:$month);

        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y')."-".$month."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=5",

            '(SUM(journal_accounts.dr_amount)-SUM(journal_accounts.cr_amount)) as expense_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );

        return (float)(($info[0]->expense_amount==null?0:$info[0]->expense_amount));
    }


    function get_previous_year_income($month){

        $m_journal=$this->Journal_account_model;
        $month=(strlen($month)==1?'0'.$month:$month);

        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".(date('Y')-1)."-".$month."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );

        return (float)(($info[0]->income_amount==null?0:$info[0]->income_amount));
    }

    function get_current_year_income($month){

        $m_journal=$this->Journal_account_model;
        $month=(strlen($month)==1?'0'.$month:$month);

        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y')."-".$month."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );

        return (float)(($info[0]->income_amount==null?0:$info[0]->income_amount));
    }


    function create_required_default_data(){

        $m_asset_property=$this->Asset_property_status_model;
        $m_asset_property->create_default_asset_property();

        $m_links=$this->Rights_link_model;
        $m_links->create_default_link_list();

        //create default user : the admin
        $m_users=$this->Users_model;
        $m_users->create_default_user();

        $m_product_type=$this->Refproduct_model;
        $m_product_type->create_default_product_type();

        //create default user group : the Super User
        $m_user_groups=$this->User_groups_model;
        $m_user_groups->create_default_user_group();

        //create default tax types : Non-vat , Vatted(12%)
        $m_tax_types=$this->Tax_types_model;
        $m_tax_types->create_default_tax_type();

        //create default approval status
        $m_approval=$this->Approval_status_model;
        $m_approval->create_default_approval_status();

        //create default order status
        $m_approval=$this->Order_status_model;
        $m_approval->create_default_order_status();

        //create default account types
        $m_account_types=$this->Account_type_model;
        $m_account_types->create_default_account_types();

        $m_department=$this->Departments_model;
        $m_department->create_default_department();

        $m_item_type=$this->Item_type_model;
        $m_item_type->create_default_item_types();

        $m_payment_method=$this->Payment_method_model;
        $m_payment_method->create_default_payment_method();

        $m_account_class=$this->Account_class_model;
        $m_account_class->create_default_account_classes();

        $m_account_title=$this->Account_title_model;
        $m_account_title->create_default_account_title();

        $m_suppliers=$this->Suppliers_model;
        $m_suppliers->create_default_supplier();


    }


    function transaction($txn=null){

        switch($txn){

                //****************************************************************************
                case 'validate' :
                    $uname=$this->input->post('uname');
                    $pword=$this->input->post('pword'); 

                    $users=$this->Users_model;
                    $result=$users->authenticate_user($uname,$pword);

                    if($result->num_rows()>0) {//valid username and pword
                        $m_rights=$this->User_group_right_model;
                        $rights=$m_rights->get_list(
                            array(
                                'user_group_rights.user_group_id'=>$result->row()->user_group_id
                            ),
                            'user_group_rights.link_code'
                        );

                        $user_rights=array();
                        $parent_links=array();
                        foreach($rights as $right){
                            $main=explode('-',$right->link_code);
                            $user_rights[]=$right->link_code;
                            $parent_links[]=$main[0];
                        }

                        //set session data here and response data

                        $tktToken = $this->Users_model->generateToken($result->row()->user_id);

                        $this->session->set_userdata(
                            array(
                                'user_id'=>$result->row()->user_id,
                                'user_group_id'=>$result->row()->user_group_id,
                                'user_fullname'=>$result->row()->user_fullname,
                                'user_email'=>$result->row()->user_email,
                                'user_photo'=>$result->row()->photo_path,
                                'user_rights'=>$user_rights,
                                'parent_rights'=>$parent_links,
                                'logged_in'=>1,
                                'token_id'=>$tktToken

                            )
                        );

                        $m_users=$this->Users_model;
                        $m_users->is_online=1;
                        date_default_timezone_set('Asia/Manila');
                        $m_users->last_seen=date("Y-m-d H:i:s");
                        $m_users->token_id = $tktToken;
                        $m_users->modify($result->row()->user_id);

                        $token_id = $tktToken;

                        $response['title']='Success';
                        $response['stat']='success';
                        $response['msg']='User successfully authenticated.';
                        echo json_encode($response);
                    }

                    else{ //not valid

                        $response['title']='Cannot authenticate user!';
                        $response['stat']='error';
                        $response['msg']='Invalid username or password.';
                        
                        echo json_encode($response);

                    }

                    break;
                //****************************************************************************
                case 'logout' :
                    $m_users=$this->Users_model;
                    $m_users->is_online=0;
                    $m_users->modify($this->session->user_id);
                    
                    $this->end_session();
                //****************************************************************************
                break;

                default:


        }




    }

}
