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

    <?php echo $_def_js_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">

    <style>
        .toolbar{
            float: left;
        }

        td.details-control {
            background: url('assets/img/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
        }

        .child_table{
            padding: 5px;
            border: 1px #ff0000 solid;
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



    </style>
    <?php echo $_def_css_files; ?>

</head>

<body class="animated-content">

<?php echo $_top_navigation; ?>

<div id="wrapper">
    <div id="layout-static">

        <?php echo $_side_bar_navigation;?>

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->
                    <ol class="breadcrumb">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="SOA">Statement of Account</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Statement of Account</b>
                            </div> -->
                            <div class="panel-body">
                                <h1 style="margin-bottom: 30px;">Statement of Account</h1><hr>
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-xs-12 col-sm-6">
                                            <label><b class="required">*</b> Customer :</label><br>
                                            <select id="cbo_customers" class="form-control" style="width: 100%">
                                                <?php foreach($customers as $customer) { ?>
                                                    <option value="<?php echo $customer->customer_id; ?>">
                                                        <?php echo $customer->customer_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-3"><br>
                                            <button id="btn_print" class="btn btn-primary btn-block" style="margin-top: 5px;"><i class="fa fa-print"></i> Print Report</button>
                                        </div>
                                    </div><br>
                                </div><hr><br>
                                <div class="row">   
                                    <div class="container-fluid">
                                        <table id="tbl_balances" width="100%" class="table table-bordered">
                                            <th class="th-label" colspan="5"><h4 style="font-weight: bold;">PREVIOUS BALANCE</h4></th>
                                            <tr>
                                                <th>Invoice #</th>
                                                <th>Date</th>
                                                <th align="right">Amount</th>
                                                <th align="right">Balance Amount</th>
                                                <th align="right">Total</th>
                                            </tr>
                                            <tr>
                                            <th colspan="5" class="group-heading">SALES</th>
                                            </tr>
                                            <tbody id="previous_balances">
                                            
                                            </tbody>
                                            <tr>
                                            <th colspan="5" class="group-heading">SERVICES</th>
                                            </tr>
                                            <tbody id="previous_balances_service">

                                            </tbody>
                                            <tr>
                                                <td colspan="4" align="right"><b>SUB-TOTAL:</b></td>
                                                <td id="total_prev" align="right">0.00</td>
                                            </tr>

                                            <th colspan="5"><h4 style="font-weight: bold;">CURRENT BALANCE</h4></th>
                                            <tr>
                                                <th>Invoice #</th>
                                                <th>Date</th>
                                                <th align="right">Amount</th>
                                                <th align="right">Balance Amount</th>
                                                <th align="right">Total</th>
                                            </tr>
                                                <th colspan="5" class="group-heading">SALES</th>
                                            </tr>
                                            <tbody id="current_balances">

                                            
                                            </tbody>
                                            <tr>
                                                <th colspan="5" class="group-heading">SERVICES</th>
                                            </tr>
                                            
                                            <tbody id="current_balances_service">
                                            </tbody>
                                            <tr>
                                                <td colspan="4" align="right"><b>SUB-TOTAL:</b></td>
                                                <td id="total_current" align="right">0.00</td>
                                            </tr>

                                            <th colspan="5"><h4 style="font-weight: bold;">PAYMENT</h4></th>
                                            <tr>
                                                <th>Receipt #</th>
                                                <th>Date</th>
                                                <th align="right">Payment Amount</th>
                                                <th align="right" colspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="5" class="group-heading">SALES</th>
                                            </tr>
                                            <tbody id="payment">

                                            </tbody>
                                            <tr>
                                                <th colspan="5" class="group-heading">SERVICES</th>
                                            </tr>
                                            <tbody id="payment_services">
                                            </tbody>
                                            <tr>
                                                <td colspan="4" align="right"><b>TOTAL:</b></td>
                                                <td id="total" align="right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="right"><b>LESS PAYMENT:</b></td>
                                                <td id="total_payment" align="right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="right"><b>BALANCE:</b></td>
                                                <td id="total_balance" align="right">0.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div> <!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div>
            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2017 - JDEV IT Business Solutions</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>
        </div>
    </div>
</div>


<?php echo $_switcher_settings; ?>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script>

$(document).ready(function(){
    var _cboCustomers;

    var initializeControls=function() {
        _cboCustomers = $('#cbo_customers').select2({
            searchPlaceholder: 'Select Customer'
        });

        reinitializeBalances();
    }();

    var bindEventHandlers=function(){
        _cboCustomers.on('select2:select',function(){
            reinitializeBalances();
        });

        $('#btn_print').click(function(){
            window.open('SOA/transaction/print?cusid='+_cboCustomers.val());
        });
    }();

    function reinitializeBalances() {
        var sumPrev = 0; var sumCur = 0; var sumPayment = 0; var totalBalance = 0; total = 0;
        $('#tbl_balances #previous_balances').html('');
        $('#tbl_balances #previous_balances_service').html('');
        $('#tbl_balances #current_balances').html('');
        $('#tbl_balances #current_balances_service').html('');
        $('#tbl_balances #payment').html('');
        $('#tbl_balances #payment_services').html('');


        $.ajax({
            url : 'SOA/transaction/balances?cusid='+_cboCustomers.val(),
            type : "GET",
            cache : false,
            dataType : 'json',
            processData : false,
            contentType : false,
            success : function(response){
                $.each(response.previous_balances, function(index,value){
                    if(value.group_status == 1 ){
                    $('#tbl_balances #previous_balances').append(
                        '<tr>'+
                            '<td>'+value.invoice_no+'</td>'+
                            '<td>'+value.date_invoice+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.receivable_amount,2)+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.balance_amount,2)+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );
                   } else{
                    $('#tbl_balances #previous_balances_service').append(
                        '<tr>'+
                            '<td>'+value.invoice_no+'</td>'+
                            '<td>'+value.date_invoice+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.receivable_amount,2)+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.balance_amount,2)+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );

                    }

                    sumPrev += parseFloat(value.receivable_amount);
                });
                $.each(response.current_balances, function(index,value){
                if(value.group_status == 1 ){

                    $('#tbl_balances #current_balances').append(
                        '<tr>'+
                            '<td>'+value.invoice_no+'</td>'+
                            '<td>'+value.date_invoice+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.receivable_amount,2)+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.balance_amount,2)+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );
                } else {
                    $('#tbl_balances #current_balances_service').append(
                        '<tr>'+
                            '<td>'+value.invoice_no+'</td>'+
                            '<td>'+value.date_invoice+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.receivable_amount,2)+'</td>'+
                            '<td align="right">'+accounting.formatNumber(value.balance_amount,2)+'</td>'+
                            '<td></td>'+
                        '</tr>'
                    );

                }

                    sumCur += parseFloat(value.receivable_amount);

                });

                $.each(response.payments, function(index,value){
                    if (value.group_status == 1){
                    $('#tbl_balances #payment').append(
                        '<tr>'+
                            '<td>'+(value.receipt_no == null ? '' : value.receipt_no_desc) +'</td>'+
                            '<td>'+(value.date_paid == null ? '' : value.date_paid) +'</td>'+
                            '<td align="right" colspan="2">'+(value.date_paid == null ? '' : accounting.formatNumber(value.payment_amount,2))+'</td>'+
                            '<td colspan="2"></td>'+
                        '</tr>'
                    );
                } else {
                    $('#tbl_balances #payment_services').append(
                        '<tr>'+
                            '<td>'+(value.receipt_no == null ? '' : value.receipt_no_desc) +'</td>'+
                            '<td>'+(value.date_paid == null ? '' : value.date_paid) +'</td>'+
                            '<td align="right" colspan="2">'+(value.date_paid == null ? '' : accounting.formatNumber(value.payment_amount,2))+'</td>'+
                            '<td colspan="2"></td>'+
                        '</tr>'
                    );

                }

                    sumPayment += parseFloat(value.payment_amount);
                });

                total = sumPrev + sumCur;

                totalBalance = total - sumPayment;

                $('#total').html('<b>'+accounting.formatNumber(total,2)+'</b>');
                $('#total_prev').html('<b>'+accounting.formatNumber(sumPrev,2)+'</b>');
                $('#total_current').html('<b>'+accounting.formatNumber(sumCur,2)+'</b>');
                $('#total_payment').html('<b>'+accounting.formatNumber(sumPayment,2)+'</b>');
                $('#total_balance').html('<b>'+accounting.formatNumber(totalBalance,2)+'</b>');
            }
        });
    };
});

</script>

</body>

</html>