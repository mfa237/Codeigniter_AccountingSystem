<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payable_payments extends CORE_Controller
{

    function __construct() {
        parent::__construct('');

        $this->validate_session();

        $this->load->model('Payable_payment_model');
        $this->load->model('Payable_payment_list_model');
        $this->load->model('Suppliers_model');
        $this->load->model('Payment_method_model');
        $this->load->model('Departments_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        //default resources of the active view
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);

        //data required by active view
        $data['suppliers']=$this->Suppliers_model->get_list();
        $data['methods']=$this->Payment_method_model->get_list(array('is_active'=>TRUE,'is_deleted'=>FALSE));
        $data['departments']=$this->Departments_model->get_list(array('is_active'=>TRUE,'is_deleted'=>FALSE));

        $data['title'] = 'AP Payment';
        
        (in_array('2-3',$this->session->user_rights)? 
        $this->load->view('payment_payable_view', $data)
        :redirect(base_url('dashboard')));
    }


    function transaction($txn=null,$filter_value=null){
        switch($txn){
            case 'list':
                $response['data']=$this->response_rows($filter_value,FALSE);
                echo json_encode($response);
                break;

            //***********************************************************************************************

            case 'create':
                $m_payment=$this->Payable_payment_model;
                $m_payment_items=$this->Payable_payment_list_model;

                $receipt_no=$this->input->post('receipt_no',TRUE);
                //******************************************************************************************************
                //IMPORTANT!!!!!
                //validation
                if(count(
                        $m_payment->get_list(
                            array(
                                'payable_payments.receipt_no'=>$receipt_no,
                                'payable_payments.is_active'=>TRUE,
                                'payable_payments.is_deleted'=>FALSE
                            )
                        )
                    )>0
                ) {
                    $response['title']="Error!";
                    $response['stat']="error";
                    $response['msg']="Invalid receipt number. Please make sure receipt number do not exists.";
                    echo json_encode($response);
                    exit;
                }
                //******************************************************************************************************


                $m_payment->begin();
                //details for auditing
                $m_payment->set('date_created','NOW()');
                $m_payment->created_by_user=$this->session->user_id;

                //payment details
                $m_payment->receipt_no=$receipt_no;
                $m_payment->supplier_id=$this->input->post('supplier_id',TRUE);


                $m_payment->department_id=$this->input->post('department',TRUE);
                $payment_method_id=$this->input->post('payment_method',TRUE);
                $m_payment->payment_method_id=$payment_method_id;

                if($payment_method_id==2){ //if check, insert additional infos
                    $m_payment->check_date_type=($this->input->post('check_date_type',TRUE)?1:2);
                    $m_payment->check_no=$this->input->post('check_no',TRUE);
                    $m_payment->check_date=date('Y-m-d',strtotime($this->input->post('check_date',TRUE)));
                }

                $m_payment->total_paid_amount=$this->get_numeric_value($this->input->post('total_paid_amount',TRUE));
                $m_payment->remarks=$this->input->post('remarks',TRUE);
                $m_payment->date_paid=date('Y-m-d',strtotime($this->input->post('date_paid',TRUE)));
                $m_payment->save();

                //payment to purchase invoice, amount per line
                $payment_id=$m_payment->last_insert_id();
                $payment_amount=$this->input->post('payment_amount',TRUE);
                $dr_invoice_id=$this->input->post('dr_invoice_id',TRUE);
                $payable_amount=$this->input->post('payable_amount',TRUE);

                for($i=0;$i<=count($payment_amount)-1;$i++){
                    $m_payment_items->payment_id=$payment_id;
                    $m_payment_items->dr_invoice_id=$dr_invoice_id[$i];
                    $m_payment_items->payment_amount=$this->get_numeric_value($payment_amount[$i]);
                    $m_payment_items->payable_amount=$this->get_numeric_value($payable_amount[$i]);
                    $m_payment_items->save();
                }


                //******************************************************************************************
                // IMPORTANT!!!
                //update payable amount field of supplier table
                $m_suppliers=$this->Suppliers_model;
                $m_suppliers->recalculate_supplier_payable($this->input->post('supplier_id',TRUE));
                //******************************************************************************************



                $m_payment->commit();

                if($m_payment->status()===TRUE){
                    $response['title']="Success!";
                    $response['stat']="success";
                    $response['msg']="Payment successfully recorded.";
                    $response['row_added']=$this->response_rows($payment_id);
                    echo json_encode($response);
                }


                break;


            //***********************************************************************************************
            case 'cancel':
                $payment_id=$this->input->post('payment_id',TRUE);
                $m_payment=$this->Payable_payment_model;


                $m_payment->begin();

                $m_payment->set('date_cancelled','NOW()');
                $m_payment->is_active=0;
                $m_payment->cancelled_by_user=$this->session->user_id;
                $m_payment->modify($payment_id);

                //get the supplier id of the payment transaction being cancelled
                $id=$m_payment->get_list($payment_id,'payable_payments.supplier_id');
                $supplier_id=$id[0]->supplier_id;

                //******************************************************************************************
                // IMPORTANT!!!
                //update payable amount field of supplier table
                $m_suppliers=$this->Suppliers_model;
                $m_suppliers->recalculate_supplier_payable($supplier_id);
                //******************************************************************************************

                $m_payment->commit();

                if($m_payment->status()===TRUE){
                    $response['title']="Success!";
                    $response['stat']="success";
                    $response['msg']="Payment successfully cancelled.";
                    $response['row_updated']=$this->response_rows($payment_id);
                    echo json_encode($response);
                }

                break;
            case 'expense-for-review':
                $response['data']=$this->response_rows(null,TRUE); //show only unposted data
                echo json_encode($response);
                break;
        }
    }

    function response_rows($id,$show_unposted=FALSE){
        $m_payments=$this->Payable_payment_model;
        return $m_payments->get_list(
            //filter
            'payable_payments.is_deleted=0 '.($id==null?'':' AND payable_payments.payment_id='.$id).
            ($show_unposted==FALSE?"":" AND payable_payments.is_posted=FALSE AND payable_payments.is_active=TRUE"),
            //fields
            array(
                'payable_payments.*',
                'DATE_FORMAT(payable_payments.date_paid,"%m/%d/%Y")as date_paid',
                'FORMAT(payable_payments.total_paid_amount,2)as total_paid_amount',
                'suppliers.supplier_name',
                'payment_methods.payment_method',
                'CONCAT_WS(" ",user_accounts.user_fname,user_accounts.user_lname)as posted_by_user',
                'DATEDIFF(payable_payments.check_date,NOW()) as rem_day_for_due'
            ),
            //joins
            array(
                array('suppliers','suppliers.supplier_id=payable_payments.supplier_id','left'),
                array('user_accounts','user_accounts.user_id=payable_payments.created_by_user','left'),
                array('payment_methods','payment_methods.payment_method_id=payable_payments.payment_method_id','left')
            ),
            'payable_payments.payment_id DESC'

        );
    }














}
