<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CORE_Controller {
    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Purchases_model');
        $this->load->model('Purchase_items_model');
        $this->load->model('Company_model');

    }

    public function index() {

    }

    //layout = po,
    //$type = pdf,preview
    //$filter_value=criteria
    function send($layout=null,$filter_value=null){
        switch($layout){
            case 'po' :
                $m_purchases=$this->Purchases_model;
                $m_po_items=$this->Purchase_items_model;
                $m_company=$this->Company_model;

                $pdfFilePath = $filter_value.".pdf"; //generate filename base on id

                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class

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




                $this->load->library('email');

                $email_setting  = array('mailtype'=>'html');
                $this->email->initialize($email_setting);

                $this->email->from('jdevsystems@jdevsolution.com', 'Paul Christian Rueda');
                $this->email->to($info[0]->email_address);
                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');

                $this->email->subject('Purchase Order : '.$filter_value);
                $this->email->message($content);
                //$this->email->set_mailtype('html');

                if($this->email->send()){
                    $m_purchases->is_email_sent=1;
                    $m_purchases->modify($filter_value);

                    $response['title']='Sent';
                    $response['stat']='success';
                    $response['msg']='Email successfully sent.';
                    $response['row_updated'] = $response['data']=$m_purchases->get_list(
                        $filter_value,
                        array(
                            'purchase_order.*',
                            'CONCAT_WS(" ",CAST(purchase_order.terms AS CHAR),purchase_order.duration)as term_description',
                            'suppliers.supplier_name',
                            'tax_types.tax_type',
                            'approval_status.approval_status',
                            'order_status.order_status'
                        ),
                        array(
                            array('suppliers','suppliers.supplier_id=purchase_order.supplier_id','left'),
                            array('tax_types','tax_types.tax_type_id=purchase_order.tax_type_id','left'),
                            array('approval_status','approval_status.approval_id=purchase_order.approval_id','left'),
                            array('order_status','order_status.order_status_id=purchase_order.order_status_id','left')
                        )
                    );


                    echo json_encode($response);
                }

                break;
        }
    }


}











