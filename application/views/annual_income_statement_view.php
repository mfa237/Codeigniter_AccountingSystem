<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        .select2-container{
            min-width: 100%;
        }


        .select2-dropdown{
            z-index: 9999999999;
        }

        .datepicker-dropdown{
            z-index: 9999999999;
        }

        .dropdown-menu{
            z-index: 9999999999;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        th { border: 1px solid #525252!important; }
/*
        tr:nth-child(even) {
            background: transparent!important;
        }

        tr:nth-child(even):hover {
            background: transparent!important;
            color: white!important;
        }

        tr:nth-child(odd):hover {
            background: transparent!important;
            color: white!important;
        }
*/
    </style>

</head>

<body class="animated-content">

<?php echo $_top_navigation; ?>

<div id="wrapper">
    <div id="layout-static">

        <?php echo $_side_bar_navigation;?>

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->
                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Annual_income_statement">Annual Income Statement</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div data-widget-group="group1">

                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Annual Income Statement <?php echo '('.date('Y').')'; ?></b>
                                </div>
 -->                                <div class="panel-body" style="overflow-x: auto;">
                                <h2 class="h2-panel-heading">Annual Income Statement <?php echo '('.date('Y').')'; ?></h2><hr>
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="col-xs-12 col-sm-2" style="padding-left: 0; padding-right: 0; margin-bottom: 10px;">
                                                <button id="btn_print" class="btn btn-primary btn-block"><span class="fa fa-file-o"></span>&nbsp;Print Report</button>
                                            </div>
                                            <table width="100%" class="table table-striped">
                                                <thead>
                                                    <th width="5%" >Account #</th>
                                                    <th width="10%" >Account Description</th>
                                                    <th width="5%" ">JANUARY</th>
                                                    <th width="5%" ">FEBRUARY</th>
                                                    <th width="5%" ">MARCH</th>
                                                    <th width="5%" ">APRIL</th>
                                                    <th width="5%" ">MAY</th>
                                                    <th width="5%" ">JUNE</th>
                                                    <th width="5%" ">JULY</th>
                                                    <th width="5%" ">AUGUST</th>
                                                    <th width="5%" ">SEPTEMBER</th>
                                                    <th width="5%" ">OCTOBER</th>
                                                    <th width="5%" ">NOVEMBER</th>
                                                    <th width="5%" ">DECEMBER</th>
                                                </thead>
                                                <tbody>
                                                    <td colspan="14" style=" text-align: center;"><strong>- INCOME -</strong></td>
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
                                                    <td colspan="14" style=" text-align: center;"><strong>- EXPENSES -</strong></td>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    
                                </div>
                            </div>             
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .container-fluid -->
    </div> <!-- #page-content -->
</div>
        </div>
    </div>
</div>


<?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>


<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        var _btnPrint = $('#btn_print');

        _btnPrint.on('click',function(){
            window.open('Annual_income_statement/Report');
        });
    })();
</script>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


</body>

</html>