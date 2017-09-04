<?php

class Products_model extends CORE_Model {
    protected  $table="products";
    protected  $pk_id="product_id";

    function __construct() {
        parent::__construct();
    }


    function getDepartment()
    {
        $query = $this->db->query('SELECT department_name FROM departments');
        return $query->result();
    }

    function getCode() {
        $query = $this->db->query('SELECT product_code FROM products');
        return $query->result();
    }

    function get_product_qty($product_id){
        $sql="SELECT 
            (((in_qty-out_qty)+(adj_in_qty-adj_out_qty))-si_out_qty) AS on_hand
        FROM
            (SELECT 
                IFNULL(SUM(dii.dr_qty), 0) AS in_qty
            FROM
                delivery_invoice_items AS dii
            INNER JOIN delivery_invoice AS di ON dii.dr_invoice_id = di.dr_invoice_id
            WHERE
                dii.product_id = $product_id
                    AND di.is_active = TRUE
                    AND di.is_deleted = FALSE) AS in_qty
                INNER JOIN
            (SELECT 
                IFNULL(SUM(iss.issue_qty), 0) AS out_qty
            FROM
                issuance_items AS iss
            INNER JOIN issuance_info AS ii ON iss.issuance_id = ii.issuance_id
            WHERE
                iss.product_id = $product_id
                    AND ii.is_active = TRUE
                    AND ii.is_deleted = FALSE) AS out_qty
                INNER JOIN
            (SELECT 
                IFNULL(SUM(ai.adjust_qty), 0) AS adj_out_qty
            FROM
                adjustment_items AS ai
            INNER JOIN adjustment_info AS a ON a.adjustment_id = ai.adjustment_id
            WHERE
                ai.product_id = $product_id
                    AND a.is_active = TRUE
                    AND a.is_deleted = FALSE
                    AND a.adjustment_type = 'OUT') AS adj_out_qty
                INNER JOIN
            (SELECT 
                IFNULL(SUM(ai.adjust_qty), 0) AS adj_in_qty
            FROM
                adjustment_items AS ai
            INNER JOIN adjustment_info AS a ON a.adjustment_id = ai.adjustment_id
            WHERE
                ai.product_id = $product_id
                    AND a.is_active = TRUE
                    AND a.is_deleted = FALSE
                    AND a.adjustment_type = 'IN') AS adj_in_qty
                INNER JOIN
            (SELECT 
                IFNULL(SUM(sii.inv_qty), 0) AS si_out_qty
            FROM
                `sales_invoice_items` AS sii
            INNER JOIN sales_invoice AS si ON si.sales_invoice_id = sii.sales_invoice_id
            WHERE
                sii.product_id = $product_id
                    AND si.is_active = TRUE
                    AND si.is_deleted = FALSE) AS si_out_qty";

            $result = $this->db->query($sql)->result();
            return $result[0]->on_hand;
    }


// THIS IS THE OLD GET PRODUCT HISTORY QUERY BEFORE THE INTEGRATION OF SALES INVOICE 08152017
    // function get_product_history($product_id,$depid=0,$as_of_date=null){
    //     $this->db->query("SET @nBalance:=0.00;");
    //     $sql="


    //             SELECT n.*,p.product_desc,@nBalance:=(@nBalance+(n.in_qty-n.out_qty)) as balance

    //             FROM

    //             (SELECT m.*

    //             FROM
    //             (SELECT

    //             (ai.date_adjusted) as txn_date,
    //             ai.adjustment_code as ref_no,
    //             ('Adjustment In')as type,
    //             '' as Description,
    //             aii.product_id,aii.exp_date,aii.`batch_no`,
    //             (aii.adjust_qty) as in_qty,
    //             0 as out_qty


    //             FROM adjustment_info as ai
    //             INNER JOIN `adjustment_items` as aii ON aii.adjustment_id=ai.adjustment_id
    //             WHERE ai.adjustment_type='IN' AND ai.is_active=TRUE AND ai.is_deleted=FALSE
    //             AND aii.product_id=$product_id ".($depid==0?"":" AND ai.department_id=".$depid)."
    //             ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."


    //             UNION ALL


    //             SELECT

    //             (ai.date_adjusted) as txn_date,
    //             ai.adjustment_code as ref_no,
    //             ('Adjustment Out')as type,
    //             '' as Description,
    //             aii.product_id,aii.exp_date,aii.`batch_no`,
    //             0 as in_qty,
    //             (aii.adjust_qty)  as out_qty


