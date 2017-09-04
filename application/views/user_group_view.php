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
    <li><a href="users">Users  <?php //print_r($user_groups); ?></a></li>
</ol>


<div class="container-fluid">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">

<div id="div_user_group_list">
    <div class="panel panel-default">
        <!-- <div class="panel-heading">
            <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; User Group</b>
        </div> -->
        <div class="panel-body table-responsive">
        <h2 class="h2-panel-heading">User Group</h2><hr>
            <table id="tbl_user_group_list" class="table table-striped" cellspacing="0" width="100%">
                <thead class="">
                <tr>
                    <th></th>
                    <th>User Group</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
       <!--  <div class="panel-footer"></div> -->
    </div>

</div>


<!-- <div id="div_user_group_fields" style="display: none;">
<div class="panel panel-default" style="border-top: 3px solid #2196f3;"> -->
<!-- <div class="panel-heading">
    <h2>User Group</h2>
    <div class="panel-ctrls" data-actions-container=""></div>
</div> -->

<!-- <div class="panel-body">
<h2>User Group Information</h2>
    <form id="frm_user_group" role="form" class="form-horizontal row-border">
        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>* User Group :</strong></label>
            <div class="col-md-7">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-users"></i>
                    </span>
                    <input type="text" name="user_group" class="form-control" placeholder="User Group" data-error-msg="User Group is required!" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 col-md-offset-1 control-label"><strong>* Description :</strong></label>
            <div class="col-md-7">
                <textarea name="user_group_desc" class="form-control"></textarea>
            </div>
        </div>
    </form>
    <br /><br />
</div> -->
<!-- <div class="panel-footer">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-3">
            <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>  Save Changes</button>
            <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
        </div>
    </div>
</div> -->
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
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

<div id="modal_user_group" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="usergroup_title" class="modal-title" style="color: white;"></h4>
            </div>
            <div class="modal-body">
                <form id="frm_user_group" role="form" class="form-horizontal row-border">
                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label"><strong>* User Group :</strong></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <input type="text" name="user_group" class="form-control" placeholder="User Group" data-error-msg="User Group is required!" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-md-offset-1 control-label"><strong>* Description :</strong></label>
                        <div class="col-md-6">
                            <textarea name="user_group_desc" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_save" class="btn btn-primary">Save</button>
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

        dt=$('#tbl_user_group_list').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "User_groups/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "user_group" },
                { targets:[2],data: "user_group_desc" },
                {
                    targets:[3],data: "is_active",render : function(data, type, full, meta){
                        var _attribute='';

                        if(data=="1"){
                            _attribute=' class="fa fa-check-circle" style="color:green;" ';
                        }else{
                            _attribute=' class="fa fa-times-circle" style="color:red;" ';
                        }

                        return '<center><i '+_attribute+'></i></center>';
                    }
                },
                {
                    targets:[4],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
                        var btn_rights='<button class="btn btn-default btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Setup User Rights"><i class="fa fa-gear"></i> Setup User Rights</button>';


                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ]
        });


        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Create User Group" >'+
                '<i class="fa fa-plus"></i> Create User Group</button>';
            $("div.toolbar").html(_btnNew);
        }();





    }();






    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_user_group_list tbody').on( 'click', 'tr td.details-control', function () {
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
                    "url":"Templates/layout/user-rights?id="+ d.user_group_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response,'no-padding' ).show();
                    // Add to the 'open' array


                    reInitializeLinksDropDown();
                    reInitializeSpecificButton(d.user_group_id);

                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                });
            }
        } );


        $('#btn_new').click(function(){
            _txnMode="new";
            clearFields();
            $('#usergroup_title').text('New User Group');
            $('#modal_user_group').modal('show');
            //showList(false);
        });






        $('#tbl_user_group_list tbody').on('click','button[name="edit_info"]',function(){
            ///alert("ddd");
            _txnMode="edit";
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.user_group_id;

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                        _elem.val(value);
                    }
                });
            });

            $('#usergroup_title').text('Edit User Group');
            $('#modal_user_group').modal('show');
            //showList(false);

        });

        $('#tbl_user_group_list tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.user_group_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeUserGroup().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });


        $('#btn_cancel').click(function(){
            $('#modal_user_group').modal('hide');
            //showList(true);
        });



        $('#btn_save').click(function(){

            if(validateRequiredFields($('#frm_user_group'))){
                if(_txnMode=="new"){
                    createUserGroup().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_user_group'));
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }else{
                    updateUserGroup().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields($('#frm_user_group'));
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }

                $('#modal_user_group').modal('hide');

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


    var createUserGroup=function(){
        var _data=$('#frm_user_group').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"User_groups/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateUserGroup=function(){
        var _data=$('#frm_user_group').serializeArray();
        _data.push({name : "user_group_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"User_groups/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeUserGroup=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"User_groups/transaction/delete",
            "data":{user_group_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_user_group_list').show();
            $('#div_user_group_fields').hide();
        }else{
            $('#div_user_group_list').hide();
            $('#div_user_group_fields').show();
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


   var reInitializeLinksDropDown=function(){
       $(".cbo_links").select2({
           allowClear: false
       });
   };



    var reInitializeSpecificButton=function(id){
        var parentDiv=$('#user_rights_'+id);
        parentDiv.on('click','button#btn_user_group_rights_'+id,function(){
            var btn=this;
            var _data=parentDiv.find('form').serializeArray();

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"User_groups/transaction/save-rights",
                "data":_data,
                "beforeSend": showSpinningProgress(btn)
            }).done(function(response){
                showNotification(response);
            }).always(function(){
                showSpinningProgress(btn);
            });


        });
    };










});




</script>


</body>


</html>