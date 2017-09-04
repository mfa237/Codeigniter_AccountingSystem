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
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _selectedBranch;

        /*$(document).ready(function(){
            $('#modal_filter').modal('show');
            showList(false);
        })*/

        var initializeControls=function() {
            dt=$('#tbl_customers').DataTable({
                "fnInitComplete": function (oSettings, json) {
                    $.unblockUI();
                },
                "dom": '<"toolbar">frtip',
                "bLengthChange": false,
                "pageLength": 15,
                "ajax" : "Customers/transaction/list",
                "language": {
                    searchPlaceholder: "Search Customer Name"
                },
                "columns": [
                    {
                        "targets": [0],
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ""
                    },
                    { targets:[1],data: "customer_name" },
                    { targets:[2],data: "contact_name" },
                    { targets:[3],data: "address" },
                    { targets:[4],data: "contact_no" },
                    {
                        targets:[5],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit" style="margin-left:-5px;"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-danger btn-sm" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash" style="margin-right:-5px;"><i class="fa fa-trash-o"></i> </button>';

                            return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                        }
                    }
                ]
            });
        
            $('.numeric').autoNumeric('init');
            $('#term').keypress(validateNumber);
            $('#credit_limit').keypress(validateNumber);

            //$('#contact_no').keypress(validateNumber);
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
                        row.child( response,'no-padding' ).show();
                        reInitializeDatatable($('#tbl_so_'+ d.customer_id));
                        if ( idx === -1 ) {
                            detailRows.push( tr.attr('id') );
                        }
                    });



                }
            } );


            $('#btn_new').click(function(){
                _txnMode="new";
                $('#modal_create_customer').modal('show');
                clearFields($('#frm_customer'));
            });

             $('#btn_browse').click(function(event){
                    event.preventDefault();
                    $('input[name="file_upload[]"]').click();
             });


            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
            });



            $('#tbl_customers tbody').on('click','button[name="edit_info"]',function(){
                    _txnMode="edit";
                    $('#modal_create_customer').modal('show');
                    _selectRowObj=$(this).closest('tr');
                    var data=dt.row(_selectRowObj).data();
                    _selectedID=data.customer_id;
                    $('#branch').val(data.department_id);
                    $('#refcustomertype_id').val(data.refcustomertype_id);
                    $('#term').val(data.term);

                    //alert(data.term);

                    if(data.photo_path==""){
                         $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
                    }
                    else{
                        $('img[name="img_user"]').attr('src',data.photo_path);
                    }

                    $('input,textarea').each(function(){
                        var _elem=$(this);
                        $.each(data,function(name,value){
                            if(_elem.attr('name')==name){
                                _elem.val(value);
                            }
                        });
                    });

                    /*$('img[name="img_user"]').attr('src',data.photo_path);
                    showList(false);*/

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
                    if(response.stat == 'success') {
                        dt.row(_selectRowObj).remove().draw();
                    }
                });
            });


                $('input[name="file_upload[]"]').change(function(event){
                    var _files=event.target.files;
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
                            /*$('#div_img_loader').hide();
                            $('#div_img_user').show();*/
                            $('img[name="img_user"]').attr('src',response.path);
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
                                clearFields($('#frm_cusomer'));
                            }).always(function(){
                                $('#modal_create_customer').modal('toggle');
                                showSpinningProgress($('#btn_save'));
                            });
                        }
                        if(_txnMode==="edit"){
                            updateCustomer().done(function(response){
                                showNotification(response);

                                dt.row(_selectRowObj).data(response.row_updated[0]).draw(false);



                            }).always(function(){
                                $('#modal_create_customer').modal('toggle');
                                showSpinningProgress($('#btn_save'));
                            });
                        }

                    }

                });


        })();


        var validateRequiredFields=function(f){
            var stat=true;
            $('div.form-group').removeClass('has-error');
            $('input[required],textarea[required],select[required]',f).each(function(){
                    if($(this).is('select')){
                    if($(this).val()==0){
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


        var createCustomer=function(){
            var _data=$('#frm_customer').serializeArray();
            _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});

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
            _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});
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

        var clearFields=function(f){
            $('input,textarea,select',f).val('');
            $(f).find('input:first').focus();
            $('#img_user').attr('src','assets/img/anonymous-icon.png');
        };

        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;

            if (event.keyCode === 8 || event.keyCode === 46
                || event.keyCode === 37 || event.keyCode === 39) {
                return true;
            }
            else if ( key < 48 || key > 57 ) {
                return false;
            }
            else return true;
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

        $('#btn_filter').click(function(){
            if(validateRequiredFields($('#frm_filter'))){
                showSpinningProgress($('#btn_filter'));
                showCustomer();
                getCustomer();
                $('#modal_filter').modal('toggle');
            }
        });

        var showCustomer=function(){
            $('#div_customer_list').show();
        };

        var hideCustomer=function(){
            $('#div_customer_list').hide();
            $('#modal_filter').modal('toggle');
        };

        $('#btn_backtofilter').click(function(){
            hideCustomer();
            $('#tbl_customers').dataTable().fnDestroy();
            $('#tbl_customers').fnClearTable();
        });

        $('#department_id').change(function() {
            _selectedBranch=$(this).val();
            //alert(_selectedBranch);
        });





    });




