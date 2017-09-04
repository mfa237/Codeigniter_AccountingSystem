<?php

class Locations_model extends CORE_Model {
    protected  $table="locations";
    protected  $pk_id="location_id";

    function __construct() {
        parent::__construct();
    }

    function get_location_list($location_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  locations as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($location_id==null?"":" AND a.location_id=$location_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>