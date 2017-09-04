<head>  <title>Purchase Invoice</title></head>
<body>
<style>
        body {
            font-family: 'Calibri',sans-serif;
            font-size: 12px;
        }
              .bottom-only{
      border:none!important;
      }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .align-center {
            text-align: center;
        }

        .report-header {
            font-weight: bolder;
        }
    tr {
/*        border: none!important;*/
    }

    tr:nth-child(even){
   /*     background: #414141 !important;*/
 /*       border: none!important;*/
    }

/*    tr:hover {
        transition: .4s;
        background: #414141 !important;
        color: white;
    }

    tr:hover .btn {
        border-color: #494949!important;
        border-radius: 0!important;
        -webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
    }*/
        table{
        border:none!important;
    }
</style>

<div>

    <table width="100%" border="0"> 
        <tr class="row_child_tbl_sales_order">
            <td class="bottom-only" width="10%"><img src="<?php echo $company_info->logo_path; ?>" style="height: 90px; width: 120px;  text-align: left;"></td>
            <td  class="bottom-only" width="90%" class="align-center">
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
    <center><table width="95%" cellpadding="5" style="font-family: tahoma;font-size: 11;" border="0">
            <tr>
                <td width="45%" valign="top" style="border: none;">
                    <span>Supplier :</span><br /><br />
                    <address>
                        <strong><?php echo $delivery_info->supplier_name; ?></strong><br>
                        <?php echo $delivery_info->address; ?><br>
                        <?php echo $delivery_info->email_address; ?><br>
                        <abbr title="Phone">P:</abbr> <?php echo $delivery_info->contact_no; ?>
                    </address>

                    <br />
                    <span>Contact Person :</span><br />
                    <strong><?php echo $delivery_info->contact_person; ?></strong><br>
                </td>

                <td width="50%" align="right" style="border: none;">
                    <h4>Purchase Invoice No.</h4>
                    <h4 class="text-navy"><?php echo $delivery_info->dr_invoice_no; ?></h4>

                    <span>Company :</span>
                    <address>
                        <strong><?php echo $company_info->company_name; ?></strong><br>
                        <strong><?php echo $company_info->company_address; ?></strong><br>
                        <abbr title="Phone">P:</abbr> <?php echo $company_info->landline; ?>
                    </address>
                    <br />

                    <p>

                        <span><strong>PO # : </strong> <?php echo  $delivery_info->po_no; ?></span><br />
                        <span><strong>Reference : </strong> <?php echo  $delivery_info->external_ref_no; ?></span><br />
                        <span><strong>Delivery Date : </strong> <?php echo  date_format(new DateTime($delivery_info->date_created),"m/d/Y"); ?></span><br />
                        <span><strong>Due Date : </strong> <?php echo  date_format(new DateTime($delivery_info->date_due),"m/d/Y"); ?></span><br />
                        <span><strong>Terms : </strong> <?php echo $delivery_info->term_description; ?></span>
                    </p>
                </td>
            </tr>
        </table></center>

    <br /><br />

    <center>
        <table width="95%" style="border-collapse: collapse;border-spacing: 0;font-family: tahoma;font-size: 11" >
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
            <?php foreach($dr_items as $item){ ?>
                <tr>
                    <td width="50%" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><?php echo $item->product_desc; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->dr_qty,0); ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: center;height: 30px;padding: 6px;"><?php echo $item->unit_name; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->dr_price,2); ?></td>

                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->dr_line_total_price,2); ?></td>
                </tr>
            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <td align="left" colspan="2"></td>
                <td colspan="2" style="padding: 6px;border-bottom: 1px solid gray;height: 30px;" align="left">Discount (%)</td>
                <td style="padding: 6px;border-bottom: 1px solid gray;height: 30px;" align="right"><strong><?php echo number_format($delivery_info->total_overall_discount,2); ?></strong></td>
            </tr>
            <tr>
                <td align="left" colspan="2"></td>
                <td colspan="2" style="padding: 6px;border-bottom: 1px solid gray;height: 30px;" align="left">Total After Discount</td>
                <td style="padding: 6px;border-bottom: 1px solid gray;height: 30px;" align="right"><strong><?php echo number_format($delivery_info->total_after_discount,2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Discount : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($delivery_info->total_discount,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Total before Tax : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($delivery_info->total_before_tax,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;">Tax Amount : </td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($delivery_info->total_tax_amount,2); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><strong>Total after Tax : </strong></td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><strong><?php echo number_format($delivery_info->total_after_tax,2); ?></strong></td>
            </tr>
            </tfoot>
        </table><br /><br />
    </center>
</div>





















