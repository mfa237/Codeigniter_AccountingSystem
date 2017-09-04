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
    <link href="assets/css/dark-theme.css" rel="stylesheet">

    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">


    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">


    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        html{
            zoom: 0.82;
            zoom: 82%;
        }
        .select2-container {
            min-width: 100%;
            z-index: 999999999;
        }
    </style>



    <?php echo $_switcher_settings; ?>
    <?php echo $_def_js_files; ?>


    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


    <!-- Date range use moment.js same as full calendar plugin -->
   

    <style>

        .toolbar{
            float: left;
            margin-bottom: 0px !important;
            padding-bottom: 0px !important;
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
        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

       /* .container-fluid {
            padding: 0 !important;
        }

        .panel-body {
            padding: 0 !important;
        }*/

        #btn_new {
            text-transform: capitalize !important;
        }

        .modal-body {
            text-transform: bold;
        }

        .boldlabel {
            font-weight: bold;
        }

        .inlinecustomlabel {
            font-weight: bold;
        }


        .numeric{
            text-align: right;
        }

        #is_tax_exempt {
            width:23px;
            height:23px;
        }

        #modal_new_supplier {
            padding-left:0px !important;
        }

        .input-group {
            padding:0;
            margin:0;
        }

        .btn-back {
            float: left; 
            border-radius: 50px; 
            border: 3px solid #9E9E9E!important; 
            background: transparent; 
            margin-right: 10px;
        }

        textarea {
            resize: none;
        }

        #supplier-modal p {
            margin-left: 20px !important;
        }

        #img_user {
            padding-bottom: 15px;
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

                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Services" id="filter">Services</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_service_list">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Services</b>
                                            </div>
                                            <div class="panel-body table-responsive">
                                                <button class="btn btn-primary" id="btn_new" style="float: left; text-transform: capitalize;font-family: Tahoma, Georgia, Serif;margin-bottom: 0px !important;" data-toggle="modal" data-target="" data-placement="left" title="Create New Service" ><i class="fa fa-plus"></i> Create New Service</button>
                                                <table id="tbl_services" class="" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>    
                                                        <th></th>
                                                        <th>PLU</th>
                                                        <th>Service Description</th>
                                                        <th>Service Amount</th>
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

                                </div>
                            </div>
                        </div>
                    </div> <!-- .container-fluid -->

                </div> <!-- #page-content -->
            </div>

            <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"  style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div><!---modal-->

            <div id="modal_units" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="unit_title" class="modal-title" style="color: white;"> New Unit</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_unit" role="form" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-md-3 col-md-offset-1 control-label"><strong>* Service Unit Name :</strong></label>
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-tag"></i>
                                            </span>
                                            <input type="text" name="service_unit_name" class="form-control" placeholder="Unit Name" data-error-msg="Unit name is required!" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-md-offset-1 control-label"><strong>* Service Unit Description :</strong></label>
                                    <div class="col-md-7">
                                        <textarea name="service_unit_desc" class="form-control" data-error-msg="Unit Description is required!" placeholder="Description" required></textarea>
                                    </div>
                                </div><br/>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_save_unit" class="btn btn-primary">Save</button>
                            <button id="btn_cancel_unit" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="modal_create_service" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog" style="width: 75%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Service Information</h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_service">
                                <div class="row">

                                    <div class="col-lg-4">

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">PLU / Service Code * :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="service_code" id="service_code" class="form-control" value="" data-error-msg="PLU is required." required>
                                                </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom:0px;">
                                                <label class="">Service Description * :</label>
                                                <textarea name="service_desc" id="service_desc" class="form-control" data-error-msg="Service Description is required." required></textarea>
                                        </div>

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Unit of Measurement * :</label>
                                            <select name="service_unit" id="service_unit" class="indexing" data-error-msg="Unit is required." required>
                                             
                                                <option value="0">[ Create Unit ]</option>
                                                <?php
                                                foreach($units as $row)
                                                {
                                                    echo '<option value="'.$row->service_unit_id.'">'.$row->service_unit_name.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>



                                    <div class="col-lg-4" style="margin:0px;">

                                        <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="">Link to Credit Account :</label>

                                                    <select name="income_account_id" id="income_account_id" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="0">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>

                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="">Link to Debit Account :</label>

                                                    <select name="expense_account_id" id="expense_account_id" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="0">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                        </div>
                                        <div class="form-group" style="">
                                        <label>Service Amount</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="service_amount" class="form-control numeric">
                                            </div>
                                    </div>



                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_save" type="button" class="btn btn-primary" style="background-color:#2ecc71;color:white;"><span></span> Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->







                <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
                </div>




            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2017 - JDEV IT BUSINESS SOLUTION</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>

        </div>
    </div>
</div>





</body>
 <script src="assets/plugins/fullcalendar/moment.min.js"></script>
    <!-- Data picker -->
    <script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Select2 -->
    <script src="assets/plugins/select2/select2.full.min.js"></script>


    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="assets/js/plugins/fullcalendar/moment.min.js"></script>
    <!-- Data picker -->
    <script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

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
    var dt; var _txnMode; var _selectedID; var _selectRowObj; 
 var _cboMeasurement; var _cboCredit; var _cboDebit;

    

    var initializeControls=function() {
        dt=$('#tbl_services').DataTable({
            "fnInitComplete": function (oSettings, json) {
                $.unblockUI();
                },
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "pageLength":15,
            "ajax" : "Services/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "service_code" },
                { targets:[2],data: "service_desc" },
                { targets:[3],data: "service_amount" ,
                      render: $.fn.dataTable.render.number( ',', '.', 2 )
                },
                {
                    targets:[4],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit" style="margin-left:-5px;"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-danger btn-sm" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash" style="margin-right:-5px;"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ],

            language: {
                         searchPlaceholder: "Search"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(4).attr({
                    "align": "right"
                });
            }


        });

        $('.numeric').autoNumeric('init',{mDec:2});


        _cboMeasurement=$('#service_unit').select2({
            placeholder: "Please select unit.",
            allowClear: true
        });

        _cboCredit=$('#income_account_id').select2({
            allowClear: false
        });

        _cboDebit=$('#expense_account_id').select2({
            allowClear: false
        });


    }();
    


    var bindEventHandlers=(function(){
        var detailRows = [];
        _cboMeasurement.on('select2:select', function(){
            if (_cboMeasurement.val() == 0) {
                clearFields($('#frm_unit'));
                $('#modal_units').modal('show');
                $('#modal_create_service').modal('hide');
                // alert('ha');
            }
        });

        $('#btn_cancel_unit').on('click', function(){
            $('#modal_units').modal('hide');
            $('#modal_create_service').modal('show');
            _cboMeasurement.select2('val',null);
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            $('#modal_create_service').modal('show');
            clearFields($('#frm_service'));
            _cboMeasurement.select2('val',null);
            _cboCredit.select2('val',0);
            _cboDebit.select2('val',0);

        });

        $('#tbl_services tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";

            $('#modal_create_service').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.service_id;

            clearFields('#frm_service');
             $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });



            _cboMeasurement.select2('val',data.service_unit);

            _cboCredit.select2('val',data.income_account_id);

            _cboDebit.select2('val',data.expense_account_id);

        });



        $('input[name="purchase_cost"],input[name="markup_percent"],input[name="sale_price"]').keyup(function(){
            reComputeSRP();
        });

        $('#tbl_services tbody').on('click','button[name="remove_info"]',function(){
            $('#modal_confirmation').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.service_id;

        });
        

        $('#btn_yes').click(function(){
            removeService().done(function(response){
                showNotification(response);
                if(response.stat == 'success') {
                    dt.row(_selectRowObj).remove().draw();
                }
            });
        });


        $('#btn_cancel').click(function(){
            $('#modal_create_service').modal('hide');
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields($('#frm_service'))){
                if(_txnMode=="new"){
                    createService().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                     
                    }).always(function(){
                        $('#modal_create_service').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateService().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                      
                    }).always(function(){
                        $('#modal_create_service').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
                }
            }
        });

        $('#btn_save_unit').click(function(){
            var btn=$(this);
            if(validateRequiredFields($('#frm_unit'))){
                var data=$('#frm_unit').serializeArray();
                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Service_unit/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_units').modal('hide');
                    $('#modal_create_service').modal('show');
                    var _measurement=response.row_added[0];
                    $('#service_unit').append('<option value="'+_measurement.service_unit_id+'" selected>'+ _measurement.service_unit_name + '</option>');
                    $('#service_unit').select2('val',_measurement.service_unit_id);
                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });



    
    })();

    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                    if($(this).val()==null || $(this).val()==""){
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

    var createService=function(){
        var _data=$('#frm_service').serializeArray();
       // _data.push({name : "is_tax_exempt" ,value : _isTaxExempt});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Services/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateService=function(){
        var _data=$('#frm_service').serializeArray();
        //_data.push({name : "is_tax_exempt" ,value : _isTaxExempt});
        _data.push({name : "service_id" ,value : _selectedID});

        return $.ajax({ 
            "dataType":"json",
            "type":"POST",
            "url":"Services/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeService=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Services/transaction/delete",
            "data":{service_id : _selectedID}
        });
    };


    var showNotification=function(obj){
        PNotify.removeAll();
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
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
    };



    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };



});

</script>


</html>