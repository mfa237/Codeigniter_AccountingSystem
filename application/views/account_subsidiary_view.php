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
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->

    <style>
        .toolbar{
            float: left;
        }

        td:nth-child(7),td:nth-child(8){
            text-align: right;
        }

        td:nth-child(9){
            text-align: right;
            font-weight: bolder;
        }
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
                        <li><a href="Account_receivable_schedule">Accounts Receivable Schedule</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_payable_list">

                                        <div class="panel-group panel-default" id="accordionA">


                                            <div class="panel panel-default" style="border-radius: 6px;border: 1px solid lightgrey;">
                                               <!--  <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;;"><b style="color:white;font-size: 12pt;"><i class="fa fa-bars"></i> Per Account Subsidiary</b></div></a> -->
                                                <div id="collapseTwo" class="collapse in">
                                                    <div class="panel-body">
                                                    <h2 class="h2-panel-heading">Account Subsidiary</h2><hr>
                                                        <div>
                                                            <div class="row">

                                                                <div class="col-lg-5">
                                                                    Account * : <br />
                                                                    <select id="cbo_accounts" class="form-control">
                                                                        <?php foreach($account_titles as $account){ ?>
                                                                            <option value="<?php echo $account->account_id; ?>" <?php echo (1==$account->account_id?'selected':''); ?>><?php echo $account->account_title; ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>

                                                                <div class="col-lg-3">
                                                                    Transactions : <br />
                                                                    <select id="cbo_options" class="form-control">
                                                                        <option value="0">Selected Account only</option>
                                                                        <option value="1">Include Transactions of Main Account</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    Period Start * :<br />
                                                                    <div class="input-group">
                                                                        <input type="text" id="txt_date" name="date_from" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>">
                                                                         <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                         </span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-2">
                                                                    Period End * :<br />
                                                                    <div class="input-group">
                                                                        <input type="text" id="txt_date" name="date_to" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>">
                                                                         <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                         </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <br />

                                                        <div >
                                                            <table id="tbl_account_subsidiary" class="table table-striped" cellspacing="0" width="100%">
                                                                <thead class="">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Txn #</th>
                                                                    <th>Account</th>
                                                                    <th>Main</th>
                                                                    <th>Particular</th>
                                                                    <th>Memo</th>

                                                                    <th style="text-align: right">Debit</th>
                                                                    <th style="text-align: right">Credit</th>
                                                                    <th style="text-align: right">Balance</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
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
                </div> <!-- .container-fluid -->
            </div> <!-- #page-content -->
        </div>

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline pull-left">
                    <li><h6 style="margin: 0;">&copy; 2016 - Paul Christian Rueda</h6></li>
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
        var _cboAccounts; var dt; var _cboOptions;
        var _date_from = $('input[name="date_from"]');
        var _date_to = $('input[name="date_to"]');


        var initializeControls=function(){

            _cboAccounts=$("#cbo_accounts").select2({
                placeholder: "Please select customer.",
                allowClear: true
            });

            _cboOptions=$("#cbo_options").select2({
                allowClear: false
            });

            _cboOptions.select2('val',0);

            $('.date-picker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true

            });

            reloadList();

            createToolBarButton();



        }();

        var bindEventControls=function(){
            _cboAccounts.on("select2:select", function (e) {
                dt.destroy();
                reloadList();
                createToolBarButton();
            });

            _cboOptions.on("select2:select", function (e) {
                dt.destroy();
                reloadList();
                createToolBarButton();
            });

            $('.date-picker').on('change',function(){
                dt.destroy();
                reloadList();
                createToolBarButton();
            });

            $(document).on('click','#btn_print',function(){
                window.open('Templates/layout/account-subsidiary?type=preview&accountId='+_cboAccounts.val()+'&startDate='+_date_from.val()+'&endDate='+_date_to.val()+'&includeChild='+_cboOptions.val());

            });

            $(document).on('click','#btn_refresh',function(){
                dt.destroy();
                reloadList();
                createToolBarButton();
            });


        }();



        function createToolBarButton(){
            var _btnPrint='<button class="btn btn-primary" id="btn_print" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" >'+
                '<i class="fa fa-print"></i> Print Report</button>';

            var _btnRefresh='<button class="btn btn-success" id="btn_refresh" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Reload" >'+
                '<i class="fa fa-refresh"></i></button>';

            $("div.toolbar").html(_btnPrint+"&nbsp;"+_btnRefresh);
        };





        function reloadList(){

            dt=$('#tbl_account_subsidiary').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "bPaginate":false,
                "ajax": {
                    "url": "Account_Subsidiary/transaction/get-account-subsidiary",
                    "type": "GET",
                    "bDestroy": true,
                    "data": function ( d ) {
                        return $.extend( {}, d, {
                            "accountId": _cboAccounts.select2('val'),
                            "startDate":_date_from.val(),
                            "endDate":_date_to.val(),
                            "includeChild":_cboOptions.select2('val')
                        });
                    }
                },
                "columns": [
                    { targets:[0],data: "date_txn" },
                    { targets:[1],data: "txn_no" },
                    { targets:[2],data: "account_title" },
                    { targets:[3],data: "parent_title" },
                    { targets:[4],data: "particular" },
                    { targets:[5],data: "memo" },


                    {
                        targets:[6],data: "debit",
                        render: function(data, type, full, meta){
                            return accounting.formatNumber(data,2);
                        }
                    },
                    {
                        targets:[7],data: "credit",
                        render: function(data, type, full, meta){
                            return accounting.formatNumber(data,2);
                        }
                    },
                    {
                        targets:[8],data: "balance",
                        render: function(data, type, full, meta){
                            return accounting.formatNumber(data,2);
                        }}
                ]

                ,
                "rowCallBack": function(a,b,c){
                    console.log(b);
                }

            });
        };



    });
</script>


</body>

</html>