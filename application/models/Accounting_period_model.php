<?php

class Accounting_period_model extends CORE_Model{

    protected  $table="accounting_period"; //table name
    protected  $pk_id="accounting_period_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


}


?>