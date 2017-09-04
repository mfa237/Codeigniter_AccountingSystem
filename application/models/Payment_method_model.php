<?php

class Payment_method_model extends CORE_Model{

    protected  $table="payment_methods"; //table name
    protected  $pk_id="payment_method_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function create_default_payment_method(){

        //return;
        $sql="INSERT IGNORE INTO payment_methods
                  (payment_method_id,payment_method,is_active,is_deleted)
              VALUES
                  (1,'Cash',1,0),
                  (2,'Check',1,0),
                  (3,'Card',1,0)
        ";
        $this->db->query($sql);

    }








}




?>