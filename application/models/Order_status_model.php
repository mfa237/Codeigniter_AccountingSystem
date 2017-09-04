<?php

class Order_status_model extends CORE_Model
{
    protected  $table = "order_status"; //table name
    protected  $pk_id = "order_status_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function create_default_order_status(){
        $sql="INSERT INTO order_status
                  (order_status_id,order_status,order_description)
              VALUES
                  (1,'Open',''),
                  (2,'Closed',''),
                  (3,'Partially received','')
              ON DUPLICATE KEY UPDATE
                  order_status.order_status_id=VALUES(order_status.order_status_id),
                  order_status.order_status=VALUES(order_status.order_status)
        ";
        $this->db->query($sql);
    }



}




?>