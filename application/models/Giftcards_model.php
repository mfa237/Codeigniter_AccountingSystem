<?php

class Giftcards_model extends CORE_Model {
    protected  $table="giftcards";
    protected  $pk_id="giftcard_id";

    function __construct() {
        parent::__construct();
    }

    function get_giftcard_list($giftcard_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  giftcards as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($giftcard_id==null?"":" AND a.giftcard_id=$giftcard_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>