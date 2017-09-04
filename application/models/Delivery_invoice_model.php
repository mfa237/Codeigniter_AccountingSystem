<?php

class Delivery_invoice_model extends CORE_Model {
    protected  $table="delivery_invoice";
    protected  $pk_id="dr_invoice_id";

    function __construct() {
        parent::__construct();
    }

    function get_aging_payables()
    {
        $sql = "SELECT
                n.supplier_name,
                SUM(n.days) days,
                SUM(n.current) current,
                SUM(n.30days) thirty_days,
                SUM(n.45days) fortyfive_days,
                SUM(n.60days) sixty_days,
                SUM(n.over_90days) over_ninetydays
                FROM
                (SELECT
                m.supplier_id,
                m.supplier_name,
                m.days,
                m.dr_invoice_no,
                IF(m.days >= 0 AND m.days < 30, m.balance,'') AS current,
                IF(m.days >= 30 AND m.days <= 44, m.balance,'') AS 30days,
                IF(m.days >= 45 AND m.days <= 59, m.balance,'') AS 45days,
                IF(m.days >= 60 AND m.days <= 89, m.balance,'') AS 60days,
                IF(m.days >= 90, m.balance,'') AS over_90days
                FROM
                (SELECT 
                    di.dr_invoice_no,
                    s.supplier_id,
                    s.supplier_name,
                    di.total_after_tax,
                    IFNULL(ppp.payment_amount,0) AS payment_amount,
                    ABS(DATEDIFF(NOW(),di.date_delivered)) AS days,
                    (IFNULL(di.total_after_tax,0) - IFNULL(ppp.payment_amount,0)) AS balance,
                    (CASE WHEN (IFNULL(ppp.payment_amount,0) < di.total_after_tax AND IFNULL(ppp.payment_amount,0) > 0) OR (IFNULL(ppp.payment_amount,0) = 0) THEN 'unpaid' ELSE 'paid' END) AS payment_status
                FROM
                    delivery_invoice di
                    LEFT JOIN suppliers s ON s.supplier_id = di.supplier_id
                    LEFT JOIN 
                    (SELECT pp.*, ppl.dr_invoice_id, SUM(ppl.payment_amount) payment_amount FROM
                    payable_payments pp
                    INNER JOIN payable_payments_list ppl ON ppl.payment_id = pp.payment_id
                    WHERE 
                    pp.is_deleted=FALSE AND pp.is_active=TRUE
                    GROUP BY ppl.dr_invoice_id) AS ppp
                    ON ppp.dr_invoice_id = di.dr_invoice_id
                WHERE
                    di.is_deleted = FALSE
                    AND di.is_active = TRUE) m
                ) n

                GROUP BY n.supplier_id";

            return $this->db->query($sql)->result();
    }

    function get_report_summary($startDate,$endDate){
        $sql="SELECT
            di.dr_invoice_no,
            s.*,
            di.date_delivered,
            di.total_after_tax
            FROM 
            delivery_invoice AS di
            LEFT JOIN suppliers AS s ON s.supplier_id = di.`supplier_id`
            WHERE date_delivered BETWEEN '$startDate' AND '$endDate' AND di.is_active=TRUE AND di.is_deleted=FALSE
            ORDER BY di.date_delivered,di.dr_invoice_id";

        return $this->db->query($sql)->result();
    }

    function get_report_detailed($startDate,$endDate){
        $sql="SELECT
            di.*,
            s.*,
            p.product_desc,
            p.`purchase_cost`,
            dii.`dr_qty`,
            dii.*,
            dr_line_total_price AS total_amount
            FROM 
            delivery_invoice AS di
            LEFT JOIN suppliers AS s ON s.supplier_id = di.`supplier_id`
            LEFT JOIN delivery_invoice_items AS dii ON dii.`dr_invoice_id`=di.`dr_invoice_id`
            LEFT JOIN products AS p ON p.`product_id`=dii.`product_id`
            WHERE date_delivered BETWEEN '$startDate' AND '$endDate' AND di.is_active=TRUE AND di.is_deleted=FALSE
            ORDER BY di.date_delivered,di.dr_invoice_id";

        return $this->db->query($sql)->result();
    }


