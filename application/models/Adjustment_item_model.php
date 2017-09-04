<?php

class Adjustment_item_model extends CORE_Model {
    protected  $table="adjustment_items";
    protected  $pk_id="adjustment_item_id";
    protected  $fk_id="adjustment_id";

    function __construct() {
        parent::__construct();
    }


}



?>