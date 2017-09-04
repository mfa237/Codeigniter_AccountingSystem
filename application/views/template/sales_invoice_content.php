<link rel="stylesheet" type="text/css" href="assets/css/style-blessed3ef7a.css">
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center" style="font-weight: 600;">EVR Vet-Options Corporation</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php if ($_GET['category'] == 1) { ?>
                    <h4 style="font-weight: 400;">SALES INVOICE</h4>
                <?php } else { ?>
                    <h4 style="font-weight: 400;">DELIVERY RECEIPT</h4>
                <?php } ?>
            </div>
        </div>
            <table class="" width="100%" style="border: 2px solid #757575">
                <tr>
                    <td class="table-cellpadding" width="15%">Sold To :</td>
                    <td class="table-cellpadding" width="30%"><strong><?php if ($_GET['category'] == 1) { echo $sales_info->customer_name; } else { echo $sales_info->department_name; }?></strong></td>
                    <td class="table-cellpadding" width="16%">OSCA/PWD ID No. :</td>
                    <td class="table-cellpadding" width="16%"></td>
                    <td class="table-cellpadding" colspan="2" width="33%">CardHolder's Signature : </td>
                </tr>
                <tr>
                    <td class="table-cellpadding" colspan="2"></td>
                    <td class="table-cellpadding">REF NO. :</td>
                    <td class="table-cellpadding"><strong><sup><?php echo $sales_info->so_no.' '.$sales_info->acr_name; ?></sup></strong></td>
                    <td class="table-cellpadding" colspan="2"></td>
                </tr>
                <tr>
                    <td class="table-cellpadding">ADDRESS :</td>
                    <td class="table-cellpadding"><strong><?php echo $sales_info->address; ?></strong></td>
                    <td class="table-cellpadding">DATE :</td>
                    <td class="table-cellpadding" colspan="3" width="16%"><strong><?php echo  date_format(new DateTime($sales_info->date_invoice),"m/d/Y"); ?></strong></td>
                </tr>
                <tr>
                    <td class="table-cellpadding">BUSINESS STYLE :</td>
                    <td class="table-cellpadding"></td>
                    <td class="table-cellpadding">TERMS :</td>
                    <td class="table-cellpadding"></td>
                    <td class="table-cellpadding" width="6%">TIN :</td>
                    <td class="table-cellpadding" width="30%"></td>
                </tr>
            </table>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="container-fluid">
        <table width="100%" cellpadding="10" class="table-border">
            <thead>
                <tr>
                    <th width="30%" class="table-cellpadding tbl-border-si tbl-center">PRODUCT</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center">QTY</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center">PACK SIZE</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center">UNIT PRICE</th>
                    <th width="30%" class="table-cellpadding tbl-border-si tbl-center">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sum = 0;
                    $item_count = 5 - count($sales_invoice_items);
                    foreach($sales_invoice_items as $item) { 
                ?>
                <tr>
                    <td width="30%" class=" tbl-border-si" style="padding: 5px;"><?php echo $item->product_desc; ?><br>
                    <sup><?php echo $item->batch_no.' '.$item->exp_date; ?></sup></td>
                    <td width="10%" class="table-cellpadding tbl-border-si tbl-center"><?php echo number_format($item->inv_qty,0); ?></td>
                    <td width="10%" class="table-cellpadding tbl-border-si tbl-center"><?php echo $item->size; ?></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-center"><?php echo number_format($item->inv_price,2); ?></td>
                    <td width="30%" class="table-cellpadding tbl-border-si tbl-center"><?php echo number_format($item->inv_line_total_price,2); ?></td>
                </tr>
                <?php
                } 
                    if ($item_count < 5) {
                        for ($i = 0; $i < $item_count; $i++) {
                            echo 
                            '<tr>
                                <td width="30%" class=" tbl-border-si" style="padding: 5px;">&nbsp;</td>
                                <td width="10%" class="table-cellpadding tbl-border-si tbl-center">&nbsp;</td>
                                <td width="10%" class="table-cellpadding tbl-border-si tbl-center">&nbsp;</td>
                                <td width="20%" class="table-cellpadding tbl-border-si tbl-center">&nbsp;</td>
                                <td width="30%" class="table-cellpadding tbl-border-si tbl-center">&nbsp;</td>
                            </tr>';
                        }
                    }
                ?>
                <tr>
                    <td class=" tbl-border-si" width="30%"></td>
                    <td class=" tbl-border-si" width="10%"></td>
                    <td class=" tbl-border-si" width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Total Sales (VAT inclusive)</td>
                    <td class=" tbl-border-si" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td class=" tbl-border-si"  width="30%"></td>
                    <td class=" tbl-border-si" width="10%"></td>
                    <td class=" tbl-border-si"  width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Less: VAT</td>
                    <td class=" tbl-border-si" align="center" width="30%"></td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding tbl-border-si tbl-right">VATable Sales</td>
                    <td class=" tbl-border-si" width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Amount: Net of VAT</td>
                    <td class=" tbl-border-si" width="30%"></td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding tbl-border-si tbl-right">VAT-Exempt Sales</td>
                    <td class=" tbl-border-si"  width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Less: SC/PWD Discount</td>
                    <td class=" tbl-border-si" width="30%"></td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding tbl-border-si tbl-right">Zero Rated Sales</td>
                    <td class=" tbl-border-si" width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Amount Due</td>
                    <td class=" tbl-border-si" align="center" style="
                    <?php if ($_GET['category'] == 1) { echo 'color: #404040;'; } else { echo 'color: transparent;'; } ?>" width="30%"><?php echo number_format($sales_info->total_before_tax,2); ?></td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding tbl-border-si tbl-right">VAT Amount</td>
                    <td class=" tbl-border-si"  width="10%"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left">Add: VAT</td>
                    <td class=" tbl-border-si" align="center" style="
                    <?php if ($_GET['category'] == 1) { echo 'color: #404040;'; } else { echo 'color: transparent;'; }?>" width="30%"><?php echo number_format($sales_info->total_tax_amount,2); ?></td>
                </tr>
                <tr>
                    <td class=" tbl-border-si"  width="50%" colspan="3"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left"><strong>TOTAL AMOUNT DUE</strong></td>
                    <td class=" tbl-border-si" align="center" width="30%"><?php echo number_format($sales_info->total_after_tax,2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="container-fluid">
        <table class="table-border" width="100%">
            <tbody>
                <tr>
                    <td width="15%"> </td>
                    <td width="15%"></td>
                    <td class="table-cellpadding" width="70%">RECEIVED the above-mentioned quantity and merchandise in good order, condition and to my/our full and complete satisfaction. I/We agree to the conditions stipulated therein.</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #404040;">&nbsp;</td>
                    <td style="border-bottom: 1px solid #404040;">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr style="text-align: center;">
                    <td class="table-cellpadding">Prepared By</td>
                    <td class="table-cellpadding">Checked By</td>
                    <td class="table-cellpadding">Customer / Authorized Representative (Print Name Over Signature / Date)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- <tr>
                   <td class="table-cellpadding table-border-si" width="10%"></td>
                   <td class="table-cellpadding table-border-si" width="10%" colspan="4">RECEIVED the above-mentioned quantity and merchandise in good order, condition and to my/our full and complete satisfaction. I/We agree to the conditions stipulated therein.</td>
                   <td class="table-cellpadding table-border-si"></td> 
                </tr>
                <tr style="text-align: center;">
                   <td class="table-cellpadding table-border-si"></td>
                   <td class="table-cellpadding table-border-si" colspan="4"><?php echo $sales_info->customer_name; ?></td>
                   <td class="table-cellpadding table-border-si"></td> 
                </tr>
                <tr style="text-align: center;">
                    <td class="table-cellpadding table-border-si">Checked By
                    </td>
                    <td class="table-cellpadding table-border-si" colspan="4">Customer / Authorized Representative (Print name over Signature / Date)</td>
                    <td class="table-cellpadding table-border-si"></td>
                </tr> -->
















<!-- <div>
    <center><table width="95%" cellpadding="5" style="font-family: tahoma;font-size: 11">
            <tr>
                <td width="45%" valign="top"><br />
                    <span>Department :</span><br />
                    <address>
                        <strong><?php echo $sales_info->department_name; ?></strong><br /><br />

                    </address>
                    <p>
                        <span>Date invoice : <br /> <b><?php echo  date_format(new DateTime($sales_info->date_invoice),"m/d/Y"); ?></b></span><br /><br />
                        <span>Date due : <br /> <b><?php echo  date_format(new DateTime($sales_info->date_due),"m/d/Y"); ?></b></span><br />
                    </p>
                    <br />
                    <span>Customer :</span><br />
                    <strong><?php echo $sales_info->customer_name; ?></strong><br>
                </td>

                <td width="50%" align="right">
                    <p>Invoice No.</p><br />
                    <h4 class="text-navy"><?php echo $sales_info->sales_inv_no; ?></h4><br />
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
            <?php foreach($sales_invoice_items as $item){ ?>
                <tr>
                    <td width="50%" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><?php echo $item->product_desc; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->inv_qty,2); ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: center;height: 30px;padding: 6px;"><?php echo $item->unit_name; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->inv_price,2); ?></td>

                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->inv_line_total_price,2); ?></td>
                </tr>
            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Discount : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($sales_info->total_discount,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Total before Tax : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($sales_info->total_before_tax,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Tax Amount : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($sales_info->total_tax_amount,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom:1px solid gray;text-align: left;height: 30px;padding: 6px;"><strong>Total after Tax : </strong></td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><strong><?php echo number_format($sales_info->total_after_tax,2); ?></strong></td>
            </tr>
            </tfoot>
        </table><br /><br />
    </center>
</div> -->





















