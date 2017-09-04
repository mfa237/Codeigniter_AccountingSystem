<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_sheet extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
                'Account_class_model',
                'Journal_info_model',
                'Journal_account_model',
                'Departments_model',
                'Accounting_period_model',
                'Users_model',
                'Company_model'
            )
        );

        $this->load->library('M_pdf');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Balance Sheet';

        $data['departments']=$this->Departments_model->get_list('is_deleted=FALSE');


        (in_array('9-1',$this->session->user_rights)? 
        $this->load->view('balance_sheet_view', $data)
        :redirect(base_url('dashboard')));
        
    }




    function transaction($txn=null){
        switch($txn){
            case 'bs':
                //$as_of_date=$this->input->get('date',TRUE);
                $as_of_date=date("Y-m-d",strtotime($this->input->get('date',TRUE)));
                $department_id=$this->input->get('depid',TRUE);
                $type=$this->input->get('type',TRUE);

                $net_income_period=$this->get_period_on_closed_txn($as_of_date);
                if(count($net_income_period)>0){ //if specified date is between the closed period
                    $net_income_start=date("Y-m-d",strtotime($net_income_period[0]->period_start));
                    $net_income_end=date("Y-m-d",strtotime($as_of_date));
                }else{
                    //if date specified is not found on "closed accounting period"

                    //get the last closed date
                    $last_closed=$this->get_last_accounting_closed_date();
                    if(count($last_closed)>0){

                        $net_income_start=date("Y-m-d",strtotime("1 days",strtotime($last_closed[0]->last_closed_date)));
                        $net_income_end=date("Y-m-d",strtotime($as_of_date));

                        //make sure new start date base on the last closed date is not greater than to the specified date
                        if($net_income_start>$net_income_end){ //if greater than
                            $first_journal_txn=$this->get_journal_first_txn_date();
                            if(count($first_journal_txn)>0){ //there is journal transaction


                                $net_income_start=date("Y-m-d",strtotime($first_journal_txn[0]->first_txn_date));
                                $net_income_end=date("Y-m-d",strtotime($as_of_date));

                                //make sure journal first date is not greater than "as of date"
                                if($net_income_start>$net_income_end){
                                    $net_income_start=$net_income_end;
                                }

                            }else{ //if no transaction found

                                $net_income_start=date("Y-m-d",strtotime(date('Y',strtotime($as_of_date)))."-01-01"); //set it to january 1, of specified date
                                $net_income_end=date("Y-m-d",strtotime($as_of_date));
                            }

                        }

                    }else{
                        $first_journal_txn=$this->get_journal_first_txn_date();
                        if(count($first_journal_txn)>0){ //there is journal transaction


                            $net_income_start=date("Y-m-d",strtotime($first_journal_txn[0]->first_txn_date));
                            $net_income_end=date("Y-m-d",strtotime($as_of_date));

                            //make sure journal first date is not greater than "as of date"
                            if($net_income_start>$net_income_end){
                                $net_income_start=$net_income_end;
                            }

                        }else{ //if no transaction found

                            $net_income_start=date("Y-m-d",strtotime(date('Y',strtotime($as_of_date)))."-01-01"); //set it to january 1, of specified date
                            $net_income_end=date("Y-m-d",strtotime($as_of_date));
                        }

                    }
                }



                $m_journal_accounts=$this->Journal_account_model;

                //if id is 1, Main-All branches is selected, set it to null to disable filtering
                if($department_id==1){$department_id=null;}

                //get list of account classifications
                $data['acc_classes']=$m_journal_accounts->get_bs_account_classes($as_of_date,$department_id);
                //get list of parent account
                $data['acc_titles']=$m_journal_accounts->get_bs_parent_account_balances($as_of_date,$department_id);

                $data['prev_net_income']=$m_journal_accounts->get_net_income($net_income_start,$department_id);

                $data['current_year_earnings']=$m_journal_accounts->get_net_income(array(
                    $net_income_start,
                    $net_income_end
                ),$department_id);

                $data['date']=date("M d, Y",strtotime($as_of_date));
                $data['net_period']=date("M d, Y",strtotime($net_income_start))." to ".date("M d, Y",strtotime($net_income_end));

                $m_company=$this->Company_model;
                $company=$m_company->get_list();

                $data['company_info']=$company[0];
                $dep_info=$this->Departments_model->get_list($department_id);
                $data['dep_info']=$dep_info[0];

                if($type==null|$type=='preview'){
                    $this->load->view('template/balance_sheet_report',$data);
                }




                break;
        }
    }



    function get_period_on_closed_txn($date){
            $m_period=$this->Accounting_period_model;

            return $m_period->get_list(
                "'$date' BETWEEN period_start AND period_end",
                array(
                    'period_start',
                    'period_end'
                )
            );

    }

    function get_last_accounting_closed_date(){
        $m_period=$this->Accounting_period_model;

        return $m_period->get_list(
            null,
            array(
                'MAX(period_end) as last_closed_date'
            ),
            null,
            null,
            null,
            TRUE,
            null,
            'NOT ISNULL(last_closed_date)'
        );
    }


    function get_journal_first_txn_date(){
        $m_journal=$this->Journal_info_model;

        return $m_journal->get_list(
            null,
            array(
                'MIN(date_txn)as first_txn_date'
            ),
            null,
            null,
            null,
            TRUE,
            null,
            'NOT ISNULL(first_txn_date)'
        );
    }




}
