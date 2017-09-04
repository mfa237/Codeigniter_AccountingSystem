<!DOCTYPE html>
<html>
<head>
	<title>Salesperson Sales Report (Detailed)</title>
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
            <td width="90%" class="align-center">
                <span class="report-header"><strong><?php echo $company_info->company_name; ?></strong></span><br>
                <span><?php echo $company_info->company_address; ?></span><br>
                <span><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></span>
            </td>
        </tr>
    </table><hr>
    <div class="">
        <h3><strong>SALES REPORT PER SALESPERSON (DETAILED)</strong></h3>
    </div>
    <?php foreach($salespersons as $salesperson) { ?>
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
			<tr>
				<td colspan="7">
					<span style="font-size: 14px;"><strong><?php echo $salesperson->salesperson_name; ?></strong></span>
				</td>
			</tr>
			<tr>
				<td width="10%"><strong>Invoice #</strong></td>
				<td width="5%"><strong>Date</strong></td>
				<td width="5%" align="right"><strong>Unit Amount</strong></td>
				<td width="5%" align="center"><strong>Qty</strong></td>
				<td width="5%" align="right"><strong>Total Amount</strong></td>
				</tr>
			<?php $sum=0; ?>
			<?php foreach($sales_details as $sales_detail) { ?>
				<?php if ($salesperson->salesperson_id == $sales_detail->salesperson_id) { ?>
					<tr>
						<td width="10%"><?php echo $sales_detail->sales_inv_no; ?></td>
						<td width="5%"><?php echo date('Y-m-d', strtotime($sales_detail->date_invoice)); ?></td>
						<td width="5%" align="right"><?php echo number_format($sales_detail->sale_price,2); ?></td>
						<td width="5%" align="center"><?php echo $sales_detail->inv_qty; ?></td>
						<td width="5%" align="right"><?php echo number_format($sales_detail->total_amount,2); ?></td>
					</tr>
					<?php $sum+=$sales_detail->total_amount; ?>
				<?php } ?>
			<?php } ?>
			<tr>
				<td align="right" colspan="4"><strong>Total :</strong></td>
				<td align="right"><strong><?php echo number_format($sum,2) ?></strong></td>
			</tr>
		</table>
	<?php } ?>
</body>
</html>