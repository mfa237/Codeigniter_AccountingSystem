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
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboItemTypes; var _isTaxExempt=0;

    var initializeControls=function(){


        dt=$('#tbl_products').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Products/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "product_code" },
                { targets:[2],data: "product_desc" },
                { targets:[3],data: "category_name" },
                { targets:[4],data: "unit_name" },
                {
                    targets:[5],data: "on_hand",
                    render: function (data, type, full, meta) {
                        if(data=="na"){
                            return data;
                        }else{
                            return accounting.formatNumber(data,2);
                        }

                    }
                },
                {
                    targets:[6],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ],

            language: {
                         searchPlaceholder: "Search Product Name"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(5).attr({
                    "align": "left"
                });
            }
        });

        /*_product_category=$("#product_category").select({
            placeholder: "Please select category",
            allowClear: true
        });

        _product_category.select('val', null);

        _product_category.on("select", function (e) {

            var i=$(this).select('val');
            if(i==0){
                $(this).select('val',null)
                $('#modal_confirmation').modal('show');
                clearFields($('#modal_confirmation').find('form'));
            }


        });*/

        // NEW PRODUCT CATEGORY
        $("#product_category").on("change", function () {        
            $modal = $('#modal_category_group');
            if($(this).val() === 'cat'){
                $modal.modal('show');
                $('#modal_create_product').modal('toggle');
                //clearFieldsModal($('#frm_category_group'));
                clearFieldsCategory($('#frm_category_group'));
            }
        });

        $('#btn_close_category_group').click(function(){
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_unit_group'));

        });
        // END HERE

        // NEW PRODUCT UNIT
        $("#product_unit").on("change", function () {        
            $modal = $('#modal_unit_group');
            if($(this).val() === 'unt'){
                $modal.modal('show');
                $('#modal_create_product').modal('toggle')
                //clearFieldsModal($('#frm_unit_group'));
                clearFieldsUnit($('#frm_unit_group'));
            }
        });

        $('#btn_close_unit_group').click(function(){
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_unit_group'));
        });
        // END HERE

        /*_product_unit=$("#product_unit").select2({
            placeholder: "Please select Unit",
            allowClear: true
        });
        _product_unit.select2('val', null);

        _cboItemTypes=$("#cbo_item_type").select2({
            placeholder: "Please select item type.",
            allowClear: false
        });


        _cboAccounts=$("#cbo_accounts").select2({
            placeholder: "Please select link account.",
            allowClear: false
        });
        _cboAccounts.select2('val', 0);

        var _cboAccountExpenses=$("#cbo_accounts_expense").select2({
            placeholder: "Please select link account.",
            allowClear: false
        });
        _cboAccountExpenses.select2('val', 0);

        _product_unit.on("select2:select", function (e) {

            var i=$(this).select2('val');
            if(i==0){
                $(this).select2('val',null)
                $('#modal_unit_group').modal('show');
                clearFields($('#modal_unit_group').find('form'));
            }


        });*/

        $('.numeric').autoNumeric('init');

        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-green"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Create New product" >'+
                '<i class="fa fa-file"></i> Create New product</button>';
            $("div.toolbar").html(_btnNew);
        }();
    }();

    $('#btn_create_category_group').click(function(){

        var btn=$(this);

        if(validateRequiredFields($('#frm_category_group'))){
            var data=$('#frm_category_group').serializeArray();

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Categories/transaction/create",
                "data":data,
                "beforeSend" : function(){
                    showSpinningProgress(btn);
                }
            }).done(function(response){
                showNotification(response);
                $('#modal_category_group').modal('hide');
                $('#modal_create_product').modal('show');

                var _group=response.row_added[0];
                $('#product_category').append('<option value="'+_group.category_id+'" selected>'+_group.category_name+'</option>');
                // TEMPORARY COMMENT --> $('#product_category').select2('val',_group.category_id);

            }).always(function(){
                showSpinningProgress(btn);
            });
        }


    });

    $('#btn_create_unit_group').click(function(){

        var btn=$(this);

        if(validateRequiredFields($('#frm_unit_group'))){
            var data=$('#frm_unit_group').serializeArray();

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Units/transaction/create",
                "data":data,
                "beforeSend" : function(){
                    showSpinningProgress(btn);
                }
            }).done(function(response){
                showNotification(response);
                $('#modal_unit_group').modal('hide');
                $('#modal_create_product').modal('show');

                var _group=response.row_added[0];
                $('#product_unit').append('<option value="'+_group.unit_id+'" selected>'+_group.unit_name+'</option>');
                // TEMPORARY COMMENT --> $('#product_unit').select2('val',_group.unit_id);

            }).always(function(){
                showSpinningProgress(btn);
            });
        }


    });
    var bindEventHandlers=(function(){
        var detailRows = [];

        $('#tbl_products tbody').on( 'click', 'tr td.details-control', function () {
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
            $('#modal_create_product').modal('show');
            clearFields($('#frm_product'));
            $('#is_tax_exempt').attr('checked', false);
        });

        $('#tbl_products tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('#modal_create_product').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.product_id;
            $('#is_tax_exempt').val(data.is_tax_exempt);

            if(data.is_tax_exempt==1){
                $('#is_tax_exempt').prop('checked', true);
                _isTaxExempt = 1;
            } else{
                $('#is_tax_exempt').prop('checked', false);
                _isTaxExempt = 0;
            }

             $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

        });


        $('input[name="purchase_cost"],input[name="markup_percent"],input[name="sale_price"]').keyup(function(){
            reComputeSRP();
        });

        $('#tbl_products tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.product_id;

        });
        

        $('#btn_yes').click(function(){
            removeProduct().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();
            });
        });

        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;

            $('#div_img_product').hide();
            $('#div_img_loader').show();

            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });

            console.log(_files);

            $.ajax({
                url : 'Products/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                    $('#div_img_loader').hide();
                    $('#div_img_product').show();
                }
            });
        });

        $('#btn_cancel').click(function(){
            showList(true);
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields($('#frm_product'))){
                if(_txnMode=="new"){
                    createProduct().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_product'))
                        showList(true);
                    }).always(function(){
                        $('#modal_create_product').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    updateProduct().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $('#modal_create_product').modal('toggle');
                        showSpinningProgress($('#btn_save'));
                    });
                    return;
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

    var createProduct=function(){
        var _data=$('#frm_product').serializeArray();
        _data.push({name : "is_tax_exempt" ,value : _isTaxExempt});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Products/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updateProduct=function(){
        var _data=$('#frm_product').serializeArray();
        _data.push({name : "is_tax_exempt" ,value : _isTaxExempt});

        console.log(_data);
        _data.push({name : "product_id" ,value : _selectedID});

        return $.ajax({ 
            "dataType":"json",
            "type":"POST",
            "url":"Products/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeProduct=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Products/transaction/delete",
            "data":{product_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_product_list').show();
            $('#div_product_fields').hide();
        }else{
            $('#div_product_list').hide();
            $('#div_product_fields').show();
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

    /*var clearFields=function(f){
        $('input,textarea',f).val('');
        //$(f).find('select').select2('val',null);
        $(f).find('input:first').focus();
    };*/

    var clearFields=function(f){
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
        ('#is_tax_exempt',f).prop('checked', false);
    };

    var clearFieldsModal=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
    };

    var clearFieldsCategory=function(f){
        $('#category_name').val('');
        $('#category_desc').val('');
        $(f).find('select:first').focus();
    };

    var clearFieldsUnit=function(f){
        $('#unit_name').val('');
        $('#unit_desc').val('');
        $(f).find('select:first').focus();
    };

    function format ( d ) {
        return '<br /><table style="margin-left:10%;width: 80%;">' +
        '<thead>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td width="20%">Product Code : </td><td width="50%"><b>'+ d.product_code+'</b></td>' +
        '</tr>' +
        '<tr>' +
        '<td>Product Name : </td><td>'+ d.product_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Product Description : </td><td>'+ d.product_desc+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Category : </td><td>'+ d.category_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Department : </td><td>na</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Unit : </td><td>'+ d.unit_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Vat Exempt : </td><td>'+ d.is_tax_exempt+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Equivalent Points : </td><td>'+ d.equivalent_points+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Warn Qty : </td><td>'+ d.product_warn+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Ideal : </td><td>'+ d.product_ideal+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Purchase Cost : </td><td>'+ accounting.formatNumber(d.purchase_cost,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Markup Percent : </td><td>'+ d.markup_percent+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Sale Price : </td><td>'+ accounting.formatNumber(d.sale_price,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Whole Sale Price : </td><td>'+ accounting.formatNumber(d.whole_sale,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Retailer Price : </td><td>'+ accounting.formatNumber(d.retailer_price,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Special Discount Price : </td><td>'+ accounting.formatNumber(d.special_disc,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Valued Customer Price : </td><td>'+ accounting.formatNumber(d.valued_customer,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Discount Price : </td><td>'+ accounting.formatNumber(d.discounted_price,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Dealer Price : </td><td>'+ accounting.formatNumber(d.dealer_price,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Distributor Price : </td><td>'+ accounting.formatNumber(d.distributor_price,2)+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Public Price : </td><td>'+ accounting.formatNumber(d.public_price,2)+'</td>' +
        '</tr>' +
        '</tbody></table><br />';
    };

    // MARKUP + PURCHASE COST
    /*var reComputeSRP=function(){
        var markupPercent=getFloat($('input[name="markup_percent"]').val());
        var purchaseAmount=getFloat($('input[name="purchase_cost"]').val());

        if(markupPercent>0){
            var markupDecimal=markupPercent/100;
            var newAmount=purchaseAmount*markupDecimal;
            var srpAmount=purchaseAmount+newAmount;
            $('input[name="sale_price"]').val(accounting.formatNumber(srpAmount,2));
        }

    };*/

    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };

    $('#frm_product').on('click','input[id="is_tax_exempt"]',function(){
        if(_isTaxExempt==0) {
            this.checked = true;
            _isTaxExempt = 1;
            //alert(_isTaxExempt);
        } else {
            this.checked = false;
            _isTaxExempt = 0;
            //alert(_isTaxExempt);
        }
    });



   /* $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });*/


    // apply input changes, which were done outside the plugin
    //$('input:radio').iCheck('update');

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

        .numeric{
            text-align: right;
            width: 60%;
        }

       /* .container-fluid {
            padding: 0 !important;
        }

        .panel-body {
            padding: 0 !important;
        }*/

        #btn_new {
            text-transform: uppercase !important;
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
                        <li><a href="products">Products</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_product_list">
                                        <div class="panel panel-default" style="border-top: 3px solid #2196f3;">
                                            <div class="panel-body table-responsive">
                                                <h2>Products</h2>
                                                <table id="tbl_products" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead class="table-erp">
                                                    <tr>
                                                        <th></th>
                                                        <th>PLU</th>
                                                        <th>Product Description</th>
                                                        <th>Category</th>
                                                        <th>Unit</th>
                                                        <th>On Hand</th>
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
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
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

            <div id="modal_category_group" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>New Category Group</h4>

                        </div>

                        <div class="modal-body">
                            <form id="frm_category_group">
                                <div class="form-group">
                                    <label class="boldlabel">* Category Name :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" data-error-msg="Category name is required." required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="boldlabel">Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="category_desc" id="category_desc" placeholder="Category Description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">
                            <button id="btn_create_category_group" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                            <button id="btn_close_category_group" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!---modal-->

            <div id="modal_unit_group" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>New Unit Group</h4>

                        </div>

                        <div class="modal-body">
                            <form id="frm_unit_group">
                                <div class="form-group">
                                    <label class="boldlabel">* Unit Name :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="Unit Name" data-error-msg="Unit name is required." required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="boldlabel">Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="unit_desc" id="unit_desc" placeholder="Unit Description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">
                            <button id="btn_create_unit_group" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                            <button id="btn_close_unit_group" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!---modal-->

            <div id="modal_create_product" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Product Information</h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_product">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">PLU :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_code" class="form-control" value="" data-error-msg="PLU is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Product Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_desc" class="form-control" data-error-msg="Product Description is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Description :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_desc1" class="form-control" data-error-msg="Description is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Size :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="size" class="form-control" data-error-msg="Size is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Category :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <select name="category_id" id="product_category" class="form-control" data-error-msg="Category is required." required>
                                                        <option value="">Please Select...</option>
                                                        <option value="cat">[ Create Category ]</option>
                                                        <?php
                                                        foreach($categories as $row)
                                                        {
                                                            echo '<option value="'.$row->category_id  .'">'.$row->category_name.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Unit :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <select name="unit_id" id="product_unit" class="form-control" data-error-msg="Unit is required." required>
                                                        <option value="">Please Select...</option>
                                                        <option value="unt">[ Create Unit ]</option>
                                                        <?php
                                                        foreach($units as $row)
                                                        {
                                                            echo '<option value="'.$row->unit_id.'">'.$row->unit_name.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">* Type :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <select name="item_type_id" id="cbo_item_type" class="form-control" data-error-msg="Item type is required." required>
                                                        <option value="">None</option>
                                                        <?php foreach($item_types as $item_type){ ?>
                                                            <option value="<?php echo $item_type->item_type_id ?>"><?php echo $item_type->item_type; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Link to Account (Income) :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <select name="income_account_id" id="cbo_accounts" class="form-control" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Link to Account (Expense) :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <select name="expense_account_id" id="cbo_accounts_expense" class="form-control" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Tax Exempt ?</label><br>
                                                
                                                <input type="checkbox" name="is_tax_exempt" id="is_tax_exempt">
                                                
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Purchase Cost :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="purchase_cost" class="form-control numeric" data-error-msg="Purchase Cost is required." required>
                                                </div>
                                        </div>
                                        <!-- <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Markup Percent (%) :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="markup_percent" class="form-control numeric">
                                                </div>
                                        </div> -->
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Suggested Retail Price (SRP) :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="sale_price" class="form-control numeric" data-error-msg="SRP is required." required>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Warning Quantity :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_warn" class="form-control numeric" data-error-msg="Warning Quantity is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Ideal Quantity :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_ideal" class="form-control numeric" data-error-msg="Ideal Quantity is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Discounted Price :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="discounted_price" class="form-control numeric" data-error-msg="Discounted Price is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Dealer's Price :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="dealer_price" class="form-control numeric">
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Distributor's Price :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="distributor_price" class="form-control numeric" data-error-msg="Distributor's Price is required." required>
                                                </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Public Price :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="public_price" class="form-control numeric" data-error-msg="Public Price is required." required>
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