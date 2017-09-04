<?php

class Supplier_photos_model extends CORE_Model {
    protected  $table="supplier_photos";
    protected  $pk_id="photo_id";
    protected  $fk_id="supplier_id";

    function __construct() {
        parent::__construct();
    }
}
?>