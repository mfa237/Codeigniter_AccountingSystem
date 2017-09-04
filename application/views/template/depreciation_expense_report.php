<!DOCTYPE html>
<html>
<head>
	<title>Depreciation Expense Report</title>
	<style>
		@media print{@page {size: landscape}}
		
		body {
			font-family: 'Segoe UI', sans-serif;
			font-size: 12px;
		}
	</style>

	<script>
		(function(){
			window.print();
		})();
	</script>
</head>
<body>
	<center>
		<h3 style="text-transform: uppercase;">Depreciation Expense Report</h3>
		<h4>For the Month of <?php echo date('F Y', strtotime($_GET['y'].'-'.$_GET['m'])); ?></h4>
	</center>
	<table width="100%" border="1" cellspacing="0" cellpadding="3">
		<thead>
			<th>Asset Code</th>
			<th>Description</th>
			<th>Date Acquired</th>
			<th>Acquisition Cost</th>
			<th>Life</th>
			<th>Salvage Value</th>
			<th>Depreciation Expense (Monthly)</th>
			<th>Accumulative Depreciation</th>
			<th>Book Value</th>
		</thead>
		<tbody>
			<?php 
			$totalacquisition = 0;
			$totalsalvage = 0;
			$totaldepreciation = 0;
			$totalaccumulative = 0;
			$totalbook  = 0;
		foreach ($depreciation_expenses as $depreciation_expense) { ?>
			<tr>
				<td><?php echo $depreciation_expense->asset_code; ?></td>
				<td><?php echo $depreciation_expense->asset_description; ?></td>
				<td><?php echo date('F d,Y', strtotime($depreciation_expense->date_acquired)); ?></td>
				<td align="right"><?php echo number_format($depreciation_expense->acquisition_cost,2); ?></td>
				<td><?php echo $depreciation_expense->life_years; ?></td>
				<td align="right"><?php echo number_format($depreciation_expense->salvage_value,2); ?></td>
				<td align="right"><?php echo number_format($depreciation_expense->depreciation_expense,2); ?></td>
				<td align="right"><?php echo number_format($depreciation_expense->accu_dep,2); ?></td>
				<td align="right"><?php echo number_format($depreciation_expense->book_value,2); ?></td>
			</tr>
			<?php
			// Total ofall categories

			$totalacquisition += $depreciation_expense->acquisition_cost;
			$totalsalvage += $depreciation_expense->salvage_value ;
			$totaldepreciation += $depreciation_expense->depreciation_expense ;
			$totalaccumulative += $depreciation_expense->accu_dep ;
			$totalbook += $depreciation_expense->book_value ;


			 } ?>

			<tr>
			<td colspan="2"></td>
			<td><b>TOTAL</b></td>
			<td align="right"><b><?php  echo number_format($totalacquisition,2);  ?></b></td>
			<td></td>
			<td align="right"><b><?php echo number_format($totalsalvage,2);  ?></b> </td>
			<td align="right"><b><?php echo number_format($totaldepreciation,2);  ?> </b></td>
			<td align="right"><b><?php echo number_format($totalaccumulative,2); ?> </b></td>
			<td align="right"><b><?php echo number_format($totalbook,2);  ?> </b></td>

			</tr>
		</tbody>
	</table>
</body>
</html>