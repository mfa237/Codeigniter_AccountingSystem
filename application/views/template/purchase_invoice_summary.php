<!DOCTYPE html>
<html>
<head>
	<title>Purchase Invoice (Summary)</title>
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
        <h1 class="report-header" style="text-align: center;"><strong>PURCHASE INVOICE REPORT <br> (SUMMARIZED)</strong></h1>
        <p style="text-align: center;">Period <?php echo $_GET['startDate']; ?> to <?php echo $_GET['endDate']; ?></p>
    </div>
    <?php foreach ($suppliers as $supplier) {
        echo '<h2 style="text-transform: uppercase;">'.$supplier->supplier_name.'</h2><hr/>';
    ?>
    <table width="95%" style="margin-left: 5%; text-align: right;">
    	<thead>
    		<tr>
    			<td style="text-align: left;"><strong>Ref #</strong></td>
    			<td style="text-align: left;"><strong>Date</strong></td>
    			<td><strong>Invoice Amount</strong></td>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			$sum = 0;
    		 foreach ($purchase_invoice_summary as $summary) {
				if ($summary->supplier_id==$supplier->supplier_id) { ?> 
    					<tr>
    						<td style="text-align: left;"><?php echo $summary->dr_invoice_no; ?></td>
    						<td style="text-align: left;"><?php echo $summary->date_delivered; ?></td>
    						<td><?php echo number_format($summary->total_after_tax,4); ?></td>
    					</tr>		
       				<?php
       				$sum+=$summary->total_after_tax;
       			}
    		}
    		?>
    		<tr>
    			<td></td>
    			<td></td>
				<td><h2><?php echo number_format($sum,2); ?></h2></td>
			</tr>
    	</tbody>
	</table>
    <?php } ?>
</body>
</html>