    //              FROM adjustment_info as ai
    //             INNER JOIN `adjustment_items` as aii ON aii.adjustment_id=ai.adjustment_id
    //             WHERE ai.adjustment_type='OUT' AND ai.is_active=TRUE AND ai.is_deleted=FALSE ".($depid==0?"":" AND ai.department_id=".$depid)."
    //             AND aii.product_id=$product_id ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."



    //             UNION ALL



    //             SELECT

    //             di.date_delivered as txn_date,
    //             di.dr_invoice_no as ref_no,
    //             ('Purchase Invoice') as type,
    //             CONCAT(IFNULL(s.supplier_name,''),' (Supplier)') as Description,
    //             dii.product_id,
    //             dii.exp_date,dii.batch_no,
    //             (dii.dr_qty)as in_qty,0 as out_qty

    //             FROM (delivery_invoice as di
    //             LEFT JOIN suppliers as s ON s.supplier_id=di.supplier_id)
    //             INNER JOIN delivery_invoice_items as dii
    //             ON dii.dr_invoice_id=di.dr_invoice_id
    //             WHERE di.is_active=TRUE AND di.is_deleted=FALSE ".($depid==0?"":" AND di.department_id=".$depid)."
    //             AND dii.product_id=$product_id ".($as_of_date==null?"":" AND di.date_delivered<='".$as_of_date."'")."




    //             UNION ALL


    //             SELECT

    //             ii.date_issued as txn_date,
    //             ii.slip_no as ref_no,
    //             'Issuance' as type,
    //             ii.issued_to_person as Description,

    //             iit.product_id,iit.exp_date,iit.batch_no,0 as in_qty,
    //             issue_qty as out_qty

    //             FROM issuance_info as ii
    //             INNER JOIN issuance_items as iit ON iit.issuance_id=ii.issuance_id

    //             WHERE ii.is_active=TRUE AND ii.is_deleted=FALSE ".($depid==0?"":" AND ii.issued_department_id=".$depid)."
    //             AND iit.product_id=$product_id ".($as_of_date==null?"":" AND ii.date_issued<='".$as_of_date."'")."


    //             ) as m ORDER BY m.txn_date ASC) as n  LEFT JOIN products as p ON n.product_id=p.product_id";

    //     return $this->db->query($sql)->result();
    // }

     function get_product_history($product_id,$depid=0,$as_of_date=null,$account){

        $this->db->query("SET @nBalance:=0.00;");
        $sql="


                SELECT n.*,p.product_desc,@nBalance:=(@nBalance+(n.in_qty-n.out_qty)) as balance

                FROM

                (SELECT m.*

                FROM
                (SELECT

                (ai.date_adjusted) as txn_date,
                ai.adjustment_code as ref_no,
                ('Adjustment In')as type,
                '' as Description,
                aii.product_id,aii.exp_date,aii.`batch_no`,
                (aii.adjust_qty) as in_qty,
                0 as out_qty


                FROM adjustment_info as ai
                INNER JOIN `adjustment_items` as aii ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='IN' AND ai.is_active=TRUE AND ai.is_deleted=FALSE
                AND aii.product_id=$product_id ".($depid==0?"":" AND ai.department_id=".$depid)."
                ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."


                UNION ALL


                SELECT

                (ai.date_adjusted) as txn_date,
                ai.adjustment_code as ref_no,
                ('Adjustment Out')as type,
                '' as Description,
                aii.product_id,aii.exp_date,aii.`batch_no`,
                0 as in_qty,
                (aii.adjust_qty)  as out_qty


                 FROM adjustment_info as ai
                INNER JOIN `adjustment_items` as aii ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='OUT' AND ai.is_active=TRUE AND ai.is_deleted=FALSE ".($depid==0?"":" AND ai.department_id=".$depid)."
                AND aii.product_id=$product_id ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."



                UNION ALL



                SELECT

                di.date_delivered as txn_date,
                di.dr_invoice_no as ref_no,
                ('Purchase Invoice') as type,
                CONCAT(IFNULL(s.supplier_name,''),' (Supplier)') as Description,
                dii.product_id,
                dii.exp_date,dii.batch_no,
                (dii.dr_qty)as in_qty,0 as out_qty

                FROM (delivery_invoice as di
                LEFT JOIN suppliers as s ON s.supplier_id=di.supplier_id)
                INNER JOIN delivery_invoice_items as dii
                ON dii.dr_invoice_id=di.dr_invoice_id
                WHERE di.is_active=TRUE AND di.is_deleted=FALSE ".($depid==0?"":" AND di.department_id=".$depid)."
                AND dii.product_id=$product_id
                 ".($as_of_date==null?"":" AND di.date_delivered<='".$as_of_date."'")."


                ".($account==TRUE?" 


                 UNION ALL
                
                SELECT 
                si.date_invoice as txn_date,
                si.sales_inv_no as ref_no,
                ('Sales Invoice') as type,
                CONCAT(IFNULL(c.customer_name,''),' (Customer)') as Description,
                sii.product_id,
                sii.exp_date,sii.batch_no,
                0 as in_qty, (sii.inv_qty) as out_qty
                 FROM 
                (sales_invoice as si
                LEFT JOIN customers c ON c.customer_id=si.customer_id)
                                
                INNER JOIN
                sales_invoice_items sii ON sii.sales_invoice_id = si.sales_invoice_id

                WHERE si.is_active = TRUE AND si.is_deleted = FALSE  ".($depid==0?"":" AND di.department_id=".$depid)."
                AND sii.product_id = $product_id


                ".($as_of_date==null?"":" AND si.date_invoice<='".$as_of_date."'")."


                ":" ")."

                UNION ALL


                SELECT

                ii.date_issued as txn_date,
                ii.slip_no as ref_no,
                'Issuance' as type,
                ii.issued_to_person as Description,

                iit.product_id,iit.exp_date,iit.batch_no,0 as in_qty,
                issue_qty as out_qty

                FROM issuance_info as ii
                INNER JOIN issuance_items as iit ON iit.issuance_id=ii.issuance_id

                WHERE ii.is_active=TRUE AND ii.is_deleted=FALSE ".($depid==0?"":" AND ii.issued_department_id=".$depid)."
                AND iit.product_id=$product_id ".($as_of_date==null?"":" AND ii.date_issued<='".$as_of_date."'")."


                ) as m ORDER BY m.txn_date ASC) as n  LEFT JOIN products as p ON n.product_id=p.product_id";

        return $this->db->query($sql)->result();
    }



