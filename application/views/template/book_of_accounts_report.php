<!DOCTYPE html>
<html>
<head>
	<title>T-Account - <?php echo $title; ?></title>
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

		@page { size: landscape; }
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
        <h3><strong>T-ACCOUNT (<?php echo $title; ?>) <br> Date: <u><?php echo $_GET['s']; ?></u> to <u><?php echo $_GET['e']; ?></u></strong></h3>
    </div>
    <table width="100%" border="1" cellspacing="0">
	    <thead>
	    	<th width="2%"></th>
		    <th align="left">Txn #</th>
		    <th align="left">Date</th>
		    <th align="left">Particular</th>
		    <th align="left">Remarks</th>
		    <th align="left">Account</th>
		    <th align="right">Dr</th>
		    <th align="right">Cr</th>
	    </thead>
	    <tbody>
	    <?php $sum_dr=0; ?>
	    <?php $sum_cr=0; ?>
	    <?php foreach($journal_list as $journal) { ?>
	    	<tr>
	    		<td></td>
	    		<td style="padding: 5px;"><?php echo $journal->txn_no; ?></td>
	    		<td style="padding: 5px;"><?php echo $journal->date_txn; ?></td>
	    		<td style="padding: 5px;"><?php echo $journal->description; ?></td>
	    		<td style="padding: 5px;"><?php echo $journal->remarks; ?></td>
	    		<td style="padding: 5px;"><?php echo $journal->account_title; ?></td>
	    		<td style="padding: 5px; text-align: right;"><?php echo number_format($journal->dr_amount,2); ?></td>
	    		<td style="padding: 5px; text-align: right;"><?php echo number_format($journal->cr_amount,2); ?></td>
	    		<?php $sum_dr+=$journal->dr_amount; ?>
	    		<?php $sum_cr+=$journal->cr_amount; ?>
	    	</tr>
		<?php } ?>
			<tr>
				<td colspan="6" align="right">Total:</td>
				<td style="padding: 5px;" align="right"><strong><?php echo number_format($sum_dr,2); ?></strong></td>
				<td style="padding: 5px;" align="right"><strong><?php echo number_format($sum_cr,2); ?></strong></td>
			</tr>
		</tbody>
	</table>
</body>
</html>