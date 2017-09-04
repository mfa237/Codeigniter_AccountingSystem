<?php

class AR_Receivable_model extends CORE_Model {
    protected  $table="";
    protected  $pk_id="";

    function __construct() {
        parent::__construct();
    }

	 function get_customer_receivable_list($filter_value,$new_filter_from,$new_filter_to) {
        $sql="SELECT unp.*,IFNULL(pay.sales_payment_amount,0) as sales_payment_amount,
                (IFNULL(unp.total_sales_amount,0)-IFNULL(pay.sales_payment_amount,0))as net_receivable
                FROM
                (SELECT si.sales_invoice_id,si.sales_inv_no,date_due,si.remarks,si.customer_id,s.customer_name,
                (si.total_after_tax)As total_sales_amount
                FROM (sales_invoice as si
                LEFT JOIN customers as s ON si.customer_id=s.customer_id)
                WHERE si.is_active=TRUE AND si.is_deleted=FALSE AND si.is_paid=FALSE
                AND si.customer_id=$filter_value AND si.date_due BETWEEN '".$new_filter_from."' AND '".$new_filter_to."'
                )as unp

                LEFT JOIN

                (SELECT rpl.payment_id,rpl.sales_invoice_id,
                SUM(rpl.payment_amount)as sales_payment_amount
                FROM (receivable_payments_list as rpl
                INNER JOIN sales_invoice as si ON rpl.sales_invoice_id=si.sales_invoice_id)
                INNER JOIN receivable_payments as rp ON rpl.payment_id=rp.payment_id
                WHERE rp.is_active=TRUE AND rp.is_deleted=FALSE AND si.is_paid=FALSE
                AND rp.customer_id=$filter_value
                GROUP BY rpl.sales_invoice_id
                )As pay

                ON unp.sales_invoice_id=pay.sales_invoice_id
                ORDER BY unp.sales_invoice_id DESC
                ";
        return $this->db->query($sql)->result();
    }
		//NO FILTER ~ JBPV
	function get_customer_receivable_list_nofilter($filter_value,$new_filter_from,$new_filter_to) {
        $sql="SELECT unp.*,IFNULL(pay.sales_payment_amount,0) as sales_payment_amount,
                (IFNULL(unp.total_sales_amount,0)-IFNULL(pay.sales_payment_amount,0))as net_receivable
                FROM
                (SELECT si.sales_invoice_id,si.sales_inv_no,date_due,si.remarks,si.customer_id,s.customer_name,
                (si.total_after_tax)As total_sales_amount
                FROM (sales_invoice as si
                LEFT JOIN customers as s ON si.customer_id=s.customer_id)
                WHERE si.is_active=TRUE AND si.is_deleted=FALSE AND si.is_paid=FALSE
				AND si.date_due BETWEEN '".$new_filter_from."' AND '".$new_filter_to."'
                )as unp

                LEFT JOIN

                (SELECT rpl.payment_id,rpl.sales_invoice_id,
                SUM(rpl.payment_amount)as sales_payment_amount
                FROM (receivable_payments_list as rpl
                INNER JOIN sales_invoice as si ON rpl.sales_invoice_id=si.sales_invoice_id)
                INNER JOIN receivable_payments as rp ON rpl.payment_id=rp.payment_id
                WHERE rp.is_active=TRUE AND rp.is_deleted=FALSE AND si.is_paid=FALSE
                GROUP BY rpl.sales_invoice_id
                )As pay

                ON unp.sales_invoice_id=pay.sales_invoice_id
                ORDER BY unp.sales_invoice_id DESC
                ";
        return $this->db->query($sql)->result();
	}
}
?>