    function get_product_current_qty($batch_no,$product_id,$expire_date){
        $sql="SELECT `get_product_qty_per_batch`('$batch_no',$product_id,'$expire_date') as batch_qty";
        $result=$this->db->query($sql)->result();
        return (count($result)>0?$result[0]->batch_qty:0);
    }



    function get_current_item_list($criteria="",$type=3){


            //adjusted 1/3/2017
            //added adjustment IN and OUT on Query
            //modified Unique ID based on Batch Number

            $sql="SELECT rc.*,p.*,u.unit_name,

                IFNULL(tt.tax_rate,0) as tax_rate,FORMAT(sale_price,4) as srp
                ,IFNULL(sinv.out_qty,0) as out_qty,

                FORMAT(dealer_price,4) as srp_dealer,
                FORMAT(distributor_price,4) as srp_distributor,
                FORMAT(public_price,4) as srp_public,
                FORMAT(discounted_price,4) as srp_discounted,
                FORMAT(purchase_cost,4) as srp_cost,
                (rc.in_qty-IFNULL(sinv.out_qty,0)-IFNULL(iss.out_qty,0)-IFNULL(aoQ.out_qty,0)) as on_hand_per_batch

                    FROM

                    (

                    SELECT inQ.*,SUM(inQ.receive_qty)as in_qty

 					FROM

 					(SELECT dii.product_id,dii.batch_no,dii.exp_date,
                    CONCAT_WS('-',dii.batch_no,dii.product_id,dii.exp_date)as unq_id,
                    SUM(dii.dr_qty) as receive_qty
                    FROM delivery_invoice_items as dii
                    INNER JOIN delivery_invoice as di
                    ON dii.dr_invoice_id=di.dr_invoice_id
                    WHERE di.is_active=TRUE AND di.is_deleted=FALSE
                    GROUP BY dii.product_id,dii.`batch_no`,dii.exp_date


 					UNION ALL


  					SELECT aii.product_id,aii.batch_no,aii.exp_date,
                    CONCAT_WS('-',aii.batch_no,aii.product_id,aii.exp_date)as unq_id,
                    SUM(aii.adjust_qty) as receive_qty
                    FROM adjustment_items as aii
                    INNER JOIN adjustment_info as ai
                    ON aii.adjustment_id=ai.adjustment_id
                    WHERE ai.adjustment_type='IN' AND ai.is_active=TRUE AND ai.is_deleted=FALSE

                    GROUP BY aii.product_id,aii.batch_no,aii.exp_date) as inQ

                    GROUP By inQ.product_id,inQ.batch_no,inQ.exp_date




                    )as rc


                    LEFT JOIN


                    (SELECT sii.product_id,
                    CONCAT_WS('-',sii.batch_no,sii.product_id,sii.exp_date)as unq_id,
                    SUM(sii.inv_qty) as out_qty
                    FROM sales_invoice_items as sii
                    INNER JOIN sales_invoice as si ON sii.sales_invoice_id=si.sales_invoice_id
                    WHERE si.is_active=TRUE AND si.is_deleted=FALSE
                    GROUP BY sii.product_id,sii.batch_no,sii.exp_date) as sinv

                    ON rc.unq_id=sinv.unq_id

                    LEFT JOIN

                    (  SELECT iss.product_id,
                    CONCAT_WS('-',iss.batch_no,iss.product_id,iss.exp_date)as unq_id,
                    SUM(iss.issue_qty) as out_qty
                    FROM issuance_items as iss INNER JOIN issuance_info as iin ON iin.issuance_id=iss.issuance_id
                    WHERE iin.is_active=TRUE AND iin.is_deleted=FALSE
                    GROUP BY iss.product_id,iss.batch_no,iss.exp_date)as iss

                    ON rc.unq_id=iss.unq_id

                    LEFT JOIN

                    (
                    SELECT aii.product_id,aii.batch_no,aii.exp_date,
                    CONCAT_WS('-',aii.batch_no,aii.product_id,aii.exp_date)as unq_id,
                    SUM(aii.adjust_qty) as out_qty
                    FROM adjustment_items as aii
                    INNER JOIN adjustment_info as ai
                    ON aii.adjustment_id=ai.adjustment_id
                    WHERE ai.adjustment_type='OUT' AND ai.is_active=TRUE AND ai.is_deleted=FALSE

                    GROUP BY aii.product_id,aii.batch_no,aii.exp_date
                    )as aoQ

                    ON rc.unq_id=aoQ.unq_id



                    LEFT JOIN

                    products as p ON rc.product_id=p.product_id

                    LEFT JOIN tax_types as tt ON p.tax_type_id=tt.tax_type_id
                    LEFT JOIN units as u ON p.unit_id=u.unit_id


                    WHERE ".($type==3?"":" p.refproduct_id=".$type." AND ")." (p.product_desc LIKE '%".$criteria."%' OR p.product_code LIKE '%".$criteria."%' OR p.product_desc1 LIKE '%".$criteria."%' OR CAST(p.product_id AS CHAR) LIKE '%".$criteria."%') HAVING on_hand_per_batch>0";


        return $this->db->query($sql)->result();
    }


