<?php

class Brands_model extends CORE_Model {
    protected  $table="brands";
    protected  $pk_id="brand_id";

    function __construct() {
        parent::__construct();
    }

        function get_brand_list($brand_id=null){
            $sql="  SELECT
                      a.*
                    FROM
                      brands as a
                    WHERE
                        a.is_deleted=FALSE AND a.is_active=TRUE
                    ".($brand_id==null?"":" AND a.brand_id=$brand_id")."
                ";
            return $this->db->query($sql)->result();
        }
}
?>