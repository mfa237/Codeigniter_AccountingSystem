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


    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">

    <link type="text/css" href="assets/plugins/zTree/zTreeStyle.css" rel="stylesheet">

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


        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        #zTreeDemoBackground { 
            overflow: auto;
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

        <ol class="breadcrumb" style="margin:0;">
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="account_titles">Chart of Accounts</a></li>
        </ol>
        <div class="container-fluid">
            <div data-widget-group="group1">
                <div class="row">
                    <div class="col-md-12">
                        <div id="div_chart_list">
                            <div class="panel panel-default">
                                <div class="panel-body table-responsive">
                            <h2 class="h2-panel-heading">Chart of Accounts</h2><hr>
                             <!--    <div class="panel-heading">
                                    <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Chart of Accounts</b>
                                </div> -->
                                <div class="row" id="treeListWrapper">
                                    <div class="col-xs-12 col-lg-4">
                                        <div id="zTreeDemoBackground" style="margin:3% 0% 3% 3%;">
                                            <ul id="treeDemo" class="ztree"></ul>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-lg-8">
                                        <div class="panel-body table-responsive" style="padding-left: 1px!important;border-top-color:transparent!important;">
                                            <table id="tbl_accounts" class="table table-striped" cellspacing="0" width="100%">
                                                <thead class="">
                                                <tr>
                                                    <th>&nbsp;&nbsp;</th>
                                                    <th>Account #</th>
                                                    <th>Account</th>
                                                    <th>Parent</th>
                                                    <th>Type</th>
                                                    <th><center>Action</center></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <!-- <div class="panel-footer"></div> -->
                            </div>
                        </div>


                        <div id="div_account_fields" style="display: none;">
                            <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                <!-- <div class="panel-heading">
                                    <h2>Account Information</h2>
                                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                </div> -->
                                <div class="panel-body">
                                    <h2 class="h2-panel-heading" id="account_add_title">Chart of Accounts</h2><hr>
                                    <!-- <h2 id="account_add_title"></h2><br> -->
                                    <form id="frm_accounts" role="form" class="form-horizontal row-border">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><strong>* Account # :</strong></label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-code"></i>
                                                    </span>
                                                    <input type="text" name="account_no" class="form-control" placeholder="Account No" data-    error-msg="Account number is required!" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><strong>* Account :</strong></label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-calendar-o"></i>
                                                                </span>
                                                    <input type="text" name="account_title" class="form-control" placeholder="Account Title" data-error-msg="Account title is required!" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><strong>Description :</strong></label>
                                            <div class="col-md-9">
                                                <textarea name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><strong>* Classification :</strong></label>
                                            <div class="col-md-9">
                                                <select name="account_class" id="cbo_account_class" data-error-msg="Account classification is required." required>
                                                    <option value="0">[ Create New Classification ]</option>
                                                    <?php foreach($classifications as $class){ ?>
                                                        <option value="<?php echo $class->account_class_id; ?>"><?php echo $class->account_class; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><strong>Parent Account :</strong></label>
                                            <div class="col-md-9">
                                                <select name="parent_account" id="cbo_parent_account">
                                                    <option value="0">No parent acccount</option>
                                                    <?php foreach($parents as $account){ ?>
                                                        <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br /><br /><br />
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
                <h4 class="modal-title" style="color:white;><span id="modal_mode"> </span>Confirm Deletion</h4>

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



<div id="modal_new_account_class" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content"><!---content--->
            <div class="modal-header modal-erp">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>New Classification</h4>
            </div>

            <div class="modal-body" style="overflow:hidden;">
                <form id="frm_account_classes">
                    <div class="form-group">
                        <label><strong>* Classification :</strong></label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </span>
                            <input type="text" name="account_class" class="form-control" placeholder="Classification" data-error-msg="Account classification is required." required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description :</strong></label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>* Account type :</strong></label>
                        <select name="account_type" id="cbo_account_type" data-error-msg="Account type is required." required>
                            <?php foreach($types as $type){ ?>
                                <option value="<?php echo $type->account_type_id; ?>"><?php echo $type->account_type; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="btn_create_account_class" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                <button id="btn_close_account_class" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
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

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>


<script type="text/javascript" src="assets/plugins/zTree/jquery.ztree.core.js"></script>


<script>
$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboClasses; var _cboParentAccounts; var zNodes; var setting; var _cboTypes;


    var reInitializeTreeView=function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    };

    var reInitializeParentAccount=function(){
        _cboParentAccounts=$("#cbo_parent_account").select2({
            placeholder: "Please select parent account.",
            allowClear: true
        });
        _cboParentAccounts.select2('val',0);
    };


    var initializeControls=function(){

        dt=$('#tbl_accounts').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Account_titles/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "account_no" },
                { targets:[2],data: "account_title" },
                { targets:[3],data: "parent_account" },
                { targets:[4],data: "account_type" },
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
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Account Title" >'+
                '<i class="fa fa-plus"></i> New Account Title</button>';
            $("div.toolbar").html(_btnNew);
        }();




        //**************************************************************************************************************
        setting= {
            view: {

                addDiyDom: addDiyDom
            },
            data: {
                key: {
                    title: "title"
                },
                simpleData: {
                    enable: true
                }
            }
        };

        /*var zNodes =[
            {id:"T1",pId:"",name:"Asset",open:true, iconOpen:"assets/plugins/zTree/img/diy/1_open.png", iconClose:"assets/plugins/zTree/img/diy/1_close.png"},
            {id:"T2",pId:"",name:"Liability",open:true, iconOpen:"assets/plugins/zTree/img/diy/1_open.png", iconClose:"assets/plugins/zTree/img/diy/1_close.png"},
            {id:"1",pId:"T1",name:"Cash in Bank"}

        ];*/

        zNodes=<?php echo json_encode($accounts); ?>;
        reInitializeTreeView();





        //initialize account classification
        _cboClasses=$("#cbo_account_class").select2({
            placeholder: "Please select classification.",
            allowClear: true
        });
        _cboClasses.select2('val',null);


        _cboTypes=$("#cbo_account_type").select2({
            placeholder: "Please select classification.",
            allowClear: false,
            dropdownParent: "#modal_new_account_class"
        });
        _cboTypes.select2('val',1);


        reInitializeParentAccount();


    }();






    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_accounts tbody').on( 'click', 'tr td.details-control', function () {
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
                    "url":"Templates/layout/customer/"+ d.account_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response,'no-padding' ).show();
                    reInitializeDatatable($('#tbl_so_'+ d.account_id));
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                });



            }
        } );


        $('#btn_new').click(function(){
            _txnMode="new";
            $('#account_add_title').text('New Account Information');
            showList(false);
        });

        $('#btn_create_account_class').click(function(){

            var btn=$(this);

            if(validateRequiredFields($('#frm_account_classes'))){
                var data=$('#frm_account_classes').serializeArray();

                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Account_classes/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_account_class').modal('hide');

                    var _class=response.row_added[0];
                    $('#cbo_account_class').append('<option value="'+_class.account_class_id+'" selected>'+_class.account_class+'</option>');
                    $('#cbo_account_class').select2('val',_class.account_class_id);

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }





        });


        $('#tbl_accounts tbody').on('click','button[name="edit_info"]',function(){
            ///alert("ddd");
            _txnMode="edit";
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.account_id;

            $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){

                        if(_elem.attr('name')==name){
                            _elem.val(value);
                        }
                });
            });

            $('#cbo_account_class').select2('val',data.account_class_id);
            $('#cbo_parent_account').select2('val',data.parent_account_id);


            $('#account_add_title').text('Edit Account Information');
            showList(false);

        });

        $('#tbl_accounts tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.account_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeAccount().done(function(response){
                showNotification(response);
                if(response.stat=='success') {
                    dt.row(_selectRowObj).remove().draw();
                    zNodes=response.row_hierarchy;
                    reInitializeTreeView();
                }
            });
        });


        _cboClasses.on("select2:select", function (e) {

            var i=$(this).select2('val');

            if(i==0){ //new supplier
                _cboClasses.select2('val',null)
                $('#modal_new_account_class').modal('show');
                clearFields($('#modal_new_account_class').find('form'));
            }


        });



        $('#btn_cancel').click(function(){

            showList(true);
        });

        $('#btn_save').click(function(){

            if(validateRequiredFields($('#frm_accounts'))){
                if(_txnMode=="new"){
                    createAccountInfo().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            var row_data=response.row_added[0];
                            dt.row.add(row_data).draw();

                            zNodes=response.row_hierarchy;
                            reInitializeTreeView();

                            var parentList='<option value="0">No parent account</option>'; var parents=response.parents;
                            $.each(parents,function(i,value){
                                parentList+=createAccountParentList(value);
                            });

                            $('#cbo_parent_account').html(parentList); reInitializeParentAccount();

                            clearFields($('#frm_accounts'));
                            showList(true);
                        }


                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }else{
                    updateAccountInfo().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw(false);
                            zNodes=response.row_hierarchy;
                            reInitializeTreeView();
                            clearFields($('#frm_accounts'));
                            showList(true);
                        }

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

        return stat;
    };


    var createAccountInfo=function(){
        var _data=$('#frm_accounts').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_titles/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateAccountInfo=function(){
        var _data=$('#frm_accounts').serializeArray();
        _data.push({name : "account_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_titles/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeAccount=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Account_titles/transaction/delete",
            "data":{account_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_chart_list').show();
            $('#div_account_fields').hide();
        }else{
            $('#div_chart_list').hide();
            $('#div_account_fields').show();
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

    function addDiyDom(treeId, treeNode) {
        var aObj = $("#" + treeNode.tId);

        if(!isNaN(treeNode.id)){

            //aObj.closest('a').text("Test");


        }
    };


    var showSpinningProgress=function(e){
        $(e).toggleClass('disabled');
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $('form').find('input:first').focus();
    };


    var reInitializeDatatable=function(tbl){
        tbl.DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false

        });
    };


    var createAccountParentList=function(row){
        return '<option value="'+row.account_id+'">'+row.account_title+'</option>'
    };





});




</script>


</body>


</html>