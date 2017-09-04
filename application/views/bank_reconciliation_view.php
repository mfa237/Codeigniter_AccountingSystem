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
/*
        .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            color: white;
            font-weight: bolder;
            background: rgba(255, 152, 0, .1);
            border-bottom: none;
        }

        .nav-tabs > li > a {
            border: 1px solid white;
            border-top-width: 1px;
            border-radius: 0;
            color: white;
        }

        .nav-tabs > li > a:hover {
            border: 1px solid white;
            border-top: 1px solid #2196f3; 
            background: transparent;
        }*/

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

        .select2-container--default .select2-selection--single {
            height: 32px;
        }

        input[type='radio']:hover {
            cursor: pointer;
        }

        input[type='radio']:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #404040;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        input[type='radio']:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #ff9800;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        td.details-control {
            background: url('assets/img/print.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
        }
    </style>
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

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
                        <li><a href="Bank_reconciliation">Bank Reconciliation</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                               <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Bank Reconciliation</b> 
                            </div> -->
                            <div class="panel-body">
                            <h2 class="h2-panel-heading">Bank Reconciliation</h2><hr>
                                <div class="row">
                                    <div class="container-fluid">
                                        <ul class="nav nav-tabs">
                                          <li class="active text-center"><a data-toggle="tab" href="#outstanding"><b>Step 1:</b> Outstanding Check</a></li>
                                          <li id="btn_step_2" class="text-center"><a data-toggle="tab" href="#bank_reconciliation_tab"><b>Step 2:</b> Bank Reconciliation</a></li>
                                        </ul>
                                        <div class="tab-content" style="background: transparent!important;">
                                          <div id="outstanding" class="tab-pane fade in active">
                                            <div class="container-fluid" style="padding-top: 20px; padding-bottom: 20px;">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-xs-12 col-sm-4">
                                                            <strong>* Bank:</strong><br>
                                                            <select id="cbo_bank" class="form-control" data-error-msg="Please Select Bank." required>
                                                                <?php foreach($banks as $bank) { ?>
                                                                    <option value="<?php echo $bank->bank_id; ?>"><?php echo $bank->bank_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            <strong>* Start Date</strong><br>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input id="startDate" type="text" class="date-picker form-control" name="start_date" data-error-msg="Start Date is required" value="<?php echo date('m/d/Y'); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            <strong>* End Date</strong><br>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input id="endDate" type="text" class="date-picker  form-control" name="end_date" data-error-msg="End Date is required" value="<?php echo date('m/d/Y'); ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="container-fluid group-box">
                                                            <span><strong><i class="fa fa-list"></i> ISSUED CHECKS</strong></span><hr>
                                                            <form id="frm_reconcile">
                                                            <table id="tbl_bank_reconciliation" class="table table-striped" width="100%">
                                                                <thead>
                                                                    <th>Check #</th>
                                                                    <th>Txn Date</th>
                                                                    <th>Check Date</th>
                                                                    <th>Particular</th>
                                                                    <th>Book</th>
                                                                    <th>Department</th>
                                                                    <th>Ref #</th>
                                                                    <th align="right">Amount</th>
                                                                    <th width="7%">Outstanding</th>
                                                                    <th width="7%">Good Check</th>
                                                                    <th width="7%">Default</th>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>                                                                
                                                </div>
                                          </div>
                                          <div id="bank_reconciliation_tab" class="tab-pane fade">
                                            <div class="container-fluid" style="padding-top: 20px; padding-bottom: 20px;">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <div class="container-fluid group-box" style="padding: 15px 15px 0 15px;">
                                                                <b><span class="fa fa-bars"></span> JOURNAL</b><hr>
                                                                <strong>ACCOUNT TO RECONCILE</strong>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <select id="cbo_accounts" class="form-control" name="account_id" data-error-msg="Please Select Account to reconcile." required>
                                                                            <?php foreach($account_titles as $account_title) { ?>
                                                                                <option value="<?php echo $account_title->account_id; ?>"><?php echo $account_title->account_title; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="account_balance" value="0" disabled>
                                                                    </div>
                                                                </div><hr>
                                                                <h5><b>DEDUCT :</b></h5>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>BANK SERVICE CHARGE</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="bank_service_charge" value="0">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>NSF CHECKS</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="nsf_check" value="0" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>CHECK PRINTING CHARGE</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="check_printing_charge" value="0" >
                                                                    </div>
                                                                </div><hr>
                                                                <h5><b>ADD :</b></h5>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>INTEREST EARNED</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="interest_earned" value="0" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>NOTES RECEIVABLE COLLECTED (BY BANK)</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="notes_receivable" value="0" >
                                                                    </div>
                                                                </div><hr>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>ADJUSTED COLLECTED BALANCE</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="adjusted_collected_balance_journal" value="0" disabled>
                                                                    </div>
                                                                </div><br>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6">
                                                            <div class="container-fluid group-box" style="padding: 15px 15px 0 15px;">
                                                                <b><span class="fa fa-bars"></span> BANK STATEMENT</b><hr>
                                                                <strong>CURRENT BANK ACCOUNT</strong>
                                                                <input type="text" class="form-control" name="current_bank_account" disabled>
                                                                <strong>ACTUAL BALANCE</strong>
                                                                <input type="text" class="form-control text-right numeric" name="actual_balance" value="0"><hr>
                                                                <h5><b>DEDUCT :</b></h5>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>OUTSTANDING CHECKS</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input id="txtOutstandingChecks" type="text" class="form-control text-right numeric" name="outstanding_checks" value="0" disabled>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <h5><b>ADD :</b></h5>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>DEPOSIT IN TRANSIT</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="deposit_in_transit" value="0">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <br>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <label>ADJUSTED COLLECTED BALANCE</label>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control text-right numeric" name="adjusted_collected_balance_bank" value="0" disabled>
                                                                    </div>
                                                                </div><br>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <button id="btn_process" class="btn btn-primary" style="min-width: 100px; margin-left: 30px;"><i class="fa fa-check"></i> Process</button> 
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Reconciliation History</b> 
                            </div> -->
                            <div class="panel-body">
                            <h2 class="h2-panel-heading">Reconciliation History</h2><hr>
                                <table id="tbl_history" class="table table-striped" width="100%">
                                    <thead>
                                        <th></th>
                                        <th>Date Reconciled</th>
                                        <th>Reconciled by</th>
                                        <th>Bank</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script>

$(document).ready(function(){
    var dt; var dtHistory; var _cboBank; var _cboAccounts;
    var _checkNo; var dtBankReconData;


    var initializeControls=function(){
        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        _cboBank=$('#cbo_bank').select2({
            allowClear: true,
            placeholder: 'Please Select Bank'
        });

        _cboAccounts=$('#cbo_accounts').select2({
            allowClear: true,
            placeholder: 'Please Select Account'
        });

        var data = _cboAccounts.select2('data');
        $('input[name="current_bank_account"]').val(data[0].text);
        $('input[name="current_bank_account"]').val('');
        
        _cboAccounts.select2('val',null);

        reinitializeHistory();
        reinitializeDataTable();
        reInitializeNumeric();
    }();

    function reinitializeHistory() {
        dtHistory=$('#tbl_history').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "language":{
                "searchPlaceholder":"Search History"
            },
            "ajax":{
                "url":"Bank_reconciliation/transaction/get-history",
                "type":"GET",
                "bDestroy":true
            },
            "columns":[
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { 
                    searchable: true,
                    targets:[1],data: "date_reconciled" 
                },
                { 
                    searchable: true,
                    targets:[2],data: "fullname" 
                },
                { 
                    searchable: false,
                    targets:[3],data: "bank_name" 
                }
            ]
        });
    };

    function reinitializeDataTable(){
        dt=$('#tbl_bank_reconciliation').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "language":{
                "searchPlaceholder":"Search Checks"
            },            
            "ajax":{
                "url":"Bank_reconciliation/transaction/list",
                "type":"GET",
                "bDestroy":true,
                "data": function (d) {
                    return $.extend({}, d, {
                        "sDate":$('#startDate').val(),
                        "eDate":$('#endDate').val(),
                        "bankid":_cboBank.select2('val')
                    });
                }
            },
            "columns":[
                { targets:[0],data: "check_no" },
                { 
                    searchable: false,
                    targets:[1],data: "date_txn" 
                },
                { 
                    searchable: false,
                    targets:[2],data: "check_date" 
                },
                { 
                    searchable: false,
                    targets:[3],data: "particular" 
                },
                { 
                    searchable: false,
                    targets:[4],data: "book_type" 
                },
                { 
                    searchable: false,
                    targets:[5],data: "department_name" 
                },
                { 
                    searchable: false,
                    class: 'ref_no',
                    targets:[6],data: "txn_no"
                },
                { 
                    searchable: false,
                    class: "text-right",
                    targets:[7],data: "amount",
                    render: function(data,type,full,meta) {
                        return accounting.formatNumber(data,2);
                    }
                },
                { 
                    class: "text-center",
                    targets:[8], 
                    render: function(data,type,full,meta) {
                        return '<input id="outstanding_'+full.check_no+'" type="radio" name="outstanding_'+ full.check_no +'[]" class="outstanding status" value="1" data-amount="' + full.amount + '"/>'
                    }
                },
                { 
                    class: "text-center",
                    targets:[9],
                    render: function(data,type,full,meta) {
                        return '<input id="good_check_'+full.check_no+'" type="radio" name="outstanding_'+ full.check_no +'[]" class="good-check status" value="2" />'
                    }
                },
                { 
                    class: "text-center hidden",
                    targets:[10],
                    render: function(data,type,full,meta) {
                        return '<input id="default_'+full.check_no+'" type="radio" name="outstanding_'+ full.check_no +'[]" class="default status" value="0" checked/>'
                    }
                }
            ]
        });
    };

    var bindEventHandlers=function(){
        $('#btn_cancel').click(function(){
            $('#modal_bank').modal('hide');
            clearFields($('#frm_bank'));
        });

        _cboAccounts.on('change', function(){
            var data = _cboAccounts.select2('data');
            $('input[name="current_bank_account"]').val(data[0].text);

            $.ajax({
                "dataType":"json",
                "type":"GET",
                "url":"Bank_reconciliation/transaction/get-account-balance?account_id="+_cboAccounts.select2('val')
            }).done(function(response){
                $('input[name="account_balance"]').val(response.data);
                reComputeTotal();
            });

        });

        $('.numeric').on('keyup',function(){
            reComputeTotal();
            reInitializeNumeric();
        });

        $('#btn_step_2').click(function(){
            var total = 0;

            $(".outstanding:checked").each(function() {
                total += parseFloat($(this).data('amount'));
            });

            $('#tbl_bank_reconciliation tbody tr').each(function() {
                var _selectRowObj=$(this);
                var data=dt.row(_selectRowObj).data();

                if (!$('#outstanding_' + data.check_no).is(':checked') && !$('#good_check_' + data.check_no).is(':checked') && !$('#default_' + data.check_no).is(':checked')) {
                    $('#default_' + data.check_no).prop('checked','checked');
                }
            });

            $('input[name="outstanding_checks"]').val(accounting.formatNumber(total,2));
            reComputeTotal();
            reInitializeNumeric();
        });

        _cboBank.on('select2:select', function(){
            dt.destroy();
            reinitializeDataTable();
        });

        $('#startDate').on('change',function(){
            dt.destroy();
            reinitializeDataTable();
        });

        $('#endDate').on('change',function(){
            dt.destroy();
            reinitializeDataTable();
        });

        $('#btn_process').click(function(){
            if(validateRequiredFields()){
                reconcileChecks().done(function(response){
                    showNotification(response);
                    clearFields();
                    dt.destroy();
                    dtHistory.destroy();
                    reinitializeDataTable();
                }).always(function(){
                    showSpinningProgress($('#btn_process'));
                })
            }
        });


    }();

    function reInitializeNumeric(){
        $('.numeric').autoNumeric('init', {mDec:2});
        $('.number').autoNumeric('init', {mDec:0});
    };

    var showSpinningProgress=function(e){
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };

    var validateRequiredFields=function(){
        var stat=true;
        var _msg="";

        if ($('input[name="outstanding_checks"]').val() == '0.00') {
            _msg="Outstanding check must not be zero";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else if (_cboBank.val() == null) {
            _msg="Bank is required";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else if (_cboAccounts.val() == null) {
            _msg="Account to reconcile is required";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else if ($('input[name="adjusted_collected_balance_journal"]').val() == 0 && $('input[name="adjusted_collected_balance_bank"]').val() == 0) {
            _msg="Adjusted collection cannot be zero.";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else if ($('input[name="adjusted_collected_balance_journal"]').val() != $('input[name="adjusted_collected_balance_bank"]').val()) {
            _msg="Adjusted collection is not balance";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else if ($('input[name="actual_balance"]').val() == 0) {
            _msg="Actual balance cannot be zero.";
            showNotification({title: 'Error!', msg: _msg, stat: 'error'});
            stat=false;
            return false;
        } else {
            stat=true;
            return true;
        }

        return stat;
    };



    var reconcileChecks=function(){
        // var _journalId;
        // var _status;
        var _data=[];

        $('.status:checked').each(function(){
            var $this = $(this),
            stat = $this.val();

            _data.push({name: "check_status[]", value: stat });
        });

        dt.rows().eq(0).each( function ( index ) {
            var row = dt.row( index );
            var data = row.data();
            
            _data.push({name: "journal_id[]", value: data.journal_id });
        });

        _data.push({name: "bank_id", value: _cboBank.select2('val') });
        _data.push({name: "account_id", value: _cboAccounts.select2('val') });
        _data.push({name: "account_balance", value: $('input[name="account_balance"]').val() });
        _data.push({name: "bank_service_charge", value: $('input[name="bank_service_charge"]').val() });
        _data.push({name: "nsf_check", value: $('input[name="nsf_check"]').val() });
        _data.push({name: "check_printing_charge", value: $('input[name="check_printing_charge"]').val() });
        _data.push({name: "interest_earned", value: $('input[name="interest_earned"]').val() });
        _data.push({name: "notes_receivable", value: $('input[name="notes_receivable"]').val() });
        _data.push({name: "adjusted_collected_balance_journal", value: $('input[name="adjusted_collected_balance_journal"]').val() });
        _data.push({name: "actual_balance", value: $('input[name="actual_balance"]').val() });
        _data.push({name: "outstanding_checks", value: $('input[name="outstanding_checks"]').val() });
        _data.push({name: "deposit_in_transit", value: $('input[name="deposit_in_transit"]').val() });
        _data.push({name: "adjusted_collected_balance_bank", value: $('input[name="adjusted_collected_balance_bank"]').val() });
        
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Bank_reconciliation/transaction/reconcile-check",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_process'))
        });
    };

    var reComputeTotal=function(){
        var _accountBal = accounting.unformat($('input[name="account_balance"]').val());
        var _bankService = accounting.unformat($('input[name="bank_service_charge"]').val());
        var _nsfChecks = accounting.unformat($('input[name="nsf_check"]').val());
        var _checkPrinting = accounting.unformat($('input[name="check_printing_charge"]').val());
        var _interestEarned = accounting.unformat($('input[name="interest_earned"]').val());
        var _notesReceivable = accounting.unformat($('input[name="notes_receivable"]').val());

        var _actualBalance = accounting.unformat($('input[name="actual_balance"]').val());
        var _outstandingChecks = accounting.unformat($('input[name="outstanding_checks"]').val());
        var _depositInTransit = accounting.unformat($('input[name="deposit_in_transit"]').val());

        var totalBank = (_actualBalance - _outstandingChecks) + _depositInTransit;

        var totalJournal = _accountBal - (_bankService + _nsfChecks + _checkPrinting) + (_interestEarned + _notesReceivable);

        $('input[name="adjusted_collected_balance_journal"]').val(accounting.formatNumber(totalJournal,2));
        $('input[name="adjusted_collected_balance_bank"]').val(accounting.formatNumber(totalBank,2));
    };

    var showNotification=function(obj){
        PNotify.removeAll(); //remove all notifications
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

    var clearFields=function(f){
        $('input[type="text"],textarea,select',f).val('0.00');
        $('input[name="current_bank_account"]').val('');
        _cboAccounts.select2('val',null);
        $(f).find('input:first').focus();
    };
});

</script>

</body>

</html>
               