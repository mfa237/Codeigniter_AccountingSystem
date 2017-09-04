<!DOCTYPE html>
<html>
<head>
	<title>Check Registry Report</title>
	<style>
		body {
			font-family: 'Segoe UI',sans-serif;
			font-size: 12px;
		}
	
		th { border-bottom:   1px solid black;
            padding: 2px 4px 2px 4px;
        }
        td{
            border-bottom: none;
            padding: 2px 4px 2px 4px;
        }

        p {
            display: inline-block;
        }
		.report-header {
			font-size: 22px;
		}
        @page {
  size: portrait;
}
@media print {
      @page { margin: 0; }
      body { margin: 1.0cm; }
}

	</style>
            <script>
        (function(){
            window.print();
        })();
    </script>

</head>
<body>
    <table  cellspacing="0" cellpadding="0">
        <tr>
            <td width="10%"><img src="<?php echo base_url($company_info->logo_path); ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%">
                <span class="report-header"><strong><?php echo $company_info->company_name; ?></strong></span><br>
                <span><?php echo $company_info->company_address; ?></span><br>
                <span><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></span>
            </td>
        </tr>
    </table><hr>
    <div>
        <h3><strong><center>Check Registry Report</center></strong></h3>
    </div>
        <div>
            <div style="float: left;">
                <b>Period Covered:</b>
                <?php echo date("m-d-Y",strtotime($start)); ?> to <?php echo date("m-d-Y",strtotime($end)); ?>
            </div>
            <div style="float: right;">
               <b> Run Date: </b>
               <?php echo date("m-d-Y");?> 
            </div>
        </div><br>
        <div>
            <strong>Bank:</strong> <?php echo (isset($report_info[0]->bank_name)) ? $report_info[0]->bank_name : ''; ?>
        </div>
  
    <table width="100%" style=" border: 1px solid black;"  cellspacing="0" >

    <thead style=" border: 1px solid black;">
    

 
        <tr style="height: 20;">
            <th style="text-align: left;">Check No.</th>
            <th style="text-align: left;">Check Date</th>
            <th  style="text-align: left;">Particular</th>
            <th style="text-align: right;">Amount</th>

        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($report_info as $report) { ?>
        <tr>
            <td style="text-align: left;"><?php echo $report->check_no; ?></td>
            <td style="text-align: left;"><?php echo $report->check_date; ?></td>
            <td style="text-align: left;"><?php echo $report->supplier_name; ?></td>
            <td style="text-align: right;"><?php echo number_format($report->amount,2); ?></td>
        </tr>
        <?php } ?>

    </tbody>
    <tr>
<?php   $total=0;
foreach ($report_info as $info) {
 
   $sum = $info->amount;
   $total += $sum;
    # code...
}
?>    

        <td></td>
        <td></td>
        <td style="text-align: right;"><b>Total:</b></td>
        <td style="border-top: 1px solid black;text-align: right;"> ₱ <?php echo number_format($total,2) ;?> </td>

    </tr>



    </table>
    			
      


  

<?php

 



?>

</body>
</html>