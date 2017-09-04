<link rel="stylesheet" type="text/css" href="assets/css/style-blessed3ef7a.css">

<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center" style="font-weight: 600;"><!-- EVR Vet-Options Corporation --></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h4 style="font-weight: 800;"><!-- SALES INVOICE --></h4>
            </div>
        </div>
            <br>
            <br>
            <br>
            <br>
            <table class="" width="100%" style="">
                <tr>
                    <td class="table-cellpadding " width="10%"><!-- SOLD To : -->&nbsp;</td>
                    <td class="" width="40%"><?php echo $sales_info->customer_name; ?></td>
                    <td class="table-cellpadding " width="16%"><!-- OSCA/PWD ID No. : -->&nbsp;</td>
                    <td class="table-cellpadding " width="16%">&nbsp;</td>
                    <td class="table-cellpadding " colspan="2" width="33%"><!-- CardHolder's Signature :  -->&nbsp;</td>
                </tr>
                <tr>
                    <td class="table-cellpadding" colspan="2"></td>
                    <td class="table-cellpadding"><!-- REF NO. : -->&nbsp;</td>
                    <td class="" colspan="3" style="padding-left: 100;" ><?php echo $sales_info->so_no.' '.$sales_info->acr_name; ?></td>
                    <td class="table-cellpadding" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td class="table-cellpadding "><!-- ADDRESS : -->&nbsp;</td>
                    <td class=""><?php echo $sales_info->address; ?></td>
                    <td class="table-cellpadding "><!-- DATE : -->&nbsp;</td>
                    <td class="" colspan="3" style="padding-left: 100;" width="16%"><?php echo  date_format(new DateTime($sales_info->date_invoice),"m/d/Y"); ?></td>
                </tr>
                <tr>
                    <td class="table-cellpadding "><!-- BUSINESS STYLE : -->&nbsp;</td>
                    <td class="table-cellpadding ">&nbsp;</td>
                    <td class="table-cellpadding "><!-- TERMS : -->&nbsp;</td>
                    <td class="table-cellpadding ">&nbsp;</td>
                    <td class="table-cellpadding " width="6%"><!-- TIN : -->&nbsp;</td>
                    <td class="table-cellpadding " width="30%">&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="container-fluid">
        <table width="100%" cellpadding="">
            <thead>
                <tr>
                    <th width="40%" class="table-cellpadding tbl-center"><!-- PRODUCT -->&nbsp;</th>
                    <th width="10%" class="table-cellpadding tbl-center"><!-- QTY -->&nbsp;</th>
                    <th width="10%" class="table-cellpadding tbl-center"><!-- PACK SIZE -->&nbsp;</th>
                    <th width="10%" class="table-cellpadding tbl-center"><!-- UNIT PRICE -->&nbsp;</th>
                    <th width="30%" class="table-cellpadding tbl-center"><!-- AMOUNT -->&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $item_count = 5 - count($sales_invoice_items);
                    foreach($sales_invoice_items as $item) { 
                ?>
                <tr>
                    <td width="30%" class=" " style="padding: 5px;"><?php echo $item->product_desc; ?><br>
                    <sup><?php echo $item->batch_no.' '.$item->exp_date; ?></sup></td>
                    <td width="10%" class="tbl-center"><?php echo number_format($item->inv_qty,0); ?></td>
                    <td width="10%" class="tbl-center"><?php echo $item->size; ?></td>
                    <td width="20%" class="tbl-center"><?php echo number_format($item->inv_price,2); ?></td>
                    <td width="30%" class="tbl-center"><?php echo number_format($item->inv_line_total_price,2); ?></td>
                </tr>
                <?php 
                    $total = $item->inv_line_total_price;
                    $sum += $total;
                } 
                    if ($item_count < 5) {
                        for ($i = 0; $i < $item_count; $i++) {
                            echo 
                            '<tr>
                                <td width="30%" class=" " style="padding: 5px;">&nbsp;</td>
                                <td width="10%" class="table-cellpadding tbl-center">&nbsp;</td>
                                <td width="10%" class="table-cellpadding tbl-center">&nbsp;</td>
                                <td width="20%" class="table-cellpadding tbl-center">&nbsp;</td>
                                <td width="30%" class="table-cellpadding tbl-center">&nbsp;</td>
                            </tr>';
                        }
                } ?>
                 <tr>
                    <td class="" width="30%">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left">&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td class="" width="30%">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Total Sales (VAT inclusive)  -->&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td class=""  width="30%">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td class=""  width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Less: VAT -->&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding  tbl-right"><!-- VATable Sales -->&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Amount: Net of VAT -->&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding  tbl-right"><!-- VAT-Exempt Sales -->&nbsp;</td>
                    <td class=""  width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Less: SC/PWD Discount -->&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding  tbl-right">&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding tbl-left">&nbsp;</td>
                    <td class="" align="center" width="30%">&nbsp;</td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding  tbl-right"><!-- Zero Rated Sales -->&nbsp;</td>
                    <td class="" width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Amount Due -->&nbsp;</td>
                    <td class="" align="center" width="30%"><?php echo number_format($sales_info->total_before_tax,2); ?></td>
                </tr>
                <tr>
                    <td width="40%" colspan="2" class="table-cellpadding  tbl-right"><!-- VAT Amount -->&nbsp;</td>
                    <td class=""  width="10%">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><!-- Add: VAT -->&nbsp;</td>
                    <td class="" align="center" width="30%"><?php echo number_format($sales_info->total_tax_amount,2); ?></td>
                </tr>
                <tr>
                    <td class=""  width="50%" colspan="3">&nbsp;</td>
                    <td width="20%" class="table-cellpadding  tbl-left"><strong><!-- TOTAL AMOUNT DUE -->&nbsp;</strong></td>
                    <td class="" align="center" width="30%"><strong><?php echo number_format($sales_info->total_after_tax,2); ?></strong></td>
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
                    <td class="table-cellpadding" width="70%"><!-- RECEIVED the above-mentioned quantity and merchandise in good order, condition and to my/our full and complete satisfaction. I/We agree to the conditions stipulated therein. --> &nbsp;</td>
                </tr>
                <tr>
                    <!-- <td style="border-bottom: 1px solid #404040;">&nbsp;</td>
                    <td style="border-bottom: 1px solid #404040;">&nbsp;</td> -->
                    <td>&nbsp;</td>
                </tr>
                <tr style="text-align: center;">
                    <td class="table-cellpadding"><!-- Prepared By --></td>
                    <td class="table-cellpadding"><!-- Checked By --></td>
                    <td class="table-cellpadding"><!-- Customer / Authorized Representative (Print Name Over Signature / Date) --></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
















