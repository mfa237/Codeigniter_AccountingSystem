<?php

class Account_integration_model extends CORE_Model{

    protected  $table="account_integration"; //table name
    protected  $pk_id="integration_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


}


?>