    function get_journal_entries($purchase_invoice_id){
        $sql="SELECT main.* FROM(SELECT
            p.expense_account_id as account_id,
            '' as memo,
            SUM(dii.dr_non_tax_amount) dr_amount,
            0 as cr_amount

            FROM `delivery_invoice_items` as dii
            INNER JOIN products as p ON dii.product_id=p.product_id
            WHERE dii.dr_invoice_id=$purchase_invoice_id AND p.expense_account_id>0
            GROUP BY p.expense_account_id

            UNION ALL


            SELECT input_tax.account_id,input_tax.memo,
            SUM(input_tax.dr_amount)as dr_amount,0 as cr_amount

             FROM
            (SELECT dii.product_id,

            (SELECT input_tax_account_id FROM account_integration) as account_id
            ,
            '' as memo,
            SUM(dii.dr_tax_amount) as dr_amount,
            0 as cr_amount

            FROM `delivery_invoice_items` as dii
            INNER JOIN products as p ON dii.product_id=p.product_id
            WHERE dii.dr_invoice_id=$purchase_invoice_id AND p.expense_account_id>0
            )as input_tax GROUP BY input_tax.account_id

            UNION ALL

            SELECT acc_payable.account_id,acc_payable.memo,
            0 as dr_amount,SUM(acc_payable.cr_amount) as cr_amount
             FROM
            (SELECT dii.product_id,

            (SELECT payable_account_id FROM account_integration) as account_id
            ,
            '' as memo,
            0 dr_amount,
            SUM(dii.dr_line_total_price) as cr_amount

            FROM `delivery_invoice_items` as dii
            INNER JOIN products as p ON dii.product_id=p.product_id
            WHERE dii.dr_invoice_id=$purchase_invoice_id AND p.expense_account_id>0
            ) as acc_payable GROUP BY acc_payable.account_id)as main WHERE main.dr_amount>0 OR main.cr_amount>0";

        return $this->db->query($sql)->result();



    }

    function get_vat_relief($startDate,$endDate) {
        $sql="SELECT
            di.*,
            s.*,
            (IFNULL(di.total_after_tax,0) - IFNULL(di.total_tax_amount,0)) AS net_of_vat
            FROM
            `delivery_invoice` AS di
            LEFT JOIN suppliers AS s ON s.`supplier_id`=di.`supplier_id`
            WHERE di.is_deleted=FALSE AND di.is_active=TRUE
            AND di.date_delivered BETWEEN '$startDate' AND '$endDate'
            AND s.tax_type_id=2";

            return $this->db->query($sql)->result();
    }

    function get_vat_relief_supplier_list($startDate,$endDate) {
        $sql="SELECT
            DISTINCT(s.supplier_name),
            s.*
            FROM
            `delivery_invoice` AS di
            LEFT JOIN suppliers AS s ON s.`supplier_id`=di.`supplier_id`
            WHERE di.is_deleted=FALSE AND di.is_active=TRUE
            AND di.date_delivered BETWEEN '$startDate' AND '$endDate'
            AND s.tax_type_id=2";

            return $this->db->query($sql)->result();
    }


    function delivery_list_count($id_filter){
        $sql="
        SELECT di.*,
        suppliers.supplier_name,
        tax_types.tax_type,
        purchase_order.po_no,
        DATE_FORMAT(di.date_due,'%m/%d/%Y')as date_due,
        DATE_FORMAT(di.date_delivered,'%m/%d/%Y')as date_delivered,

        CONCAT_WS(' ',CAST(di.terms as CHAR(250)) ,di.duration) as term_description,
        IFNULL(count.count,0) as count
        FROM
        delivery_invoice as di
         
        LEFT JOIN 
        (SELECT 
        pp.payment_id,
        pp.is_active AS payment_active,
        pp.is_deleted AS payment_deleted,
        pl.dr_invoice_id, 

        count(dr_invoice_id) as count
        FROM payable_payments_list AS pl
        LEFT JOIN payable_payments AS pp 
        ON pp.payment_id = pl.payment_id

        WHERE is_active = TRUE AND is_deleted=FALSE
        group by pl.dr_invoice_id) as count

        ON count.dr_invoice_id = di.dr_invoice_id

        LEFT JOIN suppliers ON suppliers.supplier_id = di.supplier_id
        LEFT JOIN tax_types ON tax_types.tax_type_id=di.tax_type_id
        LEFT JOIN purchase_order ON purchase_order.purchase_order_id=di.purchase_order_id 


        WHERE
        di.is_active = TRUE AND di.is_deleted=FALSE 

        ".($id_filter==null?"":" AND di.dr_invoice_id=$id_filter")."
        ";
        return $this->db->query($sql)->result();

    }

}



?>