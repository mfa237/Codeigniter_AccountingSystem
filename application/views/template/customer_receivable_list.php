<table style="font-family: 'Century Gothic', sans-serif;">
	<tr>
		<td colspan="7"><strong>PER SALES</strong></td>
	</tr>
	<?php foreach($receivables as $item){ ?>
		<?php if ($item->is_sales == '1') { ?>
	    <tr>
	        <td><?php echo $item->sales_inv_no; ?></td>
	        <td><?php echo $item->date_due; ?></td>
	        <td><?php echo $item->remarks; ?></td>
	        <td align="right"><input type="text" name="receivable_amount[]" style="text-align: right;" class="form-control" value="<?php echo number_format($item->net_receivable,2); ?>" readonly></td>
	        <td><input type="text" name="payment_amount[]" class="numeric form-control" /><input type="hidden" name="sales_invoice_id[]" value="<?php echo $item->sales_invoice_id; ?>"></td>
	        <td align="center"><button type="button" class="btn btn-success btn_set_amount"><i class="fa fa-check"></i></button></td>
	        <td class="hidden"><input type="hidden" name="is_sales[]" value="<?php echo $item->is_sales; ?>" /></td>
	    </tr>
	    <?php } ?>
	<?php } ?>
	<tr>
		<td colspan="7"><strong>PER SERVICES</strong></td>
	</tr>
	<?php foreach($receivables as $item){ ?>
		<?php if ($item->is_sales == '0') { ?>
	    <tr>
	        <td><?php echo $item->sales_inv_no; ?></td>
	        <td><?php echo $item->date_due; ?></td>
	        <td><?php echo $item->remarks; ?></td>
	        <td align="right"><input type="text" name="receivable_amount[]" style="text-align: right;" class="form-control" value="<?php echo number_format($item->net_receivable,2); ?>" readonly></td>
	        <td><input type="text" name="payment_amount[]" class="numeric form-control" /><input type="hidden" name="sales_invoice_id[]" value="<?php echo $item->sales_invoice_id; ?>"></td>
	        <td align="center"><button type="button" class="btn btn-success btn_set_amount"><i class="fa fa-check"></i></button></td>
	        <td class="hidden"><input type="hidden" name="is_sales[]" value="<?php echo $item->is_sales; ?>" /></td>
	    </tr>
	    <?php } ?>
	<?php } ?>
</table>