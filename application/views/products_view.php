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
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboItemTypes; var _selectedProductType; var _isTaxExempt=0;
    var _cboSupplier; var _cboCategory; var _cboSupplier; var _cboTax; var _cboInventory; var _cboMeasurement; var _cboCredit; var _cboDebit;
    var _cboTaxGroup;
    
    /*$(document).ready(function(){
        $('#modal_filter').modal('show');
        showList(false);
    });*/

    var initializeControls=function() {
        dt=$('#tbl_products').DataTable({
            "fnInitComplete": function (oSettings, json) {
                $.unblockUI();
                },
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "pageLength":15,
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
                {
                    targets:[4],data: "on_hand",
                    render: function (data, type, full, meta) {
                        if(data=="na"){
                            return parseFloat(data);
                        }else{
                            return parseFloat(data);
                        }

                    }
                },
                {
                    targets:[5],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"   data-toggle="tooltip" data-placement="top" title="Edit" style="margin-left:-5px;"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-danger btn-sm" name="remove_info"  data-toggle="tooltip" data-placement="top" title="Move to trash" style="margin-right:-5px;"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ],

            language: {
                         searchPlaceholder: "Search Product Name"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(4).attr({
                    "align": "right"
                });
            }


        });

        $('.numeric').autoNumeric('init',{mDec:2});

        $('#mobile_no').keypress(validateNumber);

        $('#landline').keypress(validateNumber);

        _cboSupplier=$('#new_supplier').select2({
            placeholder: "Please select supplier.",
            allowClear: false
        });

        _cboCategory=$('#product_category').select2({
            allowClear: false
        });

        _cboTax=$('#cbo_tax').select2({
            allowClear: false
        });

        _cboInventory=$('#cbo_item_type').select2({
            allowClear: false
        });

        _cboMeasurement=$('#product_unit').select2({
            allowClear: false
        });

        _cboCredit=$('#income_account_id').select2({
            allowClear: false
        });

        _cboDebit=$('#expense_account_id').select2({
            allowClear: false
        });

        _cboTaxGroup=$('#cbo_tax_group').select2({
            allowClear: false
        });
    }();
    
        

        // NEW PRODUCT CATEGORY
        $("#product_category").on("change", function () {        
            $modal = $('#modal_category_group');
            if($(this).val() === 'cat'){
         
                $modal.modal('show');
                _cboCategory.select2('val',null);
                $('#modal_create_product').modal('toggle');
                //clearFieldsModal($('#frm_category_group'));
                clearFieldsCategory($('#frm_category_group'));
            }
        });

        $('#btn_close_category_group').click(function(){
            $('#modal_category_group').modal('toggle');
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_unit_group'));

        });
        // END HERE

        // NEW PRODUCT UNIT
        $("#product_unit").on("change", function () {        
            $modal = $('#modal_unit_group');
        
            if($(this).val() === 'unt'){
                _cboMeasurement.select2('val',null);
                $modal.modal('show');
                $('#modal_create_product').modal('toggle')
                //clearFieldsModal($('#frm_unit_group'));
                clearFieldsUnit($('#frm_unit_group'));
            }
        });

        $('#btn_close_unit_group').click(function(){
            $('#modal_unit_group').modal('toggle');
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_unit_group'));
        });
        // END HERE

        // NEW PRODUCT TYPE
        $("#product_type_modal").on("change", function () {        
            $modal = $('#modal_product_type');
            if($(this).val() === 'prodtype'){

                $modal.modal('show');
                $('#modal_create_product').modal('toggle');
                //clearFieldsModal($('#frm_product_type'));
                clearFieldsProductType($('#frm_product_type'));
            }
        });

        $('#btn_close_product_type').click(function(){
            $('#modal_product_type').modal('toggle');
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_product_type'));

        });
        // END HERE

        // NEW SUPPLIER
        $("#new_supplier").on("change", function () {        
            $modal = $('#modal_new_supplier');
            if($(this).val() === 'sup'){
                _cboSupplier.select2('val',null);
                $modal.modal('show');
                $('#modal_create_product').modal('toggle')
                //clearFieldsModal($('#frm_unit_group'));
                clearFieldsModal($('#frm_suppliers_new'));
            }
        });

        $('#btn_close_new_supplier').click(function(){
            $('#modal_new_supplier').modal('toggle');
            $('#modal_create_product').modal('show');
            //clearFields($('#frm_product_type'));

        });
        // END HERE

        $('#new_supplier').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#product_category').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#cbo_tax').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#cbo_item_type').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#product_unit').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#income_account_id').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#expense_account_id').select2({
            dropdownParent: $('#modal_create_product')
        });

        $('#cbo_tax_group').select2({
            dropdownParent: $('#modal_new_supplier')
        });


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
                $('#product_category').select2('val',_group.category_id);

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
                $('#product_unit').select2('val',_group.unit_id);

            }).always(function(){
                showSpinningProgress(btn);
            });
        }
    });

    $('#btn_create_product_type').click(function(){

        var btn=$(this);

        if(validateRequiredFields($('#frm_product_type'))){
            var data=$('#frm_product_type').serializeArray();

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Refproducts/transaction/create",
                "data":data,
                "beforeSend" : function(){
                    showSpinningProgress(btn);
                }
            }).done(function(response){
                showNotification(response);
                $('#modal_product_type').modal('hide');
                $('#modal_create_product').modal('show');

                var _group=response.row_added[0];
                $('#product_type_modal').append('<option value="'+_group.refproduct_id+'" selected>'+_group.product_type+'</option>');
                // TEMPORARY COMMENT --> $('#product_type_modal').select2('val',_group.unit_id);

            }).always(function(){
                showSpinningProgress(btn);
            });
        }
    });

    $('#btn_create_new_supplier').click(function(){

        var btn=$(this);

        if(validateRequiredFields($('#frm_suppliers_new'))){
            var data=$('#frm_suppliers_new').serializeArray();
            data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Suppliers/transaction/create",
                "data":data,
                "beforeSend" : function(){
                    showSpinningProgress(btn);
                }
            }).done(function(response){
                showNotification(response);
                $('#modal_new_supplier').modal('hide');
                $('#modal_create_product').modal('show');

                var _suppliers=response.row_added[0];
                $('#new_supplier').append('<option value="'+_suppliers.supplier_id+'" selected>'+_suppliers.supplier_name+'</option>');
                _cboSupplier.select2('val',_suppliers.supplier_id);
                /*$('#cbo_suppliers').select2('val',_suppliers.supplier_id);
                $('#cbo_tax_type').select2('val',_suppliers.tax_type_id);*/

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
                var d=row.data();
                $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"Products/transaction/product-history?id="+ d.product_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response,'no-padding' ).show();

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }


                });
            }
        } );

        $('#btn_new').click(function(){
            _txnMode="new";
            $('#modal_create_product').modal('show');
            clearFields($('#frm_product'));
            _cboCategory.select2('val',null);
            _cboSupplier.select2('val',null);
            _cboTax.select2('val',null);
            _cboInventory.select2('val',null);
            _cboMeasurement.select2('val',null);
            _cboCredit.select2('val',0);
            _cboDebit.select2('val',0);
            $('#is_tax_exempt').attr('checked', false);
        });

        $('#tbl_products tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";

            $('#modal_create_product').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.product_id;

            clearFields('#frm_product');
             $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

             _cboSupplier.select2('val',data.supplier_id);

            _cboCategory.select2('val',data.category_id);

            _cboTax.select2('val',data.tax_type_id);

            _cboInventory.select2('val',data.item_type_id);

            _cboMeasurement.select2('val',data.unit_id);

            _cboCredit.select2('val',data.income_account_id);

            _cboDebit.select2('val',data.expense_account_id);

            _cboTaxGroup.select2('val',data.tax_type_id);

            $('#is_tax_exempt').prop('checked', (data.is_tax_exempt==1?true:false));

        });


        $('input[name="purchase_cost"],input[name="markup_percent"],input[name="sale_price"]').keyup(function(){
            reComputeSRP();
        });

        $('#tbl_products tbody').on('click','button[name="remove_info"]',function(){
            $('#modal_confirmation').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.product_id;

        });
        

        $('#btn_yes').click(function(){
            removeProduct().done(function(response){
                showNotification(response);
                if(response.stat == 'success') {
                    dt.row(_selectRowObj).remove().draw();
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

        $('#btn_browse').click(function(event){
            event.preventDefault();
            $('input[name="file_upload[]"]').click();
        });

        $('#btn_remove_photo').click(function(event){
            event.preventDefault();
            $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
        });

        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;
            /*$('#div_img_product').hide();
            $('#div_img_loader').show();*/
            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });
            console.log(_files);
            $.ajax({
                url : 'Suppliers/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                    $('img[name="img_user"]').attr('src',response.path);
                }
            });
        });
    })();

    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                    if($(this).val()==null || $(this).val()==""){
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
       // _data.push({name : "is_tax_exempt" ,value : _isTaxExempt});

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
        //_data.push({name : "is_tax_exempt" ,value : _isTaxExempt});
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
        $(e).toggleClass('disabled');
    };

    /*var clearFields=function(f){
        $('input,textarea',f).val('');
        //$(f).find('select').select2('val',null);
        $(f).find('input:first').focus();
    };*/

    var clearFields=function(f){
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
        $('#is_tax_exempt',f).prop('checked', false);
        $('#img_user').attr('src','assets/img/anonymous-icon.png');
    };

    var clearFieldsModal=function(f){
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
        $('#img_user').attr('src','assets/img/anonymous-icon.png');
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

    var clearFieldsProductType=function(f){
        $('#product_type').val('');
        $('#description').val('');
        $(f).find('select:first').focus();
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
        return '<br /><table style="margin-left:10%;width: 80%;">' +
        '<thead>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td width="20%">Product Code : </td><td width="50%"><b>'+ d.product_code+'</b></td>' +
        '</tr>' +
        '<tr>' +
        '<td>Product Name : </td><td>'+ d.product_desc+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Product Description : </td><td>'+ d.product_desc1+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Supplier : </td><td>'+ d.supplier_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Product Type : </td><td>'+ d.product_type+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Category : </td><td>'+ d.category_name+'</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Department : </td><td>na</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Unit of Measurement : </td><td>'+ d.unit_name+'</td>' +
        '</tr>' +
        /*'<tr>' +
        '<td>Pack Size : </td><td>'+ d.size+'</td>' +
        '</tr>' +*/
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



    $('#btn_filter').click(function(){
        if(validateRequiredFields($('#frm_filter'))){
            showSpinningProgress($('#btn_filter'));
            showProduct();
            getProduct();
            $('#modal_filter').modal('toggle');
        }
    });

    var showProduct=function(){
        $('#div_product_list').show();
    };

    var hideProduct=function(){
        $('#div_product_list').hide();
        $('#modal_filter').modal('toggle');
    };

    $('#btn_backtofilter').click(function(){
        hideProduct();
        $('#tbl_products').dataTable().fnDestroy();
        $('#tbl_products').fnClearTable();
    });

    $('#refproduct_id').change(function() {
        _selectedProductType=$(this).val();
        //alert(_selectedProductType);
    });

   /* $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });*/


    // apply input changes, which were done outside the plugin
    //$('input:radio').iCheck('update');

    /*$("input[type='text']").focus(function()
    {   
        $(this).css('font-weight','bold');
        $(this).animate({
            height: '50px',
            color: '#616161',
            'font-size': '20px',
            'background-color': '#ffed4c'
        }, 100, function() {
            // Animation complete.
        });
    }).blur(function()
    {
        $(this).css('font-weight','bold');
        $(this).animate({
            height: '32px',
            color: '#616161',
            'font-size': '14px',
            'background-color': '#FFF'
        }, 100, function() {
            // Animation complete.
        })
    })*/


















});

