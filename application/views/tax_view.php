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

            .select2-container{
                width: 100% !important;
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
                        <li><a href="tax">Tax</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_tax_list">
                                        <div class="panel panel-default">
                                            <!-- <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Tax Setup</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading"> Tax Setup</h2><hr>
                                                <table id="tbl_tax" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th>Tax</th>
                                                        <th>Tax Rate</th>
                                                        <th>Description</th>
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

                                 <!--    <div id="div_tax_fields" style="display: none;">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;"> -->
                                            <!-- <div class="panel-heading">
                                                <h2>Tax Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div> -->

                                          <!--   <div class="panel-body">
                                                <h2>Tax Information</h2>
                                                <form id="frm_tax" role="form" class="form-horizontal row-border">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><strong>* Tax Name :</strong></label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-users"></i>
                                                                            </span>
                                                                <input type="text" name="tax_type" class="form-control" placeholder="Tax Name" data-error-msg="Tax Type Name is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><strong>* Tax rate :</strong></label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-users"></i>
                                                                            </span>
                                                                <input type="number" name="tax_rate" class="form-control" placeholder="Tax Rate" data-error-msg="Tax Rate is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><strong>Description :</strong></label>
                                                        <div class="col-md-4">
                                                            <textarea name="description" class="form-control" data-error-msg="Description address is required!" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>


                                                        <br /><br />
                                                </form>

                                            </div>

                                            <div class="panel-footer">
                                                <div class="row text-center">
                                                    <div class="col-sm-10">
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

            <div id="modal_tax" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 id="tax_title" class="modal-title" style="color: white;"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_tax" role="form" class="form-horizontal row-border">
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>* Tax Name :</strong></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-code"></i>
                                            </span>
                                            <input type="text" name="tax_type" class="form-control" placeholder="Tax Name" data-error-msg="Tax Type Name is required!" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>* Tax rate :</strong></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </span>
                                            <input type="number" name="tax_rate" min="0" class="form-control" placeholder="Tax Rate" data-error-msg="Tax Rate is required!" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label"><strong>Description :</strong></label>
                                    <div class="col-md-6">
                                        <textarea name="description" class="form-control" data-error-msg="Description address is required!" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;""><span class=""></span>Save</button>
                            <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal__group" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content"><!---content--->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>New Tax Group</h4>

                        </div>

                        <div class="modal-body">
                            <form id="frm_tax_group">
                                <div class="form-group">
                                    <label>* Tax Group :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="text" name="tax_name" class="form-control" placeholder="Tax group" data-error-msg="Tax name is required." required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>* Tax Rate :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="number" name="tax_rate" class="form-control" placeholder="Tax group" data-error-msg="Tax name is required." required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="tax_group_desc" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">
                            <button id="btn_create_tax_group" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                            <button id="btn_close_user_group" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->

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

    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="assets/plugins/select2/select2.full.min.js"></script>

    <script>

    $(document).ready(function() {
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _taxTypeGroup;

        var initializeControls=function() {
            dt=$('#tbl_tax').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Tax/transaction/list",
                "columns": [
                    { targets:[0],data: "tax_type" },
                    { targets:[1],data: "tax_rate" },
                    { targets:[2],data: "description" },
                    {
                        targets:[3],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                            return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                        }
                    }
                ]
            });



            var createToolBarButton=function() {
                var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Tax" >'+
                    '<i class="fa fa-plus"></i> New Tax</button>';
                $("div.toolbar").html(_btnNew);
            }();
        }();


        var bindEventHandlers=(function(){
            var detailRows = [];

            $('#tbl_tax tbody').on( 'click', 'tr td.details-control', function () {
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
                    //console.log(row.data());
                    row.child( format( row.data() ),'no-padding' ).show();
                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            } );

            $('#btn_new').click(function(){
                _txnMode="new";
                clearFields();
                $('#tax_title').text('New Tax Info');
                $('#modal_tax').modal('show');
                //showList(false);
            });

            $('#btn_browse').click(function(event){
                event.preventDefault();
                $('input[name="file_upload[]"]').click();
            });


            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_supplier"]').attr('src','assets/img/anonymous-icon.png');
            });

            $('#tbl_tax tbody').on('click','button[name="edit_info"]',function(){
                _txnMode="edit";
                clearFields();
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.tax_type_id;

                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name){
                            _elem.val(value);
                        }
                    });

                });

                $('img[name="img_supplier"]').attr('src',data.photo_path);
                $('#tax_title').text('Edit Tax Info');
                $('#modal_tax').modal('show');
                //showList(false);

            });

            $('#tbl_tax tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.tax_type_id;

                $('#modal_confirmation').modal('show');
            });

            $('#btn_yes').click(function(){
                removeTax().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });


            $('#btn_cancel').click(function(){
                $('#modal_tax').modal('hide');
                //showList(true);
            });

            $('#btn_save').click(function() {
                if(validateRequiredFields($('#frm_tax'))) {
                    if(_txnMode=="new"){
                        createTax().done(function(response){
                            showNotification(response);
                            dt.row.add(response.row_added[0]).draw();
                            clearFields($('#frm_tax'));

                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }else{
                        updateTax().done(function(response){
                            showNotification(response);
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields($('#frm_tax'))
                            showList(true);
                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }
                    $('#modal_tax').modal('hide');
                }
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



        var createTax=function() {
            var _data=$('#frm_tax').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Tax/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updateTax=function() {
            var _data=$('#frm_tax').serializeArray();
            _data.push({name : "tax_type_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Tax/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removeTax=function() {
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Tax/transaction/delete",
                "data":{tax_type_id : _selectedID}
            });
        };

        var showList=function(b){
            if(b){
                $('#div_tax_list').show();
                $('#div_tax_fields').hide();
            }else{
                $('#div_tax_list').hide();
                $('#div_tax_fields').show();
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
        };

        var clearFields=function(f){
            $('input,textarea',f).val('');
            $(f).find('input:first').focus();
        };


        function format ( d ) {
            // `d` is the original data object for the row
            //alert(d.photo_path);
            return '<br /><table style="margin-left:10%;width: 80%;">' +
            '<thead>' +
            '</thead>' +
            '<tbody>' +
            '<tr>' +
            '<td width="20%">Supplier Name : </td><td width="50%"><b>'+ d.supplier_name+'</b></td>' +
            '<td rowspan="5" valign="top"><div class="avatar">'+
            '<img src="'+ d.photo_path+'" class="img-circle" style="margin-top:0px;height: 100px;width: 100px;">'+
            '</div></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Address : </td><td><b>'+ d.address+'</b></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Email : </td><td>'+ d.email_address+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Mobile Nos. : </td><td>'+ d.mobile_no+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Landline. : </td><td>'+ d.landline+'</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Active : </td><td><i class="fa fa-check"></i></td>' +
            '</tr>' +
            '</tbody></table><br />';
        };
    });

    </script>

    </body>

</html>