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

/*        th { border: 1px solid #525252!important; }

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
                        <li><a href="Comparative_income">Comparative Income Statement</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div data-widget-group="group1">

                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Comparative Income Statement</b>
                                </div> -->
                                <div class="panel-body">
                                <h2 class="h2-panel-heading">Comparative Income Statement</h2><hr>
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="col-xs-12 col-sm-2" style="padding-left: 0; padding-right: 0; margin-bottom: 10px;">
                                                <button id="btn_print" class="btn btn-primary btn-block"><span class="fa fa-file-o"></span>&nbsp;Print Report</button>
                                            </div>
                                            <table width="100%" border="1" class="table table-striped">
                                                <thead>
                                                    <th style=" text-align: center;" width="20%">Account Description</th>
                                                    <th style=""><center>PREVIOUS MONTH <br>(<?php echo date("F Y", strtotime("first day of previous month"));  ?>)</center></th>
                                                    <th style=""><center>CURRENT MONTH <br>(<?php echo date("F Y");  ?>)</center></th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="3" style="text-align: center;"><strong>- INCOME - </strong></td>
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
                                                        <td colspan="3" style="text-align: center;"><strong>- EXPENSES -</strong></td>
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
            window.open('Comparative_income/Report');
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