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
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   									<!-- Custom Checkboxes / iCheck -->

    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">


    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        body {
            zoom: 0.8;
            zoom: 80%;
        }

        .select2-container {
            min-width: 100%;
            z-index: 99999999;
        }

    </style>

</head>
<body>
<?php echo $_top_navigation; ?>
<div id="wrapper">
    <div id="layout-static">
        <?php echo $_side_bar_navigation;?>
        <div class="static-content-wrapper white-bg">
            <div class="static-content">
                <div class="page-content">
                    <div id="modal_inventory" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header modal-erp">
                                    <h4 class="modal-title" style="color: white;">Sales Summary Report</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="row">
                                        <div class="col-sm-12">
                                            Branch : <br />
                                            <select name="department" id="cbo_departments" data-error-msg="Branch is required." required>

                                                <?php foreach($departments as $department){ ?>
                                                    <option value="<?php echo $department->department_id; ?>" <?php echo ($department->department_id==1?"selected":""); ?>><?php echo $department->department_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-sm-12">
                                            Period Start : <br />
                                            <div class="input-group" style="z-index: 99999">

                                                <input type="text" name="date_filter" id="dt_start_date" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Due" data-error-msg="Please set the date this items are issued!" required>

                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div><br />




                                    <div class="row">
                                        <div class="col-sm-12">
                                            Period End : <br />
                                            <div class="input-group" style="z-index: 99999">

                                                <input type="text" name="date_filter" id="dt_end_date" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Due" data-error-msg="Please set the date this items are issued!" required>

                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>

                                            </div>
                                        </div>
                                    </div><br />








                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button id="btn_export" class="btn btn-success" style="text-transform: none;"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                                            <button class="btn btn-red" data-dismiss="modal" style="text-transform: none;">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


<?php echo $_def_js_files; ?>

<?php echo $_switcher_settings; ?>


<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>




<script>
    $(document).ready(function(){
        var _cboDepartments; var _cboReport;




        var bindEventHandlers=function(){
            $('#modal_inventory').modal('show');

            $('#btn_export').click(function(){

                //if($('#cbo_report').val()==1){
                window.open('Sales_summary/transaction/export?type=excel&end='+$('#dt_end_date').val()+"&start="+$('#dt_start_date').val());
                //}else{
                // window.open('Templates/layout/inventory?type=preview&date='+$('#dt_end_date').val()+'$format='+$('#cbo_report').val());
                //}

            });


        }();

        var initializeControls=function(){
            _cboDepartments=$("#cbo_departments").select2({
                placeholder: "Please select branch.",
                allowClear: false,
                enabled: false
            });

            _cboDepartments.select2("enable",false);

            _cboReport=$("#cbo_report").select2({
                placeholder: "Please select branch.",
                allowClear: false
            });


            $('.date-picker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true

            });

        }();


        _cboDepartments.select2('val',1);

    });
</script>
</html>

