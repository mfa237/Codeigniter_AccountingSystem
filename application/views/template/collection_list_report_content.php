<!DOCTYPE html>
<html>
<head>
	<title>Collection List Report</title>
	<style>
		body {
			font-family: 'Segoe UI',sans-serif;
			font-size: 12px;
		}
	
		th { border-bottom:   1px solid black;
            padding: 0px 3px 0px 3px;
        }
        td{
            padding: 0px 3px 0px 3px;
            border-bottom: none;
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
        <h3><strong><center>Collection List Report</center></strong></h3>
    </div>


    <table width="100%" style=" border: 1px solid black;"  cellspacing="0" >
            <p>   <strong>Period Covered:</strong>

            <?php echo date("m-d-Y",strtotime($start)); ?> to <?php echo date("m-d-Y",strtotime($end)); ?></p>
       <p  style="float: right;"> <strong>Run Date:</strong> <?php echo date("m-d-Y");?> </p>
    <thead style=" border: 1px solid black;">
    

 
        <tr style="height: 20;">
            <th >Reference No.</th>
            <th >Date</th>
            <th >Customer Name</th>
            <th style="text-align: right;">Pay Type<br>Cash</th>
            <th style="text-align: right;"> <br> Check </th>
            <th style="text-align: right;"><br>Credit </th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($report_info as $report) { ?>
        <tr>
            <td><?php echo $report->receipt_no; ?></td>
            <td style="text-align: center;" ><?php echo $report->date_paid; ?></td>
            <td><?php echo $report->customer_name; ?></td>
            <td style="text-align: right;"><?php echo number_format($report->cash_amount,2); ?></td>
              <td style="text-align: right;"><?php echo number_format($report->check_amount,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($report->card_amount,2); ?></td>
        </tr>
        <?php } ?>

    </tbody>
    <tfoot>



    </tfoot>
    <tr>

      <?php 
        $cash_amount=0;
        $check_amount=0;
        $card_amount=0;

        foreach ($report_info as $report) {
            $cash=$report->cash_amount;
            $check=$report->check_amount;
            $card=$report->card_amount;

            // Sum of every Pay Type
            $cash_amount += $cash;
            $check_amount += $check;
            $card_amount += $card_amount;
        
        }
       
    ?>

        <td></td>
        <td></td>
        <td></td>
        <td style="border-top: 1px solid black;text-align: right;"><b><?php echo number_format( $cash_amount,2); ?><b></td>
        <td style="border-top: 1px solid black;text-align: right;"><b><?php echo number_format($check_amount,2); ?><b></td>
        <td style="border-top: 1px solid black;text-align: right;"><b><?php  echo number_format($card_amount,2); ?><b></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right;"><b>Total</b></td>
        <td colspan="3" style="text-align:center;"><b><?php   
        $total_amount= $cash_amount + $check_amount +$card_amount;
        echo number_format($total_amount,2); ?> </b>
        </td>
    </tr>


    </table>
    			
      


  

<?php

 



?>

</body>
</html>