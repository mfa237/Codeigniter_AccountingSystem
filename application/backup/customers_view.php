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


        <?php echo $_side_bar_navigation;

        ?>


        <div class="static-content-wrapper white-bg">


            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->

                    <ol class="breadcrumb">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="customers">Customers</a></li>
                    </ol>


                <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_customer_list">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                            <div class="panel-body table-responsive">
                                              <h2>Customers</h2>
                                                <table id="tbl_customers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead class="table-erp">
                                                    <tr>
                                                        <th></th>
                                                        <th>Customer Name</th>
                                                        <th>Address</th>
                                                        <th>Landline</th>
                                                        <th>Mobile</th>
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


                                    <div id="div_customer_fields" style="display: none;">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                           <!--  <div class="panel-heading">
                                                <h2>Customer Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div> -->

                                            <div class="panel-body">

                                            <h2>Customer Information</h2>
                                               <form id="frm_customer" role="form" class="form-horizontal row-border">


                                                   <div class="form-group">
                                                       <label class="col-md-2 control-label"><strong>* Customer Name :</strong></label>
                                                       <div class="col-md-9">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                               <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" data-error-msg="Customer name is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 control-label"><strong>* Address :</strong></label>
                                                       <div class="col-md-9">
                                                           <textarea name="address" class="form-control" data-error-msg="Customer address is required!" required></textarea>
                                                       </div>
                                                   </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label"><strong>* Email :</strong></label>
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                </span>
                                                                <input type="text" name="email_address" class="form-control" placeholder="Email Address">
                                                            </div>
                                                        </div>
                                                    </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 control-label"><strong>Landline :</strong></label>
                                                       <div class="col-md-9">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <input type="text" name="landline" class="form-control" placeholder="Landline">
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 control-label"><strong>Mobile No :</strong></label>
                                                       <div class="col-md-9">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No">
                                                           </div>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 control-label"><strong>Photo :</strong></label>
                                                       <div class="col-md-5">
                                                           <div class="input-group">
                                                               <div class="" style="border:1px solid black;height: 230px;width: 210px;vertical-align: middle;">

                                                                   <div id="div_img_customer" style="position:relative;">
                                                                       <img name="img_customer" src="assets/img/anonymous-icon.png" style="object-fit: fill; !important; height: 100%;width: 100%;" />
                                                                       <input type="file" name="file_upload[]" class="hidden">
                                                                   </div>

                                                                   <div id="div_img_loader" style="display: none;">
                                                                        <img name="img_loader" src="assets/img/loader/ajax-loader-sm.gif" style="display: block;margin:40% auto auto auto; " />
                                                                   </div>
                                                               </div>

                                                               <button id="btn_browse" class="btn btn-green" style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Browse Photo</button>&nbsp;
                                                               <button id="btn_remove_photo"  class="btn btn-red" style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Remove</button>
                                                           </div>
                                                       </div>
                                                   </div>



                                                    <br /><br />



                                               </form>




                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-2">
                                                        <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;""><span class=""></span>  Save Changes</button>
                                                        <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
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

            dt=$('#tbl_customers').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Customers/transaction/list",
                "columns": [
                    {
                        "targets": [0],
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ""
                    },
                    { targets:[1],data: "customer_name" },
                    { targets:[2],data: "address" },
                    { targets:[3],data: "landline" },
                    { targets:[4],data: "mobile_no" },
                    {
                        targets:[5],
                        render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                    }
                ]
            });


            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-green"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Customer" >'+
                    '<i class="fa fa-users"></i> New Customer</button>';
                $("div.toolbar").html(_btnNew);
            }();

        }();






        var bindEventHandlers=(function(){
            var detailRows = [];

            $('#tbl_customers tbody').on( 'click', 'tr td.details-control', function () {
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

                    $.ajax({
                        "dataType":"html",
                        "type":"POST",
                        "url":"Templates/layout/customer/"+ d.customer_id,
                        "beforeSend" : function(){
                            row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                        }
                    }).done(function(response){
                        row.child( response ).show();
                        reInitializeDatatable($('#tbl_so_'+ d.customer_id));
                        if ( idx === -1 ) {
                            detailRows.push( tr.attr('id') );
                        }
                    });



                }
            } );


            $('#btn_new').click(function(){
                    _txnMode="new";
                    showList(false);
            });

             $('#btn_browse').click(function(event){
                    event.preventDefault();
                    $('input[name="file_upload[]"]').click();
             });


            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_customer"]').attr('src','assets/img/anonymous-icon.png');
            });



            $('#tbl_customers tbody').on('click','button[name="edit_info"]',function(){
                    ///alert("ddd");
                    _txnMode="edit";
                    _selectRowObj=$(this).closest('tr');
                    var data=dt.row(_selectRowObj).data();
                    _selectedID=data.customer_id;

                    $('input,textarea').each(function(){
                        var _elem=$(this);
                        $.each(data,function(name,value){
                            if(_elem.attr('name')==name){
                                _elem.val(value);
                            }
                        });
                    });

                    $('img[name="img_customer"]').attr('src',data.photo_path);
                    showList(false);

            });

            $('#tbl_customers tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.customer_id;

                $('#modal_confirmation').modal('show');
            });

            $('#btn_yes').click(function(){
                removeCustomer().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });


                $('input[name="file_upload[]"]').change(function(event){
                    var _files=event.target.files;

                    $('#div_img_customer').hide();
                    $('#div_img_loader').show();


                    var data=new FormData();
                    $.each(_files,function(key,value){
                        data.append(key,value);
                    });

                    console.log(_files);

                    $.ajax({
                        url : 'Customers/transaction/upload',
                        type : "POST",
                        data : data,
                        cache : false,
                        dataType : 'json',
                        processData : false,
                        contentType : false,
                        success : function(response){
                            //console.log(response);
                            //alert(response.path);
                            $('#div_img_loader').hide();
                            $('#div_img_customer').show();
                            $('img[name="img_customer"]').attr('src',response.path);

                        }
                    });

                });

                $('#btn_cancel').click(function(){
                    showList(true);
                });

                $('#btn_save').click(function(){

                    if(validateRequiredFields()){
                        if(_txnMode=="new"){
                            createCustomer().done(function(response){
                                showNotification(response);
                                dt.row.add(response.row_added[0]).draw();
                                clearFields();
                                showList(true);

                            }).always(function(){
                                showSpinningProgress($('#btn_save'));
                            });
                        }else{
                            updateCustomer().done(function(response){
                                showNotification(response);
                                dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                                clearFields();
                                showList(true);
                            }).always(function(){
                                showSpinningProgress($('#btn_save'));
                            });
                        }

                    }

                });


        })();


        var validateRequiredFields=function(){
                var stat=true;

                $('div.form-group').removeClass('has-error');
                  $('input[required],textarea','#frm_customer').each(function(){

                      if($(this).val()==""){
                          showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                          $(this).closest('div.form-group').addClass('has-error');
                          stat=false;
                          return false;
                      }

                  });

                return stat;
        };


        var createCustomer=function(){
            var _data=$('#frm_customer').serializeArray();
            _data.push({name : "photo_path" ,value : $('img[name="img_customer"]').attr('src')});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Customers/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updateCustomer=function(){
            var _data=$('#frm_customer').serializeArray();
            _data.push({name : "photo_path" ,value : $('img[name="img_customer"]').attr('src')});
            _data.push({name : "customer_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Customers/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removeCustomer=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Customers/transaction/delete",
                "data":{customer_id : _selectedID}
            });
        };

        var showList=function(b){
            if(b){
                $('#div_customer_list').show();
                $('#div_customer_fields').hide();
            }else{
                $('#div_customer_list').hide();
                $('#div_customer_fields').show();
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

        var clearFields=function(){
            $('input,textarea','#frm_customer').val('');
            $('form').find('input:first').focus();
        };


        function format ( d ) {
            // `d` is the original data object for the row
            //alert(d.photo_path);
            return '<br /><table style="margin-left:10%;width: 80%;">' +
                    '<thead>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td width="20%">Name : </td><td width="50%"><b>'+ d.customer_name+'</b></td>' +
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


            /*return '<div class="contact-box  animated fadeInRight">' +
                        '<a href="#"> ' +
                            '<div class="col-sm-7 col-sm-offset-1"> ' +
                                '<h3><strong>'+ d.customer_name+'</strong></h3> ' +
                                '<p><i class="fa fa-map-marker"></i> '+ d.address+'</p><br> ' +
                                '<address> ' +
                                    '<i class="fa fa-send"></i> '+ d.email_address+'<br> ' +
                                    '<i class="fa fa-map-marker"></i> '+ d.mobile_no+'<br> ' +
                                    '<i class="fa fa-list-alt"></i> '+ d.landline+'<br> ' +
                                '</address>' +
                            '</div> <div class="text-right"> ' +
                            '</div> ' +
                            '<div class="col-sm-4"><br /> ' +
                                '<div class="text-center avatar">'+
                                    '<img src="assets/demo/avatar/avatar_15.png" class="img-responsive img-circle"  style="height:150%;">'+
                                '</div>'+
                        '</a> ' +
                    '</div>';*/



        };



        var reInitializeDatatable=function(tbl){
            tbl.DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false

            });
        };





    });




</script>


</body>


</html>