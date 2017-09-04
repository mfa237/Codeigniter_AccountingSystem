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

                    <ol class="breadcrumb" style="margin-bottom: 0px;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Email_settings">Email Settings  <?php //print_r($user_groups); ?></a></li>
                    </ol>


                <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">


                                    <div id="div_company_fields">
                                        <div class="panel panel-default">
                                            <!-- <div class="panel-heading">
                                                <h2>Company Information</h2>
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                            </div>
 -->                                        <!-- <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Email Settings</b>
                                            </div> -->
                                            <div class="panel-body">
                                            <h2 class="h2-panel-heading">Email Settings</h2><hr>
                                               <form id="frm_company" role="form" class="form-horizontal row-border">
                                                   <div class="form-group hidden">
                                                       <label class="col-md-2 col-md-offset-1 control-label">
                                                           <strong>* E-mail Provider :</strong>
                                                       </label>
                                                       <div class="col-md-7">
                                                           <select id="cbo_email_provider" class="form-control" name="email_provider">
                                                               <option value="ssl://smtp.googlemail.com" data-value="@gmail.com"><i class="ti ti-google"></i> Gmail</option>
                                                               <option value="ssl://smtp-mail.outlook.com" data-value="@outlook.com"><i class="ti ti-microsoft-alt"></i> Outlook</option>
                                                               <option value="ssl://smtp.mail.yahoo.com." data-value="@yahoo.com"><i class="ti ti-yahoo"></i> Yahoo</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Email Address :</strong></label>
                                                       <div class="col-md-5">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-users"></i>
                                                                </span>
                                                                <input type="text" name="email_address" class="form-control" value="<?php echo $company->email_address; ?>" placeholder="Company Name" data-error-msg="Company Name is required!" required>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1" style="margin-top: 5px;">
                                                           <span><strong id="provider_string"></strong></span>
                                                       </div>
                                                   </div>


                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"><strong>* Password :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-file"></i>
                                                                </span>
                                                               <input type="password" name="password" class="form-control" value="<?php echo $company->password; ?>"  data-error-msg="Password is required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"> <strong>Name (From) :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <input type="text" name="name_from" class="form-control" value="<?php echo $company->name_from; ?>" data-error-msg="Name From is Required!" required>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="form-group">
                                                       <label class="col-md-2 col-md-offset-1 control-label"> <strong>Default Message :</strong></label>
                                                       <div class="col-md-7">
                                                           <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-send"></i>
                                                                </span>
                                                               <textarea type="text" name="default_message" class="form-control" required data-error-msg="Default Message is Required"><?php echo $company->default_message; ?></textarea>
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

            <div id="modal_tax_group" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content"><!---content--->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>New Tax Group</h4>

                        </div>

                        <div class="modal-body">
                            <form id="frm_tax_group">
                                <div class="form-group">
                                    <label>* Tax Type :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="text" name="tax_name" class="form-control" placeholder="Tax group" data-error-msg="Tax name is required." required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>* Tax Rate :</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </span>
                                        <input type="number" name="tax_rate" class="form-control" placeholder="Tax Rate" data-error-msg="Tax Rate is required." required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Description :</label>
                                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="tax_group_desc" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>


                        </div>

                        <div class="modal-footer">
                            <button id="btn_create_tax_group" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                            <button id="btn_close_user_group" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
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
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _company_info; var _businesstype



        var initializeControls=function(){
            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Email_settings/transaction/get-email"
            }).done(function(response){
                $('#cbo_email_provider option[value="'+response.data.email_provider+'"]').prop('selected',true);
                $('#provider_string').html($('#cbo_email_provider option:selected').data('value'));
                $('input[name="email_address"]').val(response.data.email_address.split('@')[0]);
            });

            _company_info=$("#tax_group").select2({
                placeholder: "Please select Tax type",
                allowClear: true
            });

            _businesstype=$("#business_type").select2({
                placeholder: "Please select business type",
                allowClear: true
            });
        }();

        var bindEventHandlers=function(){
            var detailRows = [];

            $('#tbl_company_info tbody').on( 'click', 'tr td.details-control', function () {
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
            });

            $('#btn_browse').click(function(event){
                event.preventDefault();
                $('input[name="file_upload[]"]').click();
            });

            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_company"]').attr('src','assets/img/anonymous-icon.png');
            });

            $('#btn_create_tax_group').click(function(){

                var btn=$(this);

                if(validateRequiredFields($('#frm_tax_group'))){
                    var data=$('#frm_tax_group').serializeArray();

                    $.ajax({
                        "dataType":"json",
                        "type":"POST",
                        "url":"Tax_groups/transaction/create",
                        "data":data,
                        "beforeSend" : function(){
                            showSpinningProgress(btn);
                        }
                    }).done(function(response){
                        showNotification(response);
                        $('#modal_tax_group').modal('hide');

                        var _group=response.row_added[0];
                        $('#tax_group').append('<option value="'+_group.tax_type_id+'" selected>'+_group.tax_type+'</option>');
                        $('#tax_group').select2('val',_group.tax_type_id);

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }
            });



            $('#btn_yes').click(function(){
                removeCompanyInfo().done(function(response){
                    showNotification(response);
                    dt.row(_selectRowObj).remove().draw();
                });
            });

            $('#cbo_email_provider').on('change',function(){
                $('#provider_string').html($('#cbo_email_provider option:selected').data('value'));
            });

            $('input[name="email_address"]').on('keydown',function(event){
                if (event.shiftKey && event.keyCode === 50){
                    event.preventDefault();
                }
            });

            _company_info.on("select2:select", function (e) {
                var i=$(this).select2('val');
                if(i==0){
                    $(this).select2('val',null)
                    $('#modal_tax_group').modal('show');
                    clearFields($('#modal_tax_group').find('form'));
                }
            });


                $('input[name="file_upload[]"]').change(function(event){
                    var _files=event.target.files;

                    $('#div_img_company').hide();
                    $('#div_img_loader').show();


                    var data=new FormData();
                    $.each(_files,function(key,value){
                        data.append(key,value);
                    });

                    console.log(_files);

                    $.ajax({
                        url : 'Company/transaction/upload',
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
                            $('#div_img_company').show();
                            $('img[name="img_company"]').attr('src',response.path);

                        }
                    });

                });

                $('#btn_cancel').click(function(){
                    showList(true);
                });



                $('#btn_save').click(function(){

                    if(validateRequiredFields($('#frm_company'))){

                            createCompanyInfo().done(function(response){
                                showNotification(response);
                            }).always(function(){
                                showSpinningProgress($('#btn_save'));
                            });


                    }

                });


        }();

        var arrayClean = function(array, thisName) {
            "use strict";
            $.each(array, function(index, item) {
                if (item.name == thisName) {
                    delete array[index];      
                }
            });
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


        var createCompanyInfo=function(){
            var _data=$('#frm_company').serializeArray();

            arrayClean(_data,'email_address');

            _data.push({name:'email_address',value: $('input[name="email_address"]').val() + $('#provider_string').html() });

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Email_settings/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
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
            $('input,textarea',f).val('');
            $(f).find('select').select2('val',null);
            $(f).find('input:first').focus();
        };


        function format ( d ) {
            // `d` is the original data object for the row
            //alert(d.photo_path);
            return '<br /><table style="margin-left:10%;width: 80%;">' +
                    '<thead>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td width="20%">Name : </td><td width="50%"><b>'+ d.user_name+'</b></td>' +
                    '<td rowspan="5" valign="top"><div class="avatar">'+
                    '<img src="'+ d.photo_path+'" class="img-circle" style="margin-top:0px;height: 100px;width: 100px;">'+
                    '</div></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Address : </td><td><b>'+ d.user_address+'</b></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Email : </td><td>'+ d.user_email+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Mobile Nos. : </td><td>'+ d.user_mobile+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Landline. : </td><td>'+ d.user_telephone+'</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Active : </td><td><i class="fa fa-check"></i></td>' +
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