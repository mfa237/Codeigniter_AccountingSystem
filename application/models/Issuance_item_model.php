<?php

class Issuance_item_model extends CORE_Model {
    protected  $table="issuance_items";
    protected  $pk_id="issuance_item_id";
    protected  $fk_id="issuance_id";

    function __construct() {
        parent::__construct();
    }


}



?>