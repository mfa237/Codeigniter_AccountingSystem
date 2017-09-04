<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_receipt extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();

        $this->load->model(
            array(
                'Customers_model',
                'Account_title_model',
                'Payment_method_model',
                'Journal_info_model',
                'Journal_account_model',
                'Departments_model',
                'Receivable_payment_model',
                'Bank_model',
                'Users_model',
                'Accounting_period_model'
            )
        );

    }

    public function index() {
        $this->Users_model->validate();
        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);

        $data['customers']=$this->Customers_model->get_list('is_deleted=0');
        $data['accounts']=$this->Account_title_model->get_list();
        $data['methods']=$this->Payment_method_model->get_list('is_deleted=0');
        $data['departments']=$this->Departments_model->get_list('is_deleted=0');
        $data['banks']=$this->Bank_model->get_list('is_deleted=0');

        $data['title'] = 'Cash Receipt';
        (in_array('1-5',$this->session->user_rights)? 
        $this->load->view('cash_receipt_journal_view', $data)
        :redirect(base_url('dashboard')));
        
    }

    public function transaction($txn=null){
        switch($txn){
            case 'list':
                $m_journal=$this->Journal_info_model;
                $response['data']=$this->get_response_rows();
                echo json_encode($response);
                break;
            case 'get-entries':
                $journal_id=$this->input->get('id');
                $m_accounts=$this->Account_title_model;
                $m_journal_accounts=$this->Journal_account_model;

                $data['accounts']=$m_accounts->get_list();
                $data['entries']=$m_journal_accounts->get_list('journal_accounts.journal_id='.$journal_id);

                $this->load->view('template/journal_entries', $data);
                break;
            case 'create' :
                $m_journal=$this->Journal_info_model;
                $m_journal_accounts=$this->Journal_account_model;

                //validate if still in valid range
                $valid_range=$this->Accounting_period_model->get_list("'".date('Y-m-d',strtotime($this->input->post('date_txn',TRUE)))."'<=period_end");
                if(count($valid_range)>0){
                    $response['stat']='error';
                    $response['title']='<b>Accounting Period is Closed!</b>';
                    $response['msg']='Please make sure transaction date is valid!<br />';
                    die(json_encode($response));
                }

                $m_journal->customer_id=$this->input->post('customer_id',TRUE);
                $m_journal->remarks=$this->input->post('remarks',TRUE);
                $m_journal->date_txn=date('Y-m-d',strtotime($this->input->post('date_txn',TRUE)));
                $m_journal->book_type='CRJ';
                $m_journal->department_id=$this->input->post('department_id');
                $m_journal->payment_method_id=$this->input->post('payment_method');
                $m_journal->check_date=date('Y-m-d',strtotime($this->input->post('check_date',TRUE)));
                $m_journal->amount=$this->get_numeric_value($this->input->post('amount'));
                $m_journal->or_no=$this->input->post('or_no');
                $m_journal->check_no=$this->input->post('check_no');
                $m_journal->bank_id=$this->input->post('bank');
                $m_journal->ref_no=$this->input->post('ref_no');


                //for audit details
                $m_journal->set('date_created','NOW()');
                $m_journal->created_by_user=$this->session->user_id;
                $m_journal->save();

                $journal_id=$m_journal->last_insert_id();
                $accounts=$this->input->post('accounts',TRUE);
                $memos=$this->input->post('memo',TRUE);
                $dr_amounts=$this->input->post('dr_amount',TRUE);
                $cr_amounts=$this->input->post('cr_amount',TRUE);

                for($i=0;$i<=count($accounts)-1;$i++){
                    $m_journal_accounts->journal_id=$journal_id;
                    $m_journal_accounts->account_id=$accounts[$i];
                    $m_journal_accounts->memo=$memos[$i];
                    $m_journal_accounts->dr_amount=$this->get_numeric_value($dr_amounts[$i]);
                    $m_journal_accounts->cr_amount=$this->get_numeric_value($cr_amounts[$i]);
                    $m_journal_accounts->save();
                }


                //update transaction number base on formatted last insert id
                $m_journal->txn_no='TXN-'.date('Ymd').'-'.$journal_id;
                $m_journal->modify($journal_id);



                $payment_id=$this->input->post('payment_id',TRUE);
                if($payment_id!=null){
                    $m_receivable_payment=$this->Receivable_payment_model;
                    $m_receivable_payment->journal_id=$journal_id;
                    $m_receivable_payment->is_journal_posted=TRUE;
                    $m_receivable_payment->modify($payment_id);
                }


                $response['stat']='success';
                $response['title']='Success!';
                $response['msg']='Journal successfully posted';
                $response['row_added']=$this->get_response_rows($journal_id);
                echo json_encode($response);
                break;
            case 'update':
                $journal_id=$this->input->get('id');
                $m_journal=$this->Journal_info_model;
                $m_journal_accounts=$this->Journal_account_model;

                //validate if this transaction is not yet closed
                $not_closed=$m_journal->get_list('accounting_period_id>0 AND journal_id='.$journal_id);
                if(count($not_closed)>0){
                    $response['stat']='error';
                    $response['title']='<b>Journal is Locked!</b>';
                    $response['msg']='Sorry, you cannot update journal that is already closed!<br />';
                    die(json_encode($response));
                }

                //validate if still in valid range
                $valid_range=$this->Accounting_period_model->get_list("'".date('Y-m-d',strtotime($this->input->post('date_txn',TRUE)))."'<=period_end");
                if(count($valid_range)>0){
                    $response['stat']='error';
                    $response['title']='<b>Accounting Period is Closed!</b>';
                    $response['msg']='Please make sure transaction date is valid!<br />';
                    die(json_encode($response));
                }

                $m_journal->customer_id=$this->input->post('customer_id',TRUE);
                $m_journal->remarks=$this->input->post('remarks',TRUE);
                $m_journal->date_txn=date('Y-m-d',strtotime($this->input->post('date_txn',TRUE)));
                $m_journal->book_type='CRJ';
                $m_journal->department_id=$this->input->post('department_id');
                $m_journal->payment_method_id=$this->input->post('payment_method');
                $m_journal->check_date=date('Y-m-d',strtotime($this->input->post('check_date',TRUE)));
                $m_journal->amount=$this->get_numeric_value($this->input->post('amount'));
                $m_journal->or_no=$this->input->post('or_no');
                $m_journal->check_no=$this->input->post('check_no');
                $m_journal->bank_id=$this->input->post('bank');

                //for audit details
                $m_journal->set('date_modified','NOW()');
                $m_journal->modified_by_user=$this->session->user_id;
                $m_journal->modify($journal_id);


                $accounts=$this->input->post('accounts',TRUE);
                $memos=$this->input->post('memo',TRUE);
                $dr_amounts=$this->input->post('dr_amount',TRUE);
                $cr_amounts=$this->input->post('cr_amount',TRUE);

                $m_journal_accounts->delete_via_fk($journal_id);

                for($i=0;$i<=count($accounts)-1;$i++){
                    $m_journal_accounts->journal_id=$journal_id;
                    $m_journal_accounts->account_id=$accounts[$i];
                    $m_journal_accounts->memo=$memos[$i];
                    $m_journal_accounts->dr_amount=$this->get_numeric_value($dr_amounts[$i]);
                    $m_journal_accounts->cr_amount=$this->get_numeric_value($cr_amounts[$i]);
                    $m_journal_accounts->save();
                }


                $response['stat']='success';
                $response['title']='Success!';
                $response['msg']='Journal successfully updated';
                $response['row_updated']=$this->get_response_rows($journal_id);
                echo json_encode($response);
                break;

            //***************************************************************************************
            case 'cancel':
                $m_journal=$this->Journal_info_model;
                $journal_id=$this->input->post('journal_id',TRUE);

                //validate if this transaction is not yet closed
                $not_closed=$m_journal->get_list('accounting_period_id>0 AND journal_id='.$journal_id);
                if(count($not_closed)>0){
                    $response['stat']='error';
                    $response['title']='<b>Journal is Locked!</b>';
                    $response['msg']='Sorry, you cannot cancel journal that is already closed!<br />';
                    die(json_encode($response));
                }

                //mark Items as deleted
                $m_journal->set('date_cancelled','NOW()'); //treat NOW() as function and not string
                $m_journal->cancelled_by_user=$this->session->user_id;//user that cancelled the record
                $m_journal->set('is_active','NOT is_active');
                $m_journal->modify($journal_id);



                $response['title']='Cancelled!';
                $response['stat']='success';
                $response['msg']='Journal successfully cancelled.';
                $response['row_updated']=$this->get_response_rows($journal_id);

                echo json_encode($response);

                break;
        };
    }



    public function get_response_rows($criteria=null){
        $m_journal=$this->Journal_info_model;
        return $m_journal->get_list(

            "journal_info.is_deleted=FALSE AND journal_info.book_type='CRJ'".($criteria==null?'':' AND journal_info.journal_id='.$criteria),

            array(
                'journal_info.journal_id',
                'journal_info.txn_no',
                'DATE_FORMAT(journal_info.date_txn,"%m/%d/%Y")as date_txn',
                'journal_info.is_active',
                'journal_info.remarks',
                'journal_info.customer_id',
                'journal_info.or_no',
                'journal_info.check_no',
                'payment_methods.payment_method_id',
                'journal_info.department_id',
                'DATE_FORMAT(journal_info.check_date,"%m/%d/%Y")as check_date',
                'journal_info.amount',
                'journal_info.bank_id',
                'customers.customer_name as particular',
                'CONCAT_WS(" ",user_accounts.user_fname,user_accounts.user_lname)as posted_by'
            ),
            array(
                array('customers','customers.customer_id=journal_info.customer_id','left'),
                array('user_accounts','user_accounts.user_id=journal_info.created_by_user','left'),
                array('payment_methods','payment_methods.payment_method_id=journal_info.payment_method_id','left'),
                array('departments','departments.department_id=journal_info.department_id','left')
            ),
            'journal_info.journal_id DESC'
        );
    }






}
