<?php

class Item_type_model extends CORE_Model{

    protected  $table="item_types"; //table name
    protected  $pk_id="item_type_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_item_types(){
        $sql="INSERT INTO
                  item_types(item_type_id,item_type,description,is_active,is_deleted)
              VALUES
                  (1,'Inventory','',TRUE,FALSE),
                  (2,'Non-inventory','',TRUE,FALSE),
                  (3,'Services','',TRUE,FALSE)
              ON DUPLICATE KEY UPDATE
                  item_types.item_type=VALUES(item_types.item_type),
                  item_types.description=VALUES(item_types.description),
                  item_types.is_active=VALUES(item_types.is_active),
                  item_types.is_deleted=VALUES(item_types.is_deleted)
                  ";
        $this->db->query($sql);
    }






}




?>