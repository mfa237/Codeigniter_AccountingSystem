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
                                <li><a href="categories">Pay Types</a></li>
                            </ol>

                            <div class="container-fluid">
                                <div data-widget-group="group1">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="div_category_list">
                                                <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                                    <div class="panel-body table-responsive">
                                                    <h2 style="margin-top: 0;">Pay Types</h2>
                                                        <table id="tbl_paymentType" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                            <thead class="table-erp">
                                                            <tr>
                                                                <th>Pay Type</th>
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
                                <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
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
                <div id="modal_new_payType" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#2ecc71;">
                                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                                <h4 id="pay_type_title" class="modal-title" style="color: #ecf0f1;"><span id="modal_mode"></span></h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form id="frm_payment_method" role="form">
                                        <div class="">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-md-4 control-label "><strong>* Pay Type :</strong></label>
                                                    <div class="col-xs-12 col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-users"></i>
                                                            </span>
                                                            <input type="text" name="payment_method" class="form-control" placeholder="Pay Type" data-error-msg="Pay Type is required!" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_save" class="btn btn-primary" name="btn_save">Save</button>
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


    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script>

    $(document).ready(function(){
        var dt; var _txnMode; var _selectedID; var _selectRowObj;

        var initializeControls=function(){
            dt=$('#tbl_paymentType').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Pay_Types/transaction/list",
                "columns": [

                    { targets:[0],data: "payment_method" },
                    {
                        targets:[1],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                            return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                        }
                    }
                ]
            });

            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-green"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New category" >'+
                    '<i class="fa fa-users"></i> New Pay Type</button>';
                $("div.toolbar").html(_btnNew);
            }();
        }();

        var bindEventHandlers=(function(){
            var detailRows = [];

            $('#tbl_paymentType tbody').on( 'click', 'tr td.details-control', function () {
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
                clearFields();
                $('#pay_type_title').text('New Pay Type');
                $('#modal_new_payType').modal('show');
                //showList(false);
            });

            $('#tbl_paymentType tbody').on('click','button[name="edit_info"]',function(){
                _txnMode="edit";
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.payment_method_id;

                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name){
                            _elem.val(value);
                        }
                    });
                });
                $('#pay_type_title').text('Edit Pay Type');
                $('#modal_new_payType').modal('show');
            });

            $('#tbl_paymentType tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.payment_method_id;
                $('#modal_confirmation').modal('show');
            });

            $('#btn_yes').click(function(){
                removePaymentMethod().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });

            $('input[name="file_upload[]"]').change(function(event){
                var _files=event.target.files;

                $('#div_img_category').hide();
                $('#div_img_loader').show();

                var data=new FormData();
                $.each(_files,function(key,value){
                    data.append(key,value);
                });

                $.ajax({
                    url : 'Categories/transaction/upload',
                    type : "POST",
                    data : data,
                    cache : false,
                    dataType : 'json',
                    processData : false,
                    contentType : false,
                    success : function(response){
                        $('#div_img_loader').hide();
                        $('#div_img_category').show();
                    }
                });
            });

            $('#btn_cancel').click(function(){
                $('#modal_new_payType').modal('hide');
                //showList(true);
            });

            $('#btn_save').click(function(){
                if(validateRequiredFields()){
                    if(_txnMode=="new"){
                        createPaymentMethod().done(function(response){
                            showNotification(response);
                            dt.row.add(response.row_added[0]).draw();
                            clearFields();

                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }else{
                        updatePaymentMethod().done(function(response){
                            showNotification(response);
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields();
                            showList(true);
                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }
                    $('#modal_new_payType').modal('hide');
                }
            });
        })();

        var validateRequiredFields=function(){
            var stat=true;

            $('div.form-group').removeClass('has-error');
            $('input[required],textarea','#frm_payment_method').each(function(){
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    stat=false;
                    return false;
                }
            });
            return stat;
        };

        var createPaymentMethod=function(){
            var _data=$('#frm_payment_method').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Pay_Types/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updatePaymentMethod=function(){
            var _data=$('#frm_payment_method').serializeArray();
            _data.push({name : "payment_method_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Pay_Types/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removePaymentMethod=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Pay_Types/transaction/delete",
                "data":{payment_method_id : _selectedID}
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
        };

        var clearFields=function(){
            $('input[required],textarea','#frm_payment_method').val('');
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