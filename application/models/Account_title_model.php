<?php

class Account_title_model extends CORE_Model{

    protected  $table="account_titles"; //table name
    protected  $pk_id="account_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_account_title(){
        //return;
        $sql="INSERT IGNORE INTO account_titles
                  (account_id,account_no,account_title,account_class_id,parent_account_id,grand_parent_id)
              VALUES
                  (1,'101','Cash',1,0,1),
                  (2,'120','Account Receivable',1,0,2),
                  (3,'140','Inventory',1,0,3),
                  (10,'150','Input Tax',1,0,10),
                  (13,'160','Petty Cash',1,0,1),

                  (4,'210','Accounts Payable',3,0,4),
                  (11,'220','Output Tax',3,0,4),

                  (5,'300','Capital',5,0,5),

                  (6,'400','Sales Income',7,0,6),
                  (7,'410','Service Income',7,0,7),


                  (8,'500','Salaries Expense',6,0,8),
                  (9,'510','Supplies Expense',6,0,9),
                  (12,'510','Miscellaneous Expense',6,0,12)
        ";
        $this->db->query($sql);
    }


    function get_account_titles_balance($start=null,$end=null){
        $sql="SELECT

                at.account_no,at.account_title,
                IFNULL(SUM(ja.dr_amount),0) as dr_amount,
                IFNULL(SUM(ja.cr_amount),0) as cr_amount,
                ac.account_class_id,ac.account_type_id,

                IF(
                    ac.account_type_id=1 OR ac.account_type_id=5,
                    IFNULL(SUM(ja.dr_amount),0)-IFNULL(SUM(ja.cr_amount),0),
                    IFNULL(SUM(ja.cr_amount),0)-IFNULL(SUM(ja.dr_amount),0)
                ) as balance


                FROM (account_titles as at LEFT JOIN `account_classes` as ac ON at.`account_class_id`=ac.account_class_id)
                LEFT JOIN

                (

                SELECT ja.* FROM journal_accounts as ja INNER
                JOIN journal_info as ji ON ja.journal_id=ji.journal_id
                WHERE ji.is_active AND ji.is_deleted=FALSE
                ".($start!=null&&$end!=null?" AND ji.date_txn BETWEEN '$start' AND '$end'":"")."

                )as ja

                ON at.account_id=ja.account_id



                GROUP BY at.account_id";

            return $this->db->query($sql)->result();
    }




}




?>