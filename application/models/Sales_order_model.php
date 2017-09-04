<?php

class Sales_order_model extends CORE_Model
{
    protected $table = "sales_order";
    protected $pk_id = "sales_order_id";

    function __construct()
    {
        parent::__construct();
    }


    function get_so_balance_qty($id){
        $sql="SELECT SUM(x.Balance)as Balance
        FROM
        (SELECT
        m.sales_order_id,
        m.so_no,m.product_id,

        SUM(m.SoQty) as SoQty,
        SUM(m.InvQty)as InvQty,
        (SUM(m.SoQty)-SUM(m.InvQty))as Balance


        FROM

        (SELECT so.sales_order_id,so.so_no,soi.product_id,SUM(soi.so_qty) as SoQty,0 as InvQty FROM sales_order as so
        INNER JOIN sales_order_items as soi ON so.sales_order_id=soi.sales_order_id
        WHERE so.sales_order_id=$id AND so.is_active=TRUE AND so.is_deleted=FALSE
        GROUP BY so.so_no,soi.product_id


        UNION ALL

        SELECT so.sales_order_id,so.so_no,sii.product_id,0 as SoQty,SUM(sii.inv_qty) as InvQty FROM (sales_invoice as si
        INNER JOIN sales_order as so ON si.sales_order_id=so.sales_order_id)
        INNER JOIN sales_invoice_items as sii ON si.sales_invoice_id=sii.sales_invoice_id
        WHERE so.sales_order_id=$id AND si.is_active=TRUE AND si.is_deleted=FALSE
        GROUP BY so.so_no,sii.product_id)as

        m GROUP BY m.so_no,m.product_id) as x";

        return $this->db->query($sql)->result();
    }



}


?>