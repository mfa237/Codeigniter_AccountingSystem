<?php

class Departments_model extends CORE_Model {
    protected  $table="departments";
    protected  $pk_id="department_id";

    function __construct() {
        parent::__construct();
    }

    function get_department_list($department_id=null) {
        $sql="  SELECT
                  a.*
                FROM
                  departments as a
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($department_id==null?"":" AND a.department_id=$department_id")."
            ";
        return $this->db->query($sql)->result();
    }


    function create_default_department(){

        //return;
        $sql="INSERT INTO
                  departments(department_id,department_name,department_desc,date_created) VALUES (1,'Admin','',NOW())
              ON DUPLICATE KEY UPDATE
                departments.department_name=VALUES(departments.department_name),
                departments.department_desc=VALUES(departments.department_desc);
        ";
        $this->db->query($sql);

    }


}
?>