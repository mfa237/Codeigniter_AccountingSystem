

<div>
<center><table width="95%" cellpadding="5" style="font-family: tahoma;font-size: 11">
    <tr>
        <td width="45%" valign="top">
            <span>Supplier :</span><br /><br />
            <address>
                <strong><?php echo $purchase_info->supplier_name; ?></strong><br>
                <?php echo $purchase_info->address; ?><br>
                <?php echo $purchase_info->email_address; ?><br>
                <abbr title="Phone">P:</abbr> <?php echo $purchase_info->contact_no; ?>
            </address>

            <br />

            <span>Contact Person :</span>
            <address>
                <strong><?php echo $purchase_info->contact_person; ?></strong><br>
            </address>
        </td>

        <td width="50%" align="right">
            <h4>Purchase Order No.</h4>
            <h4 class="text-navy"><?php echo $purchase_info->po_no; ?></h4>

            <span>Company :</span>
            <address>
                <strong><?php echo $company_info->company_name; ?></strong><br>
                <strong><?php echo $company_info->company_address; ?></strong><br>
                <abbr title="Phone">P:</abbr> <?php echo $company_info->landline; ?>
            </address>
            <br />
            <span>Deliver to :</span>
            <address>
                <strong><?php echo $purchase_info->deliver_to_address; ?></strong><br>
            </address>
            <p>
                <span><strong>Order Date : </strong> <?php echo  date_format(new DateTime($purchase_info->date_created),"m/d/Y"); ?></span><br />
                <span><strong>Terms : </strong> <?php echo $purchase_info->term_description; ?></span>
            </p>
        </td>
    </tr>
</table></center>

<br /><br />

<center>
    <table width="95%" style="border-collapse: collapse;border-spacing: 0;font-family: tahoma;font-size: 11">
        <thead>
            <tr>
                <th width="50%" style="border-bottom: 2px solid gray;text-align: left;height: 30px;padding: 6px;">Item</th>
                <th width="12%" style="border-bottom: 2px solid gray;text-align: right;height: 30px;padding: 6px;">Qty</th>
                <th width="12%" style="border-bottom: 2px solid gray;text-align: center;height: 30px;padding: 6px;">UM</th>
                <th width="12%" style="border-bottom: 2px solid gray;text-align: right;height: 30px;padding: 6px;">Price</th>
                <th width="12%" style="border-bottom: 2px solid gray;text-align: right;height: 30px;padding: 6px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($po_items as $item){ ?>
                <tr>
                    <td width="50%" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><?php echo $item->product_desc; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->po_qty,0); ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: center;height: 30px;padding: 6px;"><?php echo $item->unit_name; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->po_price,2); ?></td>

                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->po_line_total,2); ?></td>
                </tr>
            <?php } ?>

        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
            <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Discount : </td>
            <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($purchase_info->total_discount,2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
            <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Total before Tax : </td>
            <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($purchase_info->total_before_tax,2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
            <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Tax Amount : </td>
            <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($purchase_info->total_tax_amount,2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
            <td colspan="2" style="border-bottom:1px solid gray;text-align: left;height: 30px;padding: 6px;"><strong>Total after Tax : </strong></td>
            <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><strong><?php echo number_format($purchase_info->total_after_tax,2); ?></strong></td>
        </tr>
        </tfoot>
    </table><br /><br />
</center>
</div>





















