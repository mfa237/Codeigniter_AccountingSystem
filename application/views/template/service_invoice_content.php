        <style type="text/css">
    body {
            font-family: 'Calibri',sans-serif;
            font-size: 12px;
    }
    @page {
                    size: auto;   /* auto is the initial value */
                    margin: .5in .5in 1in .5in; 
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
    
    





    <table width="100%">
        <tr class="row_child_tbl_sales_order">
            <td class="bottom-only" width="10%"><img src="<?php echo $company_info->logo_path; ?>" style="height: 90px; width: 120px;  text-align: left;"></td>
            <td  class="bottom-only" width="90%" class="align-center">
                <h1 class="report-header" style="padding-left: 30px;"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p style="padding-left: 30px;"><?php echo $company_info->company_address; ?></p>
                <p style="padding-left: 30px;"> <?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>

    </table>

     <hr><br>
            
                    <p style="font-family: tahoma;font-size: 11">
                        <span >Service Invoice No : </span><b> <?php echo $service->service_invoice_no?></b></b><br /><br />
                        <span>Department :  <b><?php echo $service->department_name ?></b></span><br /><br />
                        <span>Customer Name :  <b><?php echo $service->customer_name?></b></span> <br><br />
                        <span>Invoice Date :  <b><?php echo  date_format(new DateTime($service->date_invoice ),"m/d/Y"); ?></b></span><br /><br />
                        <span>Due Date :  <b><?php echo  date_format(new DateTime($service->date_due),"m/d/Y"); ?></b></span><br /><br />
                        <span>Salesperson :  <b><?php echo $service->firstname ?> <?php echo $service->lastname ?></b></span><br><br />
                        <span>Remarks :  <b><?php echo $service->remarks ?></b></span>
                    </p>
            

<table width="95%"  style="font-family: tahoma;font-size: 11;">


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
            <?php foreach($item_info as $item){ ?>
                <tr>
                    <td width="50%" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><?php echo $item->service_desc; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->service_qty,0); ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: center;height: 30px;padding: 6px;"><?php echo $item->service_unit_name; ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->service_price,2); ?></td>
                    <td width="12%" style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><?php echo number_format($item->service_line_total,2); ?></td>
                </tr>
            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;height: 30px;padding: 6px;"></td>
                <td colspan="2" style="border-bottom: 1px solid gray;text-align: left;height: 30px;padding: 6px;"><strong>Total : </strong></td>
                <td style="border-bottom: 1px solid gray;text-align: right;height: 30px;padding: 6px;"><strong><?php echo number_format($service->total_amount,2); ?></strong></td>
            </tr>
            </tfoot>
        </table><br /><br />
    </center>




</table>
