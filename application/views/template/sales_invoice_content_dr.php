<link rel="stylesheet" type="text/css" href="assets/css/style-blessed3ef7a.css">
<style type="text/css">
    html {
        font-family: 'Calibri', sans-serif;
    }
</style>
<script type="text/javascript">
    window.print();
</script>
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="text-center" style="font-weight: 600;"><center>EVR Vet-Options Corporation</center></h3>
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
            <table class="" width="100%" border="1" cellspacing="0">
                <tr>
                    <td class="table-cellpadding" width="10%">Sold to :</td>
                    <td class="table-cellpadding" width="40%">&nbsp;<?php echo $sales_info->department_name; ?></td>
                    <td class="table-cellpadding" width="10%">Date :</td>
                    <td class="table-cellpadding" width="10%">&nbsp;<?php echo  date_format(new DateTime($sales_info->date_invoice),"m/d/Y"); ?>&nbsp;</td>
                    <td class="table-cellpadding" width="10%">&nbsp;Ref. # :</td>
                    <td class="table-cellpadding" width="20%">&nbsp;<?php echo $sales_info->remarks; ?></td>
                </tr>
                <tr>
                    <td class="table-cellpadding" width="10%">Address :</td>
                    <td class="table-cellpadding" colspan="5" width="90%">&nbsp;<?php echo $sales_info->address; ?></td>
                </tr>
               <!--  <tr>
                    <td class="table-cellpadding" width="15%" style="font-size: 12px;">Sold To :</td>
                    <td class="table-cellpadding" width="30%" style="font-size: 12px;"><strong><?php echo $sales_info->customer_name; ?></strong></td>
                    <td class="table-cellpadding" width="16%" style="font-size: 12px;">&nbsp;</td>
                    <td class="table-cellpadding" width="16%"></td>
                    <td class="table-cellpadding" colspan="2" style="font-size: 12px;" width="33%">&nbsp;</td>
                </tr>
                <tr>
                    <td class="table-cellpadding" colspan="2"></td>
                    <td class="table-cellpadding" style="font-size: 12px;">REF NO. :</td>
                    <td class="table-cellpadding" style="font-size: 12px;"><strong><sup><?php echo $sales_info->so_no.' '.$sales_info->acr_name; ?></sup></strong></td>
                    <td class="table-cellpadding" colspan="2"></td>
                </tr>
                <tr>
                    <td class="" style="font-size: 12px;">ADDRESS :</td>
                    <td class="table-cellpadding" style="font-size: 12px;"><strong><?php echo $sales_info->address; ?></strong></td>
                    <td class="table-cellpadding" style="font-size: 12px;">DATE :</td>
                    <td class="table-cellpadding" style="font-size: 12px;" colspan="3" width="16%"><strong><?php echo  date_format(new DateTime($sales_info->date_invoice),"m/d/Y"); ?></strong></td>
                </tr>
                <tr>
                    <td class="table-cellpadding" style="font-size: 12px;">BUSINESS STYLE :</td>
                    <td class="table-cellpadding"></td>
                    <td class="table-cellpadding" style="font-size: 12px;">TERMS :</td>
                    <td class="table-cellpadding"></td>
                    <td class="table-cellpadding" style="font-size: 12px;" width="6%">TIN :</td>
                    <td class="table-cellpadding" style="font-size: 12px;" width="30%"></td>
                </tr> -->
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="container-fluid">
        <table width="100%" cellpadding="10" cellspacing="0" class="table-border" border="1">
            <thead>
                <tr>
                    <th width="30%" class="table-cellpadding tbl-border-si tbl-center" style="padding: 0;">PRODUCT</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center" style="padding: 0;">QTY</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center" style="padding: 0;">PACK SIZE</th>
                    <th width="10%" class="table-cellpadding tbl-border-si tbl-center" style="padding: 0;">UNIT PRICE</th>
                    <th width="30%" class="table-cellpadding tbl-border-si tbl-center" style="padding: 0;">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sum = 0;
                    $item_count = 5 - count($sales_invoice_items);
                    foreach($sales_invoice_items as $item) { 
                ?>
                <tr>
                    <td width="30%" class=" tbl-border-si" style="font-size: 13px;font-family: 'Times New Roman', serif; font-weight: 200; padding: 2px;"><?php echo $item->product_desc; ?><br>
                    <sup><?php echo $item->batch_no.' '.$item->exp_date; ?></sup></td>
                    <td width="10%" class="table-cellpadding tbl-border-si tbl-center"  style="font-size: 15px;font-family: 'Times New Roman', serif; font-weight: 200;"><center><?php echo number_format($item->inv_qty,0); ?></center></td>
                    <td width="10%" class="table-cellpadding tbl-border-si tbl-center" style="font-size: 15px;font-family: 'Times New Roman', serif; font-weight: 200;"><center><?php echo $item->size; ?></center></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-center"  style="font-size: 15px;font-family: 'Times New Roman', serif; font-weight: 200;"><center><?php echo number_format($item->inv_price,2); ?></center></td>
                    <td width="30%" class="table-cellpadding tbl-border-si tbl-center"  style="font-size: 15px;font-family: 'Times New Roman', serif; font-weight: 200;"><center><?php echo number_format($item->inv_line_total_price,2); ?></center></td>
                </tr>
                <?php
                } 
                    
                ?>
                
                <tr>
                    <td class=" tbl-border-si"  width="50%" colspan="3"></td>
                    <td width="20%" class="table-cellpadding tbl-border-si tbl-left" style="font-size:12px;"><strong>TOTAL AMOUNT DUE</strong></td>
                    <td class=" tbl-border-si" align="center" width="30%"><?php echo number_format($sales_info->total_after_tax,2); ?></td>
                </tr>
                <tr>
                    <td class="" width="50%"></td>
                    <td class="" colspan="4" width="50%"></td>
                </tr>
                <tr>
                    <td style="padding: 0;" width="50%"><center>Prepared by</center></td>
                    <td style="padding: 0;" colspan="4" width="50%"><center>Received by</center></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- <div class="row">
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
</div> -->

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





