</script>

    <style>

        .toolbar{
            float: left;
            margin-bottom: 0px !important;
            padding-bottom: 0px !important;
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

       /* .container-fluid {
            padding: 0 !important;
        }

        .panel-body {
            padding: 0 !important;
        }*/

        #btn_new {
            text-transform: capitalize !important;
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


        .numeric{
            text-align: right;
        }

        #is_tax_exempt {
            width:23px;
            height:23px;
        }

        #modal_new_supplier {
            padding-left:0px !important;
        }

        .input-group {
            padding:0;
            margin:0;
        }

        .btn-back {
            float: left; 
            border-radius: 50px; 
            border: 3px solid #9E9E9E!important; 
            background: transparent; 
            margin-right: 10px;
        }

        textarea {
            resize: none;
        }

        #supplier-modal p {
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

                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="products" id="filter">Products</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_product_list">
                                        <div class="panel panel-default">
<!--                                             <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Products</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Products</h2><hr>
                                                <button class="btn btn-primary" id="btn_new" style="float: left; text-transform: capitalize;font-family: Tahoma, Georgia, Serif;margin-bottom: 0px !important;" data-toggle="modal" data-target="" data-placement="left" title="Create New product" ><i class="fa fa-plus"></i> Create New Product</button>
                                                <table id="tbl_products" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>    
                                                        <th></th>
                                                        <th>PLU</th>
                                                        <th>Product Description</th>
                                                        <th>Category</th>
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
                            <h4 class="modal-title"  style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
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
                            <h4 class="modal-title title"><span id="modal_mode"> </span>New Category Group</h4>

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

            <div id="modal_product_type" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title""><span id="modal_mode"> </span>New Product Type</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_product_type">
                                <div class="form-group">
                                    <label class="boldlabel">* Product Type :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-cube"></i>
                                                </span>
                                        <input type="text" name="product_type" id="product_type" class="form-control" placeholder="Product Type" data-error-msg="Product Type is required!" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="boldlabel">Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="description" id="description" class="form-control" data-error-msg="Description is required!" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_create_product_type" class="btn btn-primary" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Create</button>
                            <button id="btn_close_product_type" class="btn btn-default" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_new_supplier" class="modal fade" tabindex="-1" role="dialog" style="padding-left:0px !important;"><!--modal-->
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1 !important;"><span id="modal_mode"> </span>New Supplier</h4>
                        </div>
                        <div class="modal-body" style="overflow:hidden;">
                            <form id="frm_suppliers_new">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Company Name :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" name="supplier_name" class="form-control" placeholder="Supplier Name" data-error-msg="Supplier Name is required!" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Contact Person :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-users"></i>
                                                    </span>
                                                    <input type="text" name="contact_name" class="form-control" placeholder="Contact Person" data-error-msg="Contact Person is required!" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Address :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-home"></i>
                                                     </span>
                                                     <textarea name="address" class="form-control" data-error-msg="Supplier address is required!" placeholder="Address" required ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;">Email Address :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
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
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-mobile"></i>
                                                    </span>
                                                    <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Contact No">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;">TIN # :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-code"></i>
                                                    </span>
                                                    <input type="text" name="tin_no" class="form-control" placeholder="TIN #">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-4" id="label">
                                                 <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Tax :</label>
                                            </div>
                                            <div class="form-group" style="padding:0;margin:5px;">
                                                <div class="input-group" style="padding: 0 !important;margin: 0 !important;">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-code"></i>
                                                    </span>
                                                    <select name="tax_type_id" id="cbo_tax_group" class="">
                                                        <option value="">Please select tax type...</option>
                                                        <?php foreach($tax_types as $tax_type){ ?>
                                                            <option value="<?php echo $tax_type->tax_type_id; ?>" data-tax-rate="<?php echo $tax_type->tax_rate; ?>"><?php echo $tax_type->tax_type; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <label class="control-label boldlabel" style="text-align:left;padding-top:10px;"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px;"></i>Supplier's Photo</label>
                                                    <hr style="margin-top:0px !important;height:1px;background-color:black;">
                                                </div>
                                                <div style="width:100%;height:300px;border:2px solid #34495e;border-radius:5px;">
                                                    <center>
                                                        <img name="img_user" id="img_user" src="assets/img/anonymous-icon.png" height="140px;" width="140px;" style="padding-bottom: 15px;"></img>
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
                            <button id="btn_create_new_supplier" type="button" class="btn btn-primary"  style="background-color:#2ecc71;color:white;"><span class=""></span> Save</button>
                            <button id="btn_close_new_supplier" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->

            <div id="modal_create_product" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog" style="width: 75%;">
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
                                            <label class=""><b>*</b> PLU :</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-file-code-o"></i>
                                                    </span>
                                                    <input type="text" name="product_code" id="product_code" class="form-control" value="" data-error-msg="PLU is required." required>
                                                </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom:0px;">
                                                <label class=""><b>*</b> Product Description :</label>
                                                <textarea name="product_desc" id="product_desc"class="form-control" data-error-msg="Product Description is required." required></textarea>
                                        </div>

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Other Description :</label>
                                            <textarea name="product_desc1" id="product_desc1" class="form-control"></textarea>
                                        </div>


                                        <!-- <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="">Product Type * :</label>
                                                    <select name="refproduct_id" id="product_type_modal" class="form-control" data-error-msg="Product type is required." required>
                                                        <option value="">Please Select...</option>
                                                        <option value="prodtype">[ Create Product Type ]</option>
                                                        <?php
                                                        //foreach($refproduct as $row)
                                                        {
                                                            //echo '<option value="'.$row->refproduct_id.'">'.$row->product_type.'</option>';
                                                        }
                                                        ?>
                                                    </select>

                                        </div> -->


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><b>*</b> Supplier :</label>
                                            <select name="supplier_id" id="new_supplier" data-error-msg="Supplier is required." required>
                                                <option value="">Please select supplier</option>
                                                <option value="sup">[ Create Supplier ]</option>
                                                <?php
                                                foreach($suppliers as $row)
                                                {
                                                    echo '<option value="'.$row->supplier_id.'">'.$row->supplier_name.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><b>*</b> Category :</label>
                                            <select name="category_id" id="product_category" data-error-msg="Category is required." required>
                                                <option value="">Please Select...</option>
                                                <option value="cat">[ Create Category ]</option>
                                                <?php
                                                foreach($categories as $row)
                                                {
                                                    echo '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><b>*</b> Tax:</label>
                                            <select name="tax_type_id" id="cbo_tax" data-error-msg="Tax Type is required." required>
                                                <option value="">Please Select...</option>
                                                <?php foreach($tax_types as $tax_type) { ?>
                                                    <option value="<?php echo $tax_type->tax_type_id; ?>"><?php echo $tax_type->tax_type; ?></option>
                                                <?php    } ?>


                                            </select>
                                        </div>



                                    </div>



                                    <div class="col-lg-4" style="margin:0px;">


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><b>*</b> Inventory type :</label>

                                            <select name="item_type_id" id="cbo_item_type" data-error-msg="Inverntory type is required." required>
                                                <option value="">None</option>
                                                <?php foreach($item_types as $item_type){ ?>
                                                    <option value="<?php echo $item_type->item_type_id ?>"><?php echo $item_type->item_type; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>



                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class=""><b>*</b> Unit of Measurement :</label>
                                            <select name="unit_id" id="product_unit" data-error-msg="Unit is required." required>
                                                <option value="">Please select unit of measurement</option>
                                                <option value="unt">[ Create Unit ]</option>
                                                <?php
                                                foreach($units as $row)
                                                {
                                                    echo '<option value="'.$row->unit_id.'">'.$row->unit_name.'</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>


                                        <!-- <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Pack Size :</label>
                                            <input type="text" name="size" class="form-control">
                                        </div> -->




                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Suggested Retail Price (SRP) :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="sale_price" id="sale_price" class="form-control numeric">
                                            </div>
                                        </div>


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Discounted Price :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="discounted_price" id="discounted_price" class="form-control numeric">
                                            </div>
                                        </div>



                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Dealer's Price :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="dealer_price" id="dealer_price" class="form-control numeric">
                                            </div>
                                        </div>



                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Distributor's Price :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="distributor_price" id="distributor_price" class="form-control numeric">
                                            </div>
                                        </div>

                                    </div>




                                    <div class="col-lg-4">

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Public Price :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="public_price" id="public_price" class="form-control numeric">
                                            </div>
                                        </div>



                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Purchase Cost :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="purchase_cost" id="purchase_cost" class="form-control numeric">
                                            </div>

                                        </div>

                                        <!-- <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Purchase Cost 2 (Viz-Min Area):</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="purchase_cost_2" class="form-control numeric">
                                            </div>

                                        </div> -->


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Warning Quantity :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="product_warn" id="product_warn" class="form-control numeric">
                                            </div>
                                        </div>


                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="">Ideal Quantity :</label>
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </span>
                                                <input type="text" name="product_ideal" id="product_ideal" class="form-control numeric">
                                            </div>
                                        </div>





                                        <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="">Link to Credit Account :</label>

                                                    <select name="income_account_id" id="income_account_id" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="0">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>

                                        </div>


                                        <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="">Link to Debit Account :</label>

                                                    <select name="expense_account_id" id="expense_account_id" data-error-msg="Link to Account is required." required>
                                                        <optgroup label="Please select NONE if this will not be recorded on Journal."></optgroup>
                                                        <option value="0">None</option>
                                                        <?php foreach($accounts as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>"><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>

                                        </div>


                                        <div class="form-group" style="margin-bottom:0px;">
                                                <label class="">Tax Exempt ?</label><br>
                                                <input type="checkbox" name="is_tax_exempt" class="form-control" id="is_tax_exempt">

                                        </div>





                                    </div>



                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_save" type="button" class="btn btn-primary" style="background-color:#2ecc71;color:white;"><span></span> Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->





            <div id="modal_filter" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#27ae60;">
                            <button type="button" style="color:white;" class="close"  data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> View Product List </h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_filter">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="margin-bottom:0px;">
                                            <label class="boldlabel">Product Type :</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-file-code-o"></i>
                                                </span>
                                                <select name="refproduct_id" id="refproduct_id" class="form-control">
                                                    <option value="">View all products</option>
                                                    
                                                    <?php
                                                    foreach($refproduct as $row)
                                                    {
                                                        echo '<option value="'.$row->refproduct_id.'">'.$row->product_type.'</option>';
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
                </div>

            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2017 - JDEV IT BUSINESS SOLUTION</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>

        </div>
    </div>
</div>





</body>

</html>