<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_titles extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Account_title_model');
        $this->load->model('Account_type_model');
        $this->load->model('Account_class_model');
        $this->load->model('Journal_info_model');
        $this->load->model('Journal_account_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Chart of Accounts';



        $data['classifications']=$this->Account_class_model->get_list(array('account_classes.is_active'=>TRUE,'account_classes.is_deleted'=>FALSE),null,null,'account_classes.account_class ASC');
        $data['types']=$this->Account_type_model->get_list(null,null,null,'account_types.account_type');
        $data['parents']=$this->Account_title_model->get_list(array('account_titles.is_active'=>TRUE,'account_titles.is_deleted'=>FALSE),null,null,'account_titles.account_title ASC');
        $data['accounts']=$this->get_account_hierarchy();
        (in_array('6-2',$this->session->user_rights)? 
        $this->load->view('account_titles_view', $data)
        :redirect(base_url('dashboard')));
        
    }


    function transaction($txn=null,$filter_id=null){
        switch($txn){
            case 'list':
                $m_accounts=$this->Account_title_model;
                $response['data']=$this->response_rows($filter_id); //filter_id is default as null
                echo json_encode($response);
                break;
            case 'create':
                $m_accounts=$this->Account_title_model;
                $parent_account_id=(float)$this->input->post('parent_account',TRUE);
                $account_no=$this->input->post('account_no',TRUE);


                $m_accounts->begin();

                $m_accounts->set('date_created','NOW()');
                $m_accounts->created_by_user=$this->session->user_id;

                $m_accounts->account_no=$account_no;
                $m_accounts->account_title=$this->input->post('account_title',TRUE);
                $m_accounts->account_class_id=$this->input->post('account_class',TRUE);
                $m_accounts->parent_account_id=$parent_account_id;
                $m_accounts->save();


                //update grandparent id
                $account_id=$m_accounts->last_insert_id();
                if($parent_account_id>0){ //if there is selected parent, get the grand parent id

                    $grand_parent_id=$m_accounts->get_list($parent_account_id,'account_titles.grand_parent_id,account_titles.account_class_id');
                    $m_accounts->grand_parent_id=$grand_parent_id[0]->grand_parent_id;
                    $m_accounts->account_class_id=$grand_parent_id[0]->account_class_id; //to make sure account class of parent and its child are the same

                }else{ //parent id has post 0 value, it means this account has no parent, set by default it self as its grand parent id
                    $m_accounts->grand_parent_id=$account_id;
                }
                $m_accounts->modify($account_id);


                $m_accounts->commit();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Account successfully created.';
                $response['row_added']=$this->response_rows($account_id);
                $response['parents']=$m_accounts->get_list(null,array('account_titles.account_id','account_titles.account_title'),null,'account_titles.account_title');
                $response['row_hierarchy']=$this->get_account_hierarchy();

                echo json_encode($response);
                break;
            case 'update':
                $m_accounts=$this->Account_title_model;
                $parent_account_id=(float)$this->input->post('parent_account',TRUE);
                $account_no=$this->input->post('account_no',TRUE);
                $account_id=$this->input->post('account_id',TRUE);
                $account_class_id=$this->input->post('account_class',TRUE);

                //******************************************************************************************************
                //make sure, you cannot update parent account to its own child account


                $m_accounts->begin();

                $m_accounts->set('date_modified','NOW()');
                $m_accounts->modified_by_user=$this->session->user_id;

                $m_accounts->account_no=$account_no;
                $m_accounts->account_title=$this->input->post('account_title',TRUE);
                $m_accounts->account_class_id=$account_class_id;
                $m_accounts->parent_account_id=$parent_account_id;
                $m_accounts->modify($account_id);


                //update grandparent id
                $account_id=$m_accounts->last_insert_id();
                if($parent_account_id>0){ //if there is selected parent, get the grand parent id

                    $grand_parent=$m_accounts->get_list($parent_account_id,'account_titles.grand_parent_id,account_titles.account_class_id');
                    $grand_parent_id=$grand_parent[0]->grand_parent_id;
                    $m_accounts->grand_parent_id=$grand_parent_id;


                }else{ //parent id has post 0 value, it means this account has no parent, set by default it self as its grand parent id
                    $grand_parent_id=$account_id;
                    $m_accounts->grand_parent_id=$grand_parent_id;
                }
                $m_accounts->modify($account_id);


                //FOR UPDATE ONLY!!!!!!!!
                //$account_class=$m_accounts->get_list($grand_parent_id,'account_titles.account_class_id');
                //$m_accounts->account_class_id=$account_class[0]->account_class_id;
                //$m_accounts->modify($account_id);



                $m_accounts->commit();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Account successfully update.';
                $response['parents']=$m_accounts->get_list(null,array('account_titles.account_id','account_titles.account_title'),null,'account_titles.account_title');
                $response['row_updated']=$this->response_rows($account_id);
                $response['row_hierarchy']=$this->get_account_hierarchy();

                echo json_encode($response);
                break;
            case 'delete':
                $m_accounts=$this->Account_title_model;

                $m_journal=$this->Journal_info_model;
                $m_journal_accounts=$this->Journal_account_model;

                $account_id=$this->input->post('account_id',TRUE);

                if(count($m_accounts->get_list(

                    'journal_info.is_active=1 AND account_titles.account_id='.$account_id,

                    'account_titles.account_id',

                    array(
                        array('journal_accounts','journal_accounts.account_id=account_titles.account_id','left'),
                        array('journal_info','journal_info.journal_id=journal_accounts.journal_id','left')
                    )

                ))>0){  

                    $response['title'] = 'Cannot delete!';
                    $response['stat'] = 'error';
                    $response['msg'] = 'This account still has an active transaction in General Info.';

                    echo json_encode($response);
                    exit;
                }

                else {

                    //******************************************************************************************************
                    //make sure, you cannot delete account with child accounts

                    //mark Items as deleted
                    $m_accounts->set('date_deleted','NOW()'); //treat NOW() as function and not string
                    $m_accounts->deleted_by_user=$this->session->user_id;//user that deleted the record
                    $m_accounts->is_deleted=1   ;//mark as deleted
                    $m_accounts->modify($account_id);



                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Account successfully deleted.';
                    $response['row_hierarchy']=$this->get_account_hierarchy();
                    echo json_encode($response);
                }

                break;
        }
    }



    function get_account_hierarchy(){
        $titles=$this->Account_title_model->get_list(
            'account_titles.is_active=TRUE AND account_titles.is_deleted=FALSE',
            array(
                'account_titles.account_id as id',
                'IF(account_titles.parent_account_id=0,CONCAT("C",CAST(account_titles.account_class_id AS CHAR)),account_titles.parent_account_id) as pId',
                'account_titles.account_title as name',
                'account_titles.account_title as title',
                '"true" as open',
                '"assets/plugins/zTree/img/diy/3.png" as icon'
            ),
            array(
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','left'),
                array('account_types','account_types.account_type_id=account_classes.account_type_id','left')
            )
        );


        $classes=$this->Account_class_model->get_list(
            'account_titles.is_active=TRUE AND account_titles.is_deleted=FALSE', //account title as its filter
            array(
                'CONCAT("C",CAST(account_classes.account_class_id AS CHAR)) as id',
                'CONCAT("T",CAST(account_classes.account_type_id AS CHAR)) as pId',
                'account_classes.account_class as name',
                'account_classes.account_class as title',
                '"true" as open',
                '"assets/plugins/zTree/img/diy/11.png" as icon'
            ),
            array(
                array('account_titles','account_titles.account_class_id=account_classes.account_class_id','inner')
            ),
            null,
            'account_titles.account_class_id'
        );


        $types=$this->Account_type_model->get_list(
            null,
            array(
                'CONCAT("T",CAST(account_types.account_type_id AS CHAR)) as id',
                '"" as pId',
                'account_types.account_type as name',
                'account_types.account_type as title',
                '"true" as open',
                '"assets/plugins/zTree/img/diy/1_open.png" as iconOpen',
                '"assets/plugins/zTree/img/diy/1_close.png" as iconClose'
            )
        );

        //$x=0;
        $accounts=array();

        foreach($titles as $item){
            $accounts[]=$item;

        }

        foreach($classes as $item){
            $accounts[]=$item;

        }

        foreach($types as $item){
            $accounts[]=$item;

        }

        return $accounts;
    }


    function response_rows($account_id){
        $m_accounts=$this->Account_title_model;

        return $m_accounts->get_list(
            'account_titles.is_active=TRUE AND account_titles.is_deleted=FALSE '.($account_id==null?'':' AND account_titles.account_id='.$account_id),
            'account_titles.*,parent.account_title as parent_account,account_classes.account_class,account_types.account_type,IF(account_titles.parent_account_id=0,CONCAT("C",CAST(account_titles.account_class_id AS CHAR)),account_titles.parent_account_id) as pId',

            array(
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','left'),
                array('account_types','account_types.account_type_id=account_classes.account_type_id','left'),
                array('account_titles as parent','parent.account_id=account_titles.parent_account_id','left')
            ),
            'account_titles.account_id DESC'
        );
    }
 

}
