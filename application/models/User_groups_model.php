<?php

class User_groups_model extends CORE_Model
{
    protected  $table = "user_groups"; //table name
    protected  $pk_id = "user_group_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_user_group(){
        $sql="INSERT INTO user_groups
                  (user_group_id,user_group,user_group_desc)
              VALUES
                  (1,'System Administrator','Can access all features.')
              ON DUPLICATE KEY UPDATE
                  user_groups.user_group=VALUES(user_groups.user_group),
                  user_groups.user_group_desc=VALUES(user_groups.user_group_desc)
        ";
        $this->db->query($sql);


        //create default user rights of this group
        $sql="INSERT INTO user_group_rights() SELECT link_id,1,link_code FROM rights_links

                    ON DUPLICATE KEY UPDATE
                    user_group_rights.link_code=VALUES(user_group_rights.link_code),
                    user_group_rights.user_group_id=VALUES(user_group_rights.user_group_id)

                    ";
        $this->db->query($sql);


    }








}




?>