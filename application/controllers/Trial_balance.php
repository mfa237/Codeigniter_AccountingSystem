<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trial_balance extends CORE_Controller
{
    function __construct()
    {
        parent::__construct('');
        $this->validate_session();

        $this->load->library('excel');

        $this->load->model(
            array
            (
                'Account_type_model',
                'Account_class_model',
                'Account_title_model',
                'Departments_model',
                'Users_model',
                'Company_model'
            )
        );
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Inventory Report';

        $data['departments']=$this->Departments_model->get_list(array('is_deleted'=>FALSE,'is_active'=>TRUE));
        $data['title']="Trial Balance Report";
        
        (in_array('9-3',$this->session->user_rights)? 
        $this->load->view('trial_balance_view',$data)
        :redirect(base_url('dashboard')));
    }


    public function transaction($txn=null){
        switch($txn){
            case 'test':


            case 'export':

                $m_class=$this->Account_class_model;
                $m_types=$this->Account_type_model;
                $m_titles=$this->Account_title_model;
                $m_company=$this->Company_model;

                $company_info=$m_company->get_list();
                $start=$this->input->get('start',TRUE);
                $end=$this->input->get('end',TRUE);
                $classes=$m_class->get_account_class_on_account_titles();

                $titles=$m_titles->get_account_titles_balance(
                    date('Y-m-d',strtotime($start)),
                    date('Y-m-d',strtotime($end))
                );

                $excel=$this->excel;


                $excel->setActiveSheetIndex(0);
                $excel->getActiveSheet()->getColumnDimensionByColumn('B')->setWidth('100');
                $excel->getActiveSheet()->getColumnDimensionByColumn('C')->setWidth('100');
                $excel->getActiveSheet()->getColumnDimensionByColumn('D')->setWidth('100');

                //name the worksheet
                $excel->getActiveSheet()->setTitle('Trial Balance');

                $account_types=$m_types->get_list();

               //company info
                $excel->getActiveSheet()->setCellValue('A1',$company_info[0]->company_name)
                                        ->setCellValue('A2',$company_info[0]->company_address)
                                        ->setCellValue('A3',$company_info[0]->email_address)
                                        ->setCellValue('A4',$company_info[0]->mobile_no);

                //$excel->getActiveSheet()->getProtection()->setSheet(TRUE);
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);

                $excel->getActiveSheet()->setCellValue('A6','Trial Balance')
                                        ->setCellValue('A7',$start.' to '.$end)
                                        ->setCellValue('B10','Dr')
                                        ->setCellValue('C10','Cr')
                                        ->setCellValue('D10','Balance');

                $excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('B9:D9')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A7')->getFont()->setItalic(TRUE);

                $i=9;
                $dr_amount=0.00; $cr_amount=0.00;
                foreach($account_types as $types){
                    $i++;
                    $excel->getActiveSheet()->setCellValue('A'.$i,$types->account_type);
                    $excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(TRUE);
                    $excel->getActiveSheet()->getStyle('A'.$i.':D'.$i)->getFill()
                                            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                            ->getStartColor()->setARGB('0252d3');

                    //change font color
                    $phpColor = new PHPExcel_Style_Color();
                    $phpColor->setRGB('FFFFF');
                    $excel->getActiveSheet()->getStyle('A'.$i.':D'.$i)->getFont()->setColor($phpColor);




                    foreach($classes as $class){

                        $c_dr_amount=0.00; $c_cr_amount=0.00; $c_total=0.00;

                        if($types->account_type_id==$class->account_type_id){
                            $i++;
                            $excel->getActiveSheet()->setCellValue('A'.$i,'       '.$class->account_class);
                            $excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setItalic(TRUE)->setBold(TRUE);
                        }

                        foreach($titles as $title){
                            if($types->account_type_id==$title->account_type_id&&$title->account_class_id==$class->account_class_id){
                                $i++;

                                $excel->getActiveSheet()->getStyle('B'.$i.':D'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');

                                $excel->getActiveSheet()->setCellValue('A'.$i,'               '.$title->account_title);
                                $excel->getActiveSheet()->setCellValue('B'.$i,number_format($title->dr_amount,2));
                                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($title->cr_amount,2));
                                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($title->balance,2));


                                $c_dr_amount+=$title->dr_amount;
                                $c_cr_amount+=$title->cr_amount;
                                $c_total+=$title->balance;

                                $dr_amount+=$title->dr_amount;
                                $cr_amount+=$title->cr_amount;

                            }
                        }

                        //write total of account titles for each class
                        if($types->account_type_id==$class->account_type_id){


                            //border bottom
                            $BStyle = array(
                                'borders' => array(
                                    'bottom' => array(
                                        'style' => PHPExcel_Style_Border::BORDER_THIN
                                    )
                                )
                            );
                            $excel->getActiveSheet()->getStyle('A'.$i.':D'.$i)->applyFromArray($BStyle);

                            $i++;

                            $excel->getActiveSheet()
                                    ->getStyle('A'.$i)
                                    ->getAlignment()
                                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(TRUE);

                            $excel->getActiveSheet()->setCellValue('A'.$i,'Sub-Total :   ');
                            $excel->getActiveSheet()->setCellValue('B'.$i,number_format($c_dr_amount,2));
                            $excel->getActiveSheet()->setCellValue('C'.$i,number_format($c_cr_amount,2));
                            $excel->getActiveSheet()->setCellValue('D'.$i,number_format($c_total,2));

                            $excel->getActiveSheet()->getStyle('B'.$i.':D'.$i)->getFont()->setBold(TRUE);
                            $excel->getActiveSheet()->getStyle('B'.$i.':D'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');
                            $i++;
                        }

                    }



                }


                $i++;
                $excel->getActiveSheet()->setCellValue('B'.$i,number_format($dr_amount,2));
                $excel->getActiveSheet()->setCellValue('C'.$i,number_format($cr_amount,2));
                $excel->getActiveSheet()->setCellValue('D'.$i,number_format($dr_amount-$cr_amount,2));

                $excel->getActiveSheet()->getStyle('B'.$i.':D'.$i)->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('B'.$i.':D'.$i)->getNumberFormat()->setFormatCode('###,##0.00;(###,##0.00)');




                $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);















                //merge cell A1 until D1
                //$excel->getActiveSheet()->mergeCells('A1:D1');
                //set aligment to center for that merged cell (A1 to D1)
                //$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Trial Balance '.date('Y-m-d',strtotime($end)).'.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $objWriter->save('php://output');


                break;
        }
    }



}
?>