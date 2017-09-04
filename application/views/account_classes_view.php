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

        #account_type_id {
            z-index:  !important;
        }
        .select2-search,
        .select2-search input {
            color: white;
            font-size: 18px;
            border-width: 1px!important;
        }

        .select2-selection {
            padding-bottom: 10px!important;
            color: white !important;
            font-size: 15px;
            border-width: 1px!important;
            border-radius: 0!important;
        }

        .select2-container{
            min-width: 100%;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
     
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            font-weight: bolder !important;
            font-size: 18px;
        }

        .select2-results__option {

        }

        .select2-results {
            border-width: 1px!important;
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

                    <ol class="breadcrumb" style="margin:0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Account_classes">Account Classes</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_unit_list">
                                        <div class="panel panel-default">
<!--                                             <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Account Classification</b>
                                            </div> -->
                                            
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Account Clasification</h2><hr>
                                                <table id="tbl_account_class" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th>Account Class</th>
                                                        <th>Description</th>
                                                        <th>Account Type</th>
                                                        <th style="display: none;">Account Type ID</th>
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

                                    <!-- <div id="div_unit_fields" style="display: none;">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;"> -->
                                            <!-- <div class="panel-heading">
                                                <h2>Unit Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div>
 -->
                                    <!--         <div class="panel-body">
                                                <h2>Unit Information</h2>
                                                <form id="frm_unit" role="form" class="form-horizontal row-border">
                                                    <div class="form-group">
                                                        <label class="col-md-2 col-md-offset-2 control-label"><strong>* Unit Name :</strong></label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                                    <span class="input-group-addon">
                                                                                        <i class="fa fa-users"></i>
                                                                                    </span>
                                                                <input type="text" name="unit_name" class="form-control" placeholder="Unit Name" data-error-msg="Unit name is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 col-md-offset-2 control-label"><strong>* Unit Description :</strong></label>
                                                        <div class="col-md-4">
                                                            <textarea name="unit_desc" class="form-control" data-error-msg="Unit Description is required!" placeholder="Description" required></textarea>
                                                        </div>
                                                    </div><br/>
                                                </form>
                                            </div>

                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-4">
                                                        <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;""><span class=""></span>  Save Changes</button>
                                                        <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

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
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->

            <div id="modal_account_class" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="modal-title" class="modal-title" style="color: white;"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_account_class" role="form" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-md-3 col-md-offset-1 control-label"><strong><B>* </B> Account Class :</strong></label>
                                    <div class="col-md-7">
                                        <input type="text" name="account_class" class="form-control" placeholder="Account Class" data-error-msg="Unit name is required!" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-md-offset-1 control-label"><strong>Description :</strong></label>
                                    <div class="col-md-7">
                                        <input name="description" class="form-control" placeholder="Description">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-md-offset-1 control-label"><strong><B>* </B> Account Type :</strong></label>
                                    <div class="col-md-7">
                                        <select name="account_type_id" id="account_type_id" data-error-msg="Account Type is required!" placeholder="Account Type" required>
                                            <option value="" disabled selected>Select Account Type</option>
                                        	<?php foreach ($account_types as $account_type) { ?>
                                        		<option value="<?php echo $account_type->account_type_id; ?>"><?php echo $account_type->account_type; ?></option>
                                        	<?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_save" class="btn btn-primary"><span></span>Save</button>
                            <button id="btn_cancel" class="btn btn-default">Cancel</button>
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

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboAccountType;

    var initializeControls=function(){
        dt=$('#tbl_account_class').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Account_classes/transaction/classes_list",
            "columns": [
                { targets:[0],data: "account_class" },
                { targets:[1],data: "description" },
                { targets:[2],data: "account_type" },
                { 
                	targets:[3],
                	data: "account_type_id", 
                	visible: false, 
                	searchable: false 
                },
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

        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New unit" >'+
                '<i class="fa fa-plus"></i> New Account Classification</button>';
            $("div.toolbar").html(_btnNew);
        }();

        _cboAccountType = $('#account_type_id').select2({
            placeholder: "Please select account type.",
            allowClear: true
        });
         _cboAccountType.select2('val',null);
    }();

    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_account_class tbody').on( 'click', 'tr td.details-control', function () {
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
                row.child( format( row.data() ) ).show();
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        $('#btn_new').click(function(){
            _txnMode="new";
            $('#modal-title').text('New Account Class');
            $('#modal_account_class').modal('show');
            _cboAccountType.select2('val',null);
            clearFields();
        });

        $('#tbl_account_class tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.account_class_id;

            $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });
            $('#modal-title').text('Edit Account Class');
            $('#modal_account_class').modal('show');
        });

        $('#tbl_account_class tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.account_class_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeAccountClass().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });

        $('#account_type_id').select2({
            dropdownParent: $('#modal_account_class')
        });

        $('#btn_cancel').click(function(){
            $('#modal_account_class').modal('hide');
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields()){
                if(_txnMode=="new") {
                    createAccountClass().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields();
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                } else {
                    updateAccountClass().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields();
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }
                $('#modal_account_class').modal('hide');
            }
        });
    })();

    var validateRequiredFields=function(){
        // var stat=true;

        // $('div.form-group').removeClass('has-error');
        // $('input[required],textarea','#frm_account_class').each(function(){
        //     if($(this).val()==""){
        //         showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
        //         $(this).closest('div.form-group').addClass('has-error');
        //         stat=false;
        //         return false;
        //     }
        // });
        // return stat;




        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],select[required]').each(function(){
                if($(this).is('select')){
                    if($(this).val()==0 || $(this).val()==null || $(this).val()==undefined || $(this).val()==""){
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

    var createAccountClass=function(){
        var _data=$('#frm_account_class').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_classes/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateAccountClass=function(){
        var _data=$('#frm_account_class').serializeArray();
        _data.push({name : "account_class_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_classes/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeAccountClass=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_classes/transaction/delete",
            "data":{ account_class_id : _selectedID }
        });
    };

    var showList=function(b){
        if(b){
            $('#div_unit_list').show();
            $('#div_unit_fields').hide();
        }else{
            $('#div_unit_list').hide();
            $('#div_unit_fields').show();
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
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
        $(e).toggleClass('disabled');
    };

    var clearFields=function(){
        $('input[required],textarea,select','#frm_account_class').val('');
        $('form').find('input:first').focus();
    };

    function format ( d ) {
        return '<br /><table style="margin-left:10%;width: 80%;">' +
        '<thead>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td>Unit Name : </td><td><b>'+ d.unit_name+'</b></td>' +
        '</tr>' +
        '<tr>' +
        '<td>Unit Description : </td><td>'+ d.unit_desc+'</td>' +
        '</tr>' +
        '</tbody></table><br />';
    };
});

</script>

</body>

</html>