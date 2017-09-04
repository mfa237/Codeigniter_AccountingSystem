<?php

class Sales_invoice_model extends CORE_Model
{
    protected $table = "sales_invoice";
    protected $pk_id = "sales_invoice_id";

    function __construct()
    {
        parent::__construct();
    }

    function get_journal_entries($sales_invoice_id){
        $sql="SELECT main.* FROM(SELECT
            p.income_account_id as account_id,
            '' as memo,
            SUM(sii.inv_non_tax_amount) cr_amount,
            0 as dr_amount

            FROM `sales_invoice_items` as sii
            INNER JOIN products as p ON sii.product_id=p.product_id
            WHERE sii.sales_invoice_id=$sales_invoice_id AND p.income_account_id>0
            GROUP BY p.income_account_id

            UNION ALL


            SELECT output_tax.account_id,output_tax.memo,
            SUM(output_tax.cr_amount)as cr_amount,0 as dr_amount
             FROM
            (SELECT sii.product_id,

            (SELECT output_tax_account_id FROM account_integration) as account_id
            ,
            '' as memo,
            SUM(sii.inv_tax_amount) as cr_amount,
            0 as dr_amount

            FROM `sales_invoice_items` as sii
            INNER JOIN products as p ON sii.product_id=p.product_id
            WHERE sii.sales_invoice_id=$sales_invoice_id AND p.income_account_id>0
            )as output_tax GROUP BY output_tax.account_id

            UNION ALL

            SELECT acc_receivable.account_id,acc_receivable.memo,
            0 as cr_amount,SUM(acc_receivable.dr_amount) as dr_amount
             FROM
            (SELECT sii.product_id,

            (SELECT receivable_account_id FROM account_integration) as account_id
            ,
            '' as memo,
            0 cr_amount,
            SUM(sii.inv_line_total_price) as dr_amount

            FROM `sales_invoice_items` as sii
            INNER JOIN products as p ON sii.product_id=p.product_id
            WHERE sii.sales_invoice_id=$sales_invoice_id AND p.income_account_id>0
            ) as acc_receivable GROUP BY acc_receivable.account_id)as main WHERE main.dr_amount>0 OR main.cr_amount>0";

