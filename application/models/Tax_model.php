<?php

class Tax_model extends CORE_Model {
    protected  $table="tax_types";
    protected  $pk_id="tax_type_id";

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

}
?>