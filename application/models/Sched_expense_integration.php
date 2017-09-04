<?php

class Sched_expense_integration extends CORE_Model{

    protected  $table="sched_expense_integration"; //table name
    protected  $pk_id="sched_expense_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_schedule_expense($as_of_date,$depid=null){
        $sql="SELECT n.account_title,
                  FORMAT(n.general_expense,2)as general_expense,
                  FORMAT(n.selling_expense,2)as selling_expense,
                  FORMAT((n.general_expense+n.selling_expense),2)as line_expense
              FROM(SELECT
                  m.*,
                  IF(m.group_id=1,m.balance,0)as general_expense,
                  IF(m.group_id=2,m.balance,0)as selling_expense
              FROM
                  (SELECT
                          core.grand_parent_id,at.account_title,
                          core.balance,IF(ISNULL(sei.account_id),1,2)as group_id
                    FROM
                          (SELECT
                              at.grand_parent_id,
                              IF(ac.account_type_id=1 OR ac.account_type_id=5,
                            SUM(ja.dr_amount)-SUM(ja.cr_amount),
                            SUM(ja.cr_amount)-SUM(ja.dr_amount)) as balance
                            FROM (journal_accounts as ja
                            INNER JOIN (account_titles as at
                            INNER JOIN account_classes as ac ON ac.account_class_id=at.account_class_id)
                            ON at.account_id=ja.account_id)
                            INNER JOIN journal_info as ji ON ji.journal_id=ja.journal_id
                            WHERE ji.is_active=1 AND ji.is_deleted=0 AND ac.account_type_id=5 AND ji.date_txn<='$as_of_date'
                            ".($depid==1||$depid==null?"":" AND ji.department_id=".$depid)."
                            GROUP BY at.grand_parent_id
                            ) as core

                            LEFT JOIN sched_expense_integration as sei ON sei.`account_id`=core.grand_parent_id
                            INNER JOIN account_titles as at ON at.account_id=core.grand_parent_id
                ) as m ORDER BY m.account_title) as n
                ";

        return $this->db->query($sql)->result();


    }


}


?>