        return $this->db->query($sql)->result();
    }

    function get_customer_soa_complete($date, $customer_id, $status, $payment_date){
$sql="SELECT * FROM (
        SELECT
        1 as group_status,
        m.sales_invoice_id as invoice_id,
        m.sales_inv_no as invoice_no,
        m.date_invoice as date_invoice,
        m.customer_name,
        m.total_after_tax as receivable_amount,
        m.payment_amount as payment_amount,
        IF(m.balance = 0, m.payment_amount, m.balance) balance_amount,
        m.status

        FROM (SELECT
            sales.*,
            payments.receipt_no,
            payments.date_paid,
            IFNULL(sales.total_after_tax,0) receivable_amount,
            IFNULL(payments.payment_amount,0) payment_amount,
            (IFNULL(sales.total_after_tax,0) - IFNULL(payments.payment_amount,0)) balance,
            IF(IFNULL(payments.payment_amount,0) != IFNULL(sales.total_after_tax,0),'unpaid','paid') status
        FROM
        (
            SELECT
            si.*,
            c.customer_name,
            IFNULL(si.address,c.address) customer_address,
            c.contact_name
            FROM
            sales_invoice si
            LEFT JOIN customers c ON c.customer_id = si.customer_id
            WHERE si.is_deleted=FALSE
            AND si.is_active=TRUE
            AND si.customer_id = $customer_id
         ".($date = null ? "AND YEAR(date_invoice) = YEAR(NOW())" : "AND MONTH(date_invoice) $date AND YEAR(date_invoice) = YEAR(NOW())")."
        ) sales

        LEFT JOIN

        (
            SELECT
                rp.*,
                rpl.sales_invoice_id,
                SUM(IFNULL(rpl.receivable_amount,0)) receivable_amount,
                SUM(IFNULL(rpl.payment_amount,0)) payment_amount
            FROM
            receivable_payments_list rpl
            INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
            WHERE rp.is_deleted=FALSE
            AND rp.is_active=TRUE
            AND rp.customer_id = $customer_id
            AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(rp.date_paid) = YEAR(NOW())
            GROUP BY rpl.sales_invoice_id
        ) payments

        ON sales.sales_invoice_id = payments.sales_invoice_id) m HAVING balance_amount > 0


        ) as sales

        UNION
        (
        SELECT
        n.*
        FROM (
        SELECT
        0 as group_status,
        service_invoice.service_invoice_id as invoice_id,
        service_invoice.service_invoice_no as invoice_no,
        service_invoice.date_invoice as date_invoice,
        service_invoice.customer_name,
        IFNULL(service_invoice.total_amount,0) receivable_amount,
        IFNULL(service_payment.payment_amount,0) payment_amount,
        (IFNULL(service_invoice.total_amount,0) - IFNULL(service_payment.payment_amount,0)) balance_amount,
        IF(IFNULL(service_payment.payment_amount,0) != IFNULL(service_invoice.total_amount,0),'unpaid','paid') status


        FROM

        (SELECT
        service_invoice.*,c.customer_name FROM
        service_invoice
        LEFT JOIN
        customers c on c.customer_id =  service_invoice.customer_id
        WHERE service_invoice.is_deleted = FALSE
        AND service_invoice.is_active= TRUE
        AND service_invoice.customer_id= $customer_id
         ".($date = null ? "AND YEAR(date_invoice) = YEAR(NOW())" : "AND MONTH(date_invoice) $date AND YEAR(date_invoice) = YEAR(NOW())")." ) as service_invoice

        LEFT JOIN
        (SELECT
        IF(rpl.sales_invoice_id = 0, 1 , 0) status_group,
            rp.*,
            rpl.sales_invoice_id,
            rpl.service_invoice_id,
            SUM(IFNULL(rpl.receivable_amount,0)) receivable_amount,
            SUM(IFNULL(rpl.payment_amount,0)) payment_amount
        FROM
        receivable_payments_list rpl
        INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
        WHERE rp.is_deleted=FALSE
        AND rp.is_active=TRUE
        AND rp.customer_id = $customer_id
        AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(rp.date_paid) = YEAR(NOW())
        GROUP BY rpl.service_invoice_id
        ) as service_payment

        ON service_invoice.service_invoice_id = service_payment.service_invoice_id ) as n  HAVING balance_amount > 0)
";


