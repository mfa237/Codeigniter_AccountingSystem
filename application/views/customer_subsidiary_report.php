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
                <h3>PERIOD : <?php echo '<strong>'.$_GET['startDate'].'</strong> to <strong>'.$_GET['endDate'].'</strong>'; ?></h3>
            </td>
        </tr>
    </table><hr>
    <div class="">
        <h3 class="report-header"><strong>CUSTOMER SUBSIDIARY REPORT</strong></h3>
    </div>
     <table width="100%" border="1" cellspacing="-1">
        <tr>
        	<td style="padding: 4px;" width="50%"><strong>Customer: </strong><?php echo $subsidiary_info->customer_name; ?></td>
        	<td style="padding: 4px;" width="50%"><strong>Account: </strong><?php echo $subsidiary_info->account_title; ?></td>
        </tr>
    </table><br>
    <table width="100%" border="1" cellspacing="-1">
    	<thead>
            <tr>
                <th style="border: 1px solid black;text-align: center;height: 30px;padding: 6px;">Txn Date</th>
                <th style="border: 1px solid black;text-align: center;height: 30px;padding: 6px;">Txn #</th>
                <th style="border: 1px solid black;text-align: left;height: 30px;padding: 6px;">Memo</th>
                <th style="border: 1px solid black;text-align: left;height: 30px;padding: 6px;">Remarks</th>
                <th style="border: 1px solid black;text-align: left;height: 30px;padding: 6px;">Posted by</th>
                <th style="border: 1px solid black;text-align: right;height: 30px;padding: 6px;">Debit</th>
                <th style="border: 1px solid black;text-align: right;height: 30px;padding: 6px;">Credit</th>
                <th style="border: 1px solid black;text-align: right;height: 30px;padding: 6px;">Balance</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach($customer_subsidiary as $items) { ?>
        	<tr>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo $items->date_txn; ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo $items->txn_no; ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo $items->memo; ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo $items->remarks; ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo $items->posted_by; ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo number_format($items->debit,2); ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo number_format($items->credit,2); ?></td>
        		<td style="border: 1px solid black;text-align: left;height: 20px;padding: 6px;"><?php echo number_format($items->balance,2); ?></td>
    		</tr>
    		<?php } ?>
        </tbody>
    </table>
</html>