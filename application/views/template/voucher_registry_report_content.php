<!DOCTYPE html>
<html>
<head>
	<title>Voucher Registry Report</title>
	<style>
		body {
			font-family: 'Segoe UI',sans-serif;
			font-size: 12px;
		}
	
		th { border-bottom:   1px solid black;

        }
        td{
            padding:0px 3px 0px 3px;
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
        <h3><strong><center>Voucher Registry</center></strong></h3>
    </div>


    <table width="100%" style=" border: 1px solid black;"   cellspacing="0">
            <p>   <strong>Period Covered:</strong>   <?php echo date("m-d-Y",strtotime($start)); ?>  to <?php echo date("m-d-Y",strtotime($end)); ?> </p>
       <p  style="float: right;"> <strong>Run Date:</strong> <?php echo date("m-d-Y");?> </p>
    <thead style=" border: 1px solid black;">
        <tr >
            <th width="10%" style="text-align: left;">CV No.</th>
            <th width="15%" style="text-align: left;">Date</th>
            <th width="25%" style="text-align: left;">Particular/ Supplier</th>
            <th width="15%" style="text-align: right;">Amount</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($vouchers as $voucher) { ?>
        <tr>
            <td><?php echo $voucher->ref_no; ?></td>
            <td><?php  echo $voucher->date_txn; ?></td>
            <td><?php echo $voucher->supplier_name; ?></td>
            <td style="text-align: right;"><?php echo number_format($voucher->amount,2); ?></td>
        </tr>
        <?php } ?>

    </tbody>
    <tfoot>



    </tfoot>
    <tr>
        <td></td>
        <td></td>
        <td><b>Total</b></td>
        <td style="border-top: 1px solid black;text-align: right;"><b><?php echo number_format($total_info->summary,2); ?></b></td>
    </tr>


    </table>
    			



  



</body>
</html>