<?php

class Refproduct_model extends CORE_Model {
    protected  $table="refproduct";
    protected  $pk_id="refproduct_id";

    function __construct() {
        parent::__construct();
    }



    function create_default_product_type(){

        //return;
        $sql="INSERT INTO
                  refproduct(refproduct_id,product_type,description,date_created)
                  VALUES  (3,'All Product type','',NOW()),
                          (1,'Companion Animals','Common house pets',NOW()),
                          (2,'Livestock Animals','Farm animals',NOW())

              ON DUPLICATE KEY UPDATE

                        refproduct.product_type=VALUES(refproduct.product_type),
                        refproduct.description=VALUES(refproduct.description)

        ";
        $this->db->query($sql);

    }





}
?>