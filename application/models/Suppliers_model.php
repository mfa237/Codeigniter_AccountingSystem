<?php

class Suppliers_model extends CORE_Model {
    protected  $table="suppliers";
    protected  $pk_id="supplier_id";

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function create_default_supplier(){
        //return;
        $sql="INSERT IGNORE INTO suppliers
                  (supplier_id,
                  supplier_code,
                  supplier_name,
                  contact_name,
                  contact_person,
                  address,
                  email_address,
                  contact_no,
                  tin_no,
                  term,
                  tax_type_id)
              VALUES
                  (1,
                  'N/A',
                  'N/A',
                  '',
                  '',
                  '',
                  '',
                  '',
                  '',
                  '',
                  1)
        ";
        $this->db->query($sql);
    }

    function get_supplier_list($supplier_id=null) {
        $sql="  SELECT
                  a.*,b.photo_path
                FROM
                  suppliers as a
                LEFT JOIN
                    supplier_photos as b
                ON
                  a.supplier_id=b.supplier_id
                WHERE
                    a.is_deleted=FALSE AND a.is_active=TRUE
                ".($supplier_id==null?"":" AND a.supplier_id=$supplier_id")."
            ";
        return $this->db->query($sql)->result();
    }

    //returns list of purchase invoice of supplier that are unpaid
    function get_supplier_payable_list($supplier_id) {
        $sql="SELECT unp.*,IFNULL(pay.dr_payment_amount,0) as dr_payment_amount,
                (IFNULL(unp.total_dr_amount,0)-IFNULL(pay.dr_payment_amount,0))as net_payable
                FROM
                (SELECT di.dr_invoice_id,di.dr_invoice_no,date_due,di.remarks,di.supplier_id,s.supplier_name,
                CONCAT_WS(' ',di.terms,di.duration)as term_description,
                (di.total_after_tax)As total_dr_amount
                FROM (delivery_invoice as di
                LEFT JOIN suppliers as s ON di.supplier_id=s.supplier_id)
                WHERE di.is_active=TRUE AND di.is_deleted=FALSE AND di.is_paid=FALSE
                AND di.supplier_id=$supplier_id
                )as unp

                LEFT JOIN

                (SELECT ppl.payment_id,ppl.dr_invoice_id,
                SUM(ppl.payment_amount)as dr_payment_amount
                FROM (payable_payments_list as ppl
                INNER JOIN delivery_invoice as di ON ppl.dr_invoice_id=di.dr_invoice_id)
                INNER JOIN payable_payments as pp ON ppl.payment_id=pp.payment_id
                WHERE pp.is_active=TRUE AND pp.is_deleted=FALSE AND di.is_paid=FALSE
                AND pp.supplier_id=$supplier_id
                GROUP BY ppl.dr_invoice_id
                )As pay

                ON unp.dr_invoice_id=pay.dr_invoice_id HAVING net_payable>0";
        return $this->db->query($sql)->result();
    }


    function get_current_payable_amount($supplier_id){
        $sql="SELECT IFNULL((SUM(m.total_payable)-SUM(m.total_payment)),0) as net_payable
            FROM
            (SELECT SUM(di.total_after_tax) as total_payable,0 as total_payment FROM delivery_invoice as di
            WHERE di.is_active=TRUE AND di.is_deleted=FALSE AND di.supplier_id=$supplier_id GROUP BY di.supplier_id


            UNION


            SELECT 0 as total_payable,SUM(pp.total_paid_amount) as total_payment FROM payable_payments as pp
            WHERE pp.is_active=TRUE AND pp.is_deleted=FALSE AND pp.supplier_id=$supplier_id GROUP BY pp.supplier_id)as m";

        $result=$this->db->query($sql)->result();

        return (float)($result[0]->net_payable);
    }


    function recalculate_supplier_payable($supplier_id){
        $sql="UPDATE suppliers SET total_payable_amount=".$this->get_current_payable_amount($supplier_id)." WHERE supplier_id=$supplier_id";
        return $this->db->query($sql);
    }


    function get_list_supplier_invoice($supplier_id){
      $sql="
      SELECT
      unpaid.dr_invoice_no, 
      unpaid.total_after_tax,
      paid.total_paid,
      unpaid.invoice_date,

      (CASE WHEN unpaid.total_after_tax = paid.total_paid THEN 'paid' ELSE 'unpaid' END ) AS remarks
      FROM

      (SELECT 
      dr_invoice_id, 
      date_delivered as invoice_date,
      dr_invoice_no,
      total_after_tax
      FROM delivery_invoice 
      WHERE is_active=TRUE AND is_deleted=FALSE and supplier_id = $supplier_id) AS unpaid

      LEFT JOIN

      (SELECT
      dr_invoice_id,
      SUM(payment_amount) as total_paid
      FROM payable_payments_list
      LEFT JOIN payable_payments ON payable_payments.payment_id= payable_payments_list.payment_id
      WHERE is_active=TRUE AND is_deleted=FALSE AND supplier_id = $supplier_id
      GROUP BY dr_invoice_id) AS paid

      ON paid.dr_invoice_id = unpaid.dr_invoice_id";

      return $this->db->query($sql)->result();
    }


    function get_supplier_payment($supplier_id){

$sql="SELECT
      unpaid.dr_invoice_no, 
      paid.receipt_no,
      unpaid.invoice_date,
      paid.total_paid,
      paid.date_paid,
      paid.check_no
      FROM

      (SELECT 
      dr_invoice_id, 
      date_delivered as invoice_date,
      dr_invoice_no,
      total_after_tax
      FROM delivery_invoice 
      WHERE is_active=TRUE AND is_deleted=FALSE and supplier_id = $supplier_id) AS unpaid

      LEFT JOIN

      (SELECT
      dr_invoice_id,
      receipt_no,
      date_paid,
      check_no,
      SUM(payment_amount) as total_paid
      FROM payable_payments_list
      LEFT JOIN payable_payments ON payable_payments.payment_id= payable_payments_list.payment_id
      WHERE is_active=TRUE AND is_deleted=FALSE AND supplier_id = $supplier_id
      GROUP BY dr_invoice_id) AS paid

      ON paid.dr_invoice_id = unpaid.dr_invoice_id
      having paid.total_paid > 0";
      return $this->db->query($sql)->result();


    }



}
?>