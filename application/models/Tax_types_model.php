<?php

class Tax_types_model extends CORE_Model {
    protected  $table="tax_types";
    protected  $pk_id="tax_type_id";

    function __construct() {
        parent::__construct();
    }


    function create_default_tax_type(){
        $sql="INSERT INTO
                  tax_types(tax_type_id,tax_type,tax_rate,description,is_default)
              VALUES
                  (1,'Non-vat',0,'',FALSE),
                  (2,'Vatted',12,'',TRUE)
              ON DUPLICATE KEY UPDATE
                  tax_types.tax_type=VALUES(tax_types.tax_type),
                  tax_types.tax_rate=VALUES(tax_types.tax_rate),
                  tax_types.description=VALUES(tax_types.description),
                  tax_types.is_deleted=FALSE";

        $this->db->query($sql);
    }


}


?>