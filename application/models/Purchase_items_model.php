<?php

class Purchase_items_model extends CORE_Model {
    protected  $table="purchase_order_items";
    protected  $pk_id="po_item_id";
    protected  $fk_id="purchase_order_id";

    function __construct() {
        parent::__construct();
    } 

    function get_products_with_balance_qty2($purchase_order_id)
    {
        $sql = "SELECT 
                o.*, (o.po_line_total - o.non_tax_amount) AS tax_amount
            FROM
                (SELECT 
                    n.*,
                    ((n.po_price * n.po_qty) - (n.po_discount * n.po_qty)) AS po_line_total2,
                    ((n.po_price * n.po_qty) - ((n.po_price * n.po_qty) * (n.po_discount / 100))) AS po_line_total,
                    ((n.po_price * n.po_qty) / (1 + tax_rate_decimal)) AS non_tax_amount,
                    (n.po_discount * n.po_qty) AS po_line_total_discount
                FROM
                    (SELECT 
                    main.*,
                        (main.po_tax_rate / 100) AS tax_rate_decimal,
                        p.product_code,
                        p.product_desc,
                        p.unit_id,
                        u.unit_name
                FROM
                    (SELECT 
                        m.purchase_order_id,
                        m.po_no,
                        m.total_after_discount,
                        m.product_id,
                        MAX(m.po_price) AS po_price,
                        MAX(m.po_discount) AS po_discount,
                        MAX(m.po_tax_rate) AS po_tax_rate,
                        (SUM(m.PoQty) - SUM(m.DrQty)) AS po_qty
                FROM
                    (SELECT 
                    po.purchase_order_id,
                        po.po_no,
                        po.total_after_discount,
                        poi.product_id,
                        SUM(poi.po_qty) AS PoQty,
                        0 AS DrQty,
                        poi.po_price,
                        poi.po_discount,
                        poi.po_tax_rate
                    FROM
                    purchase_order AS po
                    INNER JOIN purchase_order_items AS poi ON po.purchase_order_id = poi.purchase_order_id
                    WHERE
                    po.purchase_order_id = $purchase_order_id
                        AND po.is_active = TRUE
                        AND po.is_deleted = FALSE
                    GROUP BY po.po_no , poi.product_id 
                    
                    
                    UNION ALL 
                    
                    
                    SELECT 
                    po.purchase_order_id,
                        po.po_no,
                        po.total_after_discount,
                        dii.product_id,
                        0 AS PoQty,
                        SUM(dii.dr_qty) AS DrQty,
                        0 AS po_price,
                        0 AS po_discount,
                        0 AS po_tax_rate
                FROM
                    (delivery_invoice AS di
                INNER JOIN purchase_order AS po ON di.purchase_order_id = po.purchase_order_id)
                INNER JOIN delivery_invoice_items AS dii ON di.dr_invoice_id = dii.dr_invoice_id
                WHERE
                    po.purchase_order_id = $purchase_order_id
                        AND di.is_active = TRUE
                        AND di.is_deleted = FALSE
                GROUP BY po.po_no , dii.product_id) AS m
                GROUP BY m.po_no , m.product_id
                HAVING po_qty > 0) AS main
                LEFT JOIN products AS p ON main.product_id = p.product_id
                LEFT JOIN units AS u ON p.unit_id = u.unit_id) AS n) AS o";

            return $this->db->query($sql)->result();
    }

    function get_products_with_balance_qty($purchase_order_id){
        $sql="SELECT o.*,(o.po_line_total-o.non_tax_amount)as tax_amount FROM

                (SELECT n.*,

                ((n.po_price*n.po_qty)-(n.po_discount*n.po_qty))as po_line_total,
                ((n.po_price*n.po_qty)/(1+tax_rate_decimal))as non_tax_amount,
                (n.po_discount*n.po_qty) as po_line_total_discount


                FROM
                (SELECT main.*,(main.po_tax_rate/100)as tax_rate_decimal,p.product_code,p.product_desc,p.unit_id,u.unit_name FROM

                (SELECT
                m.purchase_order_id,
                m.po_no,m.product_id,
                MAX(m.po_price)as po_price,
                MAX(m.po_discount)as po_discount,
                MAX(m.po_tax_rate)as po_tax_rate,
                (SUM(m.PoQty)-SUM(m.DrQty))as po_qty


                FROM

                (SELECT po.purchase_order_id,po.po_no,poi.product_id,SUM(poi.po_qty) as PoQty,0 as DrQty,
                poi.po_price,poi.po_discount,poi.po_tax_rate FROM purchase_order as po
                INNER JOIN purchase_order_items as poi ON po.purchase_order_id=poi.purchase_order_id
                WHERE po.purchase_order_id=$purchase_order_id AND po.is_active=TRUE AND po.is_deleted=FALSE
                GROUP BY po.po_no,poi.product_id


                UNION ALL

                SELECT po.purchase_order_id,po.po_no,dii.product_id,0 as PoQty,SUM(dii.dr_qty) as DrQty,
                0 as po_price,0 as po_discount,0 as po_tax_rate FROM (delivery_invoice as di
                INNER JOIN purchase_order as po ON di.purchase_order_id=po.purchase_order_id)
                INNER JOIN delivery_invoice_items as dii ON di.dr_invoice_id=dii.dr_invoice_id
                WHERE po.purchase_order_id=$purchase_order_id AND di.is_active=TRUE AND di.is_deleted=FALSE
                GROUP BY po.po_no,dii.product_id)as

                m GROUP BY m.po_no,m.product_id HAVING po_qty>0)as main


                LEFT JOIN products as p ON main.product_id=p.product_id
                LEFT JOIN units as u ON p.unit_id=u.unit_id)as n) as o";

        return $this->db->query($sql)->result();

    }

