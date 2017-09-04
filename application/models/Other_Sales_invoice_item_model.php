<?php

class Other_Sales_invoice_item_model extends CORE_Model
{
    protected $table = "other_sales_invoice_items";
    protected $pk_id = "sales_item_id";
    protected $fk_id = "sales_invoice_id";

    function __construct()
    {
        parent::__construct();
    }
}


?>