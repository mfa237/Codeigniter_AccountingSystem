<div>
	<table width="100%" class="table table-striped table-bordered">
		<thead class="table-erp">
			<tr>
				<th width="15%">Date</th>
				<th width="20%">Sales Invoice #</th>
				<th width="25%">SO #</th>
				<th width="30%">Customer</th>
				<th width="10%">Total</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($sales_report as $item) { ?>
				<tr>
					<td><?php echo $item->date_invoice; ?></td>
					<td><?php echo $item->sales_inv_no; ?></td>
					<td><?php echo $item->sales_order_no; ?></td>
					<td><?php echo $item->customer_name; ?></td>
					<td><?php echo number_format($item->inv_line_total_price,2); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div align="right" style="">
	Grand Total : <b>
	<?php 
		$sum = 0;
		foreach($sales_report as $item) {
			$total = $item->inv_line_total_price;
			$sum += $total;
		}
		echo number_format($sum,2);
	?></b>
</div>