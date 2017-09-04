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

                            <ol class="breadcrumb" style="margin:0;">
                                <li><a href="dashboard">Dashboard</a></li>
                                <li><a href="Salesperson">Salesperson</a></li>
                            </ol>

                            <div class="container-fluid">
                                <div data-widget-group="group1">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="div_category_list">
                                                <div class="panel panel-default">
                                                    <!-- <div class="panel-heading">
                                                        <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Sales Person</b>
                                                    </div> -->
                                                    <div class="panel-body table-responsive">
                                                    <h2 class="h2-panel-heading">Salesperson</h2><hr>
                                                        <table id="tbl_salesperson" class="table table-striped" cellspacing="0" width="100%">
                                                            <thead class="">
                                                            <tr>
                                                                <!-- <th>Acronym Name</th> -->
                                                                <th>Salesperson</th>
                                                                <th>Department</th>
                                                                <th><center>Action</center></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- <div class="panel-footer"></div> -->
                                                </div>
                                            </div>
                                            <!-- <div id="div_category_fields" style="display: none;">
                                                <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                                   <!--  <div class="panel-heading">
                                                        <h2>Category Information</h2>
                                                        <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                                    </div> -->

                                                    <!-- <div class="panel-body">
                                                    <h2>Categories</h2>
                                                        <form id="frm_payment_method" role="form" class="form-horizontal row-border">
                                                            <div class="form-group">
                                                                <label class="col-md-2 col-md-offset-2 control-label"><strong>* Category Name :</strong></label>
                                                                <div class="col-md-4">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-users"></i>
                                                                        </span>
                                                                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" data-error-msg="category name is required!" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-3 col-md-offset-1 control-label"><strong>* Category Description :</strong></label>
                                                                <div class="col-md-4">
                                                                    <textarea name="category_desc" class="form-control" data-error-msg="Category Description is required!" placeholder="Description" required></textarea>
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
                        </div><!-content-->
                    </div>
                </div><!---modal-->
                <div id="modal_new_salesperson" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#2ecc71;">
                                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                                <h4 id="salesperson_title" class="modal-title" style="color: #ecf0f1;"><span id="modal_mode"></span></h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form id="frm_salesperson" role="form">
                                        <div class="">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> Salesperson Code :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="salesperson_code" class="form-control" placeholder="Salesperson Code" data-error-msg="Salesperson Code is required!" required>
                                                    </div>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> First name :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="firstname" class="form-control" placeholder="Firstname" data-error-msg="Firstname is required!" required>
                                                    </div>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong>&nbsp;&nbsp;Middle name :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="middlename" class="form-control" placeholder="Middlename">
                                                    </div>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> Last name :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="lastname" class="form-control" placeholder="Last name">
                                                    </div>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong>Contact Number :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Contact Number">
                                                    </div>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <label class="col-xs-12 col-md-4 control-label "><strong>Department :</strong></label>
                                                <div class="col-xs-12 col-md-8">
                                                    <select name="department_id" id="cbo_department" class="form-control" data-error-msg="Department is required!" style="width: 100%;">
                                                        <option value="0">[ Create New Department ]</option>
                                                        <?php foreach($departments as $department) { ?>
                                                            <option value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><br><br>
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong>TIN Number:</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <input type="text" name="tin_no" id="tin_no" class="form-control" placeholder="TIN Number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_save" class="btn btn-primary" name="btn_save"><span></span>Save</button>
                                <button id="btn_cancel" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal_new_department" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #2ecc71">
                             <h2 id="department_title" class="modal-title" style="color:white;">Create New Department</h2>
                        </div>
                        <div class="modal-body">
                            <form id="frm_department" role="form" class="form-horizontal">
                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><font color="red">*</font> Department Name :</label>
                                            <textarea name="department_name" class="form-control" data-error-msg="Department Name is required!" placeholder="Department name" required></textarea>

                                        </div>
                                    </div>
                                </div>


                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Department Description :</label>
                                            <textarea name="department_desc" class="form-control" placeholder="Department Description"></textarea>

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

    <script src="assets/plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script>

    $(document).ready(function(){
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboDepartment;

        var initializeControls=function(){
            dt=$('#tbl_salesperson').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Salesperson/transaction/list",
                "columns": [
                    { targets:[0],data: "fullname" },
                    { targets:[1],data: "department_name" },
                    {
                        targets:[2],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                            return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                        }
                    }
                ]
            });

            _cboDepartment=$('#cbo_department').select2({
                placeholder: "Please Select Department",
                allowClear: true
            });

            _cboDepartment.select2('val',null);

            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New category" >'+
                    '<i class="fa fa-plus"></i> New Sales person</button>';
                $("div.toolbar").html(_btnNew);
            }();
        }();

        var bindEventHandlers=(function(){
            var detailRows = [];

            _cboDepartment.on('select2:select', function(){
                if (_cboDepartment.val() == 0) {
                    clearFields($('#frm_department'));
                    $('#modal_new_department').modal('show');
                    $('#modal_new_salesperson').modal('hide');
                }
            });

            $('#btn_cancel_department').on('click', function(){
                $('#modal_new_department').modal('hide');
                $('#modal_new_department_sp').modal('hide');
                $('#modal_new_salesperson').modal('show');
                _cboDepartment.select2('val',null);
            });

            $('#tbl_salesperson tbody').on( 'click', 'tr td.details-control', function () {
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
                clearFields($('#frm_salesperson'));
                $('#salesperson_title').text('New Sales person');
                $('#modal_new_salesperson').modal('show');
                _cboDepartment.select2('val',null);
            });

            $('#tbl_salesperson tbody').on('click','button[name="edit_info"]',function(){
                _txnMode="edit";
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.salesperson_id;
                
                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name){
                            _elem.val(value);
                        }
                    });
                });

                _cboDepartment.select2('val',data.department_id);

                $('#salesperson_title').text('Edit Sales person');
                $('#modal_new_salesperson').modal('show');
            });

            $('#tbl_salesperson tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.salesperson_id;
                $('#modal_confirmation').modal('show');
            });

            $('#btn_yes').click(function(){
                removeSalesperson().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });

            $('#btn_cancel').click(function(){
                $('#modal_new_salesperson').modal('hide');
            });

            $('#btn_save_department').click(function(){
                if(validateRequiredFields($('#frm_department'))){
                    createDepartment().done(function(response){
                        var department=response.row_added[0];

                        $('#cbo_department').append('<option value="'+ department.department_id +'">'+ department.department_name +'</option>');
                        _cboDepartment.select2('val',department.department_id);

                        $('#modal_new_department').modal('hide');
                        $('#modal_new_salesperson').modal('show');
                        clearFields($('#frm_department'));
                    });
                }
            }); 

            $('#btn_save').click(function(){
                if(validateRequiredFields($('#frm_salesperson'))){
                    if(_txnMode=="new"){
                        createSalesperson().done(function(response){
                            showNotification(response);
                            dt.row.add(response.row_added[0]).draw();
                            clearFields($('#frm_salesperson'));

                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }else{
                        updateSalesperson().done(function(response){
                            showNotification(response);
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields($('#frm_salesperson'));
                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }
                    $('#modal_new_salesperson').modal('hide');
                }
            });
        })();

        var validateRequiredFields=function(frm){
            var stat=true;

            $('div.form-group').removeClass('has-error');
            $('input[required],textarea[required]',frm).each(function(){
                if($(this).val()==""){
                    showNotification({
                        title:"Error!",
                        stat:"error",
                        msg:$(this).data('error-msg')
                    });
                    $(this).closest('div.form-group').addClass('has-error');
                    stat=false;
                    return false;
                }
            });
            return stat;
        };

        var createDepartment=function(){
            var _dataDepartment=$('#frm_department').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Departments/transaction/create",
                "data":_dataDepartment
            });
        }

        var createSalesperson=function(){
            var _data=$('#frm_salesperson').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Salesperson/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updateSalesperson=function(){
            var _data=$('#frm_salesperson').serializeArray();
            _data.push({name : "salesperson_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Salesperson/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removeSalesperson=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Salesperson/transaction/delete",
                "data":{salesperson_id : _selectedID}
            });
        };

        var showList=function(b){
            if(b){
                $('#div_category_list').show();
                $('#div_category_fields').hide();
            }else{
                $('#div_category_list').hide();
                $('#div_category_fields').show();
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

        var clearFields=function(frm){
            $('input[required],input,textarea',frm).val('');
            $('form').find('input:first').focus();
        };

        function format ( d ) {
            return '<br /><table style="margin-left:10%;width: 80%;">' +
            '<thead>' +
            '</thead>' +
            '<tbody>' +
            '<tr>' +
            '<td>Category Name : </td><td><b>'+ d.category_name+'</b></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Category Description : </td><td>'+ d.category_desc+'</td>' +
            '</tr>' +
            '</tbody></table><br />';
        };
    });

    </script>

    </body>

</html>