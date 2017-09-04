<?php

class Invoice_counter_model extends CORE_Model{

    protected  $table="invoice_counter"; //table name
    protected  $pk_id="counter_id"; //primary key id
    protected  $fk_id="user_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


}




?>