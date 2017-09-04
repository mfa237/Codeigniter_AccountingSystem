<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->load->model('Sales_invoice_item_model');
    }

    public function index() {


    }

    function get($txn=null,$depid=null){
        switch($txn){
            case 'items':
                $m_items=$this->Sales_invoice_item_model;

                echo(json_encode(
                    $m_items->get_list(

                        null, //to be filtered base on department id
                        array(
                            'sales_invoice_items.*',
                            'p.product_desc',
                            'p.product_code',
                            'si.*'
                        ),

                        array(
                            array('sales_invoice as si','si.sales_invoice_id=sales_invoice_items.sales_invoice_id','inner'),
                            array('products as p','p.product_id=sales_invoice_items.product_id','left')
                        )


                    )
                ));


                break;
        }

    }



}
