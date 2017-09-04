<?php

class Journal_account_model extends CORE_Model{

    protected  $table="journal_accounts"; //table name
    protected  $pk_id="journal_account_id"; //primary key id
    protected  $fk_id="journal_id"; //foreign key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_payable_balance() {
        $sql="SELECT 
            IF(ac.account_type_id = 1
                    OR ac.account_type_id = 5,
                (SUM(ja.dr_amount) - SUM(ja.cr_amount)),
                (SUM(ja.cr_amount) - SUM(ja.dr_amount))) AS Balance
        FROM
            journal_accounts ja
                INNER JOIN
            journal_info ji ON ji.journal_id = ja.journal_id
                LEFT JOIN
            account_titles at ON at.account_id = ja.account_id
                LEFT JOIN
            account_classes ac ON ac.account_class_id = at.account_class_id
        WHERE
            ja.account_id IN (SELECT 
                    payable_account_id
                FROM
                    account_integration)
                AND ji.is_deleted = FALSE
                AND ji.is_active = TRUE";

        return $this->db->query($sql)->result();
    }

    function get_receivable_balance() {
        $sql="SELECT 
            IF(ac.account_type_id = 1
                    OR ac.account_type_id = 5,
                (SUM(ja.dr_amount) - SUM(ja.cr_amount)),
                (SUM(ja.cr_amount) - SUM(ja.dr_amount))) AS Balance
        FROM
            journal_accounts ja
                INNER JOIN
            journal_info ji ON ji.journal_id = ja.journal_id
                LEFT JOIN
            account_titles at ON at.account_id = ja.account_id
                LEFT JOIN
            account_classes ac ON ac.account_class_id = at.account_class_id
        WHERE
            ja.account_id IN (SELECT 
                    receivable_account_id
                FROM
                    account_integration)
                AND ji.is_deleted = FALSE
                AND ji.is_active = TRUE";

        return $this->db->query($sql)->result();
    }

    function get_bs_account_classes($date,$department_id=null){
        $sql="SELECT ac.account_type_id,ac.account_class_id,ac.account_class
                FROM (journal_accounts as ja
                INNER JOIN journal_info as ji ON ji.journal_id=ja.journal_id)
                INNER JOIN (account_titles as at
                INNER JOIN account_classes as ac ON ac.account_class_id=at.account_class_id)
                ON at.account_id=ja.account_id
                WHERE
                  ac.account_type_id IN(1,2,3) AND ji.is_active=TRUE AND ji.is_deleted=FALSE
                  AND ji.date_txn<='$date'
                  ".($department_id==null?"":" AND ji.department_id=$department_id")."
                GROUP BY ac.account_class_id
            ";
        return $this->db->query($sql)->result();
    }


    function get_bs_parent_account_balances($date,$department_id=null){
        $sql="SELECT m.*,mQat.account_title
                FROM
                (SELECT at.grand_parent_id,at.account_class_id,ac.account_type_id,
                (
                    IF(ac.account_type_id=1,
                    SUM(ja.dr_amount)-SUM(ja.cr_amount),
                    SUM(ja.cr_amount)-SUM(ja.dr_amount))
                ) as balance
                FROM (journal_accounts as ja
                INNER JOIN journal_info as ji ON ji.journal_id=ja.journal_id)
                INNER JOIN (account_titles as at
                INNER JOIN account_classes as ac ON ac.account_class_id=at.account_class_id)
                ON at.account_id=ja.account_id
                WHERE ac.account_type_id IN(1,2,3) AND ji.is_active=TRUE AND ji.is_deleted=FALSE
                AND ji.date_txn<='$date'
                ".($department_id==null?"":" AND ji.department_id=$department_id")."
                GROUP BY at.grand_parent_id) as m
                LEFT JOIN account_titles as mQat ON mQat.account_id=m.grand_parent_id
        ";
        return $this->db->query($sql)->result();
    }


    function get_net_income($date_filter,$department_id=null){
        $sql="SELECT (SUM(m.income_balance)-SUM(m.expense_balance)) as net_income

                FROM

                (SELECT IFNULL((SUM(ja.cr_amount)-SUM(ja.dr_amount)),0)as income_balance,0 as expense_balance FROM (journal_accounts as ja
                INNER JOIN (account_titles as at
                INNER JOIN account_classes as ac ON ac.account_class_id=at.account_class_id)
                ON at.account_id=ja.account_id)
                INNER JOIN journal_info as ji ON ja.journal_id=ji.journal_id
                WHERE ac.account_type_id=4 AND ji.is_active=TRUE AND ji.is_deleted=FALSE
                ".(is_array($date_filter)?" AND ji.date_txn BETWEEN '".date("Y-m-d",strtotime($date_filter[0]))."' AND '".date("Y-m-d",strtotime($date_filter[1]))."'":" AND ji.date_txn<'".date("Y-m-d",strtotime($date_filter))."'")."
                ".($department_id==null?"":" AND ji.department_id=$department_id")."
                UNION ALL

                SELECT 0 as income_balance,IFNULL((SUM(ja.dr_amount)-SUM(ja.cr_amount)),0)as expense_balance  FROM (journal_accounts as ja
                INNER JOIN (account_titles as at
                INNER JOIN account_classes as ac ON ac.account_class_id=at.account_class_id)
                ON at.account_id=ja.account_id)
                INNER JOIN journal_info as ji ON ja.journal_id=ji.journal_id
                WHERE ac.account_type_id=5 AND ji.is_active=TRUE AND ji.is_deleted=FALSE
                ".(is_array($date_filter)?" AND ji.date_txn BETWEEN '".date("Y-m-d",strtotime($date_filter[0]))."' AND '".date("Y-m-d",strtotime($date_filter[1]))."'":" AND ji.date_txn<'".date("Y-m-d",strtotime($date_filter))."'")."
                ".($department_id==null?"":" AND ji.department_id=$department_id")."
                ) as m

                ";

        $net_income_result=$this->db->query($sql)->result();
        return (count($net_income_result)>0?$net_income_result[0]->net_income:0);
    }


    function get_bs_account_balances($date){

        //get what period the argument date is
        $sql="SELECT period_start,period_end FROM accounting_period WHERE '$date' BETWEEN period_start AND period_end";
        $period=$this->db->query($sql);

        //*************GET PERIOD START AND PERIOD END OF NET INCOME
        if(count($period)>0){ //if period is found, means this period is already closed

                //we will be using the start date of the "closed period" and "As of Date" argument/parameter to Filter Net Income
                $net_income_start=date('Y-m-d',strtotime($period[0]->period_start));
                $net_income_end=date('Y-m-d',strtotime($date));

        }else{ //if not found on accounting period

                //check if there is closed transactions
                $sql="SELECT period_start,period_end FROM accounting_period";
                $count_closed_trans=$this->db->query($sql);
                if(count($count_closed_trans)>0){ //there is closed transactions

                }else{ //if there is no closed transactions

                }

        }


    }


    function get_account_schedule($account_id,$as_of_date,$particular_tye='C'){

        $as_of_date=date('Y-m-d',strtotime($as_of_date));
        $this_month_start_date=date('Y',strtotime($as_of_date))."-01-".date('m',strtotime($as_of_date));
        $prev_month=date('Y-m-d',strtotime("-1 days", strtotime($this_month_start_date)));

        if($particular_tye=='C'){
            $sql="SELECT

                m.customer_id,
                IFNULL(c.`customer_name`,'Unknown') as customer_name,
                SUM(m.previous) as previous,
                SUM(m.current) as current,
                (SUM(m.previous)+SUM(m.current)) as total

                FROM

                (SELECT
                ji.customer_id,
                (
                    IF( ac.account_type_id=1 OR ac.account_type_id=5
                        ,SUM(ja.dr_amount)-SUM(ja.cr_amount)
                        ,SUM(ja.cr_amount)-SUM(ja.dr_amount)
                    )
                ) as previous,
                0 as current
                FROM `journal_info` as ji

                INNER JOIN (`journal_accounts` as ja
                LEFT JOIN (account_titles as at
                LEFT JOIN account_classes as ac ON ac.account_class_id=at.account_class_id
                ) ON at.account_id=ja.account_id
                ) ON ja.journal_id=ji.journal_id

                WHERE ji.`date_txn`<='$prev_month'
                AND ji.is_active=TRUE AND ji.is_deleted=FALSE AND ja.account_id=$account_id

                GROUP BY ji.customer_id

                UNION ALL

                SELECT
                ji.customer_id,0 as previous,
                (
                    IF( ac.account_type_id=1 OR ac.account_type_id=5
                        ,SUM(ja.dr_amount)-SUM(ja.cr_amount)
                        ,SUM(ja.cr_amount)-SUM(ja.dr_amount)
                    )
                ) as current
                FROM `journal_info` as ji

                INNER JOIN (`journal_accounts` as ja
                LEFT JOIN (account_titles as at
                LEFT JOIN account_classes as ac ON ac.account_class_id=at.account_class_id
                ) ON at.account_id=ja.account_id
                ) ON ja.journal_id=ji.journal_id

                WHERE ji.`date_txn` BETWEEN '$this_month_start_date' AND '$as_of_date'
                AND ji.is_active=TRUE AND ji.is_deleted=FALSE AND ja.account_id=$account_id

                GROUP BY ji.customer_id) as m

                LEFT JOIN customers as c ON c.customer_id=m.customer_id

                GROUP BY m.customer_id ORDER BY IFNULL(c.`customer_name`,'Unknown')";
        }else{
            $sql="SELECT

                m.supplier_id,
                IFNULL(s.`supplier_name`,'Unknown') as supplier_name,
                SUM(m.previous) as previous,
                SUM(m.current) as current,
                (SUM(m.previous)+SUM(m.current)) as total

                FROM

                (SELECT
                ji.supplier_id,
                (
                    IF( ac.account_type_id=1 OR ac.account_type_id=5
                        ,SUM(ja.dr_amount)-SUM(ja.cr_amount)
                        ,SUM(ja.cr_amount)-SUM(ja.dr_amount)
                    )
                ) as previous,
                0 as current
                FROM `journal_info` as ji

                INNER JOIN (`journal_accounts` as ja
                LEFT JOIN (account_titles as at
                LEFT JOIN account_classes as ac ON ac.account_class_id=at.account_class_id
                ) ON at.account_id=ja.account_id
                ) ON ja.journal_id=ji.journal_id

                WHERE ji.`date_txn`<='$prev_month'
                AND ji.is_active=TRUE AND ji.is_deleted=FALSE AND ja.account_id=$account_id

                GROUP BY ji.supplier_id

                UNION ALL

                SELECT
                ji.supplier_id,0 as previous,
                (
                    IF( ac.account_type_id=1 OR ac.account_type_id=5
                        ,SUM(ja.dr_amount)-SUM(ja.cr_amount)
                        ,SUM(ja.cr_amount)-SUM(ja.dr_amount)
                    )
                ) as current
                FROM `journal_info` as ji

                INNER JOIN (`journal_accounts` as ja
                LEFT JOIN (account_titles as at
                LEFT JOIN account_classes as ac ON ac.account_class_id=at.account_class_id
                ) ON at.account_id=ja.account_id
                ) ON ja.journal_id=ji.journal_id

                WHERE ji.`date_txn` BETWEEN '$this_month_start_date' AND '$as_of_date'
                AND ji.is_active=TRUE AND ji.is_deleted=FALSE AND ja.account_id=$account_id

                GROUP BY ji.supplier_id) as m

                LEFT JOIN suppliers as s ON s.supplier_id=m.supplier_id

                GROUP BY m.supplier_id ORDER BY IFNULL(s.`supplier_name`,'Unknown')";
        }



        return $this->db->query($sql)->result();
    }


    function get_t_account($book,$start,$end){
        $sql="SELECT 
            DATE_FORMAT(ji.date_txn,'%m/%d/%Y')as date_txn,
            ji.txn_no,
            CONCAT(
              IFNULL(s.supplier_name,''),
              IFNULL(c.customer_name,'')
            )as description,
            ji.remarks,
            at.account_title,
            ja.dr_amount,
            ja.cr_amount

            FROM ((`journal_info` as ji
            LEFT JOIN customers as c ON c.customer_id=ji.customer_id)
            LEFT JOIN suppliers as s ON s.supplier_id=ji.supplier_id)
            INNER JOIN (`journal_accounts` as ja
            INNER JOIN account_titles as at ON at.account_id=ja.account_id)
            ON ja.journal_id=ji.journal_id WHERE ji.book_type='$book' AND ji.date_txn BETWEEN '$start' AND '$end'
            ORDER BY ji.date_txn ASC";

        return $this->db->query($sql)->result();
    }

}

?>