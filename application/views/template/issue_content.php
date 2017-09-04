<head>  <title>Issuance Report</title></head>
<body>
<style>



    #issuance tr {
        background: transparent !important;
    }

    #report_footer th {
/*        background: #303030 !important;
*/    }
    .report{

    border-bottom: 1px solid gray;

    border-right: none;
    border-left:none;
    border-top:none;

}
    td{

    }
    tr {
/*        border: none!important;*/
    }

    tr:nth-child(even){
/*        background: #414141 !important;*/
/*        border: none!important;*/
    }

/*    tr:hover {
        transition: .4s;
        background: #414141 !important;
        color: white;
    }
    
*/
    th{
        background-color: transparent!important;
    }
/*    tr:hover .btn {
        border-color: #494949!important;
        border-radius: 0!important;
        -webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
    }
*/
       body {
        font-family: 'Calibri',sans-serif;
        font-size: 12px;
    }

    .align-right {
        text-align: right;
    }

    .align-left {
        text-align: left;
    }

    .align-center {
        text-align: center;
    }

    .report-header {
        font-weight: bolder;
    }
       table{
        border:none!important;
    }
          
      </style>

<div style="width:100%">
<table width="100%">
        <tr>
            <td width="10%" style="border:none!important;"><img src="<?php echo $company_info->logo_path; ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%" style="border:none!important;" class="align-center">
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
<table style="font-family:tahoma;" id="report_header">
    <tbody>
        <tr>
            <td style="width:85%;font-size:18px;font-weight:bold;border:none!important;">ISSUANCE REPORT</td>
            <td style="width:15%;font-size:18px;font-weight:bold;border:none!important;"><?php echo $issuance_info->slip_no; ?></td>
        </tr>
    </tbody>
</table>
<table width="100%" id="issuance">
    <thead>
    </thead>
    <tbody>
        <tr>
            <td style="width:20%;font-weight:bold;border:none!important;">Name of Customer: </td>
            <td style="width:30%;" class="report"> <?php echo $issuance_info->customer_name; ?></td>
            <td style="width:10%;border:none!important;"></td>
            <td style="text-align:right;font-weight:bold;border:none!important;">Date:</td>
            <td style="width:20%;text-align:center;" class="report"><?php echo  date_format(new DateTime($issuance_info->date_issued),"m/d/Y"); ?></td>
        </tr>
        <tr>
            <td style="width:20%;font-weight:bold;border:none!important;">Address: </td>
            <td style="width:30%;" class="report"> <?php echo $issuance_info->address; ?></td>
            <td style="width:10%;border: none!important;"></td>
            <td style="text-align:right;font-weight:bold;border:none!important;">Terms:</td>
            <td style="width:20%;text-align:center;" class="report"> <?php echo $issuance_info->terms; ?></td>
        </tr>
    </tbody>
</table><br>
<table width="100%" style="font-family:tahoma;" cellspacing="0" >
    <thead>
        <tr >
            <th style="width:35%;text-align:left;border-bottom: 1px solid gray;">Description</th>
            <th style="width:10%;text-align:center;border-bottom: 1px solid gray;">Quantity</th>
            <th style="width:15%;text-align:center;border-bottom: 1px solid gray;">Pack. Size</th>
            <th style="width:20%;text-align:center;border-bottom: 1px solid gray;">Unit Price</th>
            <th style="width:20%;text-align:center;border-bottom: 1px solid gray;">Amount</th>
        </tr>
    </thead>
    <tbody>
       <?php 
            $grandtotal=0;
            foreach($issue_items as $item){
            $grandtotal+=$item->issue_line_total_price;
             ?>
                <tr>
                    <td style="border-bottom: 1px solid gray;"><?php echo $item->product_desc; ?></td>
                    <td style="text-align:center; border-bottom: 1px solid gray;"><?php echo number_format($item->issue_qty,0); ?></td>
                    <td style="text-align:center; border-bottom: 1px solid gray;"></td>
                    <td style="text-align:center;border-bottom: 1px solid gray;"><?php echo number_format($item->issue_price,2); ?></td>
                    <td style="text-align:center;border-bottom: 1px solid gray;"><?php echo number_format($item->issue_line_total_price,2); ?></td>
                </tr>
            <?php } ?>
            <tr>
            <td colspan="3"></td>
                <td  style="text-align:left;font-weight:bold;  border-bottom: 1px solid gray;">Grand Total</td>
                <td style="text-align:center;font-weight:bold; border-bottom: 1px solid gray;"><?php echo number_format($grandtotal,2); ?></td>
            </tr>
    </tbody>
</table>
<br><br><br>
<table id="report_footer" style="width: 100%;">
    <tbody>
<!--         <tr >
            <th style="width:35%;text-align:center;"><br></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:22%;text-align:center;"></th>
            <th style="width:23%;text-align:center;"></th>
        </tr>
        <tr style="background-color: transparent!important;">
            <th style="width:35%;text-align:center;border-top:1px solid black;">Authorized Signature</th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:22%;text-align:center;"></th>
            <th style="width:23%;text-align:center;border-top:1px solid black;">Customer's Signature</th>
        </tr> -->
        <tr>
        <td style="border:none!important;">
            <th style="width: 10%;"></th><th style="width:30%;text-align:center;border-top:1px solid black;">Authorized Signature</th><th style="width: 10%;"></th>
        </td>
        <td style="border:none!important;">
        <th style="width: 10%;"></th><th style="width:30%;text-align:center;border-top:1px solid black;">Customer's Signature</th><th style="width: 10%;"></th>
        </td>
        </tr>
    </tbody>
</table>
</div>









