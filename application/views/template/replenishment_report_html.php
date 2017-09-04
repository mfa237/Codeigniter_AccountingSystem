<!DOCTYPE html>
<html>
<head>
	<title>Replenishment Report</title>
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
        <h3><strong>REPLENISHMENT REPORT <br> as of <?php echo $_GET['aod']; ?></strong></h3>
    </div>
    <?php foreach($batches as $batch) { ?>
    			
    <table width="100%" cellpadding="3" cellspacing="0" border="1">
    	<thead>
    		<tr>
				<td colspan="4"><strong>BATCH # : </strong><?php echo $batch->batch_no; ?></strong></td>
			</tr>
    		<th width="25%" align="left">Document # / PCV #</th>
    		<th width="25%" align="left">Particular</th>
    		<th width="25%" align="left">Remarks</th>
    		<th width="25%" align="right">Amount</th>
    	</thead>
    	<tbody>
    		<?php 
	    		$sum_replenish_amount=0;
    		?>
    		<?php foreach($replenishments as $replenishment) { ?>
    			<?php if ($batch->batch_id == $replenishment->batch_id) { ?>
    			<tr>
    				<td width="25%"><?php echo $replenishment->txn_no; ?></td>
    				<td width="25%" align="left"><?php echo $replenishment->supplier_name; ?></td>
    				<td width="25%" align="left"><?php echo $replenishment->remarks; ?></td>
    				<td width="25%" align="right"><?php echo number_format($replenishment->amount,2); ?></td>
    			</tr>
    			<?php 
    				$sum_replenish_amount += $replenishment->amount; 
    			?>
    			<?php } ?>
    		<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td width="25%" align="right"><strong>TOTAL :</strong></td>
				<td width="25%" align="right"><?php echo number_format($sum_replenish_amount,2) ?></td>
			</tr>
    	</tbody>
    </table>

	<?php } ?>
</body>
</html>