<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-cdjp-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">


    <!--<link href="assets/dropdown-enhance/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">-->

    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">



    <style>
        .drag_member{
            cursor: pointer;
        }

        .toolbar{
            float: left;
        }

        #tbl_entries td,#tbl_entries tr,#tbl_entries th{
            table-layout: fixed;
            border: 1px solid gray;
            border-collapse: collapse;
        }

        body {
            overflow-x: hidden;
        }

        td.details-control {
            background: url('assets/img/print.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/print.png') no-repeat center center;
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


        .custom_frame{

            border: 1px solid lightgray;
            margin: 1% 1% 1% 1%;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .numeric{
            text-align: right;
        }

        .boldlabel {
            font-weight: bold;
        }

        .modal-body {
            padding-left:0px !important;
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

                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Check_layout">Check Layout</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_payable_list">

                                        <div class="panel-group panel-default" id="accordionA">

                                            <div id="div_tests" class="panel panel-default">
                                                <!-- <div class="panel-heading">
                                                    <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Check Layout</b>
                                                </div> -->
                                                <div class="panel-body" style="min-height: 400px;">
                                                <h2 class="h2-panel-heading">Check Layout</h2><hr>
                                                    <div >
                                                        <table id="tbl_check_layouts" class="table table-striped" cellspacing="0" width="100%">
                                                            <thead class="">
                                                            <tr>

                                                                <th>Check Layout</th>
                                                                <th>Description</th>
                                                                <th>Posted by</th>
                                                                <th>Layout</th>
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
                                    </div>
                                </div>

                           </div>
                        </div>
                    </div>
                </div> <!-- .container-fluid -->
            </div> <!-- #page-content -->
        </div>

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline pull-left">
                    <li><h6 style="margin: 0;">&copy; 2016 - JDEV OFFICE SOLUTIONS</h6></li>
                </ul>
                <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
            </div>
        </footer>

    </div>
</div>
</div>

<div id="modal_new_layout" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog" style="width: 40%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2ecc71;">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:#ecf0f1 !important;"><span id="modal_mode"> </span>New Check Layout</h4>

            </div>

            <div class="modal-body" style="overflow:hidden;">
                <form id="frm_check_layout">
                    <div style="border: 1px solid lightgrey;padding: 1%;border-radius: 5px;margin-left: 2%;padding: 2%;">
                        <div class="row">
                            <div class="col-lg-12">
                                Check Layout * : <br />
                                <input type="text" name="check_layout" class="form-control" data-error-msg="Check layout is required!" placeholder="Check Layout" required >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                Description : <br />
                                <textarea name="description" class="form-control"></textarea>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12"><br />
                                <label class="radio-inline"><input type="radio" name="orientation_layout" id="rdoLandscape" value="0" checked>Landscape (11in x 8.5in)</label>
                                <label class="radio-inline"><input type="radio" name="orientation_layout" id="rdoPortrait" value="1">Portrait (8.5in x 11in)</label>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer">
                <button id="btn_save_layout" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Save Check Layout</button>
                <button id="btn_close_new_supplier" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>

        </div><!---content---->
    </div>
</div><!---modal-->






<?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>


<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<!-- Select2-->
<script src="assets/plugins/select2/select2.full.min.js"></script>
<!---<script src="assets/plugins/dropdown-enhance/dist/js/bootstrap-select.min.js"></script>-->



<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>



<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>



<script>
    $(document).ready(function() {
        var dt; var _selectRowObj; var _selectedID; var _txnMode;


        var initializeControls = (function () {

            $('#span_particular').draggable({containment:'#div_check_area'});
            $('#span_amount_words').draggable({containment:'#div_check_area'});
            $('#span_date').draggable({containment:'#div_check_area'});
            $('#span_amount').draggable({containment:'#div_check_area'});


            dt = $('#tbl_check_layouts').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange": false,
                "ajax" : "Check_layout/transaction/list",
                "columns": [

                    { targets:[0],data: "check_layout" },
                    { targets:[1],data: "description" },
                    { targets:[2],data: "posted_by_user" },
                    { targets:[3],data: "layout" },
                    {
                        targets:[4],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
                            var btn_scale='<button class="btn btn-success btn-sm" name="set_scale" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Scale"><i class="fa fa-gear"></i> Set Scale</button>';

                            return '<center>'+btn_edit+'&nbsp;'+btn_trash+'&nbsp;'+btn_scale+'</center>';
                        }
                    }
                ]
            });

            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Check Layout" >'+
                    '<i class="fa fa-plus"></i> New Check Layout</button>';
                $("div.toolbar").html(_btnNew);
            }();


        })();



        var bindEventHandlers=function(){

            $('#btn_new').click(function(){
                _txnMode="new";


                $('#modal_new_layout').modal('show');
            });

            $('#tbl_check_layouts tbody').on('click','button[name="remove_info"]',function(){

                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.check_layout_id;

                removeLayout().done(function(response){
                    if(response.stat=="success"){
                        showNotification(response);
                        dt.row(_selectRowObj).remove().draw();
                    }
                });
            });


            $('#tbl_check_layouts tbody').on('click','button[name="set_scale"]',function(){

                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.check_layout_id;

                window.open("Check_positions?id="+_selectedID,"Check Scale", "location=0,status=0,scrollbars=0,width=700,height=400");

            });


            $('#tbl_check_layouts tbody').on('click','button[name="edit_info"]',function(){

                _txnMode="edit";

                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.check_layout_id;


                if(data.is_portrait==1){

                    $('#rdoLandscape').prop('checked',false);
                    $('#rdoPortrait').prop('checked',true);
                }else{

                    $('#rdoLandscape').prop('checked',true);
                    $('#rdoPortrait').prop('checked',false);
                }




                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name) {
                            _elem.val(value);
                        }
                    });
                });


                $('#modal_new_layout').modal('show');
            });


            $('#btn_save_layout').click(function(){
                var objMainModal=$('#modal_new_layout');

                if(validateRequiredFields(objMainModal)){
                    if(_txnMode=="new"){
                        postLayout().done(function(response){
                            if(response.stat=="success"){
                                dt.row.add(response.row_added[0]).draw();
                                showNotification(response);
                                objMainModal.modal('hide');
                                clearFields(objMainModal);
                            }

                        }).always(function(){
                            showSpinningProgress($('#btn_save_layout'))
                        });
                    }else{
                        updateLayout().done(function(response){
                            if(response.stat=="success"){
                                dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                                showNotification(response);
                                objMainModal.modal('hide');
                                clearFields(objMainModal);
                            }

                        }).always(function(){
                            showSpinningProgress($('#btn_save_layout'))
                        });
                    }

                }

            });





        }();



        var postLayout=function(){

            var _data=$('#frm_check_layout').serializeArray();
            _data.push({name:'is_portrait',value:($('#rdoPortrait:checked').length>0?1:0)});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Check_layout/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save_layout'))
            });
        };


        var updateLayout=function(){

            var _data=$('#frm_check_layout').serializeArray();
            _data.push({name:'layout_id',value:_selectedID});
            _data.push({name:'is_portrait',value:($('#rdoPortrait:checked').length>0?1:0)});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Check_layout/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save_layout'))
            });
        };


        var removeLayout=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Check_layout/transaction/delete",
                "data":{layout_id : _selectedID}
            });
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
            $('input',f).val('');
        };

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




    });

</script>

</body>

</html>