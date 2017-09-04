<!DOCTYPE html>
<html>
<head>
    <title>Customer Subsidiary Report</title>
    <style type="text/css">
        body {
            font-family: 'Calibri',sans-serif;
            font-size: 12px;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .data {
            border-bottom: 1px solid #404040;
        }

        .align-center {
            text-align: center;
        }

        .report-header {
            font-size: 10pt;
            font-weight: bolder;
        }

        hr {
            border-top: 3px solid #404040;
        }
    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td width="5%"><img src="<?php echo $company_info->logo_path; ?>" style="height: 90px; width: 120px; text-align: left;"></td>
        <td width="95%" class="align-center">
            <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
            <p><?php echo $company_info->company_address; ?></p>
            <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p><br>
            <p>As of Date <?php echo $date; ?></p><br>
            <center></center><h3 class="report-header"><strong>Accounts Payable Schedule</strong></h3></center>
        </td>
    </tr>
</table>

<br /><br />

<table width="100%" border="1" cellspacing="-1">
    <thead>
    <tr>
        <th width="50%" style="border: 1px solid black;padding: 3px;text-align: left;padding-left: 5px;">Customer</th>
        <th width="15%" style="border: 1px solid black;padding: 3px;text-align: right;padding-right: 5px;">Previous</th>
        <th width="15%" style="border: 1px solid black;padding: 3px;text-align: right;padding-right: 5px;">This Month</th>
        <th width="15%" style="border: 1px solid black;padding: 3px;text-align: right;padding-right: 5px;">Total</th>
    </tr>
    </thead>
    <tbody>
    <?php $total=0.00; foreach($ar_accounts as $ar){ ?>
        <tr>
            <td  style="padding-left: 5px;"><?php echo $ar->supplier_name; ?></td>
            <td align="right" style="padding-right: 5px;"><?php echo number_format($ar->previous,2); ?></td>
            <td align="right" style="padding-right: 5px;"><?php echo number_format($ar->current,2); ?></td>
            <td align="right" style="padding-right: 5px;"><?php echo number_format($ar->total,2); ?></td>
        </tr>
        <?php $total+=$ar->total; } ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3" align="right"><b>Total : </b></td>
        <td align="right" style="padding-right: 5px;"><b><?php echo number_format($total,2); ?></b></td>
    </tfoot>
</table>
</html>