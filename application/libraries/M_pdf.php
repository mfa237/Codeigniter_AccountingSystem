<?php 
class M_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($format="A4",$margin_left=13,$margin_right=13,$margin_top=13,$margin_bottom=13)
    {
        include_once APPPATH.'third_party/mpdf/mpdf.php';

        return new mPDF('c',$format,0, '', $margin_left, $margin_right, $margin_top, $margin_bottom);
    }
}