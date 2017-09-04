<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-cdjp-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <!--<link href="assets/dropdown-enhance/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">-->
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">
    <style>
        div.dataTables_filter input {
            margin-top: 10px;
        }

        .toolbar{
            float: left;
        }

        .text-right {
            text-align: right!important;
        }

        .text-left {
            text-align: left!important;
        }

        td:nth-child(7),td:nth-child(8){
            text-align: right;
        }

/*        .tab-warning.tab-container > .nav-tabs > li.active > a {
        background: #414141 !important;
        color: white!important;
        border-top: 2px solid orange!important;
        border-bottom-color: transparent!important; 
        }

        .tab-warning.tab-container > .nav-tabs > li > a {
        background: transparent!important;
        color: white!important;
        }
*/
    </style>

</head>

<body class="animated-content" style="font-family: tahoma;">

<?php echo $_top_navigation; ?>

<div id="wrapper">
<div id="layout-static">

<?php echo $_side_bar_navigation;?>

<div class="static-content-wrapper white-bg">
<div class="static-content"  >

<div class="page-content"><!-- #page-content -->

<ol class="breadcrumb" style="margin-bottom: 0px;">
    <li><a href="dashboard">Dashboard</a></li>
    <li><a href="TAccount">T-Accounts</a></li>
</ol>

<div class="container-fluid">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">
<div id="div_payable_list">
<div class="panel-group panel-default" id="accordionA">
<div class="panel panel-default" style="border-radius: 6px;min-height: 670px;">
<!-- <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;;"><b style="color:white;font-size: 12pt;"><i class="fa fa-bars"></i> T-Accounts Report</b></div></a> -->
<div id="collapseTwo" class="collapse in">
<div class="panel-body">
<h2 class="h2-panel-heading">T-Accounts Report</h2><hr>
<div style="">
    <div class="row">
        <div class="col-xs-12 col-lg-3">
            Period Start * :<br />
            <div class="input-group">
                <input type="text" id="txt_start" name="date_from" class="date-picker form-control" value="01/01/<?php echo date("Y"); ?>">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>

        <div class="col-xs-12 col-lg-3">
            Period End * :<br />
            <div class="input-group">
                <input type="text" id="txt_end" name="date_to" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>

    </div>
</div>
<br />
    <div class="tab-container tab-warning">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#gje" id="btn_customer">General Journal</a></li>
            <li><a data-toggle="tab" href="#cdj" id="btn_salesman">Cash Disbursement</a></li>
            <li><a data-toggle="tab" href="#pje" id="btn_products">Purchase Journal</a></li>
            <li><a data-toggle="tab" href="#sje" id="btn_products">Sales Journal</a></li>
            <li><a data-toggle="tab" href="#pcf" id="btn_products">Petty Cash Journal</a></li>
            <li><a data-toggle="tab" href="#crj" id="btn_products">Cash Receipt Journal</a></li>
        </ul>
        <div class="tab-content">
            <div id="gje" class="tab-pane fade in active">
                    <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_gje" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                    <table id="tbl_gje" style="margin-top: 10px;" class="table table-striped" cellspacing="0" width="100%">
                        <thead class="">
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Txn #</th>
                            <th>Description</th>
                            <th>Remarks</th>
                            <th>Account</th>
                            <th>Dr</th>
                            <th>Cr</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td align="right" colspan="6">Total : </td>
                            <td id="td_dr_total" align="right"></td>
                            <td id="td_cr_total" align="right"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            <div id="cdj" class="tab-pane fade in">
                <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_cdj" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                <table id="tbl_cdj" style="margin-top: 10px;" class="table table-striped" cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Txn #</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Account</th>
                        <th>Dr</th>
                        <th>Cr</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="right" colspan="6">Total : </td>
                        <td id="td_dr_total" align="right"></td>
                        <td id="td_cr_total" align="right"></td>
                    </tr>


                    </tfoot>
                </table>
            </div>

            <div id="pje" class="tab-pane fade in">
                <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_pje" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                <table id="tbl_pje" style="margin-top: 10px;" class="table table-striped" cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Txn #</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Account</th>
                        <th>Dr</th>
                        <th>Cr</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="right" colspan="6">Total : </td>
                        <td id="td_dr_total" align="right"></td>
                        <td id="td_cr_total" align="right"></td>
                    </tr>


                    </tfoot>
                </table>
            </div>

            <div id="sje" class="tab-pane fade in">
                <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_sje" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                <table id="tbl_sje" style="margin-top: 10px;"  class="table table-striped" cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Txn #</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Account</th>
                        <th>Dr</th>
                        <th>Cr</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="right" colspan="6">Total : </td>
                        <td id="td_dr_total" align="right"></td>
                        <td id="td_cr_total" align="right"></td>
                    </tr>


                    </tfoot>
                </table>
            </div>

            <div id="pcf" class="tab-pane fade in">
                <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_pcf" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                <table id="tbl_pcf" style="margin-top: 10px;" class="table table-striped" cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Txn #</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Account</th>
                        <th>Dr</th>
                        <th>Cr</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="right" colspan="6">Total : </td>
                        <td id="td_dr_total" align="right"></td>
                        <td id="td_cr_total" align="right"></td>
                    </tr>


                    </tfoot>
                </table>
            </div>

            <div id="crj" class="tab-pane fade in">
                <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print_crj" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report</button>
                <table id="tbl_crj" style="margin-top: 10px;" class="table table-striped"  cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Txn #</th>
                        <th>Description</th>
                        <th>Remarks</th>
                        <th>Account</th>
                        <th>Dr</th>
                        <th>Cr</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td align="right" colspan="6">Total : </td>
                        <td id="td_dr_total" align="right"></td>
                        <td id="td_cr_total" align="right"></td>
                    </tr>


                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
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
<?php echo $_def_js_files; ?>


