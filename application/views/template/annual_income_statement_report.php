<!DOCTYPE html>
<html>
<head>
	<title>Annual Income Report</title>
	<style type="text/css">
        body {
            font-family: 'Calibri',sans-serif;
            font-size: 12px;
        }

        th {
        	color: white;
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
			body {-webkit-print-color-adjust: exact;}
		}

		@media print{@page {size: landscape}}
        @media print {
      @page { margin: 0; }
      body { margin: 1.0cm; }
}
    </style>
    <script type="text/javascript">
    	(function(){
    		window.print();
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
        <h1 class="report-header" style="text-align: center;"><strong>ANNUAL INCOME STATEMENT</strong></h1>
    </div>
	<table width="100%" border="1" cellspacing="0">
        <thead>
            <th width="5%" style="background: #0960a5!important;">Account #</th>
            <th width="10%" style="background: #0960a5!important;">Account Description</th>
            <th width="5%" style="background: #074d85!important;">JANUARY</th>
            <th width="5%" style="background: #074d85!important;">FEBRUARY</th>
            <th width="5%" style="background: #074d85!important;">MARCH</th>
            <th width="5%" style="background: #074d85!important;">APRIL</th>
            <th width="5%" style="background: #074d85!important;">MAY</th>
            <th width="5%" style="background: #074d85!important;">JUNE</th>
            <th width="5%" style="background: #074d85!important;">JULY</th>
            <th width="5%" style="background: #074d85!important;">AUGUST</th>
            <th width="5%" style="background: #074d85!important;">SEPTEMBER</th>
            <th width="5%" style="background: #074d85!important;">OCTOBER</th>
            <th width="5%" style="background: #074d85!important;">NOVEMBER</th>
            <th width="5%" style="background: #074d85!important;">DECEMBER</th>
        </thead>
        <tbody>
            <td colspan="14" style="background:#36474f; text-align: center; color: white;"><strong>- INCOME -</strong></td>
            <?php 
                $jan_inc_bal=0; 
                $feb_inc_bal=0;
                $mar_inc_bal=0;
                $apr_inc_bal=0;
                $may_inc_bal=0;
                $jun_inc_bal=0;
                $jul_inc_bal=0;
                $aug_inc_bal=0;
                $sep_inc_bal=0;
                $oct_inc_bal=0;
                $nov_inc_bal=0;
                $dec_inc_bal=0;
            ?>
            <?php foreach($income_accounts as $income_account) { ?>
                <tr>
                    <td width="5%"><?php echo $income_account->account_no; ?></td>
                    <td width="10%"><?php echo $income_account->account_title; ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_jan_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_feb_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_mar_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_apr_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_may_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_jun_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_jul_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_aug_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_sep_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_oct_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_nov_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($income_account->core_nov_balance,2); ?></td>
                </tr>
                <?php 
                    $jan_inc_bal+=$income_account->core_jan_balance; 
                    $feb_inc_bal+=$income_account->core_feb_balance;
                    $mar_inc_bal+=$income_account->core_mar_balance;
                    $apr_inc_bal+=$income_account->core_apr_balance; 
                    $may_inc_bal+=$income_account->core_may_balance;
                    $jun_inc_bal+=$income_account->core_jun_balance;
                    $jul_inc_bal+=$income_account->core_jul_balance; 
                    $aug_inc_bal+=$income_account->core_aug_balance;
                    $sep_inc_bal+=$income_account->core_sep_balance;
                    $oct_inc_bal+=$income_account->core_oct_balance; 
                    $nov_inc_bal+=$income_account->core_nov_balance;
                    $dec_inc_bal+=$income_account->core_dec_balance;
                ?>
            <?php } ?>
            <tr>
                <td colspan="2" align="right">Total Income: </td>
                <td align="right"><?php echo number_format($jan_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($feb_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($mar_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($apr_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($may_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jun_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jul_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($aug_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($sep_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($oct_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($nov_inc_bal, 2); ?></td>
                <td align="right"><?php echo number_format($dec_inc_bal, 2); ?></td>
            </tr>
            <td colspan="14" style="background: #36474f; text-align: center; color: white;"><strong>- EXPENSES -</strong></td>
            <?php 
                $jan_exp_bal=0; 
                $feb_exp_bal=0;
                $mar_exp_bal=0;
                $apr_exp_bal=0;
                $may_exp_bal=0;
                $jun_exp_bal=0;
                $jul_exp_bal=0;
                $aug_exp_bal=0;
                $sep_exp_bal=0;
                $oct_exp_bal=0;
                $nov_exp_bal=0;
                $dec_exp_bal=0;
            ?>
            <?php foreach($expense_accounts as $expense_account) { ?>
                <tr>
                    <td width="10%"><?php echo $expense_account->account_no; ?></td>
                    <td width="10%"><?php echo $expense_account->account_title; ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_jan_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_feb_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_mar_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_apr_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_may_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_jun_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_jul_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_aug_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_sep_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_oct_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_nov_balance,2); ?></td>
                    <td width="5%" align="right"><?php echo number_format($expense_account->core_nov_balance,2); ?></td>
                </tr>
                <?php 
                    $jan_exp_bal+=$expense_account->core_jan_balance; 
                    $feb_exp_bal+=$expense_account->core_feb_balance;
                    $mar_exp_bal+=$expense_account->core_mar_balance;
                    $apr_exp_bal+=$expense_account->core_apr_balance; 
                    $may_exp_bal+=$expense_account->core_may_balance;
                    $jun_exp_bal+=$expense_account->core_jun_balance;
                    $jul_exp_bal+=$expense_account->core_jul_balance; 
                    $aug_exp_bal+=$expense_account->core_aug_balance;
                    $sep_exp_bal+=$expense_account->core_sep_balance;
                    $oct_exp_bal+=$expense_account->core_oct_balance; 
                    $nov_exp_bal+=$expense_account->core_nov_balance;
                    $dec_exp_bal+=$expense_account->core_dec_balance;
                ?>
            <?php } ?>
            <tr>
                <td colspan="2" align="right">Total Expenses: </td>
                <td align="right"><?php echo number_format($jan_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($feb_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($mar_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($apr_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($may_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jun_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jul_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($aug_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($sep_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($oct_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($nov_exp_bal, 2); ?></td>
                <td align="right"><?php echo number_format($dec_exp_bal, 2); ?></td>
            </tr>
            <?php 
                $jan_ni_bal=$jan_inc_bal - $jan_exp_bal;
                $feb_ni_bal=$feb_inc_bal - $feb_exp_bal;
                $mar_ni_bal=$mar_inc_bal - $mar_exp_bal;
                $apr_ni_bal=$apr_inc_bal - $apr_exp_bal;
                $may_ni_bal=$may_inc_bal - $may_exp_bal;
                $jun_ni_bal=$jun_inc_bal - $jun_exp_bal;
                $jul_ni_bal=$jul_inc_bal - $jul_exp_bal;
                $aug_ni_bal=$aug_inc_bal - $aug_exp_bal;
                $sep_ni_bal=$sep_inc_bal - $sep_exp_bal;
                $oct_ni_bal=$oct_inc_bal - $oct_exp_bal;
                $nov_ni_bal=$nov_inc_bal - $nov_exp_bal;
                $dec_ni_bal=$dec_inc_bal - $dec_exp_bal;
            ?>
            <tr>
                <td colspan="2" align="right">Net Income: </td>
                <td align="right"><?php echo number_format($jan_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($feb_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($mar_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($apr_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($may_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jun_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($jul_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($aug_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($sep_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($oct_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($nov_ni_bal, 2); ?></td>
                <td align="right"><?php echo number_format($dec_ni_bal, 2); ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>