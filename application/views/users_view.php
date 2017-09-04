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



    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <?php echo $_def_css_files; ?>


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

        h2 {
          color: #FFF;
        }
        td.child{


          border: none!important;
        }
        
        
        /*table{
            min-width: 700px;
        }

        .dataTables_filter{
            min-width: 700px;
        }

        .dataTables_info{
            min-width: 700px;
        }

        .dataTables_paginate{
            float: left;
            width: 100%;
        }*/

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

                    <ol class="breadcrumb" style="margin-bottom: 0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="users">Users  <?php //print_r($user_groups); ?></a></li>
                    </ol>


                <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_user_list">
                                        <div class="panel panel-default">
                                            <!-- <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; User Accounts</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">User Accounts</h2><hr>
                                                <table id="tbl_user_list" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th></th>
                                                        <th>Username</th>
                                                        <th>Fullname</th>
                                                        <th>Address</th>
                                                        <th>Mobile #</th>
                                                        <th>User Group</th>
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


                                    <div id="div_user_fields" style="display: none;">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                            <!-- <div class="panel-heading">
                                                <h2>User Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div> -->
                                            <div class="panel-body">
                                            <h2 class="h2-panel-heading">User Information</h2>
                                            <br>
                                               <form id="frm_users" role="form" class="form-horizontal row-border">
                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* User Name :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                               <input type="text" name="user_name" class="form-control" placeholder="User Name" data-error-msg="User name is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>User Group :</strong></label>

                                                       <div class="col-md-7">
                                                           <select name="" id="cbo_user_groups" data-error-msg="User group is required." required>
                                                               <option value="0">[ Create User Account Group ]</option>
                                                               <?php foreach($user_groups as $group){ ?>
                                                                        <option value="<?php echo $group->user_group_id; ?>"><?php echo $group->user_group; ?></option>
                                                               <?php } ?>
                                                           </select>


                                                           <i class="help-block m-b-none">* Required. Please select the correct user group of the user.</i>

                                                       </div>

                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Password :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                               <input type="password" name="user_pword" class="form-control" placeholder="Password" data-error-msg="Password is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Confirm Password :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                               <input type="password" name="user_confirm_pword" class="form-control" placeholder="Confirm Password" data-error-msg="Please confirm password!" required>
                                                           </div>

                                                           <span class="help-block m-b-none">Please make sure password match.</span>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Firstname :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                               <input type="text" name="user_fname" class="form-control" placeholder="Firstname" data-error-msg="Firstname is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Middlename :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                               <input type="text" name="user_mname" class="form-control" placeholder="Middlename">
                                                           </div>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Lastname :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                               <input type="text" name="user_lname" class="form-control" placeholder="Lastname" data-error-msg="Lastname is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Birthdate :</strong></label>

                                                       <div class="col-md-7">
                                                           <div class="input-group date">
                                                               <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="txt_bdate" name="user_bdate" type="text" class="form-control" value="<?php echo date("m/d/Y"); ?>">
                                                           </div>

                                                       </div>

                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Address :</strong></label>
                                                       <div class="col-md-7">
                                                           <textarea name="user_address" class="form-control"></textarea>
                                                       </div>
                                                   </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 col-md-offset-1 control-label"><strong>Email Address :</strong></label>
                                                        <div class="col-md-7">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                </span>
                                                                <input type="text" name="user_email" class="form-control" placeholder="Email Address">
                                                            </div>
                                                        </div>
                                                    </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Landline :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <input type="text" name="user_telephone" class="form-control" placeholder="Landline">
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Mobile No :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <input type="text" name="user_mobile" class="form-control" placeholder="Mobile No">
                                                           </div>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>Photo :</strong></label>
                                                       <div class="col-md-5">
                                                           <div class="input-group">
                                                               <div class="" style="border:1px solid black;height: 230px;width: 210px;vertical-align: middle;margin-bottom: 20px;">

                                                                   <div id="div_img_user" style="position:relative;">
                                                                       <img name="img_user" src="assets/img/anonymous-icon.png" style="padding-bottom: 50px; height: 277px; width: 207px;"/>
                                                                       <input type="file" name="file_upload[]" class="hidden">
                                                                   </div>

                                                                   <div id="div_img_loader" style="display: none;">
                                                                        <img name="img_loader" src="assets/img/loader/ajax-loader-sm.gif" style="display: block;margin:40% auto auto auto;" />
                                                                   </div>
                                                               </div>

                                                               <button type="button" id="btn_browse" class="btn btn-primary "  style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Browse Photo</button>
                                                               <button type="button" id="btn_remove_photo"  class="btn btn-danger" style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Remove</button>
                                                           </div>
                                                       </div>
                                                   </div>

                                               </form>


                                                    <br /><br />








                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-3">
                                                        <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>  Save Changes</button>
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
                            <button type="button" class="close" style="color:white;"  data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>

                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->


            <div id="modal_user_group" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content"><!---content--->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>New User Group</h4>

                        </div>

                        <div class="modal-body">
                            <form id="frm_user_group">
                                <div class="form-group">
                                            <label>* User Group :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                                <input type="text" name="user_group" class="form-control" placeholder="User group" data-error-msg="Category name is required." required>
                                            </div>
                                 </div>


                                <div class="form-group">
                                    <label>Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="user_group_desc" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">
                            <button id="btn_create_user_group" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
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