<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<!-- Select2-->
<script src="assets/plugins/select2/select2.full.min.js"></script>
<!---<script src="assets/plugins/dropdown-enhance/dist/js/bootstrap-select.min.js"></script>-->

<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
   var dtGJE; var dtCDJ;
    var _date_from = $('input[name="date_from"]');
    var _date_to = $('input[name="date_to"]');


    var initializeControls=function(){
        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        reloadGJE();
    }();

    var bindEventControls=function(){
        $('#txt_start').on('change',function(){
            dtGJE.destroy();
            dtCDJ.destroy();
            dtPJE.destroy();
            dtSJE.destroy();
            dtPCF.destroy();
            dtCRJ.destroy();

            reloadGJE();
        });

        $('#btn_print_crj').click(function(){
            window.open('TAccount/transaction/journal-report?b=CRJ&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#btn_print_pcf').click(function(){
            window.open('TAccount/transaction/journal-report?b=PCF&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#btn_print_sje').click(function(){
            window.open('TAccount/transaction/journal-report?b=SJE&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#btn_print_pje').click(function(){
            window.open('TAccount/transaction/journal-report?b=PJE&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#btn_print_cdj').click(function(){
            window.open('TAccount/transaction/journal-report?b=CDJ&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#btn_print_gje').click(function(){
            window.open('TAccount/transaction/journal-report?b=GJE&s='+$('#txt_start').val()+'&e='+$('#txt_end').val());
        });

        $('#txt_end').on('change',function(){
            dtGJE.destroy();
            dtCDJ.destroy();
            dtPJE.destroy();
            dtSJE.destroy();
            dtPCF.destroy();
            dtCRJ.destroy();

            reloadGJE();
        });
    }();

    function reloadGJE() {
        dtGJE=$('#tbl_gje').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "GJE"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_gje #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_gje #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });

        dtCDJ=$('#tbl_cdj').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "CDJ"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_cdj #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_cdj #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });


        dtPJE=$('#tbl_pje').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "PJE"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_pje #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_pje #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });


        dtSJE=$('#tbl_sje').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "SJE"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_sje #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_sje #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });


        dtPCF=$('#tbl_pcf').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "PCF"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_pcf #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_pcf #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });


        dtCRJ=$('#tbl_crj').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "bPaginate":false,
            "ajax": {
                "url": "TAccount/transaction/get-journal-list",
                "type": "POST",
                "bDestroy": true,
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "start": $('#txt_start').val(),
                        "end" : $('#txt_end').val(),
                        "book" : "CRJ"
                    });
                }
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "date_txn" },
                { targets:[2],data: "txn_no" },
                { targets:[3],data: "description" },
                { targets:[4],data: "remarks" },
                { targets:[5],data: "account_title" },
                {
                    targets:[6],
                    data: "dr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                },
                {
                    targets:[7],
                    data: "cr_amount",
                    render: function(data, type, full, meta){
                        return '<b>'+accounting.formatNumber(data,2)+'</b>';
                    }

                }

            ],
            "footerCallback": function(a,b,c){
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                total_dr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total_cr = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $('#tbl_crj #td_dr_total').html('<b>'+accounting.formatNumber(total_dr,2)+'</b>');
                $('#tbl_crj #td_cr_total').html('<b>'+accounting.formatNumber(total_cr,2)+'</b>');
            }

        });

    };

});
</script>


</body>

</html>