<?php

class Payable_payment_list_model extends CORE_Model
{
    protected $table = "payable_payments_list";
    protected $pk_id = "payment_list_id";

    function __construct()
    {
        parent::__construct();
    }


}



?>