<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>





<script>
    $(document).ready(function(){
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboUserGroup;



        var initializeControls=function(){

            dt=$('#tbl_user_list').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Users/transaction/list",
                "columns": [
                    {
                        "targets": [0],
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ""
                    },
                    { targets:[1],data: "user_name" },
                    { targets:[2],data: "full_name" },
                    { targets:[3],data: "user_address" },
                    { targets:[4],data: "user_mobile" },
                    { targets:[5],data: "user_group" },
                    {
                        targets:[6],
                        render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                    }
                ]
            });


            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Register User Account" >'+
                    '<i class="fa fa-plus"></i> Register User Account</button>';
                $("div.toolbar").html(_btnNew);
            }();


            $('#txt_bdate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true

            });


            _cboUserGroup=$("#cbo_user_groups").select2({
                placeholder: "Please select user group",
                allowClear: true
            });

            _cboUserGroup.select2('val', null)



        }();

        var bindEventHandlers=(function(){
            var detailRows = [];

            $('#tbl_user_list tbody').on( 'click', 'tr td.details-control', function () {
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
                    showList(false);
            });

             $('#btn_browse').click(function(event){
                    event.preventDefault();
                    $('input[name="file_upload[]"]').click();
             });


            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
            });

            $('#btn_create_user_group').click(function(){

                var btn=$(this);

                if(validateRequiredFields($('#frm_user_group'))){
                    var data=$('#frm_user_group').serializeArray();

                    $.ajax({
                        "dataType":"json",
                        "type":"POST",
                        "url":"User_groups/transaction/create",
                        "data":data,
                        "beforeSend" : function(){
                            showSpinningProgress(btn);
                        }
                    }).done(function(response){
                        showNotification(response);
                        $('#modal_user_group').modal('hide');

                        var _group=response.row_added[0];
                        $('#cbo_user_groups').append('<option value="'+_group.user_group_id+'" selected>'+_group.user_group+'</option>');
                        $('#cbo_user_groups').select2('val',_group.user_group_id);

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }





            });



            $('#tbl_user_list tbody').on('click','button[name="edit_info"]',function(){
                    ///alert("ddd");
                    _txnMode="edit";
                    _selectRowObj=$(this).closest('tr');
                    var data=dt.row(_selectRowObj).data();
                    _selectedID=data.user_id;

                    $('input,textarea').each(function(){
                        var _elem=$(this);
                        $.each(data,function(name,value){
                            if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                                _elem.val(value);
                            }

                        });

                        $('#cbo_user_groups').select2('val',data.user_group_id);
                    });

                    $('img[name="img_user"]').attr('src',data.photo_path);
                    showList(false);

            });

            $('#tbl_user_list tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.user_id;

                $('#modal_confirmation').modal('show');
            });

            $('#btn_yes').click(function(){
                removeCustomer().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });


            _cboUserGroup.on("select2:select", function (e) {

                var i=$(this).select2('val');
                if(i==0){
                    $(this).select2('val',null)
                    $('#modal_user_group').modal('show');
                    clearFields($('#modal_user_group').find('form'));
                }


            });


                $('input[name="file_upload[]"]').change(function(event){
                    var _files=event.target.files;

                    $('#div_img_user').hide();
                    $('#div_img_loader').show();


                    var data=new FormData();
                    $.each(_files,function(key,value){
                        data.append(key,value);
                    });

                    console.log(_files);

                    $.ajax({
                        url : 'Users/transaction/upload',
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
                            $('#div_img_user').show();
                            $('img[name="img_user"]').attr('src',response.path);

                        }
                    });

                });

                $('#btn_cancel').click(function(){
                    showList(true);
                });



                $('#btn_save').click(function(){

                    if(validateRequiredFields($('#frm_users'))){
                        if(_txnMode=="new"){
                            createUserAccount().done(function(response){
                                showNotification(response);
                                if(response.stat=="success"){
                                    dt.row.add(response.row_added[0]).draw();
                                    clearFields($('#frm_users'));
                                    showList(true);
                                }

                            }).always(function(){
                                showSpinningProgress($('#btn_save'));
                            });
                        }else{
                            updateUserAccount().done(function(response){
                                showNotification(response);
                                dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                                clearFields($('#frm_users'));
                                showList(true);
                            }).always(function(){
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


                    if($('input[name="user_confirm_pword"]').val()!=$('input[name="user_pword"]').val()){
                        showNotification({title:"Error!",stat:"error",msg:"Password did not match."});
                        $('input[name="user_confirm_pword"]').focus();
                        stat=false;
                    }

                return stat;
        };


        var createUserAccount=function(){
            var _data=$('#frm_users').serializeArray();
            _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});
            _data.push({name : "user_group_id" ,value : $('#cbo_user_groups').select2('val')});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Users/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updateUserAccount=function(){
            var _data=$('#frm_users').serializeArray();
            _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});
            _data.push({name : "user_group_id" ,value : $('#cbo_user_groups').select2('val')});
            _data.push({name : "user_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Users/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removeCustomer=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Users/transaction/delete",
                "data":{user_id : _selectedID}
            });
        };

        var showList=function(b){
            if(b){
                $('#div_user_list').show();
                $('#div_user_fields').hide();
            }else{
                $('#div_user_list').hide();
                $('#div_user_fields').show();
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
            $(f).find('select').select2('val',null);
            $(f).find('input:first').focus();
        };


        function format ( d ) {
            // `d` is the original data object for the row
            //alert(d.photo_path);
            return '<br /><table style="margin-left:10%;width: 80%;" style="border:none!important">' +
                    '<thead>' +
                    '</thead>' +
                    '<tbody style="border:none!important">' +
                    '<tr>' +
                    '<td width="20%" class="child">Name : </td><td width="50%"  class="child"><b>'+ d.user_name+'</b></td>' +
                    '<td rowspan="5" valign="top"  class="child"><div class="avatar"  class="child">'+
                    '<img src="'+ d.photo_path+'" class="img-circle" style="margin-top:0px;height: 100px;width: 100px;">'+
                    '</div></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td  class="child">Address : </td><td  class="child"><b>'+ d.user_address+'</b></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td  class="child">Email : </td><td  class="child">'+ d.user_email+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td class="child">Mobile Nos. : </td><td  class="child">'+ d.user_mobile+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td  class="child">Landline. : </td><td  class="child">'+ d.user_telephone+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td  class="child">Active : </td><td  class="child"><i class="fa fa-check"></i></td>' +
                    '</tr>' +
                    '</tbody></table><br />';
        };




        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };












    });




</script>


</body>


</html>