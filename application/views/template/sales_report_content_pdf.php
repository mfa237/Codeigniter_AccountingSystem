<body style="font-family: 'Roboto', sans-serif; color: #404040; font-weight: 200;">
	<tr>
		<h1 style="font-weight: 200;">Sales Report</h1>
		<p>Date : <?php if (isset($_GET['start'])) {
		echo '<b>'. $_GET['start'] .'</b>';
		} ?> - <?php if (isset($_GET['end'])) {
		echo '<b>'. $_GET['end'] .'</b>';
		} ?></p>
	</tr>
	<table width="100%" cellspacing="0">
		<thead>
			<tr>
				<th style="border-bottom: 2px solid #404040;" width="15%">Invoice Date</th>
				<th style="border-bottom: 2px solid #404040;" width="20%">Sales Invoice #</th>
				<th style="border-bottom: 2px solid #404040;" width="25%">SO #</th>
				<th style="border-bottom: 2px solid #404040;" width="30%">Customer</th>
				<th style="border-bottom: 2px solid #404040;" width="10%">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($sales_report as $item) { ?>
				<tr>
					<td width="15%" align="center"><?php echo $item->date_invoice; ?></td>
					<td width="20%" align="center"><?php echo $item->sales_inv_no; ?></td>
					<td width="25%" align="right"><?php echo $item->sales_order_no; ?></td>
					<td width="30%" align="center"><?php echo $item->customer_name; ?></td>
					<td width="10%" align="right"><?php echo number_format($item->inv_line_total_price,2); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div align="right" style="padding-right: 20px;">
		Grand Total : <b>
		<?php 
			$sum = 0;
			foreach($sales_report as $item) {
				$total = $item->inv_line_total_price;
				$sum += $total;
			}
			echo number_format($sum,2);
		?>
		</b>
	</div>
</body>


		
		
		
		
		