    //per expiration inventory report
    function get_all_items_inventory($date){
        $sql="SELECT rc.*,p.*,rp.product_type,cat.category_name,DATE_FORMAT(exp_date,'%m/%d/%Y')as expiration,IFNULL(sinv.out_qty,0) as out_qty,(rc.in_qty-IFNULL(sinv.out_qty,0)-IFNULL(iss.out_qty,0)) as on_hand
                    FROM

                    (

                    SELECT dii.product_id,di.batch_no,di.dr_invoice_id,dii.exp_date,
                    CONCAT_WS('-',dii.dr_invoice_id,dii.product_id,dii.exp_date)as unq_id,
                    SUM(dii.dr_qty) as in_qty
                    FROM delivery_invoice_items as dii
                    INNER JOIN delivery_invoice as di
                    ON dii.dr_invoice_id=di.dr_invoice_id
                    WHERE di.date_created<='".$date." 00:00:00' AND di.is_deleted=FALSE AND di.is_active=TRUE
                    GROUP BY dii.product_id,dii.dr_invoice_id)as rc


                    LEFT JOIN


                    (SELECT sii.product_id,
                    CONCAT_WS('-',sii.dr_invoice_id,sii.product_id,sii.exp_date)as unq_id,
                    SUM(sii.inv_qty) as out_qty
                    FROM sales_invoice_items as sii
                    INNER JOIN sales_invoice as si ON sii.sales_invoice_id=si.sales_invoice_id
                    WHERE si.date_created<='".$date." 00:00:00' AND si.is_deleted=FALSE AND si.is_active=TRUE
                    GROUP BY sii.product_id,sii.dr_invoice_id) as sinv

                    ON rc.unq_id=sinv.unq_id

                    LEFT JOIN

                    ( SELECT iss.product_id,
                    CONCAT_WS('-',iss.dr_invoice_id,iss.product_id,iss.exp_date)as unq_id,
                    SUM(iss.issue_qty) as out_qty
                    FROM issuance_items as iss
                    INNER JOIN issuance_info as ii ON iss.issuance_id=ii.issuance_id
                    WHERE ii.date_created<='".$date." 00:00:00' AND ii.is_deleted=FALSE AND ii.is_active=TRUE
                    GROUP BY iss.product_id,iss.dr_invoice_id)as iss

                    ON rc.unq_id=iss.unq_id



                    LEFT JOIN

                    products as p ON rc.product_id=p.product_id

                    LEFT JOIN refproduct as rp ON rp.refproduct_id=p.refproduct_id

                    LEFT JOIN categories as cat ON cat.category_id=p.category_id




                    ORDER BY p.product_desc,exp_date
                    ";






        $sql="SELECT rc.*,p.*,c.category_name,DATE_FORMAT(rc.exp_date,'%m/%d/%Y')as expiration,

                    FORMAT(sale_price,2) as srp
                    ,IFNULL(sinv.out_qty,0) as out_qty,

                    (rc.in_qty-IFNULL(sinv.out_qty,0)-IFNULL(iss.out_qty,0)-IFNULL(aoQ.out_qty,0)) as on_hand_per_batch

                    FROM

                    (

                    SELECT inQ.*,SUM(inQ.receive_qty)as in_qty

 					FROM

 					(SELECT dii.product_id,dii.batch_no,dii.exp_date,
                    CONCAT_WS('-',dii.batch_no,dii.product_id,dii.exp_date)as unq_id,
                    SUM(dii.dr_qty) as receive_qty
                    FROM delivery_invoice_items as dii
                    INNER JOIN delivery_invoice as di
                    ON dii.dr_invoice_id=di.dr_invoice_id
                    WHERE di.is_active=TRUE AND di.is_deleted=FALSE
                    AND di.date_delivered<='$date'
                    GROUP BY dii.product_id,dii.`batch_no`,dii.exp_date


 					UNION ALL


  					SELECT aii.product_id,aii.batch_no,aii.exp_date,
                    CONCAT_WS('-',aii.batch_no,aii.product_id,aii.exp_date)as unq_id,
                    SUM(aii.adjust_qty) as receive_qty
                    FROM adjustment_items as aii
                    INNER JOIN adjustment_info as ai
                    ON aii.adjustment_id=ai.adjustment_id
                    WHERE ai.adjustment_type='IN' AND ai.is_active=TRUE AND ai.is_deleted=FALSE
                    AND ai.date_adjusted<='$date'
                    GROUP BY aii.product_id,aii.batch_no,aii.exp_date) as inQ

                    GROUP By inQ.product_id,inQ.batch_no,inQ.exp_date




                    )as rc


                    LEFT JOIN


                    (SELECT sii.product_id,
                    CONCAT_WS('-',sii.batch_no,sii.product_id,sii.exp_date)as unq_id,
                    SUM(sii.inv_qty) as out_qty
                    FROM sales_invoice_items as sii
                    INNER JOIN sales_invoice as si
                    ON sii.sales_invoice_id=si.sales_invoice_id
                    WHERE si.is_active=TRUE AND si.is_deleted=FALSE
                    AND si.date_invoice<='$date'
                    GROUP BY sii.product_id,sii.batch_no,sii.exp_date) as sinv

                    ON rc.unq_id=sinv.unq_id

                    LEFT JOIN

                    (SELECT iss.product_id,
                    CONCAT_WS('-',iss.batch_no,iss.product_id,iss.exp_date)as unq_id,
                    SUM(iss.issue_qty) as out_qty
                    FROM issuance_items as iss
                    INNER JOIN issuance_info as iin
                    ON iss.issuance_id=iin.issuance_id
                    WHERE iin.date_issued<='$date' AND iin.is_active=TRUE AND iin.is_deleted=FALSE
                    GROUP BY iss.product_id,iss.batch_no,iss.exp_date)as iss

                    ON rc.unq_id=iss.unq_id

                    LEFT JOIN

                    (

                    SELECT aii.product_id,aii.batch_no,aii.exp_date,
                    CONCAT_WS('-',aii.batch_no,aii.product_id,aii.exp_date)as unq_id,
                    SUM(aii.adjust_qty) as out_qty
                    FROM adjustment_items as aii
                    INNER JOIN adjustment_info as ai
                    ON aii.adjustment_id=ai.adjustment_id
                    WHERE ai.adjustment_type='OUT' AND ai.is_active=TRUE AND ai.is_deleted=FALSE
                    AND ai.date_adjusted<='$date'

                    GROUP BY aii.product_id,aii.batch_no,aii.exp_date
                    )as aoQ

                    ON rc.unq_id=aoQ.unq_id



                    LEFT JOIN

                    products as p ON rc.product_id=p.product_id

                    LEFT JOIN categories as c ON p.category_id=c.category_id

                    ORDER BY p.product_desc,exp_date

                    ";


        return $this->db->query($sql)->result();
    }

