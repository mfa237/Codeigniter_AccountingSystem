<?php

class User_group_right_model extends CORE_Model{

    protected  $table="user_group_rights"; //table name
    protected  $pk_id="user_rights_id"; //primary key id
    protected  $fk_id="user_group_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_user_group_rights($user_group_id){
        $sql="SELECT rl.link_code,rl.link_name,
            IF(ISNULL(ugr.link_code),0,1)as is_allowed

            FROM rights_links as rl

            LEFT JOIN


            (SELECT x.link_code FROM user_group_rights as x WHERE x.user_group_id=$user_group_id)as ugr


            ON rl.link_code=ugr.link_code";
        return $this->db->query($sql)->result();
    }




}




?>