return $this->db->query($sql)->result();

    }

    function get_customer_soa_payment($customer_id){
$sql="
SELECT * FROM
(SELECT * FROM
        (SELECT
            1 as group_status,
            rp.*,
            c.customer_name,
            rpl.sales_invoice_id,
            0 as service_invoice_id,
            GROUP_CONCAT(rp.receipt_no) receipt_no_desc,
            IFNULL(rpl.receivable_amount,0) receivable_amount,
            SUM(IFNULL(rpl.payment_amount,0)) payment_amount,
            (IFNULL(rpl.receivable_amount,0) - SUM(IFNULL(rpl.payment_amount,0))) balance
        FROM
        receivable_payments_list rpl
        INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
        LEFT JOIN customers c ON c.customer_id = rp.customer_id
        WHERE rp.is_deleted=FALSE
        AND rp.is_active=TRUE
        AND rp.customer_id = $customer_id
        AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(NOW())
        GROUP BY rpl.sales_invoice_id) m HAVING balance > 0) as m

UNION

(SELECT * FROM
        (SELECT
            0 as group_status,
            rp.*,
            c.customer_name,
            0 as sales_invoice_id,
            rpl.service_invoice_id,
            GROUP_CONCAT(rp.receipt_no) receipt_no_desc,
            IFNULL(rpl.receivable_amount,0) receivable_amount,
            SUM(IFNULL(rpl.payment_amount,0)) payment_amount,
            (IFNULL(rpl.receivable_amount,0) - SUM(IFNULL(rpl.payment_amount,0))) balance
        FROM
        receivable_payments_list rpl
        INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
        LEFT JOIN customers c ON c.customer_id = rp.customer_id
        WHERE rp.is_deleted=FALSE
        AND rp.is_active=TRUE
        AND rp.customer_id = $customer_id
        AND rpl.service_invoice_id != 0
        AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(NOW())
        GROUP BY rpl.service_invoice_id) m HAVING balance > 0) ";



return $this->db->query($sql)->result();

    }

    function get_customer_soa($date, $customer_id, $status, $payment_date)
    {
        $sql = "SELECT
                *,
                IF(m.balance = 0, m.payment_amount, m.balance) balance_amount
                FROM (SELECT
                    sales.*,
                    payments.receipt_no,
                    payments.date_paid,
                    IFNULL(sales.total_after_tax,0) receivable_amount,
                    IFNULL(payments.payment_amount,0) payment_amount,
                    (IFNULL(sales.total_after_tax,0) - IFNULL(payments.payment_amount,0)) balance,
                    IF(IFNULL(payments.payment_amount,0) != IFNULL(sales.total_after_tax,0),'unpaid','paid') status
                FROM
                (
                    SELECT
                    si.*,
                    c.customer_name,
                    IFNULL(si.address,c.address) customer_address,
                    c.contact_name
                    FROM
                    sales_invoice si
                    LEFT JOIN customers c ON c.customer_id = si.customer_id
                    WHERE si.is_deleted=FALSE
                    AND si.is_active=TRUE
                    AND si.customer_id = $customer_id
                    ".($date = null ? "AND YEAR(date_invoice) = YEAR(NOW())" : "AND MONTH(date_invoice) $date AND YEAR(date_invoice) = YEAR(NOW())")."
                ) sales

                LEFT JOIN

                (
                    SELECT
                        rp.*,
                        rpl.sales_invoice_id,
                        SUM(IFNULL(rpl.receivable_amount,0)) receivable_amount,
                        SUM(IFNULL(rpl.payment_amount,0)) payment_amount
                    FROM
                    receivable_payments_list rpl
                    INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
                    WHERE rp.is_deleted=FALSE
                    AND rp.is_active=TRUE
                    AND rp.customer_id = $customer_id
                    AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(rp.date_paid) = YEAR(NOW())
                    GROUP BY rpl.sales_invoice_id
                ) payments

                ON sales.sales_invoice_id = payments.sales_invoice_id) m HAVING balance > 0";

        return $this->db->query($sql)->result();
    }

    function get_customer_payments($customer_id)
    {
        $sql = "SELECT * FROM
        (SELECT
            rp.*,
            c.customer_name,
            rpl.sales_invoice_id,
            GROUP_CONCAT(rp.receipt_no) receipt_no_desc,
            IFNULL(rpl.receivable_amount,0) receivable_amount,
            SUM(IFNULL(rpl.payment_amount,0)) payment_amount,
            (IFNULL(rpl.receivable_amount,0) - SUM(IFNULL(rpl.payment_amount,0))) balance
        FROM
        receivable_payments_list rpl
        INNER JOIN receivable_payments rp ON rp.payment_id = rpl.payment_id
        LEFT JOIN customers c ON c.customer_id = rp.customer_id
        WHERE rp.is_deleted=FALSE
        AND rp.is_active=TRUE
        AND rp.customer_id = $customer_id
        AND MONTH(rp.date_paid) = MONTH(NOW()) AND YEAR(NOW())
        GROUP BY rpl.sales_invoice_id) m HAVING balance > 0";

        return $this->db->query($sql)->result();
    }

    // function get_aging_receivables()
    // {
    //     $sql = "SELECT
    //         n.customer_name,
    //         SUM(n.days) days,
    //         SUM(n.current) current,
    //         SUM(n.30days) thirty_days,
    //         SUM(n.45days) fortyfive_days,
    //         SUM(n.60days) sixty_days,
    //         SUM(n.over_90days) over_ninetydays
    //         FROM
    //         (SELECT
    //         m.customer_id,
    //         m.customer_name,
    //         m.days,
    //         m.sales_inv_no,
    //         IF(m.days >= 0 AND m.days < 30, m.balance,'') AS current,
    //         IF(m.days >= 30 AND m.days <= 44, m.balance,'') AS 30days,
    //         IF(m.days >= 45 AND m.days <= 59, m.balance,'') AS 45days,
    //         IF(m.days >= 60 AND m.days <= 89, m.balance,'') AS 60days,
    //         IF(m.days >= 90, m.balance,'') AS over_90days
    //         FROM
    //         (SELECT
    //             si.sales_inv_no,
    //             si.customer_id,
    //             c.customer_name,
    //             IFNULL(rpp.payment_amount,0) AS payment_amount,
    //             ABS(DATEDIFF(NOW(),si.date_invoice)) AS days,
    //             (IFNULL(si.total_after_tax,0) - IFNULL(rpp.payment_amount,0)) AS balance,
    //             (CASE WHEN (IFNULL(rpp.payment_amount,0) < si.total_after_tax AND IFNULL(rpp.payment_amount,0) > 0) OR (IFNULL(rpp.payment_amount,0) = 0) THEN 'unpaid' ELSE 'paid' END) AS payment_status
    //         FROM
    //             sales_invoice si
    //             LEFT JOIN customers c ON c.customer_id = si.customer_id
    //             LEFT JOIN
    //             (
    //                 SELECT rp.*, rpl.sales_invoice_id, SUM(rpl.payment_amount) payment_amount FROM
    //                 receivable_payments rp
    //                 INNER JOIN receivable_payments_list rpl ON rpl.payment_id = rp.payment_id
    //                 WHERE
    //                 rp.is_deleted=FALSE AND rp.is_active=TRUE
    //                 GROUP BY rpl.sales_invoice_id
    //             ) AS rpp
    //             ON rpp.sales_invoice_id = si.sales_invoice_id
    //         WHERE
    //             si.is_deleted = FALSE
    //             AND si.is_active = TRUE) m
    //         ) n

    //         GROUP BY n.customer_id";

    //     return $this->db->query($sql)->result();
    // }

    function get_aging_receivables()
    {
        $sql = "SELECT
        *
        FROM
        (
            (
            SELECT
            n.customer_id,
            n.customer_name,
            SUM(n.days) days,
            SUM(n.current) current,
            SUM(n.30days) thirty_days,
            SUM(n.45days) fortyfive_days,
            SUM(n.60days) sixty_days,
            SUM(n.over_90days) over_ninetydays,
            1 is_sales
            FROM
            (SELECT
            m.customer_id,
            m.customer_name,
            m.days,
            m.sales_inv_no,
            IF(m.days >= 0 AND m.days < 30, m.balance,'') AS current,
            IF(m.days >= 30 AND m.days <= 44, m.balance,'') AS 30days,
            IF(m.days >= 45 AND m.days <= 59, m.balance,'') AS 45days,
            IF(m.days >= 60 AND m.days <= 89, m.balance,'') AS 60days,
            IF(m.days >= 90, m.balance,'') AS over_90days
            FROM
            (SELECT
                si.sales_inv_no,
                si.customer_id,
                c.customer_name,
                IFNULL(rpp.payment_amount,0) AS payment_amount,
                ABS(DATEDIFF(NOW(),si.date_invoice)) AS days,
                (IFNULL(si.total_after_tax,0) - IFNULL(rpp.payment_amount,0)) AS balance,
                (CASE WHEN (IFNULL(rpp.payment_amount,0) < si.total_after_tax AND IFNULL(rpp.payment_amount,0) > 0) OR (IFNULL(rpp.payment_amount,0) = 0) THEN 'unpaid' ELSE 'paid' END) AS payment_status
            FROM
                sales_invoice si
                LEFT JOIN customers c ON c.customer_id = si.customer_id
                LEFT JOIN
                (
                    SELECT rp.*, rpl.sales_invoice_id, SUM(rpl.payment_amount) payment_amount FROM
                    receivable_payments rp
                    INNER JOIN receivable_payments_list rpl ON rpl.payment_id = rp.payment_id
                    WHERE
                    rp.is_deleted=FALSE AND rp.is_active=TRUE
                    GROUP BY rpl.sales_invoice_id
                ) AS rpp
                ON rpp.sales_invoice_id = si.sales_invoice_id
            WHERE
                si.is_deleted = FALSE
                AND si.is_active = TRUE) m
            ) n

            GROUP BY n.customer_id
            )

            UNION

            (
            SELECT
            n.customer_id,
            n.customer_name,
            SUM(n.days) days,
            SUM(n.current) current,
            SUM(n.30days) thirty_days,
            SUM(n.45days) fortyfive_days,
            SUM(n.60days) sixty_days,
            SUM(n.over_90days) over_ninetydays,
            0 is_sales
            FROM
            (SELECT
            m.customer_id,
            m.customer_name,
            m.days,
            m.service_invoice_no,
            IF(m.days >= 0 AND m.days < 30, m.balance,'') AS current,
            IF(m.days >= 30 AND m.days <= 44, m.balance,'') AS 30days,
            IF(m.days >= 45 AND m.days <= 59, m.balance,'') AS 45days,
            IF(m.days >= 60 AND m.days <= 89, m.balance,'') AS 60days,
            IF(m.days >= 90, m.balance,'') AS over_90days
            FROM
            (SELECT
                si.service_invoice_no,
                si.customer_id,
                c.customer_name,
                IFNULL(rpp.payment_amount,0) AS payment_amount,
                ABS(DATEDIFF(NOW(),si.date_invoice)) AS days,
                (IFNULL(si.total_amount,0) - IFNULL(rpp.payment_amount,0)) AS balance,
                (CASE WHEN (IFNULL(rpp.payment_amount,0) < si.total_amount AND IFNULL(rpp.payment_amount,0) > 0) OR (IFNULL(rpp.payment_amount,0) = 0) THEN 'unpaid' ELSE 'paid' END) AS payment_status
            FROM
                service_invoice si
                LEFT JOIN customers c ON c.customer_id = si.customer_id
                LEFT JOIN
                (
                    SELECT rp.*, rpl.service_invoice_id, SUM(rpl.payment_amount) payment_amount FROM
                    receivable_payments rp
                    INNER JOIN receivable_payments_list rpl ON rpl.payment_id = rp.payment_id
                    WHERE
                    rp.is_deleted=FALSE AND rp.is_active=TRUE
                    GROUP BY rpl.service_invoice_id
                ) AS rpp
                ON rpp.service_invoice_id = si.service_invoice_id
            WHERE
                si.is_deleted = FALSE
                AND si.is_active = TRUE) m
            ) n

            GROUP BY n.customer_id
            )
        ) sales_services";

        return $this->db->query($sql)->result();
    }

    function get_report_summary($startDate,$endDate){
        $sql="SELECT
            si.sales_inv_no,
            c.*,
            si.date_invoice,
            si.total_after_tax,
            si.remarks
            FROM
            sales_invoice AS si
            LEFT JOIN customers AS c ON c.customer_id = si.customer_id
            WHERE date_invoice BETWEEN '$startDate' AND '$endDate' AND inv_type=1
            ORDER BY si.customer_id";

        return $this->db->query($sql)->result();
    }


    function get_sales_summary($start=null,$end=null){
        $sql="SELECT mQ.*,DATE_FORMAT(mQ.date_invoice,'%m/%d/%Y') as inv_date,(mQ.sales-mQ.cost_of_sales) as net_profit
                FROM
                (

                SELECT nQ.*,
                (

                IF(nQ.inv_price=0,0,nQ.purchase_cost*nQ.inv_qty)

                )as cost_of_sales

                FROM
                (SELECT si.sales_inv_no,si.date_invoice,sii.inv_price,
                '' as dr_si,'' as vr,c.customer_name,
                IF(sii.inv_price=0,CONCAT(pr.product_desc,' (Free)'),pr.product_desc)as product_desc,
                refp.product_type,

                IF(sii.inv_price=0,0,SUM(sii.inv_qty))as inv_qty,

                IF(sii.inv_price=0,SUM(sii.inv_qty),0) as fg, /**this free item**/

                pr.size,
                s.supplier_name,sii.inv_price as srp,
                IFNULL(SUM(sii.inv_line_total_price),0) as sales,

                IF(sii.inv_price=0,
                  0,
                  sii.cost_upon_invoice
                )as purchase_cost /**GET THE COST OF THE PRODUCT WHEN IT WAS INVOICED**/



                FROM sales_invoice as si

                LEFT JOIN customers as c ON si.customer_id=c.customer_id
                INNER JOIN sales_invoice_items as sii ON si.sales_invoice_id=sii.sales_invoice_id
                LEFT JOIN (products as pr  LEFT JOIN refproduct as refp ON refp.refproduct_id=pr.refproduct_id)ON sii.product_id=pr.product_id
                LEFT JOIN suppliers as s ON pr.supplier_id=s.supplier_id

                WHERE si.date_invoice BETWEEN '$start' AND '$end' AND si.is_active=TRUE AND si.is_deleted=FALSE

                GROUP BY si.sales_inv_no,sii.product_id,sii.inv_price,IF(sii.inv_price=0,
                  0,
                  sii.cost_upon_invoice
                ))as nQ) mQ
                ";

            return $this->db->query($sql)->result();
    }


    function get_per_customer_sales_summary($start=null,$end=null,$customer_id=null){
        $sql="SELECT n.* FROM(SELECT si.sales_invoice_id,
            si.sales_inv_no,si.customer_id,c.customer_name,'SI' as type,c.address,c.contact_no,c.email_address,
            SUM(sii.inv_line_total_price)as total_amount_invoice

            FROM (sales_invoice as si
            LEFT JOIN customers as c ON c.customer_id=si.customer_id)
            INNER JOIN sales_invoice_items as sii ON si.sales_invoice_id=sii.sales_invoice_id
            WHERE si.is_active=TRUE AND si.is_deleted=FALSE
            AND si.date_invoice BETWEEN '$start' AND '$end' AND si.inv_type=1
            GROUP BY si.customer_id


            UNION ALL


            SELECT si.sales_invoice_id,
            si.sales_inv_no,d.department_id as customer_id,
            CONCAT(d.department_name,' (DR)') as customer_name,'DR' as type,'' as address,'' as contact_no,'' as email_address,
            SUM(sii.inv_line_total_price)as total_amount_invoice

            FROM (sales_invoice as si
            LEFT JOIN departments as d ON d.department_id=si.issue_to_department)
            INNER JOIN sales_invoice_items as sii ON si.sales_invoice_id=sii.sales_invoice_id
            WHERE si.is_active=TRUE AND si.is_deleted=FALSE
            AND si.date_invoice BETWEEN '$start' AND '$end' AND si.inv_type=2
            GROUP BY si.department_id) as  n ORDER By n.customer_name";
        return $this->db->query($sql)->result();
    }

    function get_sales_detailed_list($start=null,$end=null){
        $sql="SELECT
                si.sales_invoice_id,
                si.sales_inv_no,
                si.date_invoice,
                si.customer_id,
                c.customer_name,
                p.product_id,
                p.product_code,
                p.product_desc,
                p.sale_price,
                sii.inv_qty,
                s.salesperson_id,
                s.salesperson_code,
                CONCAT(s.firstname,' ',s.lastname) AS salesperson_name,
                ((p.sale_price) * (sii.inv_qty)) as total_amount
            FROM
                (sales_invoice AS si
                LEFT JOIN customers AS c ON c.customer_id = si.customer_id)
                INNER JOIN sales_invoice_items AS sii ON si.sales_invoice_id = sii.sales_invoice_id
                LEFT JOIN products AS p ON p.product_id=sii.product_id
                LEFT JOIN salesperson AS s ON s.salesperson_id=si.salesperson_id
            WHERE
                si.is_active = TRUE AND si.is_deleted = FALSE
                AND si.date_invoice BETWEEN '$start' AND '$end'
            ORDER BY si.sales_inv_no ASC";
        return $this->db->query($sql)->result();
    }

    function get_sales_summary_list($start=null,$end=null){
        $sql="SELECT
                  si.customer_id,
                  c.customer_code,
                  c.customer_name,
                  s.salesperson_code,
                  CONCAT(s.firstname,' ',s.lastname) AS salesperson_name,
                  SUM((p.sale_price) * (sii.inv_qty)) as total_amount
              FROM
                  (sales_invoice AS si
                  LEFT JOIN customers AS c ON c.customer_id = si.customer_id)
                  INNER JOIN sales_invoice_items AS sii ON si.sales_invoice_id = sii.sales_invoice_id
                  LEFT JOIN products AS p ON p.product_id=sii.product_id
                  LEFT JOIN salesperson AS s ON s.salesperson_id=si.salesperson_id
              WHERE
                  si.is_active = TRUE AND si.is_deleted = FALSE
                  AND si.date_invoice BETWEEN '$start' AND '$end'
              GROUP BY si.customer_id";
        return $this->db->query($sql)->result();
    }

    function get_sales_product_summary_list($start=null,$end=null){
        $sql="SELECT
                  si.customer_id,
                  p.product_code,
                  p.product_desc,
                  SUM((p.sale_price) * (sii.inv_qty)) as total_amount
              FROM
                  (sales_invoice AS si)
                  INNER JOIN sales_invoice_items AS sii ON si.sales_invoice_id = sii.sales_invoice_id
                  LEFT JOIN products AS p ON p.product_id=sii.product_id
              WHERE
                  si.is_active = TRUE AND si.is_deleted = FALSE
                  AND si.date_invoice BETWEEN '$start' AND '$end'
              GROUP BY sii.product_id";
         return $this->db->query($sql)->result();
    }

    function list_with_count($filter_id){
    $sql="SELECT
        si.sales_invoice_id,
        si.sales_inv_no,
        si.remarks,
        si.date_created,
        si.customer_id,
        si.inv_type,
        si.is_journal_posted,
        DATE_FORMAT(si.date_invoice,'%m/%d/%Y') as date_invoice,
        DATE_FORMAT(si.date_due,'%m/%d/%Y') as date_due,

        si.salesperson_id,
        si.address,

        departments.department_id,
        departments.department_name,
        customers.customer_name,
        sales_order.so_no,


        IFNULL(count.count,0) as count
        FROM sales_invoice AS si

        LEFT JOIN

        (SELECT
        rp.payment_id,
        rpl.sales_invoice_id,
        count(sales_invoice_id) AS count
        FROM receivable_payments_list AS rpl
        LEFT JOIN receivable_payments AS rp ON rp.payment_id = rpl.payment_id
        WHERE rp.is_active= TRUE AND rp.is_deleted = FALSE
        group by rpl.sales_invoice_id) AS count

        ON count.sales_invoice_id = si.sales_invoice_id
        LEFT JOIN departments ON departments.department_id=si.department_id
        LEFT JOIN customers  ON customers.customer_id=si.customer_id
        LEFT JOIN sales_order ON sales_order.sales_order_id=si.sales_order_id


        WHERE si.is_active= TRUE AND si.is_deleted =  FALSE";

         return $this->db->query($sql)->result();
    }
}


?>
