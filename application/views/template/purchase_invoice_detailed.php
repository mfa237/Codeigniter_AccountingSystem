<!DOCTYPE html>
<html>
<head>
	<title>Purchase Invoice (Detailed)</title>
	<style type="text/css">
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

        .data {
            border-bottom: 1px solid #404040;
        }

        .align-center {
            text-align: center;
        }

        .report-header {
            font-weight: bolder;
        }

        hr {
            border-top: 1px solid #404040;
        }
        @media print {
      @page { margin: 0; }
      body { margin: 1.0cm; }
}
    </style>
    <script type="text/javascript">
    	(function(){
    		window.print();
    		setTimeout(function() {
    			//window.close();
    		}, 500);
    	})();
    </script>
</head>
<body>
	<table width="100%">
        <tr>
            <td width="10%"><img src="<?php echo base_url($company_info->logo_path); ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%" class="align-center">
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
    <div>
        <h1 class="report-header" style="text-align: center;"><strong>PURCHASE INVOICE REPORT <br> (DETAILED)</strong></h1>
        <p style="text-align: center;">Period <?php echo $_GET['startDate']; ?> to <?php echo $_GET['endDate']; ?></p>
    </div>
    <?php foreach ($invoice_numbers as $invoice_number) { ?>
		<span><strong><?php echo $invoice_number->dr_invoice_no; ?></strong></span><br><hr>


					<span style="margin-left: 50px;"><strong><?php echo $invoice_number->supplier_name; ?></strong><hr></span>
					<table width="85%" style="margin-left: 10%; text-align: right;">
						<thead>
							<tr>
								<td style="text-align: left;" width="40%"><strong>PRODUCT</strong></td>
				    			<td width="20%"><strong>UNIT COST</strong></td>
				    			<td width="10%"><strong>QTY</strong></td>
				    			<td width="30%"><strong>TOTAL NET</strong></td>
							</tr>	
						</thead>
						<tbody>
						<?php $inv_total = 0; ?>
						<?php foreach ($purchase_invoice_detailed as $detail) { ?>
							<?php if($detail->supplier_id==$invoice_number->supplier_id&&$detail->dr_invoice_id==$invoice_number->dr_invoice_id) { ?>
								<tr>
									<td style="text-align: left;"><?php echo $detail->product_desc; ?></td>
									<td><?php echo number_format($detail->dr_price,4); ?></td>
									<td><?php echo number_format($detail->dr_qty,0); ?></td>
									<td><?php echo number_format($detail->dr_line_total_price,4); ?></td>
								</tr>
                                <?php $inv_total+=$detail->dr_line_total_price; ?>
							<?php } ?>
						<?php } ?>
						</tbody>
					</table><hr>
					<table width="95%">
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td style="text-align: right;"><span style="font-size: 20px; font-weight: bolder;"><?php echo number_format($inv_total,4); ?></span></td>
						</tr>
					</table><br>


		<?php } ?>
</body>
</html>