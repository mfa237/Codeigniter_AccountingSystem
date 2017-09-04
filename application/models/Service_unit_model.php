<?php

class Service_unit_model extends CORE_Model {
    protected  $table="service_unit";
    protected  $pk_id="service_unit_id";

    function __construct() {
        parent::__construct();
    }

    function get_service_unit_list($service_unit_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  service_unit as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($service_unit_id==null?"":" AND a.service_unit_id=$service_unit_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>