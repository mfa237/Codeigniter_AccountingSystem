<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CORE_Controller {

    function __construct()
    {
        parent::__construct('');
        $this->validate_session();
        $this->load->model(array(
            'Journal_info_model',
            'Journal_account_model',
            'Users_model',
            'Company_model',
            'Customers_model',
            'Suppliers_model'
        ));

    }

    public function index()
    {
        $this->Users_model->validate();
        $data['_def_css_files']=$this->load->view('template/assets/css_files','',TRUE);
        $data['_def_js_files']=$this->load->view('template/assets/js_files','',TRUE);
        $data['_switcher_settings']=$this->load->view('template/elements/switcher','',TRUE);
        $data['_side_bar_navigation']=$this->load->view('template/elements/side_bar_navigation','',TRUE);
        $data['_top_navigation']=$this->load->view('template/elements/top_navigation','',TRUE);

        $data['title']='Dashboard';

        $data['company_info']=$this->Company_model->get_list(array('company_info'));
        
        $m_journal=$this->Journal_account_model;
        $m_journal_info=$this->Journal_info_model;

        $customer_count=$this->Customers_model->get_list(
          'is_deleted=false AND is_active=true',
          'COUNT(*) as count'
        );

        $receivables=$m_journal->get_receivable_balance();
        $payables=$m_journal->get_payable_balance();

        $data['receivables']=$receivables[0];
        $data['payables']=$payables[0];

        $data['customer_count']=$customer_count[0]->count;

        $suppliers_count=$this->Suppliers_model->get_list(
          'is_deleted=false AND is_active=true',
          'COUNT(*) as count'
        );

        $data['suppliers_count']=$suppliers_count[0]->count;

        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y-m-d')."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $income_this_day=$info[0]->income_amount;
        $data['income_this_day']=$income_this_day;


        $yesterday=date('Y-m-d', strtotime("yesterday"));
        $info=$m_journal->get_list(

            "journal_info.date_txn='$yesterday' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $income_yesterday=$info[0]->income_amount;
        $data['income_yesterday']=$income_yesterday;


        /**
         * get income of previous week
         */
        $period_end=date('Y-m-d', strtotime("last sunday"));
        $period_start=date('Y-m-d',strtotime('-6 days',strtotime("last sunday")));
        $info=$m_journal->get_list(

            "journal_info.date_txn BETWEEN '$period_start' AND '$period_end' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )
        );
        $income_last_week=$info[0]->income_amount;
        $data['income_last_week']=$income_last_week;

        $full_income_period=$income_this_day+$income_yesterday+$income_last_week;
        if($full_income_period>0){
            $this_day_percentage=(100*$income_this_day)/$full_income_period;
            $yesterday_percentage=(100*$income_yesterday)/$full_income_period;
            $last_week_percentage=(100*$income_last_week)/$full_income_period;
        }else{
            $this_day_percentage=0;
            $yesterday_percentage=0;
            $last_week_percentage=0;
        }
        $data['this_day_percentage']=$this_day_percentage;
        $data['yesterday_percentage']=$yesterday_percentage;
        $data['last_week_percentage']=$last_week_percentage;



        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y-m')."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $data['income_current_month']=$info[0]->income_amount;


        /**
         * get previous month income
         */
        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y-m',strtotime('-1 month'))."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $data['income_last_month']=$info[0]->income_amount;

        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y')."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $income_this_year=$info[0]->income_amount;
        $data['income_this_year']=$income_this_year;


        /**
         * income from previous year
         */
        $info=$m_journal->get_list(

            "journal_info.date_txn LIKE '".date('Y',strtotime('-1 year'))."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND account_classes.account_type_id=4",

            '(SUM(journal_accounts.cr_amount)-SUM(journal_accounts.dr_amount)) as income_amount',

            array(
                array('journal_info','journal_info.journal_id=journal_accounts.journal_id','inner'),
                array('account_titles','account_titles.account_id=journal_accounts.account_id','inner'),
                array('account_classes','account_classes.account_class_id=account_titles.account_class_id','inner')
            )

        );
        $income_last_year=$info[0]->income_amount;
        $data['income_last_year']=$income_last_year;


        /**
         * compute percentage on total income
         */
        $full_percentage=$income_this_year+$income_last_year;
        if($full_percentage>0){
            $this_year_percentage=(100*$income_this_year)/$full_percentage;
            $last_year_percentage=(100*$income_last_year)/$full_percentage;
        }else{
            $this_year_percentage=0;
            $last_year_percentage=0;
        }


        $data['this_year_income_percentage']=$this_year_percentage;
        $data['last_year_income_percentage']=$last_year_percentage;


        /**
         * get total number of clients on previous year
         */
        $info=$m_journal_info->get_list(
            "journal_info.date_txn LIKE '".date('Y',strtotime('-1 year'))."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND journal_info.customer_id>0"
            ,
            'COUNT(journal_info.customer_id)as total_clients',
            null,
            null
        );
        $data['total_last_year_client']=$info[0]->total_clients;


        /**
         * get total number of clients this year
         */
        $info=$m_journal_info->get_list(

            "journal_info.date_txn LIKE '".date('Y')."%' AND journal_info.is_active=TRUE AND journal_info.is_deleted=FALSE AND journal_info.customer_id>0",

            'COUNT(DISTINCT journal_info.customer_id)as total_clients',
            null,
            null

        );
        $data['total_current_year_client']=$info[0]->total_clients;


        $current_year_income_monthly=array();
        $previous_year_income_monthly=array();
        $expense_monthly=array();

        for($i=1;$i<=12;$i++){

            $current_year_income_monthly[]=$this->get_current_year_income($i);
            $previous_year_income_monthly[]=$this->get_previous_year_income($i);

            $expense_monthly[]=$this->get_expense($i);
        }

        $data['current_year_income_monthly']=$current_year_income_monthly;
        $data['previous_year_income_monthly']=$previous_year_income_monthly;
        $data['expense_monthly']=$expense_monthly;

        $m_users=$this->Users_model;
        
        $online_count=$m_users->get_list(
            'is_online=TRUE',
            'COUNT(is_online) AS count_online'
        );

        $data['online_count']=$online_count[0]->count_online;

        $params['activities']=$m_users->get_newsfeed();
        $template_news_feed = $this->load->view('template/activity_feed_content',$params,TRUE);

        $data['news_feed'] = $template_news_feed;

        $this->load->view('dashboard_view',$data);
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




}
