<?php

class Approval_status_model extends CORE_Model
{
    protected  $table = "approval_status"; //table name
    protected  $pk_id = "approval_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_approval_status(){
        $sql="INSERT INTO approval_status
                  (approval_id,approval_status,approval_description)
              VALUES
                  (1,'Approved',''),
                  (2,'Pending','')
              ON DUPLICATE KEY UPDATE
                  approval_status.approval_id=VALUES(approval_status.approval_id),
                  approval_status.approval_status=VALUES(approval_status.approval_status)
        ";
        $this->db->query($sql);
    }



}




?>