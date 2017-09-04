<!DOCTYPE html>
<html>
<head>
	<title>Comparative Income Statement</title>
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
            border-top: 1px solid #404040;
        }
        @media print {
              @page { margin: 0; }
              body { margin: 1.0cm; }
        }
        @media print {
			body {-webkit-print-color-adjust: exact;}
		}
    </style>
    <script>
    	(function(){
            window.print();
            setTimeout(function() {
                 //window.close();
             }, 500);
        })();
    </script>
</head>
<body>
	<table width="100%">
        <tr>
            <td width="10%"><img src="<?php echo base_url().$company_info->logo_path; ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%" class="align-center">
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
    <div>
        <h1 class="report-header" style="text-align: center;"><strong>COMPARATIVE INCOME STATEMENT</strong></h1>
    </div>
	<table width="100%" border="1" cellspacing="0">
        <thead>
            <th width="20%"></th>
            <th><center>Previous Month <br>(<?php echo date("F Y", strtotime("first day of previous month"));  ?>)</center></th>
            <th><center>Current Month <br>(<?php echo date("F Y");  ?>)</center></th>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="background: #5a5a5a;"><strong style="color: white;">INCOME</strong></td>
            </tr>
            <?php $sum_inc_prev=0; ?>
            <?php $sum_inc_cur=0; ?>
            <?php foreach($income_accounts as $income_account) { ?>
            <tr>
                <td style="text-transform: uppercase;"><?php echo $income_account->account_title; ?></td>
                <td align="right"><?php echo number_format($income_account->core_prev_balance,2); ?></td>
                <td align="right"><?php echo number_format($income_account->core_cur_balance,2); ?></td>
                <?php $sum_inc_prev+=$income_account->core_prev_balance; ?>
                <?php $sum_inc_cur+=$income_account->core_cur_balance; ?>
            </tr>
            <?php } ?>
            <tr>
                <td align="right">Total Income:</td>
                <td align="right"><?php echo number_format($sum_inc_prev,2); ?></td>
                <td align="right"><?php echo number_format($sum_inc_cur,2); ?></td>
            </tr><br>
            <tr>
                <td colspan="3" style="background: #5a5a5a;"><strong style="color: white;">EXPENSES</strong></td>
            </tr>
            
            <?php $sum_exp_prev=0; ?>
            <?php $sum_exp_cur=0; ?>
            <?php foreach($expense_accounts as $expense_account) { ?>
            <tr>
                <td style="text-transform: uppercase;"><?php echo $expense_account->account_title; ?></td>
                <td align="right"><?php echo number_format($expense_account->core_prev_balance,2); ?></td>
                <td align="right"><?php echo number_format($expense_account->core_cur_balance,2); ?></td>
                <?php
                    $sum_exp_prev+=$expense_account->core_prev_balance;
                    $sum_exp_cur+=$expense_account->core_cur_balance;
                ?>
            </tr>
            <?php } ?>
            <tr>
                <td align="right">Total Expenses:</td>
                <td align="right"><?php echo number_format($sum_exp_prev,2); ?></td>
                <td align="right"><?php echo number_format($sum_exp_cur,2); ?></td>
            </tr>
            <tr>
                <td align="right"><strong style="font-size: 16px;">Net Income :</strong></td>
                <td align="right"><strong style="font-size: 16px;"><?php echo number_format($sum_inc_prev - $sum_exp_prev,2); ?></strong></td>
                <td align="right"><strong style="font-size: 16px;"><?php echo number_format($sum_inc_cur - $sum_exp_cur,2); ?></strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>