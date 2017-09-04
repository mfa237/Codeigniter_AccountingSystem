<?php

class Customer_photos_model extends CORE_Model{

    protected  $table="customer_photos"; //table name
    protected  $pk_id="photo_id"; //primary key id
    protected  $fk_id="customer_id"; //foreign key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }




}




?>