    //function to get the Merchandise Inventory on COST OF GOODS SOLD REPORt
    function get_inventory_costing($as_of_date,$department=null){
        $sql="SELECT n.*,FORMAT((n.BalanceQty*n.AvgCost),4)as TotalAvgCost
                FROM
                (SELECT

                m.*,

                (m.ReceiveQty+m.AdjInQty-m.AdjOutQty-m.IssueQty-m.SalesQty) as BalanceQty

                FROM

                (SELECT

                p.product_id,p.`product_desc`,
                FORMAT(IFNULL(recQuery.AvgCost,0),4) as AvgCost,
                IFNULL(recQuery.ReceiveQty,0)as ReceiveQty,
                IFNULL(adjInQuery.AdjInQty,0) as AdjInQty,
                IFNULL(adjOutQuery.AdjOutQty,0) as AdjOutQty,
                IFNULL(issQuery.IssueQty,0) as IssueQty,
                IFNULL(salesQuery.SalesQty,0) as SalesQty


                FROM products as p LEFT JOIN

                (

                SELECT

                dii.product_id,
                SUM(dii.dr_qty) as ReceiveQty,

                /***get the average cost of all price, if 0 this means it is free***/
                AVG(IF(dii.dr_price>0,dii.dr_price,NULL)) as AvgCost

                FROM `delivery_invoice_items` as dii
                INNER JOIN `delivery_invoice` as di
                ON di.`dr_invoice_id`=dii.`dr_invoice_id`

                WHERE di.is_active=1 AND di.is_deleted=0 AND di.date_delivered<='$as_of_date'

                ".($department==1||$department==null?"":" AND di.department_id=$department")."

                GROUP BY dii.product_id

                ) as recQuery ON recQuery.product_id=p.product_id

                LEFT JOIN

                (

                SELECT

                aii.product_id,
                SUM(aii.adjust_qty)as AdjInQty

                FROM adjustment_items as aii
                INNER JOIN adjustment_info as ai
                ON ai.`adjustment_id`=aii.`adjustment_id`
                WHERE ai.is_active=1
                AND ai.is_deleted=0
                AND ai.`adjustment_type`='IN' AND ai.date_adjusted<='$as_of_date'
                ".($department==1||$department==null?"":" AND ai.department_id=$department")."
                GROUP BY aii.product_id

                ) as adjInQuery ON adjInQuery.product_id=p.product_id


                LEFT JOIN


                (

                SELECT

                aii.product_id,
                SUM(aii.adjust_qty)as AdjOutQty

                FROM adjustment_items as aii
                INNER JOIN adjustment_info as ai
                ON ai.`adjustment_id`=aii.`adjustment_id`
                WHERE ai.is_active=1
                AND ai.is_deleted=0
                AND ai.`adjustment_type`='OUT' AND ai.date_adjusted<='$as_of_date'
                ".($department==1||$department==null?"":" AND ai.department_id=$department")."
                GROUP BY aii.product_id


                )as adjOutQuery ON adjOutQuery.product_id=p.product_id


                LEFT JOIN


                (

                SELECT

                iii.product_id,
                SUM(iii.`issue_qty`)as IssueQty

                FROM `issuance_items` as iii
                INNER JOIN `issuance_info` as ii
                ON ii.`issuance_id`=iii.`issuance_id`
                WHERE ii.`is_active`=1 AND ii.date_issued<='$as_of_date'
                ".($department==1||$department==null?"":" AND ii.issued_department_id=$department")."
                AND ii.`is_deleted`=0


                GROUP BY iii.product_id

                ) as issQuery ON issQuery.product_id=p.product_id


                LEFT JOIN



                (

                SELECT
                sii.product_id,
                SUM(sii.`inv_qty`)as SalesQty

                FROM `sales_invoice_items` as sii
                INNER JOIN `sales_invoice` as si
                ON si.`sales_invoice_id`=sii.`sales_invoice_id`
                WHERE si.is_active=1 AND si.`is_deleted`=0 AND si.date_invoice<='$as_of_date'
                ".($department==1||$department==null?"":" AND si.department_id=$department")."

                GROUP BY sii.product_id

                ) as salesQuery ON salesQuery.product_id=p.product_id


                WHERE p.is_deleted=0) as m)as n ORDER BY product_desc";

            return $this->db->query($sql)->result();

    }



