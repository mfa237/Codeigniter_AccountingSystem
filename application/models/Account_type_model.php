<?php

class Account_type_model extends CORE_Model {
    protected  $table="account_types";
    protected  $pk_id="account_type_id";


    function __construct() {
        parent::__construct();
    }


    function create_default_account_types(){

        //return;
        $sql="INSERT  INTO account_types
                  (account_type_id,account_type,description)
              VALUES
                  (1,'Asset',''),
                  (2,'Liability',''),
                  (3,'Capital',''),
                  (4,'Income',''),
                  (5,'Expense','')
              ON DUPLICATE KEY UPDATE
                  account_types.account_type=VALUES(account_types.account_type),
                  account_types.description=VALUES(account_types.description)
        ";
        $this->db->query($sql);

    }



}



?>