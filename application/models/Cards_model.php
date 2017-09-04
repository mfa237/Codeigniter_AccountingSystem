<?php

class Cards_model extends CORE_Model {
    protected  $table="cards";
    protected  $pk_id="card_id";

    function __construct() {
        parent::__construct();
    }

    function get_card_list($card_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  cards as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($card_id==null?"":" AND a.card_id=$card_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>