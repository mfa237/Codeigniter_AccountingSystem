
    <?php foreach($payables as $item){ ?>
        <tr>
            <td><?php echo $item->dr_invoice_no; ?></td>
            <td><?php echo $item->date_due; ?></td>
            <td><?php echo $item->term_description; ?></td>
            <td><?php echo $item->remarks; ?></td>
            <td align="right"><input type="text" name="payable_amount[]" style="text-align: right;" class="form-control" value="<?php echo number_format($item->net_payable,2); ?>" readonly></td>
            <td><input type="text" name="payment_amount[]" class="numeric form-control" /><input type="hidden" name="dr_invoice_id[]" value="<?php echo $item->dr_invoice_id; ?>"></td>
            <td align="center"><button type="button" class="btn btn-success btn_set_amount"><i class="fa fa-check"></i></button></td>
        </tr>
    <?php } ?>