    function get_list_open_purchase(){
       $sql="  SELECT o.* FROM

        (SELECT n.*


        FROM
        (SELECT main.*,p.product_code,p.product_desc FROM

        (SELECT
        m.purchase_order_id,
        m.po_no,m.product_id,
        m.date_created,
        MAX(m.date_delivered) as last_date_delivered,
        m.PoQty as PoQtyTotal, 
        (m.PoQty-(SUM(m.PoQty)-SUM(m.DrQty))) as PoQtyDelivered,
        (SUM(m.PoQty)-SUM(m.DrQty))as PoQtyBalance


        FROM

        (SELECT po.purchase_order_id,po.date_created,'' as date_delivered,po.po_no,poi.product_id,SUM(poi.po_qty) as PoQty,0 as DrQty,
        poi.po_price,poi.po_discount,poi.po_tax_rate FROM purchase_order as po
        INNER JOIN purchase_order_items as poi ON po.purchase_order_id=poi.purchase_order_id
        
        WHERE po.is_active=TRUE AND po.is_deleted=FALSE
        GROUP BY po.po_no,poi.product_id

        UNION ALL

        SELECT po.purchase_order_id,po.date_created,max(di.date_delivered),po.po_no,dii.product_id,0 as PoQty,SUM(dii.dr_qty) as DrQty,
        0 as po_price,0 as po_discount,0 as po_tax_rate FROM (delivery_invoice as di
        INNER JOIN purchase_order as po ON di.purchase_order_id=po.purchase_order_id)
        INNER JOIN delivery_invoice_items as dii ON di.dr_invoice_id=dii.dr_invoice_id
        WHERE di.is_active=TRUE AND di.is_deleted=FALSE
        GROUP BY po.po_no,dii.product_id)as

        m GROUP BY m.po_no,m.product_id HAVING PoQtyBalance>0)as main

        LEFT JOIN products as p ON main.product_id=p.product_id)as n) as o

        
        ";

        return $this->db->query($sql)->result();




    }

    function get_po_no_of_open_purchase(){
        $sql="SELECT o.* FROM
            (SELECT n.*
            FROM
            (SELECT 
            DISTINCT main.po_no
            FROM

            (SELECT
            m.purchase_order_id,
            m.po_no,
            (SUM(m.PoQty)-SUM(m.DrQty))as PoQtyBalance
            
            FROM
            
            (SELECT po.purchase_order_id,po.po_no,poi.product_id,SUM(poi.po_qty) as PoQty,0 as DrQty
            FROM purchase_order as po
            INNER JOIN purchase_order_items as poi ON po.purchase_order_id=poi.purchase_order_id
            WHERE po.is_active=TRUE AND po.is_deleted=FALSE
            GROUP BY po.po_no,poi.product_id

            UNION ALL

            SELECT po.purchase_order_id,po.po_no,dii.product_id,0 as PoQty,SUM(dii.dr_qty) as DrQty
            FROM (delivery_invoice as di
            INNER JOIN purchase_order as po ON di.purchase_order_id=po.purchase_order_id)
            INNER JOIN delivery_invoice_items as dii ON di.dr_invoice_id=dii.dr_invoice_id
            WHERE di.is_active=TRUE AND di.is_deleted=FALSE
            GROUP BY po.po_no,dii.product_id)as

            m GROUP BY m.po_no,m.product_id HAVING PoQtyBalance>0)as main

           )as n) as o
            ";

        return $this->db->query($sql)->result();





    }




}



?>