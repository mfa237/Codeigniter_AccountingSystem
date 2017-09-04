<?php

class Units_model extends CORE_Model {
    protected  $table="units";
    protected  $pk_id="unit_id";

    function __construct() {
        parent::__construct();
    }

    function get_unit_list($unit_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  units as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($unit_id==null?"":" AND a.unit_id=$unit_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>