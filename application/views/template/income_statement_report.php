<html>
<head>
    <title>Income Statement</title>
    <style>
        @page  {
            size: A4;

        }

        body{
            font-family: 'Times New Roman', serif;

        }
        @media print {
      @page { margin: 0; }
      body { margin: 1.0cm; }
  }
    </style>
</head>
<body>
    <table width="100%">
    <tr>
        <td width="20%" valign="top"><img src="<?php echo base_url($company_info->logo_path); ?>" style="height: 90px; width: 120px; text-align: left;"></td>
        <td width="80%" class="align-center">
            <span style="font-size: 12pt;font-weight: bolder;"><strong><?php echo $company_info->company_name; ?></strong></span><br />
            <span style="font-size: 8pt;"><?php echo $company_info->company_address; ?></span><br />
            <span style="font-size: 8pt;"><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></span><br /><br />
            <span style="font-size: 12pt;font-weight: bolder;"><strong>Income Statement - <?php echo $departments; ?></strong></h3></span>
            <span style="font-size: 10pt;"><i>Period <?php echo $start; ?> to <?php echo $end; ?></i></span><br /><br /><br />
        </td>
    </tr>
</table>



<div class="row">
    <div class="col-lg-12">
        <br />

        <b>Income</b>
        <hr />

        <div class="col-lg-11 col-lg-offset-1">
            <table width="100%" class="table">
                <tbody>
                <?php $total_income=0; foreach($income_accounts as $income){ ?>
                    <tr style="border-bottom: 1px solid lightgray;">
                        <td width="80%"><?php echo $income->account_title; ?></td>
                        <td width="20%" align="right"><?php echo number_format($income->account_balance,2); ?></td>
                    </tr>
                    <?php $total_income+=$income->account_balance; } ?>
                </tbody>
            </table>

            <table width="100%">
                <tr>
                    <td width="80%" align="right"><b>Total Income</b></td>
                    <td width="20%" align="right"><b><?php echo number_format($total_income,2); ?></b></td>
                </tr>
            </table>
        </div>


        <br />
        <b>Expense</b>
        <hr />

        <div class="col-lg-11 col-lg-offset-1">
            <table width="100%">
                <tbody>
                <?php $total_expense=0; foreach($expense_accounts as $expense){ ?>
                    <tr>
                        <td width="80%"><?php echo $expense->account_title; ?></td>
                        <td width="20%" align="right"><?php echo number_format($expense->account_balance,2); ?></td>
                    </tr>
                    <?php $total_expense+=$expense->account_balance; } ?>
                </tbody>
            </table>

            <table width="100%">
                <tr>
                    <td width="80%" align="right"><b>Total Expense :</b></td>
                    <td width="20%" align="right"><b><?php echo number_format($total_expense,2); ?></b></td>
                </tr>
            </table>
            <br /><br />

            <table width="100%">
                <tr>
                    <td width="80%" align="right"><b>NET INCOME :</b></td>
                    <td width="20%" align="right"><b><?php echo number_format($total_income-$total_expense,2); ?></b></td>
                </tr>
            </table>

        </div>


    </div>
</div>
</body>
<script>
    window.print();
</script>
</html>







