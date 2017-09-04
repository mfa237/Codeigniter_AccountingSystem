<?php

class Other_Sales_invoice_model extends CORE_Model
{
    protected $table = "other_sales_invoice";
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




}


?>