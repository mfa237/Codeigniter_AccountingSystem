<?php

class Categories_model extends CORE_Model {
    protected  $table="categories";
    protected  $pk_id="category_id";

    function __construct() {
        parent::__construct();
    }

    function get_category_list($category_id=null){
        $sql="  SELECT
                  a.*
                FROM
                  categories as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($category_id==null?"":" AND a.category_id=$category_id")."
            ";
        return $this->db->query($sql)->result();
    }
}
?>