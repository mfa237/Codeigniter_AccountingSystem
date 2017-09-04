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
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
    <link href="assets/css/light-theme.css" rel="stylesheet">
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

<ol class="breadcrumb" style="margin:0%;">
    <li><a href="dashboard">Dashboard</a></li>
    <li><a href="Profile">My Profile</a></li>
</ol>


<div class="container-fluid">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">


<div id="div_user_fields">
<div class="panel panel-default" style="border-top: 3px solid #2196f3;">


<div class="panel-body">

    <h2 ><span style="margin-left: 1%"><i class="fa fa-users"></i> User Information</span></h2>
    <hr /><br />

    <form id="frm_users" role="form" class="form-horizontal row-border">


        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>* User Name :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                    <input type="text" name="user_name" class="form-control" value="<?php echo $user_info->user_name; ?>" placeholder="User Name" data-error-msg="User name is required!" required>
                </div>
            </div>
        </div>




        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>* Password :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                    <input type="password" name="user_pword" class="form-control" placeholder="Password">
                </div>

                <span class="help-block m-b-none"><b><i class="fa fa-lock"></i> Update Password</b> (Please leave it blank if you do not want to update your password)</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>* Confirm Password :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                    <input type="password" name="user_confirm_pword" class="form-control" placeholder="Confirm Password">
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
                    <input type="text" name="user_fname" class="form-control" value="<?php echo $user_info->user_fname; ?>" placeholder="Firstname" data-error-msg="Firstname is required!" required>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong> Middlename :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                    <input type="text" name="user_mname" class="form-control" value="<?php echo $user_info->user_mname; ?>" placeholder="Middlename">
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
                    <input type="text" name="user_lname" class="form-control" value="<?php echo $user_info->user_lname; ?>" placeholder="Lastname" data-error-msg="Lastname is required!" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>Birthdate :</strong></label>

            <div class="col-md-7">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="txt_bdate" name="user_bdate" value="<?php echo $user_info->birth_date; ?>" type="text" class="form-control" value="<?php echo date("m/d/Y"); ?>">
                </div>

            </div>

        </div>


        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>Address :</strong></label>
            <div class="col-md-7">
                <textarea name="user_address" class="form-control"><?php echo $user_info->user_address; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>Email Address :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-envelope-o"></i>
                                                                </span>
                    <input type="text" name="user_email" class="form-control" value="<?php echo $user_info->user_email; ?>" placeholder="Email Address">
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
                    <input type="text" name="user_telephone" class="form-control" value="<?php echo $user_info->user_telephone; ?>" placeholder="Landline">
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
                    <input type="text" name="user_mobile" class="form-control" value="<?php echo $user_info->user_mobile; ?>" placeholder="Mobile No">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>Photo :</strong></label>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="" style="border:1px solid black;height: 230px;width: 210px;vertical-align: middle;">

                        <div id="div_img_user" style="position:relative;">
                            <img name="img_user" src="<?php echo $user_info->photo_path; ?>" style="object-fit: fill; !important; height: 100%;width: 100%;" />
                            <input type="file" name="file_upload[]" class="hidden">
                        </div>

                        <div id="div_img_loader" style="display: none;">
                            <img name="img_loader" src="assets/img/loader/ajax-loader-sm.gif" style="display: block;margin:40% auto auto auto; " />
                        </div>
                    </div>

                    <button type="button" id="btn_browse" class="btn btn-green "  style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Browse Photo</button>&nbsp;
                    <button type="button" id="btn_remove_photo"  class="btn btn-red" style="margin-top: 2%;text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Remove</button>
                </div>
            </div>
        </div>




    </form>


    <br /><br />








</div>
<div class="panel-footer">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-3">
            <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><i class="fa fa-check-circle"></i> <span class=""></span>  Update Profile</button>
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
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->




<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2017 - JDEV OFFICE SOLUTIONS</h6></li>
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



        $('#txt_bdate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });




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
                row.child( format( row.data() ) ).show();
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


        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;

            $('#div_img_user').hide();
            $('#div_img_loader').show();


            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });


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


        $('#btn_save').click(function(){

            if(validateRequiredFields($('#frm_users'))){

                    updateUserAccount().done(function(response){
                        showNotification(response);
                        //dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        //clearFields($('#frm_users'));
                        //showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });


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




    var updateUserAccount=function(){
        var _data=$('#frm_users').serializeArray();
        _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});


        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Users/transaction/update-profile",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
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
        //$(f).find('select').select2('val',null);
        $(f).find('input:first').focus();
    };






});




</script>


</body>


</html>