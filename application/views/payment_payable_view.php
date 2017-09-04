<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from avenxo.kaijuthemes.com/ui-typography.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2016 12:09:25 GMT -->
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


    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <!--/twitter typehead-->
    <link href="assets/plugins/twittertypehead/twitter.typehead.css" rel="stylesheet">






    <style>
        .toolbar{
            float: left;
        }

        #tbl_payables td,#tbl_payables tr,#tbl_payables th{
            table-layout: fixed;
            border: 1px solid gray;
            border-collapse: collapse;
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


        .select2-container{
            min-width: 100%;
        }

        .dropdown-menu > .active > a,.dropdown-menu > .active > a:hover{
            background-color: dodgerblue;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        .custom_frame{
            background-color: white;
            border: 1px solid lightgray;
            margin: 0% 1% 1% 0%;
            padding: 0%;

        }

        .numeric{
            text-align: right;
        }



        @media screen and (max-width: 480px) {

            table{
                min-width: 800px;
            }

            .dataTables_filter{
                min-width: 800px;
            }

            .dataTables_info{
                min-width: 800px;
            }

            .dataTables_paginate{
                float: left;
                width: 100%;
            }
        }






    </style>
</head>

<body class="animated-content"  style="font-family: tahoma;text-transform: none;">

<?php echo $_top_navigation; ?>

<div id="wrapper">
<div id="layout-static">


<?php echo $_side_bar_navigation;

?>


<div class="static-content-wrapper white-bg">


<div class="static-content"  >
<div class="page-content"><!-- #page-content -->

<ol class="breadcrumb"  style="margin-bottom: 0px;">
    <li><a href="Dashboard">Dashboard</a></li>
    <li><a href="Payable_payments">AP Payments</a></li>
</ol>


<div class="container-fluid"">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">

<div id="div_payment_list">




    <div class="panel panel-default">
<!--         <div class="panel-heading">
            <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Payment History</b>
        </div> -->

        <div class="panel-body table-responsive">
            <h2 class="h2-panel-heading">Payment History</h2><hr>
            <table id="tbl_payments" class="table table-striped" cellspacing="0" width="100%">
                <thead class="">
                <tr>
                    <th></th>
                    <th>Receipt #</th>
                    <th>Supplier</th>
                    <th>Remarks</th>
                    <th>Posted by</th>
                    <th>Date Paid</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>





        <div class="panel-footer"></div>
    </div>

</div>


<div id="div_payment_fields" style="display: none;">

    <div class="panel panel-default" style="border: 4px solid #2980b9;border-radius: 8px;">

        <div class="panel-body">
        <h2 class="h2-panel-heading">Add Payment</h2><hr>
        <div>

        <div class="row ">
            <div class="container-fluid">
        <form id="frm_payments" role="form" class="form-horizontal">
            <div >
                <div class="row">

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <b>* </b> Receipt/Voucher type  : <br />
                                <select id="cbo_receipt_type" name="receipt_type" class="form-control">
                                    <option value="1" selected>CV</option>
                                    <option value="2">JV</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <b>* </b> Department  : <br />
                                <select id="cbo_branch" name="department" class="form-control">
                                    <?php foreach($departments as $department){ ?>
                                        <option value="<?php echo $department->department_id; ?>" selected><?php echo $department->department_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <b>* </b> Receipt #  : <br />
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-code"></i>
                                    </span>
                                    <input type="text" name="receipt_no" class="form-control" placeholder="Receipt #" data-error-msg="Receipt number is required!" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <b>* </b> Payment Date  : <br />
                                <div class="input-group">
                                    <span class="input-group-addon">
                                         <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="date_paid" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date of Payment" data-error-msg="Payment Date is required!" required>
                                </div>
                            </div>

                        </div>



                    </div>


                    <div class="col-lg-3 col-lg-offset-3">

                        <div class="row" style="">
                            <div class="col-lg-12">
                                <b>* </b> Method : <br />
                                <select id="cbo_payment_method" name="payment_method" class="form-control">
                                    <?php foreach($methods as $method){ ?>
                                        <option value="<?php echo $method->payment_method_id; ?>"><?php echo $method->payment_method; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div  id="div_check_details" class="row" style="display: none;border-radius: 6px; border:1px solid gray;margin: 1%;padding: 1%;padding-bottom: 7%;">


                            <div class="col-lg-12">
                                <label class="radio-inline"><input type="radio" name="check_date_type" value="1" checked>Dated</label>
                                <label class="radio-inline"><input type="radio" name="check_date_type" value="2">Post Dated</label>
                            </div>

                            <div class="col-lg-12">
                                <b>* </b> Check #  : <br />
                                <div class="input-group">
                                    <input type="text" name="check_no" class="form-control">
                                                                     <span class="input-group-addon">
                                                                        <i class="fa fa-code"></i>
                                                                    </span>
                                </div>
                            </div>



                            <div class="col-lg-12">
                               <b>* </b> Check Date : <br />
                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                         <i class="fa fa-calendar"></i>
                                                                    </span>
                                    <input type="text" name="check_date" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date of Payment" data-error-msg="Payment Date is required!" required>
                                </div>
                            </div>




                        </div>

                    </div>


                </div>
            </div>
        </form>

        <br />


        <form id="frm_payment_items">

            <div >
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label><strong>Please select Supplier :</strong></label>
                        <select name="supplier_id" id="cbo_suppliers" data-error-msg="Supplier is required." required>
                            <?php foreach($suppliers as $supplier){ ?>
                                <option value="<?php echo $supplier->supplier_id; ?>" data-tax-type="<?php echo $supplier->tax_type_id; ?>"><?php echo $supplier->supplier_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <br />


                <div class="table-responsive">
                    <table id="tbl_payables" class="table table-striped" cellspacing="0" width="100%" style="font-font:tahoma;border: 1px solid gray;">
                        <thead class="">
                        <tr>
                            <th width="12%">Invoice #</th>
                            <th width="12%">Due Date</th>
                            <th width="12%">Terms</th>
                            <th width="30%">Remarks</th>
                            <th width="12%" style="text-align: right;">Payable</th>
                            <th width="14%">Payment</th>
                            <th width="5%">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>

                        <tr>
                            <td colspan="7" style="height: 50px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><b>Total : </b></td>
                            <td id="td_total_payables" align="right"><b>0.00</b></td>
                            <td id="td_total_payments" align="right"><b>0.00</b></td>
                            <td></td>
                        </tr>

                        </tfoot>
                    </table>
                </div>

            </div>

            <br />

        </form>


        <br />
        <div class="row" style="margin: 3px;">
            Remarks :<br />
            <textarea name="remarks" class="form-control" placeholder="Remarks"></textarea>
        </div>
        <br />

        <div class="row" style="display: none;">
            <div class="col-lg-3 col-lg-offset-9">
                <div class="table-responsive">
                    <table id="tbl_purchase_summary" width="100%" class="table" style="font-family: tahoma;">
                        <tbody>

                        <tr style="border-bottom: 1px solid lightgray;">
                            <td align="right"><strong>Total Payable :</strong></td>
                            <td id="td_total_payable" align="right"><b>0.00</b></td>
                        </tr>

                        <tr style="border-bottom: 1px solid lightgray;">
                            <td align="right"><strong>Total Payment :</strong></td>
                            <td id="td_total_payment" align="right"><b>0.00</b></td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-sm-12">
                    <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>  Record Payment</button>
                    <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
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


<div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content"><!---content--->
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirmation</h4>

            </div>

            <div class="modal-body">
                <p id="modal-body-message">Are you sure you want to cancel this transaction ?</p>
            </div>

            <div class="modal-footer">
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
            </div>
        </div><!---content---->
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




<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>



<!-- twitter typehead -->
<script src="assets/plugins/twittertypehead/handlebars.js"></script>
<script src="assets/plugins/twittertypehead/bloodhound.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.bundle.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>

<!-- touchspin -->
<script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>

<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script>




$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboSuppliers; var _cboTaxType;
    var _cboPaymentMethod;


    var oTableItems={
        qty : 'td:eq(0)',
        unit_price : 'td:eq(3)',
        discount : 'td:eq(4)',
        total_line_discount : 'td:eq(5)',
        tax : 'td:eq(6)',
        total : 'td:eq(7)',
        vat_input : 'td:eq(8)',
        net_vat : 'td:eq(9)'

    };


    var oTableDetails={
        discount : 'tr:eq(0) > td:eq(1)',
        before_tax : 'tr:eq(1) > td:eq(1)',
        tax_amount : 'tr:eq(2) > td:eq(1)',
        after_tax : 'tr:eq(3) > td:eq(1)'
    };


    var initializeControls=function(){
        dt=$('#tbl_payments').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Payable_payments/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control hidden",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "receipt_no" },
                { targets:[2],data: "supplier_name" },
                { targets:[3],data: "remarks" },
                { targets:[4],data: "posted_by_user" },
                { targets:[5],data: "date_paid" },
                { targets:[6],data: "total_paid_amount" },
                {
                    targets:[7],data: "is_active",
                    render: function (data, type, full, meta){
                        if(data=="1"){
                            _attribute='class="fa fa-check-circle" style="color:green;"';
                        }else{
                            _attribute='class="fa fa-times-circle" style="color:red;"';
                            // $('.btn_cancel_or').attr('disabled','disabled');
                        }
                        return '<center><i '+_attribute+'></i></center>';
                    }
                },
                {
                    targets:[8],data: "is_active",
                    render: function (data, type, full, meta){
                        if(data=="1"){
                             return '<center><button type="button" class="btn btn-default btn_cancel_or"><i class="fa fa-times-circle"></i></button></center>';
                        }else{
                            return '<center><button type="button" class="btn btn-default btn_cancel_or" disabled><i class="fa fa-times-circle"></i></button></center>';
                        
                    }
                }
            }
                // {
                //     targets:[8],data: null,
                //     render: function (data, type, full, meta){
                //         return '<center><button type="button" class="btn btn-default btn_cancel_or"><i class="fa fa-times-circle"></i></button></center>';
                //     }

                // }
            ],
            "createdRow": function ( row, data, index ) {
                $('td:eq(6)',row).attr('align','right');
            }
        });


        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Payment" >'+
                '<i class="fa fa-plus"></i> New Payment</button>';
            $("div.toolbar").html(_btnNew);
        }();

        _cboPaymentMethod = $('#cbo_payment_method').select2({
            placeholder: "Please select receipt type.",
            allowClear: false
        });

        _cboBranch = $('#cbo_branch').select2({
            placeholder: "Please select branch.",
            allowClear: false
        });

        _cboReceiptType = $('#cbo_receipt_type').select2({
            placeholder: "Please select receipt type.",
            allowClear: false
        });

        _cboSuppliers=$("#cbo_suppliers").select2({
            placeholder: "Please select supplier to record payment.",
            allowClear: true
        });

        _cboSuppliers.select2('val',null);

        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

    }();






    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_payments tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                var d=row.data();

                console.log(d);

                $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"Templates/layout/po/" + d.purchase_order_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response ).show();
                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                });
            }
        });


        $('#btn_new').click(function(){
            _txnMode="new";
            //$('.toggle-fullscreen').click();
            clearFields($('#frm_payments'));
            _cboSuppliers.select2('val',null);
            showList(false);
        });


        $('#btn_yes').click(function(){
            cancelPayable().done(function(response){
                showNotification(response);
                if(response.stat=="success"){
                    dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                }

            });

        });

        $('#btn_cancel').click(function(){
            showList(true);
        });



        _cboPaymentMethod.on("select2:select", function (e) {
            var method_id=$(this).select2('val');
            if(method_id==2){
                $('#div_check_details').show();
            }else{
                $('#div_check_details').hide();
            }
        });



        _cboSuppliers.on("select2:select", function (e) {
            var supplier_id=$(this).select2('val');


            $.ajax({
                "dataType":"html",
                "type":"GET",
                "url":"Suppliers/transaction/payables?id="+supplier_id,
                "beforeSend": function(){
                    var obj=$("#tbl_payables");
                    showTableLoader(obj);
                    resetSummaryDetails();
                }
            }).done(function(response){
                $('#tbl_payables > tbody').html(response);
                reInitializeNumeric();
                reComputeDetails();
            });


        });



        $('#btn_save').click(function(){

            total = getFloat($('#td_total_payment').text());
            if (total == 0){
                showNotification({
                    "title": "Invalid!",
                    "stat" : "error",
                    "msg" : "Sorry, total payment amount should not be zero."
                });


            } else{
          
            if(validateRequiredFields($('#frm_payments'))){
                if(_txnMode=="new"){
                    postPurchaseInvoicePayment().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            dt.row.add(response.row_added[0]).draw();
                            clearFields($('#frm_payments'));
                            showList(true);
                        }

                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }

            }
            }
        });


        $('#tbl_payments > tbody').on('click','button.btn_cancel_or',function(e){
            _selectRowObj=$(this).closest('tr');
            var d=dt.row(_selectRowObj).data();
            _selectedID= d.payment_id;

            $('#modal_confirmation').modal('show');
        });


        $('#tbl_payables > tbody').on('click','button.btn_set_amount',function(e){
            var row=$(this).closest('tr');
            var payableAmount=getFloat(row.find('input[name="payable_amount[]"]').val());
            row.find('input[name="payment_amount[]"]').val(accounting.formatNumber(payableAmount,2));
            reComputeDetails();
        });

        $('#tbl_payables > tbody').on('keyup','input.numeric',function(e){
            var row=$(this).closest('tr');

            var payment=getFloat($(this).val());
            var payable=getFloat(row.find('input[name="payable_amount[]"]').val());

            if(payment>payable){
                showNotification({
                    "title": "Invalid!",
                    "stat" : "error",
                    "msg" : "Sorry, payment amount is greater than payable amount."
                });

                $(this).val('');
            }

            reComputeDetails();

        });


    })();


    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

            if($(this).is('select')){
                if($(this).select2('val')==0||$(this).select2('val')==null){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }

        });

        return stat;
    };


    var postPurchaseInvoicePayment=function(){

        var _data=$('#frm_payments,#frm_payment_items').serializeArray();
        _data.push({name:"total_paid_amount",value:getFloat($('#td_total_payment').text())});
        _data.push({name:"remarks",value:$('textarea[name="remarks"]').val()});


        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Payable_payments/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };


    var cancelPayable=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Payable_payments/transaction/cancel",
            "data":{payment_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_payment_list').show();
            $('#div_payment_fields').hide();
        }else{
            $('#div_payment_list').hide();
            $('#div_payment_fields').show();
        }
    };

    var showNotification=function(obj){
        PNotify.removeAll(); //remove all notifications
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };



    var showSpinningProgress=function(e){
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
        $(e).toggleClass('disabled');
    };

    var clearFields=function(f){
        $('input:not(.date-picker),textarea',f).val('');
        $(f).find('input:first').focus();
        $('#tbl_payables > tbody').html('');



    };


    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };


    var reInitializeNumeric=function(){
        $('.numeric').autoNumeric('init');
    };

    var reComputeDetails=function(){
        var rows=$('#tbl_payables > tbody > tr');
        var total_payment=0; var total_payable=0;

        $.each(rows,function(i,value){
            var row=$(this);
            total_payment+=getFloat(row.find('input[name="payment_amount[]"]').val());
            total_payable+=getFloat(row.find('input[name="payable_amount[]"]').val());

        });

        $('#td_total_payment').html('<b>'+accounting.formatNumber(total_payment,2)+'</b>');
        $('#td_total_payable').html('<b>'+accounting.formatNumber(total_payable,2)+'</b>');


        $('#td_total_payments').html('<b>'+accounting.formatNumber(total_payment,2)+'</b>');
        $('#td_total_payables').html('<b>'+accounting.formatNumber(total_payable,2)+'</b>');

    };

    var resetSummaryDetails=function(){
        $('#td_total_payment').html('<b>0.00</b>');
        $('#td_total_payable').html('<b>0.00</b>');
    };

    var showTableLoader=function(obj){
        var i=obj.find('thead').find('tr').first().find('th').length;
        obj.find('tbody').html('<tr><td colspan="'+i+'" align="center"><br /><img src="assets/img/loader/ajax-loader-sm.gif" /><br /><br /></td></tr>');
    };






});




</script>


</body>


</html>