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

    <style>
        select {
            width: 100%;
        }

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

        #asset_code {
            text-align: right;
        }

        #txtAcquisitionCost {
            text-align: right;
        }

        #serial_no {
            text-align: right;
        }

        #txtSalvageValue {
            text-align: right;
        }

        .select2-container {
            height: 34px;
        }

        .select2-close-mask{
            z-index: 999999;
        }
        .select2-dropdown{
            z-index: 999999;
        }
        table#fix_extend{
            border: none!important;
        }
/*        table#fix_extend tr:nth-child(odd) {
            background: #303030 !important;
            color: #FFF !important;
        }

        table#fix_extend tr:nth-child(even) {
            background: #414141 !important;
            color: #FFF !important;
        }*/

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

                    <ol class="breadcrumb" style="margin:0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="fixed_asset_management">Fixed Asset Management</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_assets_list">
                                        <div class="panel panel-default">
                                            <!-- <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Fixed Asset Management</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Fixed Asset Management</h2><hr>
                                                <table id="tbl_fixed_management" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th></th>
                                                        <th>Asset Code</th>
                                                        <th>Description</th>
                                                        <th>Location</th>
                                                        <th>Category</th>
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


           

            <div id="modal_create_asset" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog" style="width: 75%;">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"></span></h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_fixed_asset">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-xs-12 col-md-4">
                                            Asset Code : <br>
                                           <div class="input-group">
                                               <span class="input-group-addon">
                                                     <i class="fa fa-code"></i>
                                                </span>
                                               <input class="form-control" type="text" name="asset_code" id="asset_code">
                                           </div>
                                                Asset Description : <br>
                                           <div class="input-group">
                                               <span class="input-group-addon">
                                                     <i class="fa fa-file-text-o"></i>
                                                </span>
                                               <input class="form-control" type="text" name="asset_description">
                                           </div>
                                            Serial No. : <br>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-code"></i>
                                                </span>
                                                <input class="form-control" id="serial_no" type="text" name="serial_no">
                                           </div>
                                           Acquisition Cost : <br>
                                           <div class="input-group">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-credit-card"></i>
                                                </span>
                                                <input id="txtAcquisitionCost" class="form-control numeric" type="text" name="acquisition_cost">
                                           </div>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            Salvage Value : <br>
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                     <i class="fa fa-credit-card"></i>
                                                </span>
                                            <input id="txtSalvageValue" class="form-control numeric" type="text" name="salvage_value">
                                            </div>
                                                Acquisition Date : <br>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>
                                               <input class="date-picker form-control" id="date_acquired_format" value="<?php echo date("m/d/Y"); ?>" type="text" name="date_acquired">
                                            </div>
                                            Location : <br>
                                            <select id="cbo_location" name="location_id" class="form-control" style="width: 100% !important;">
                                                <option value="0">[ Add New Location ]</option>
                                                <?php foreach($locations as $location) { ?>
                                                    <option value="<?php echo $location->location_id; ?>"><?php echo $location->location_name; ?></option>
                                                <?php } ?>
                                            </select><br>
                                            Category : <br>
                                            <select id="cbo_category" name="category_id" class="form-control" style="width: 100% !important;">
                                                <option value="0">[ Add New Category ]</option>
                                                <?php foreach($categories as $category) { ?>
                                                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            Life <i>(in Years)</i> : <br>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-line-chart"></i>
                                                </span>
                                               <input class="form-control" type="text" name="life_years">
                                            </div>
                                            Asset / Property Status : <br>
                                           <select id="cbo_asset_status" name="asset_status_id" class="form-control" style="width: 100% !important;">
                                                <?php foreach($asset_properties as $asset_property) { ?>
                                                    <option value="<?php echo $asset_property->asset_status_id; ?>"><?php echo $asset_property->asset_property_status; ?></option>
                                                <?php } ?>
                                           </select>
                                           Department : <br>
                                           <select id="cbo_department" name="department_id" class="form-control" style="width: 100% !important;">
                                                <option value="0">[ Create New Department ]</option>
                                                <?php foreach($departments as $department) { ?>
                                                    <option value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                                                <?php } ?>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container-fluid">
                                        <div style="padding: 0 1% 0 1%;">
                                            Notes
                                            <textarea class="form-control" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn_save" type="button" class="btn btn-primary"  style="background-color:#2ecc71;color:white;"><span class=""></span>  Save</button>
                                    <button id="btn_cancel_assets" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color: white"><span id="modal_mode"> </span>Confirm Deletion</h4>
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

            <div id="modal_new_department" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #2ecc71">
                             <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                             <h2 id="department_title" class="" style="color:white;">New Department</h2>
                        </div>
                        <div class="modal-body">
                            <form id="frm_department" role="form" class="form-horizontal">
                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Department Name * :</label>
                                            <textarea name="department_name" id="department_txt" class="form-control" data-error-msg="Department Name is required!" placeholder="Department name" required></textarea>

                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                                <label class="">Department Description :</label>
                                                <textarea name="department_desc" id="department_txt_desc" class="form-control" placeholder="Department Description"></textarea>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_save_department" class="btn btn-primary">Save</button>
                            <button id="btn_cancel_department" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_new_category" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#2ecc71;">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h2 id="department_title" class="" style="color:white;">New Category</h2>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form id="frm_category" role="form">
                                        <div class="">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong>* Category Name :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-users"></i>
                                                            </span>
                                                            <input type="text" name="category_name" id="category_txt" class="form-control" placeholder="Category Name" data-error-msg="category name is required!" required>
                                                        </div>
                                                    </div>
                                                </div><br/>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"><strong>* Category Description :</strong></label>
                                                    <div class="col-md-8">
                                                        <textarea name="category_desc" id="category_txt_desc" class="form-control" data-error-msg="Category Description is required!" placeholder="Description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_save_category" class="btn btn-primary" name="btn_save"><span class=""></span> Save</button>
                                <button id="btn_cancel_category" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal_new_location" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    <h2 id="department_title" class="" style="color:white;">New Location</h2>
                                </div>

                                <div class="modal-body">
                                    <form id="frm_location" role="form" class="form-horizontal row-border">
                                        <div class="form-group">
                                            <div style="padding-left: 10px;">
                                                <strong>* Location Name :</strong>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" name="location_name" id="location_txt" class="form-control" placeholder="Location Name" data-error-msg="Location name is required!" required>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button id="btn_save_location" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;""><span class=""></span>  Save Changes</button>
                                    <button id="btn_cancel_location" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
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

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>

<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboLocation; var _cboCategory; var _cboAsset; var _cboDepartments

    var initializeControls=function(){
        dt=$('#tbl_fixed_management').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Fixed_asset_management/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "asset_code" },
                { targets:[2],data: "asset_description" },
                { targets:[3],data: "location_name" },
                { targets:[4],data: "category_name" },
                {
                    targets:[5],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+"&nbsp;"+btn_trash+'</center>';
                    }
                }
            ]
        });

        _cboDepartments=$('#cbo_department').select2({
            placeholder:"Please select Department",
            allowClear:true
        });

       _cboAsset=$('#cbo_asset_status').select2({
            placeholder: "Please Select Asset / Property Status",
            allowClear: true
       });

        _cboCategory=$('#cbo_category').select2({
            placeholder: "Please select Category",
            allowClear: true
        });

        _cboLocation=$('#cbo_location').select2({
            placeholder: "Please select Location",
            allowClear: true
        });

        _cboAsset.select2('val',null);
        _cboCategory.select2('val',null);
        _cboLocation.select2('val',null);
        _cboDepartments.select2('val',null);

        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New unit" >'+
                '<i class="fa fa-plus"></i> New Asset</button>';
            $("div.toolbar").html(_btnNew);
        }();

        $('#div_assets_fields').hide();
    }();

    var bindEventHandlers=(function(){
        var detailRows = [];

        _cboCategory.on('select2:select', function(){
            if(_cboCategory.val() == 0)
                $('#modal_new_category').modal('show');

            $('#btn_save_category').attr('disabled',false);
        });

        _cboLocation.on('select2:select', function(){
            if(_cboLocation.val() == 0)
                $('#modal_new_location').modal('show');

            $('#btn_save_location').attr('disabled', false);
        });

        _cboDepartments.on('select2:select', function(){
            if(_cboDepartments.val() == 0)
                $('#modal_new_department').modal('show');

            $('#btn_save_department').attr('disabled',false);
        });

        $('#btn_cancel_department').on('click', function(){
            clearFields($('#frm_department'));
            _cboDepartments.select2('val',null);
            $('#modal_new_department').modal('hide');
        });

        $('#btn_cancel_location').on('click', function(){
            clearFields($('#frm_location'));
            _cboLocation.select2('val',null);
            $('#modal_new_location').modal('hide');
        });

        $('#btn_cancel_category').on('click', function(){
            clearFields($('#frm_category'));
            _cboCategory.select2('val',null);
            $('#modal_new_category').modal('hide');            
        });

        $('#tbl_fixed_management tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );

                row.child( format( row.data() ),'no-padding' ).show();

                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        $('.numeric').autoNumeric('init',{mDec:2});

        $('#btn_cancel_assets').click(function(){
            $('#modal_create_asset').modal('toggle');
            showList(true);
        });

        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

        $('#btn_new').click(function(){
            _txnMode="new";
            showList(true);
            clearFields($('#frm_fixed_asset'));
            $('.panel-title').html('<i class="fa fa-plus"></i>&nbsp; New Asset');
            _cboLocation.select2('val',null);
            _cboDepartments.select2('val',null);
            _cboCategory.select2('val',null);
            _cboAsset.select2('val',null);
            $('#txtSalvageValue').val('0.00');
            $('#txtAcquisitionCost').val('0.00');
            $('#modal_create_asset').modal('show');
            $('.modal-title').html('Create Fixed Asset');
            $('#date_acquired_format').datepicker('setDate', 'today');
        });

        $('#tbl_fixed_management tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            showList(true);
            $('#modal_create_asset').modal('show');
            $('.modal-title').html('Edit Fixed Asset');
            
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.fixed_asset_id;

            //$('#date_acquired_format').format("dateFormat", 'm/d/y');
            //$('#date_acquired_format').datepicker("option", "dateFormat", 'mm/dd/yyyy');
            //$('#date_acquired_format').datepicker('dateFormat', 'mm/dd/yyyy');
            //$('#date_acquired_format').format('mm/dd/yyyy');

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            $('.panel-title').html('<i class="fa fa-pencil"></i>&nbsp; Edit Asset');
            _cboLocation.select2('val',data.location_id);
            _cboDepartments.select2('val',data.department_id);
            _cboCategory.select2('val',data.category_id);
            _cboAsset.select2('val',data.asset_status_id);
        });

        $('#tbl_fixed_management tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.fixed_asset_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeFixedAsset().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });

        /*$('#btn_cancel').click(function(){
            $('#modal_product_type').modal('hide');
        });*/

        $('#btn_save_location').click(function(){
            if(validateRequiredFields($('#frm_location'))){
                createLocation().done(function(response){
                    showNotification(response);
                    $('#cbo_location').append('<option value="'+ response.row_added[0].location_id +'">'+ response.row_added[0].location_name +'</option>');
                    _cboLocation.select2('val',response.row_added[0].location_id);
                    clearFields($('#frm_location'));
                    $('#modal_new_location').modal('hide');
                    $('#btn_save_location').attr('disabled', true);
                });
            }
        });

        $('#btn_save_department').click(function(){
            if(validateRequiredFields($('#frm_department'))){
                createDepartment().done(function(response){
                    showNotification(response);
                    $('#cbo_department').append('<option value="'+ response.row_added[0].department_id +'">'+ response.row_added[0].department_name +'</option>');

                    _cboDepartments.select2('val',response.row_added[0].department_id);
                    clearFields($('#frm_department'));

                    $('#modal_new_department').modal('hide');
                    $('#btn_save_department').attr('disabled',true);
                });
            }
        });

        $('#btn_save_category').click(function(){
            if(validateRequiredFields($('#frm_category'))){
                createCategory().done(function(response){
                    showNotification(response);
                    $('#btn_save_category').attr('disabled',true);
                    if(response.stat=="success"){
                        $('#cbo_category').append('<option value="'+ response.row_added[0].category_id +'">'+ response.row_added[0].category_name +'</option>');
                        _cboCategory.select2('val',response.row_added[0].category_id);
                        $('#btn_save_category').attr('disabled',false);
                        $('#modal_new_category').modal('hide');
                        clearFields($('#frm_category'));
                    }
                }).always(function(){
                    showSpinningProgress($('#btn_save_category'));
                });
        }
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields($('#frm_fixed_asset'))){
                if(_txnMode=="new"){
                    createFixedAsset().done(function(response){
                        showNotification(response);
                        $('#btn_save_category').attr('disabled',true);
                        if(response.stat=="success"){
                            dt.row.add(response.row_added[0]).draw();
                            clearFields($('#frm_fixed_asset'));
                            showList(true);
                            $('#btn_save_category').attr('disabled',false);
                        }
                    }).always(function(){
                        $('#modal_create_asset').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateFixedAsset().done(function(response){
                        showNotification(response);
                        $('#btn_save_category').attr('disabled',true);
                        if(response.stat=="success"){
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields($('#frm_fixed_asset'));
                            $('#btn_save_category').attr('disabled',false);
                        }
                    }).always(function(){
                        $('#modal_create_asset').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
                }
            }
        });
    })();

    var validateRequiredFields=function(){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea','#frm_product_type').each(function(){
            if($(this).val()==""){
                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                $(this).closest('div.form-group').addClass('has-error');
                stat=false;
                return false;
            }
        });
        return stat;
    };

    var createFixedAsset=function(){
        var _data=$('#frm_fixed_asset').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Fixed_asset_management/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateFixedAsset=function(){
        var _data=$('#frm_fixed_asset').serializeArray();
        _data.push({name : "fixed_asset_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Fixed_asset_management/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeFixedAsset=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Fixed_asset_management/transaction/delete",
            "data":{fixed_asset_id : _selectedID}
        });
    };

    var createLocation=function(){
        var _data=$('#frm_location').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Locations/transaction/create",
            "data":_data
        });
    };

    var createDepartment=function(){
        var _data=$('#frm_department').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Departments/transaction/create",
            "data":_data
        });
    };

    var createCategory=function(){
        var _data=$('#frm_category').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Categories/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save_category'))
        });
    };

    var showList=function(b){
        if(b){
            $('#div_assets_list').show();
            $('#div_assets_fields').hide();
        }else{
            $('#div_assets_list').hide();
            $('#div_assets_fields').show();
        }
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
        $(e).toggleClass('disabled');
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };

    $('#txtAcquisitionCost').keypress(validateNumber);

    $('#txtSalvageValue').keypress(validateNumber);

    function validateNumber(event) {
        var key = window.event ? event.keyCode : event.which;

        if (event.keyCode === 8 || event.keyCode === 46
            || event.keyCode === 37 || event.keyCode === 39 || key === 188) {
            return true;
        }
        else if ( key < 48 || key > 57 ) {
            return false;
        }
        else return true;
    };

    var clearFields=function(frm){
        $('input,textarea,select', frm).val('');
        $('form').find('input:first').focus();
        $('#location_txt').val('');
        $('#category_txt').val('');
        $('#category_txt_desc').val('');
        $('#department_txt').val('');
        $('#department_txt_desc').val('');
    };

    function format ( d ) {
        return '<table style="width: 80%;" id="fix_extend">' +
            '<tbody>' +
                '<tr>' +
                    '<td width="15%"><b>Asset Code :</b></td><td>'+ d.asset_code +'</td>' +
                    '<td width="15%"><b>Asset Description :</b></td><td>'+ d.asset_description +'</td>' +
                    '<td width="15%"><b>Serial no. :</b></td><td>'+ d.serial_no +'</td>' +
                '</tr>' +
                '<tr>' +
                    '<td width="15%"><b>Acquisition Cost :</b></td><td>'+ d.acquisition_cost +'</td>' +
                    '<td width="15%"><b>Salvage Value :</b></td><td>'+ d.salvage_value +'</td>' +
                    '<td width="15%"><b>Acquisition Date :</b></td><td>'+ d.date_acquired +'</td>' +
                '</tr>' +
                '<tr>' +
                    '<td width="15%"><b>Location :</b></td><td>'+ d.location_name +'</td>' +
                    '<td width="15%"><b>Category :</b></td><td>'+ d.category_name +'</td>' +
                    '<td width="15%"><b>Life in Years :</b></td><td>'+ d.life_years +'</td>' +
                '</tr>' +
                '<tr>' +
                    '<td width="15%"><b>Asset / Property Status :</b></td><td>'+ d.asset_property_status +'</td>' +
                    '<td width="15%"><b>Department :</b></td><td>'+ d.department_name +'</td>' +
                '</tr>' +
            '</tbody>' +
        '</table>';
    };
});

</script>

</body>

</html>