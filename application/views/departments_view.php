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

        <div class="static-content-wrapper white-bg custom-background">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->

                    <ol class="breadcrumb transparent-background" style="margin: 0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="departments">Departments</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_department_list">
                                        <div class="panel panel-default">
<!--                                             <div class="panel-heading">
                                     
                                                <b style="color: white; font-size: 12pt;"><i style="color: #ffce3a;" class="ti ti-layout-accordion-merged"></i>&nbsp; Departments</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Departments</h2><hr>
                                                <table id="tbl_departments" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead>

                                                    <tr>
                                                        <th>Department Name</th>
                                                        <th>Department Description</th>
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
            <div id="modal_new_department" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #2ecc71">
                             <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                             <h2 id="department_title" class="modal-title" style="color:white;"></h2>
                        </div>
                        <div class="modal-body">
                            <form id="frm_department" role="form" class="form-horizontal">
                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><B> * </B> Department Name :</label>
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
                                </div><!-- 

                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Delivery Address :</label>
                                            <textarea name="delivery_address" class="form-control" placeholder="Delivery Address"></textarea>

                                        </div>
                                    </div>
                                </div>



                                <div class="row" style="margin: 1%;">
                                    <div class="col-lg-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Please specify the default cost of this Branch when purchasing items (Optional) :</label>
                                            <select name="default_cost" id="cbo_default_cost" class="form-control" data-error-msg="Item type is required." required>
                                                <option value="1">Purchase Cost 1 (Luzon Area)</option>
                                                <option value="2">Purchase Cost 2 (Viz-Min Area)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br /><br /> -->



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

<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;

    var initializeControls=function(){
        dt=$('#tbl_departments').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Departments/transaction/list",
            "language" : {
                "searchPlaceholder": "Search Department"
            },
            "columns": [
                { targets:[0],data: "department_name" },
                { targets:[1],data: "department_desc" },
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

        var createToolBarButton=function(){

            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Department" >'+

                '<i class="fa fa-plus"></i> New Department</button>';
            $("div.toolbar").html(_btnNew);
        }();
    }();

    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_departments tbody').on( 'click', 'tr td.details-control', function () {
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
            //showList(false);
            clearFields($('#frm_department'));
            $('#department_title').text('New Department');
            $('#modal_new_department').modal('show');
        });

        $('#tbl_departments tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.department_id;

            $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });
            $('#department_title').text('Edit Department');
            $('#modal_new_department').modal('show');
            //showList(false);
        });

        $('#tbl_departments tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.department_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeDepartment().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });

        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;

            $('#div_img_department').hide();
            $('#div_img_loader').show();

            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });

            //console.log(_files);

            $.ajax({
                url : 'Departments/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                    $('#div_img_loader').hide();
                    $('#div_img_department').show();
                }
            });
        });

        $('#btn_cancel').click(function(){
            clearFields();
            $('#modal_new_department').modal('hide');
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields()){
                if(_txnMode=="new"){
                    createDepartment().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields();
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }else{
                    updateDepartment().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields();
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }
                $('#modal_new_department').modal('hide');
            }
        });
    })();

    var validateRequiredFields=function(){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required]','#frm_department').each(function(){
            if($(this).val()==""){
                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                $(this).closest('div.form-group').addClass('has-error');
                stat=false;
                return false;
            }
        });
        return stat;
    };

    var createDepartment=function(){
        var _data=$('#frm_department').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Departments/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateDepartment=function(){
        var _data=$('#frm_department').serializeArray();
        _data.push({name : "department_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Departments/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeDepartment=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Departments/transaction/delete",
            "data":{department_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_department_list').show();
            $('#div_department_fields').hide();
        }else{
            $('#div_department_list').hide();
            $('#div_department_fields').show();
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
        $('input[required],textarea','#frm_department').val('');
        $('form').find('input:first').focus();
    };

    function format ( d ) {
        return '<br /><table style="margin-left:10%;width: 80%;">' +
        '<thead>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td>Department Name : </td><td><b>'+ d.department_name+'</b></td>' +
        '</tr>' +
        '<tr>' +
        '<td>Department Description : </td><td>'+ d.department_desc+'</td>' +
        '</tr>' +
        '</tbody></table><br />';
    };
});

</script>

</body>

</html>