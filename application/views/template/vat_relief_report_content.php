<!DOCTYPE html>
<html>
<head>
	<title>VAT Relief Report</title>
	<style>
		body {
			font-family: 'Segoe UI',sans-serif;
			font-size: 12px;
		}
		table, th, td { border-color: white; }
		tr { border-bottom: none !important; }

		.report-header {
			font-size: 22px;
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
	<table width="100%">
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
        <h3><strong>VAT RELIEF REPORT</strong></h3>
    </div>
    <?php foreach($suppliers as $supplier) { ?>
    			
    <table width="100%" cellpadding="3" cellspacing="0" border="1">
    	<thead>
    		<tr>
				<td colspan="2"><strong>SUPPLIER : </strong><?php echo $supplier->supplier_name; ?></strong></td>
				<td colspan="2"><strong> TIN # :</strong> <?php echo $supplier->tin_no; ?></strong></td>
			</tr>
    		<th width="25%" align="left">Invoice / OR #</th>
    		<th width="25%" align="right">Invoice Amount</th>
    		<th width="25%" align="right">VAT Input</th>
    		<th width="25%" align="right">Net of VAT</th>
    	</thead>
    	<tbody>
    		<?php 
	    		$sum_invoice_amt=0; 
	    		$sum_vat_input=0;
	    		$sum_net_vat=0; 
    		?>
    		<?php foreach($vat_reliefs as $vat_relief) { ?>
    			<?php if ($supplier->supplier_id == $vat_relief->supplier_id) { ?>
    			<tr>
    				<td width="25%"><?php echo $vat_relief->dr_invoice_no; ?></td>
    				<td width="25%" align="right"><?php echo number_format($vat_relief->total_after_tax,2); ?></td>
    				<td width="25%" align="right"><?php echo number_format($vat_relief->total_tax_amount,2); ?></td>
    				<td width="25%" align="right"><?php echo number_format($vat_relief->net_of_vat,2); ?></td>
    			</tr>
    			<?php 
    				$sum_invoice_amt += $vat_relief->total_after_tax; 
    				$sum_vat_input += $vat_relief->total_tax_amount;
    				$sum_net_vat += $vat_relief->net_of_vat;
    			?>
    			<?php } ?>
    		<?php } ?>
			<tr>
				<td width="25%"><strong>TOTAL :</strong></td>
				<td width="25%" align="right"><?php echo number_format($sum_invoice_amt,2) ?></td>
				<td width="25%" align="right"><?php echo number_format($sum_vat_input,2) ?></td>
				<td width="25%" align="right"><?php echo number_format($sum_net_vat,2) ?></td>
			</tr>
    	</tbody>
    </table>

	<?php } ?>
</body>
</html>