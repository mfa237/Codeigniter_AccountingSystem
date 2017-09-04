<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AR_Reports extends CORE_Controller {
    function __construct() {
        parent::__construct('');

        $this->validate_session();
        $this->load->model('AR_Receivable_model');
		$this->load->model('Customers_model');
        $this->load->library('M_pdf');
        $this->load->model('Users_model');
    }

    public function index() {

    }


    function layout($layout=null,$filter_value=null,$filter_from=null,$filter_to=null,$type=null){
        switch($layout){
            case 'ar_receivable_reports': //purchase order
					$m_ar_receivable=$this->AR_Receivable_model;
					$m_customers=$this->Customers_model;
					$tempfrom = str_replace("-", "/", $filter_from);
					$tempto = str_replace("-", "/", $filter_to);
					
					$new_filter_from = date("Y-m-d", strtotime($tempfrom));
					$new_filter_to = date("Y-m-d", strtotime($tempto));
					if($filter_value=="all"){
						$data['receivables']=$m_ar_receivable->get_customer_receivable_list_nofilter($filter_value,$new_filter_from,$new_filter_to);
					}
					else{
						$data['receivables']=$m_ar_receivable->get_customer_receivable_list($filter_value,$new_filter_from,$new_filter_to);
					}
					if($filter_value!="all"){
						$customer_name=$m_customers->get_list(
						$filter_value,
						'customers.customer_name'
						);
						$data['customers']=$customer_name[0]->customer_name;
					}
					else{
						$data['customers']="All";
					}
					
					$data['tempfrom']=$tempfrom;
					$data['tempto']=$tempto;
                    
					
                        //show only inside grid
						if($type=='fullview'||$type==null){
                            echo $this->load->view('template/customer_receivable_list_report_html',$data,TRUE);
                        }
						
                        //download pdf
                        if($type=='pdf'){
                            $pdfFilePath = $data['customers']."-".$tempfrom."-".$tempto.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/customer_receivable_list_report_html',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->Output($pdfFilePath,"D");

                        }

                        //preview on browser
                        if($type=='preview'){
                            $pdfFilePath = "print.pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/customer_receivable_list_report_html',$data,TRUE); //load the template
                            $pdf->setFooter('{PAGENO}');
                            $pdf->WriteHTML($content);
                            //download it.
							$pdf->SetJS('this.print();');
                            $pdf->Output();
                        }



                        break;
          
        }
    }


}
