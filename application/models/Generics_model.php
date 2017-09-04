<?php

class Generics_model extends CORE_Model {
    protected  $table="generics";
    protected  $pk_id="generic_id";

    function __construct() {
        parent::__construct();
    }

    function get_generic_list($generic_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  generics as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($generic_id==null?"":" AND a.generic_id=$generic_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>