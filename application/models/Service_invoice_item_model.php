<?php

class Service_invoice_item_model extends CORE_Model
{
    protected $table = "service_invoice_items";
    protected $pk_id = "service_item_id";
    protected $fk_id = "service_invoice_id";

    function __construct()
    {
        parent::__construct();
    }
}


?>