</script>

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

        .numeric{
            text-align: right;
            width: 60%;
        }

        #btn_new {
            text-transform: capitalize; !important;
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
        .form-group {
            padding-bottom: 3px;
        }

        #is_tax_exempt {
            width:23px;
            height:23px;
        }

        .modal-body {
            padding-left:0px !important;
        }

        #label {
            text-align:left;
        }

        .form-group {
            padding:0;
            margin:5px;
        }

        .input-group {
            padding:0;
            margin:0;
        }

        textarea {
            resize: none;
        }

        .modal-body p {
            margin-left: 20px !important;
        }

        #img_user {
            padding-bottom: 15px;
        }

        .btn-back {
            float: left; 
            border-radius: 50px; 
            border: 3px solid #9E9E9E!important; 
            background: transparent; 
            margin-right: 10px;
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
                        <li><a href="customers">Customers</a></li>
                    </ol>


                <div class="container-fluid">
                        <div data-widget-group="group1">    
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_customer_list">
                                        <div class="panel panel-default">
                                           <!--  <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Customers</b>
                                            </div>              -->                     
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Customers</h2><hr>
                                                <button class="btn btn-primary" id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;margin-bottom: 0px !important; float: left;" data-toggle="modal" data-target="" data-placement="left" title=" New product" ><i class="fa fa-plus"></i>  New Customer</button>
                                                <table id="tbl_customers" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th>&nbsp;&nbsp;</th>
                                                        <th>Customer Name</th>
                                                        <th>Contact Person</th>
                                                        <th>Address</th>
                                                        <th>Contact No</th>
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


                                    <!-- <div id="div_customer_fields" style="display: none;">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                            <div class="panel-heading">
                                                <h2>Customer Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div> -->

                                            <!-- <div class="panel-body">

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

                                                                   <div id="div_img_users" style="position:relative;">
                                                                       <img name="img_users" src="assets/img/anonymous-icon.png" style="object-fit: fill; !important; height: 100%;width: 100%;" />
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
                                    </div> -->




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
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
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

            <div id="modal_filter" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#27ae60;">
                            <button type="button" style="color:white;" class="close"  data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> View Branches </h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_filter">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-bottom:0px;margin-left:20px !important;">
                                            <label class="boldlabel">Branches :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-users"></i>
                                                </span>
                                                <select name="department_id" id="department_id" class="form-control">
                                                    <option value="">View all branches</option>
                                                    
                                                    <?php
                                                    foreach($departments as $row)
                                                    {
                                                        echo '<option value="'.$row->department_id.'">'.$row->department_name.'</option>';
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_filter" type="button" class="btn" style="background-color:#2ecc71;color:white;">Select</button>
                            <button id="btn_close_filter" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_create_customer" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Customer Information</h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_customer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Customer Name :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" data-error-msg="Customer Name is required!" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"></font> Contact Person :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" name="contact_name" class="form-control" placeholder="Contact Person">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Address :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                     </span>
                                                     <textarea name="address" class="form-control" data-error-msg="Supplier address is required!" placeholder="Address" required ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"> Term :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="term" id="term" class="form-control" placeholder="Term in days">
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"> Credit Limit :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="credit_limit" id="credit_limit" class="form-control" placeholder="Credit Limit">
                                                </div>
                                            </div>
                                        </div> -->
                                    
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;">Email Address :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope-o"></i>
                                                    </span>
                                                    <input type="text" name="email_address" class="form-control" placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;">Contact No :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Contact No">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;">Tin No :</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="tin_no" id="tin_no" class="form-control" placeholder="Tin No">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <label class="control-label boldlabel" style="text-align:left;padding-top:10px;"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px;"></i>Customer's Photo</label>
                                                <hr style="margin-top:0px !important;height:1px;background-color:black;">
                                            </div>
                                            <div style="width:100%;height:300px;border:2px solid #34495e;border-radius:5px;">
                                                <center>
                                                    <img name="img_user" id="img_user" src="assets/img/anonymous-icon.png" height="140px;" width="140px;"></img>
                                                </center>
                                                <hr style="margin-top:0px !important;height:1px;background-color:black;">
                                                <center>
                                                     <button type="button" id="btn_browse" style="width:150px;margin-bottom:5px;" class="btn btn-primary">Browse Photo</button>
                                                     <button type="button" id="btn_remove_photo" style="width:150px;" class="btn btn-danger">Remove</button>
                                                     <input type="file" name="file_upload[]" class="hidden">
                                                </center> 
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_save" type="button" class="btn" style="background-color:#2ecc71;color:white;">Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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







</body>


</html>