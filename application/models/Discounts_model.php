<?php

class Discounts_model extends CORE_Model {
    protected  $table="discounts";
    protected  $pk_id="discount_id";

    function __construct() {
        parent::__construct();
    }

    function get_discount_list($discount_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  discounts as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($discount_id==null?"":" AND a.discount_id=$discount_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>