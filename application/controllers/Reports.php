<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Purchases_model');
        $this->load->model('Purchase_items_model');
        $this->load->model('Delivery_invoice_model');
        $this->load->model('Delivery_invoice_item_model');
        $this->load->model('Company_model');
    }

    public function index() {

    }

    //layout = po,
    //$type = pdf,preview
    //$filter_value=criteria
    function layout($layout=null,$type=null,$filter_value=null){
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class


        switch($layout){
            case 'po' :
                $m_purchases=$this->Purchases_model;
                $m_po_items=$this->Purchase_items_model;
                $m_company=$this->Company_model;



                $pdfFilePath = $filter_value.".pdf"; //generate filename base on id

                $info=$m_purchases->get_list(
                    $filter_value,
                    'purchase_order.*,suppliers.supplier_name,suppliers.address,suppliers.email_address,suppliers.landline',
                    array(
                        array('suppliers','suppliers.supplier_id=purchase_order.supplier_id','left')
                    )
                );

                $company=$m_company->get_list();

                $data['purchase_info']=$info[0];
                $data['company_info']=$company[0];
                $data['po_items']=$m_po_items->get_list(
                    array('purchase_order_id'=>$filter_value),
                    'purchase_order_items.*,products.product_desc,units.unit_name',
                    array(
                        array('products','products.product_id=purchase_order_items.product_id','left'),
                        array('units','units.unit_id=purchase_order_items.unit_id','left')
                    )
                );

                $content=$this->load->view('template/po_content',$data,TRUE); //load the template
                $pdf->setFooter('{PAGENO}');


                $pdf->WriteHTML($content);

                if($type=='pdf'){
                    //download it.
                    $pdf->Output($pdfFilePath,"D");
                }else{
                    //just output it on browser
                    $pdf->Output();
                }

                break;
            //******************************************************************************************
            case 'dr' :
                $m_delivery=$this->Delivery_invoice_model;
                $m_dr_items=$this->Delivery_invoice_item_model;
                $m_company=$this->Company_model;

                $pdfFilePath = $filter_value.".pdf"; //generate filename base on id

                $info=$m_delivery->get_list(
                    $filter_value,
                    'delivery_invoice.*,purchase_order.po_no,CONCAT_WS(" ",delivery_invoice.terms,delivery_invoice.duration)as term_description,suppliers.supplier_name,suppliers.address,suppliers.email_address,suppliers.landline',
                    array(
                        array('suppliers','suppliers.supplier_id=delivery_invoice.supplier_id','left'),
                        array('purchase_order','purchase_order.purchase_order_id=delivery_invoice.purchase_order_id','left')
                    )
                );

                $company=$m_company->get_list();

                $data['delivery_info']=$info[0];
                $data['company_info']=$company[0];
                $data['dr_items']=$m_dr_items->get_list(
                    array('dr_invoice_id'=>$filter_value),
                    'delivery_invoice_items.*,products.product_desc,units.unit_name',
                    array(
                        array('products','products.product_id=delivery_invoice_items.product_id','left'),
                        array('units','units.unit_id=delivery_invoice_items.unit_id','left')
                    )
                );

                $content=$this->load->view('template/dr_content',$data,TRUE); //load the template
                $pdf->setFooter('{PAGENO}');


                $pdf->WriteHTML($content);

                if($type=='pdf'){
                    //download it.
                    $pdf->Output($pdfFilePath,"D");
                }else{
                    //just output it on browser
                    $pdf->Output();
                }

                break;
        }
    }


}