    //function that returns product inventory on specified date
    function get_product_list_inventory($as_of_date,$depid=null,$account){


        $sql="SELECT core.*,
            /* CurrentQty IF/ELSE generated for Account Integration
                IF account integration (Sales_invoice_inventory) is TRUE(1)
                then GET the --on_hand-- quantity where sales_invoice QTY is already computed

                ELSE 



                (ReceiveQty+AdjustInQty-IssueQty-AdjustOut)as CurrentQty
                This  query is used to compute QTY without sales_invoice



              */

             ".($account==TRUE?" 
                    (ReceiveQty+AdjustInQty-IssueQty-AdjustOut-SalesOUtQty)as CurrentQty
             ":" 
                    (ReceiveQty+AdjustInQty-IssueQty-AdjustOut)as CurrentQty
             ")."
       

                FROM


             ".($account==TRUE?" 
                (SELECT pQ.product_id,pQ.product_code,pQ.product_desc,pQ.category_name,pQ.unit_name,pQ.on_hand,
                IFNULL(recQ.ReceivedQTY,0)as ReceiveQty,
                IFNULL(issQ.IssueQty,0)as IssueQty,
                IFNULL(aInQ.AdjustInQty,0)as AdjustInQty,
                IFNULL(aOutQ.AdjustOut,0)as AdjustOut,
                IFNULL(siQout.SalesOUtQty,0)as SalesOUtQty
             ":" 
                (SELECT pQ.product_id,pQ.product_code,pQ.product_desc,pQ.category_name,pQ.unit_name,pQ.on_hand,
                IFNULL(recQ.ReceivedQTY,0)as ReceiveQty,
                IFNULL(issQ.IssueQty,0)as IssueQty,
                IFNULL(aInQ.AdjustInQty,0)as AdjustInQty,
                IFNULL(aOutQ.AdjustOut,0)as AdjustOut
             ")."

                FROM

                (SELECT p.product_id,p.product_code,p.product_desc,c.category_name,u.unit_name,p.on_hand FROM products as p
                LEFT JOIN categories as c ON c.category_id=p.category_id
                LEFT JOIN units as u ON u.unit_id=p.unit_id
                WHERE
                p.item_type_id=1)as pQ


                LEFT JOIN

                (

                SELECT dii.product_id,SUM(dii.dr_qty) as ReceivedQTY FROM delivery_invoice as di
                INNER JOIN delivery_invoice_items as dii ON dii.dr_invoice_id=di.dr_invoice_id
                WHERE di.date_delivered<='$as_of_date' ".($depid==null||$depid==0?"":" AND di.department_id=".$depid)."
                AND di.is_deleted=0
                GROUP BY dii.product_id

                )as recQ ON recQ.product_id=pQ.product_id


                LEFT JOIN

                (

                SELECT iii.product_id,
                SUM(iii.issue_qty)as IssueQty
                FROM issuance_info as ii INNER
                JOIN issuance_items as iii ON iii.issuance_id=ii.issuance_id
                WHERE ii.date_issued<='$as_of_date' ".($depid==null||$depid==0?"":" AND ii.issued_department_id=".$depid)."
                AND ii.is_deleted=0
                GROUP BY iii.product_id

                )as issQ ON issQ.product_id=pQ.product_id


             ".($account==TRUE?" 
                LEFT JOIN

             (SELECT sii.product_id,SUM(sii.inv_qty) as SalesOUtQty FROM sales_invoice si
             INNER JOIN sales_invoice_items  sii ON sii.sales_invoice_id =  si.sales_invoice_id
             WHERE si.date_invoice<='$as_of_date' 
             AND si.is_deleted = 0
             GROUP BY sii.product_id) siQout ON siQout.product_id=pQ.product_id

             ":" 
             ")."
       

               LEFT JOIN

                (

                SELECT aii.product_id,
                SUM(aii.adjust_qty)as AdjustInQty
                FROM adjustment_info as ai
                INNER JOIN adjustment_items as aii
                ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='IN' AND ai.date_adjusted<='$as_of_date' ".($depid==null||$depid==0?"":" AND ai.department_id=".$depid)."
                AND ai.is_deleted=0
                GROUP BY aii.product_id

                )as aInQ ON aInQ.product_id=pQ.product_id





                LEFT JOIN

                (

                SELECT aii.product_id,
                SUM(aii.adjust_qty)as AdjustOut
                FROM adjustment_info as ai
                INNER JOIN adjustment_items as aii
                ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='OUT' AND ai.date_adjusted<='$as_of_date' ".($depid==null||$depid==0?"":" AND ai.department_id=".$depid)."
                AND ai.is_deleted=0
                GROUP BY aii.product_id

                )as aOutQ ON aOutQ.product_id=pQ.product_id)as core ORDER BY core.product_desc
                ";

        return $this->db->query($sql)->result();

    }


function product_list($account,$as_of_date=null,$product_id=null){
    $sql="SELECT 
                rp.product_type,
                s.supplier_name,
                it.item_type,
                account_titles.account_title,
                core.*,





             ".($account==TRUE?" 
                    (ReceiveQty+AdjustInQty-IssueQty-AdjustOut-SalesOUtQty)as CurrentQty
             ":" 
                    (ReceiveQty+AdjustInQty-IssueQty-AdjustOut)as CurrentQty
             ")."
       

                FROM


             ".($account==TRUE?" 
                (SELECT pQ.*,
                IFNULL(recQ.ReceivedQTY,0)as ReceiveQty,
                IFNULL(issQ.IssueQty,0)as IssueQty,
                IFNULL(aInQ.AdjustInQty,0)as AdjustInQty,
                IFNULL(aOutQ.AdjustOut,0)as AdjustOut,
                IFNULL(siQout.SalesOUtQty,0)as SalesOUtQty
             ":" 
                (SELECT pQ.*,
                IFNULL(recQ.ReceivedQTY,0)as ReceiveQty,
                IFNULL(issQ.IssueQty,0)as IssueQty,
                IFNULL(aInQ.AdjustInQty,0)as AdjustInQty,
                IFNULL(aOutQ.AdjustOut,0)as AdjustOut
             ")."




                FROM

                (SELECT p.*,c.category_name,u.unit_name FROM products as p
                LEFT JOIN categories as c ON c.category_id=p.category_id
                LEFT JOIN units as u ON u.unit_id=p.unit_id
                WHERE p.is_deleted = FALSE 

                ".($product_id==NULL?" 
                
             ":" 
                   AND p.product_id = $product_id
             ")."



                 )as pQ


                LEFT JOIN

                (

                SELECT dii.product_id,SUM(dii.dr_qty) as ReceivedQTY FROM delivery_invoice as di
                INNER JOIN delivery_invoice_items as dii ON dii.dr_invoice_id=di.dr_invoice_id
                WHERE  di.is_deleted=0 ".($as_of_date==null?"":" AND di.date_delivered<='".$as_of_date."'")."
               
                GROUP BY dii.product_id

                )as recQ ON recQ.product_id=pQ.product_id

            ".($account==TRUE?" 
                LEFT JOIN

             (SELECT sii.product_id,SUM(sii.inv_qty) as SalesOUtQty FROM sales_invoice si
             INNER JOIN sales_invoice_items  sii ON sii.sales_invoice_id =  si.sales_invoice_id
             WHERE si.date_invoice<='$as_of_date' 
             AND si.is_deleted = 0
             GROUP BY sii.product_id) siQout ON siQout.product_id=pQ.product_id

             ":" 
             ")."
       
                LEFT JOIN

                (

                SELECT iii.product_id,
                SUM(iii.issue_qty)as IssueQty
                FROM issuance_info as ii INNER
                JOIN issuance_items as iii ON iii.issuance_id=ii.issuance_id
                WHERE   
                
               
                ii.is_deleted=0
                 ".($as_of_date==null?"":"  AND ii.date_issued<='".$as_of_date."'")."
                GROUP BY iii.product_id

                )as issQ ON issQ.product_id=pQ.product_id


                LEFT JOIN

                (

                SELECT aii.product_id,
                SUM(aii.adjust_qty)as AdjustInQty
                FROM adjustment_info as ai
                INNER JOIN adjustment_items as aii
                ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='IN' 
                AND ai.is_deleted=0
                 ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."
                GROUP BY aii.product_id

                )as aInQ ON aInQ.product_id=pQ.product_id


                LEFT JOIN

                (

                SELECT aii.product_id,
                SUM(aii.adjust_qty)as AdjustOut
                FROM adjustment_info as ai
                INNER JOIN adjustment_items as aii
                ON aii.adjustment_id=ai.adjustment_id
                WHERE ai.adjustment_type='OUT' 
                 ".($as_of_date==null?"":" AND ai.date_adjusted<='".$as_of_date."'")."

                AND ai.is_deleted=0
                GROUP BY aii.product_id

                )as aOutQ ON aOutQ.product_id=pQ.product_id)as core 
                

                LEFT JOIN suppliers s ON s.supplier_id = core.supplier_id
                LEFT JOIN refproduct rp ON rp.refproduct_id = core.refproduct_id
                LEFT JOIN item_types it ON it.item_type_id = core.item_type_id
                LEFT JOIN account_titles ON account_titles.account_id=core.income_account_id
                            
                ORDER BY core.product_desc
                

    ";

 return $this->db->query($sql)->result();


}





}
?>