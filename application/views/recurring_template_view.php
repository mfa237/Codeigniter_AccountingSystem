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

        .select2-container { 
            width: 100% !important; 
        } 

        .select2-close-mask{
            z-index: 999999;
        }
        .select2-dropdown{
            z-index: 999999;
        }

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

                    <ol class="breadcrumb">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="recurring_template">Recurring Template</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div class="panel panel-default">
                           <!--  <div class="panel-heading">
                                <b style="color:white;font-size: 12pt;" class="panel-title"><i class="fa fa-bars"></i> Recurring Template </b>
                            </div> -->
                            <div class="panel-body">
                            <h2 class="h2-panel-heading">Recurring Template</h2><hr>
                                <div id="panel_list">
                                    <button id="btn_create" class="btn btn-primary pull-left" style="text-transform: capitalize;"><i class="fa fa-plus"></i>&nbsp; Create New Template</button>
                                    <table id="tbl_recurring_templates" class="table table-striped" width="100%">
                                        <thead>
                                            <th>Book Type</th>
                                            <th>Template Code</th>
                                            <th>Template Description</th>
                                            <th>Payee / Particular</th>
                                            <th><center>Action</center></th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div id="panel_entry">
                                    <div class="row">
                                    <form id="frm_journal" role="form">
                                        <div class="container-fluid">
                                            <div class="container-fluid group-box">
                                                <div class="col-xs-12 col-md-4">
                                                    <strong>* Template Code :</strong>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-code"></i>
                                                        </div>
                                                        <input type="text" name="template_code" class="form-control" data-error-msg="Template Code is required!" placeholder="Enter Template Code" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-4">
                                                    <strong>* Template Description :</strong><br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-code"></i>
                                                        </div>
                                                        <input type="text" name="template_description" class="form-control" data-error-msg="Template Description is required!" placeholder="Enter Template Description" required>
                                                    </div>
                                                </div>
                                                <div id="show_gj">
                                                    <div class="col-xs-12 col-md-4">
                                                        <strong>* Particular :</strong><br>
                                                        <select id="cbo_particulars" name="particular_id" class="show-tick form-control" data-live-search="true" data-error-msg="Particular is required!" placeholder="Enter Particular" required>
                                                            <optgroup label="Customers">
                                                                <?php foreach($customers as $customer){ ?>
                                                                    <option value='C-<?php echo $customer->customer_id; ?>'><?php echo $customer->customer_name; ?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                            <optgroup label="Suppliers">
                                                                <?php foreach($suppliers as $supplier){ ?>
                                                                    <option value='S-<?php echo $supplier->supplier_id; ?>'><?php echo $supplier->supplier_name; ?></option>
                                                                <?php } ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="show_cdj">
                                                    <div class="col-xs-12 col-md-4">
                                                        <strong>* Supplier :</strong><br>
                                                        <select id="cbo_supplier" name="particular_id" class="show-tick form-control" data-live-search="true">
                                                            <?php foreach($suppliers as $supplier){ ?>
                                                                <option value='S-<?php echo $supplier->supplier_id; ?>'><?php echo $supplier->supplier_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="container-fluid group-box">
                                                <div style="width: 100%;">
                                                    <table id="tbl_entries" class="table table-striped">
                                                        <thead class="">
                                                        <tr>
                                                            <th style="width: 30%;">Account</th>
                                                            <th style="width: 30%;">Memo</th>
                                                            <th style="width: 15%;text-align: right;">Dr</th>
                                                            <th style="width: 15%;text-align: right;">Cr</th>
                                                            <th align="center">Action</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" title="Please select Student">
                                                                    <?php foreach($accounts as $account){ ?>
                                                                        <option value='<?php echo $account->account_id; ?>'><?php echo $account->account_title; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="memo[]" class="form-control"></td>
                                                            <td><input type="text" name="dr_amount[]" class="form-control numeric text-right"></td>
                                                            <td><input type="text" name="cr_amount[]" class="form-control numeric text-right"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                                                <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" title="Please select Student">
                                                                    <?php foreach($accounts as $account){ ?>
                                                                        <option value='<?php echo $account->account_id; ?>'><?php echo $account->account_title; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="memo[]" class="form-control"></td>
                                                            <td><input type="text" name="dr_amount[]" class="form-control numeric text-right"></td>
                                                            <td><input type="text" name="cr_amount[]" class="form-control numeric text-right"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                                                <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
                                                            </td>
                                                        </tr>

                                                        </tbody>

                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="2" align="right"><strong>Total</strong></td>
                                                            <td align="right"><strong>0.00</strong></td>
                                                            <td align="right"><strong>0.00</strong></td>
                                                            <td></td>
                                                        </tr>
                                                        </tfoot>


                                                    </table>

                                                </div>


                                                <hr />
                                                <label>Remarks :</label><br />
                                                <textarea name="remarks" class="form-control col-lg-12"></textarea>

                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button id="btn_save_entry" class="btn btn-primary" style="text-transform: capitalize;"><span class=""></span> Save Changes</button>
                                <button id="btn_cancel_entry" class="btn btn-default" style="text-transform: capitalize;">Cancel</button>
                            </div>
                        </div>
                        <table id="table_hidden" class="hidden">
                            <tr>
                                <td>
                                    <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" title="Please select Student">
                                        <?php foreach($accounts as $account){ ?>
                                            <option value='<?php echo $account->account_id; ?>'><?php echo $account->account_title; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="text" name="memo[]" class="form-control"></td>
                                <td><input type="text" name="dr_amount[]" class="form-control numeric text-right"></td>
                                <td><input type="text" name="cr_amount[]" class="form-control numeric text-right"></td>
                                <td>
                                    <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                    <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div> <!-- .container-fluid -->

                </div> <!-- #page-content -->
            </div>

            <div id="modal_booktype" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" style="color: white;">Please Select Book Type</h3>
                        </div>
                        <div class="modal-body">
                            <strong>Book Type :</strong>
                            <select id="cboBookType" class="form-control">
                                <option value="GJE">General Journal</option>
                                <option value="CDJ">Cash Disbursement Journal</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_accept" class="btn btn-primary">Accept</button>
                            <button id="btn_cancel" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Confirm Deletion</h4>

                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div><!---content-->
                </div>
            </div><!---modal-->

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

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script>

$(document).ready(function(){
    var dt; var _txnMode; var bookType; var _cboBookType;
 
    var oTBJournal={
        "dr" : "td:eq(2)",
        "cr" : "td:eq(3)"
    };

    var oTFSummary={
        "dr" : "td:eq(1)",
        "cr" : "td:eq(2)"
    };

    var initializeControls=function(){
        $('#cbo_particulars').select2({
            placeholder: "Select Particular"
        });

        $('#cbo_supplier').select2({
            placeholder: "Select Supplier"
        });

        $('#cbo_particulars').select2('val',null);
        $('#cbo_supplier').select2('val',null);

        dt=$('#tbl_recurring_templates').DataTable({
            "dom":'<"toolbar">frtip',
            "bLengthChange": false,
            "bPaginate":true, 
            language: { 
                "searchPlaceholder": "Search Template" 
            },
            "ajax" : "Recurring_template/transaction/list",
            "columns": [
                { targets:[0],data: "book_type" },
                { targets:[1],data: "template_code" },
                { targets:[2],data: "template_description" },
                { targets:[3],data: "particular" },
                {
                    targets:[4],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ]
        });

        _cboBookType=$('#cboBookType').select2({
            placeholder: "Please Select Book Type",
            allowClear: true
        });

        _cboBookType.select2('val',null);

        reInitializeNumeric();
        reInitializeDropDownAccounts($('#tbl_entries'));
        showList(true);
    }();

    var bindEventHandlers=function() {
        $('#btn_accept').on('click', function(){
            _txnMode="new";
            showBookType($('#cboBookType').val());
            clearFields($('#frm_journal'));
            showList(false);
            $('#modal_booktype').modal('hide');
        });

        $('#btn_cancel').on('click', function(){
            $('#modal_booktype').modal('hide');
        });

        $('#btn_create').on('click',function(){
            $('#modal_booktype').modal('show');
        });

        $('#btn_cancel_entry').click(function(){
            showList(true);
            $('.panel-title').html('<i class="fa fa-bars"></i> Recurring Template');
        });

        $('#btn_yes').click(function(){
            removeTemplate().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });

        $('#tbl_recurring_templates').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.template_id;

            $('#modal_confirmation').modal('show');
        });

        $('#tbl_recurring_templates').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";

            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.template_id;


            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            if (data.book_type == 'CDJ') {
                $('#cbo_supplier').select2('val',data.particular_id);
            } else {
                $('#cbo_particulars').select2('val',data.particular_id);
            }

            bookType = data.book_type;

            showBookType(data.book_type);

            $.ajax({
                url: 'Recurring_template/transaction/get-entries?id=' + data.template_id,
                type: 'GET',
                cache: false,
                dataType: 'html',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#tbl_entries > tbody').html('<tr><td align="center" colspan="4"><br /><img src="assets/img/loader/ajax-loader-sm.gif" /><br /><br /></td></tr>');
                }
            }).done(function(response){
                $('#tbl_entries > tbody').html(response);
                reInitializeNumeric();
                reInitializeDropDownAccounts($('#tbl_entries'));
                reComputeTotals($('#tbl_entries'));
            });

            showList(false);

        });

        //add account button on table
        $('#tbl_entries').on('click','button.add_account',function(){

            var row=$('#table_hidden').find('tr');
            row.clone().insertAfter('#tbl_entries > tbody > tr:last');

            reInitializeNumeric();
            reInitializeDropDownAccounts($('#tbl_entries'));

        });

        var _oTblEntries=$('#tbl_entries > tbody');
        _oTblEntries.on('keyup','input.numeric',function(){
            var _oRow=$(this).closest('tr');

            if(_oTblEntries.find(oTBJournal.dr).index()===$(this).closest('td').index()){ //if true, this is Debit amount
                if(getFloat(_oRow.find(oTBJournal.dr).find('input.numeric').val())>0){
                    _oRow.find(oTBJournal.cr).find('input.numeric').val('0.00');
                }
            }else{

                if(getFloat(_oRow.find(oTBJournal.cr).find('input.numeric').val())>0) {
                    _oRow.find(oTBJournal.dr).find('input.numeric').val('0.00');
                }
            }


            reComputeTotals($('#tbl_entries'));
        });

        $('#tbl_entries').on('click','button.remove_account',function(){
            var oRow=$('#tbl_entries > tbody tr');

            if(oRow.length>1){
                $(this).closest('tr').remove();
            }else{
                showNotification({"title":"Error!","stat":"error","msg":"Sorry, you cannot remove all rows."});
            }

            reComputeTotals($('#tbl_entries'));

        });


        $('#tbl_accounts_receivable').on('click','button[name="cancel_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.journal_id;
            $('#modal_confirmation').modal('show');
        });

        $('#btn_save_entry').on('click',function(){
            if (validateRequiredFields($('#frm_journal'))) {
                if (_txnMode=="new"){
                    createTemplate().done(function(response){
                        showNotification(response);
                        $('#btn_save_entry').attr('disabled',true);
                        if(response.stat=="success"){
                            dt.row.add(response.row_added[0]).draw();
                            clearFields($('#frm_journal'));
                            showList(true);
                            $('#btn_save_entry').attr('disabled',false);
                        }
                    }).always(function(){
                        showSpinningProgress($('#btn_save_entry'));
                    });
                } else {
                    updateTemplate().done(function(response){
                        showNotification(response);
                        $('#btn_save_entry').attr('disabled',true);
                        if(response.stat=="success"){
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields($('#frm_journal'));
                            showList(true);
                            $('#btn_save_entry').attr('disabled',false);
                        }
                    }).always(function(){
                        showSpinningProgress($('#btn_save_entry'));
                    });
                }
                $('.panel-title').html('<i class="fa fa-bars"></i> Recurring Template');
            }
        });
    }();

    var isBalance=function(){
        var oRow=$('#tbl_entries > tfoot tr');
        var dr=getFloat(oRow.find(oTFSummary.dr).text());
        var cr=getFloat(oRow.find(oTFSummary.cr).text());

        return (dr==cr);
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
    };

    var clearFields=function(f){
        $('input,textarea',f).val('');

        $(f).find('input:first').focus();
        $('#tbl_entries > tbody tr').slice(2).remove();

        $('#tbl_entries > tfoot tr').find(oTFSummary.dr).html('<b>0.00</b>');
        $('#tbl_entries > tfoot tr').find(oTFSummary.cr).html('<b>0.00</b>');
        $('#cbo_particulars').select2('val',null);
        $('#cbo_supplier').select2('val',null);
    };

    var createTemplate=function(){
        var _data=$('#frm_journal').serializeArray();
        _data.push({name: 'book_type', value: $('#cboBookType').val() });
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Recurring_template/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save_entry'))
        });
    };

    var updateTemplate=function(){
        var _data=$('#frm_journal').serializeArray();
        _data.push({name: 'book_type', value: bookType});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Recurring_template/transaction/update?id="+_selectedID,
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save_entry'))
        });
    };

    var removeTemplate=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Recurring_template/transaction/delete",
            "data":{template_id : _selectedID}
        });
    };

    function showList(b){
        if(b == true) {
            $('#panel_list').show();
            $('#panel_entry').hide();
            $('.panel-footer').hide();
        } else {
            $('#panel_list').hide();
            $('#panel_entry').show();
            $('.panel-footer').show();
        }
    };

    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };

    var reComputeTotals=function(tbl){
        var oRows=tbl.find('tbody tr');
        var _DR_amount=0.00; var _CR_amount=0.00;

        $.each(oRows,function(i,value){
            _DR_amount+=getFloat($(this).find(oTBJournal.dr).find('input.numeric').val());
            _CR_amount+=getFloat($(this).find(oTBJournal.cr).find('input.numeric').val());
        });

        tbl.find('tfoot tr').find(oTFSummary.dr).html('<b>'+accounting.formatNumber(_DR_amount,2)+'</b>');
        tbl.find('tfoot tr').find(oTFSummary.cr).html('<b>'+accounting.formatNumber(_CR_amount,2)+'</b>');
    };

    function reInitializeDropDownAccounts(tbl){
        tbl.find('select.selectpicker').select2({
            placeholder: "Please select account.",
            allowClear: false
        });
    };

    function reInitializeNumeric(){
        $('.numeric').autoNumeric('init');
    };

    function showBookType(bt) {
        if (bt == 'GJE') {
            $('#show_gj').show();
            $('#show_cdj').hide();
            $('.panel-title').html('<i class="fa fa-bars"></i> Recurring Template (General Journal)');
        } else {
            $('#show_gj').hide();
            $('#show_cdj').show();
            $('.panel-title').html('<i class="fa fa-bars"></i> Recurring Template (Cash Disbursement)');
        }
    };

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


        if(!isBalance()){
            showNotification({title:"Error!",stat:"error",msg:'Please make sure Debit and Credit amount are equal.'});
            stat=false;
        }

        return stat;
    };
});

</script>

</body>

</html>