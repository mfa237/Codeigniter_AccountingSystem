<?php

class Delivery_invoice_item_model extends CORE_Model {
    protected  $table="delivery_invoice_items";
    protected  $pk_id="dr_invoice_item_id";
    protected  $fk_id="dr_invoice_id";

    function __construct() {
        parent::__construct();
    }


}



?>