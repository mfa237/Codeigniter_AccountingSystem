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
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        .select2-container{
            min-width: 100%;
        }


        .select2-dropdown{
            z-index: 9999999999;
        }

        .datepicker-dropdown{
            z-index: 9999999999;
        }

        .dropdown-menu{
            z-index: 9999999999;
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

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->
                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Balance_sheet">Balance Sheet</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div data-widget-group="group1">

                            <div id="modal_bsheet" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color: white;">Income Statement</h4>
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
                                                    Start Date : <br />
                                                    <div class="input-group" style="z-index: 99999">

                                                        <input type="text" name="date_start" id="dt_start_date" class="date-picker form-control" value="01/01/<?php echo date("Y"); ?>"  placeholder="Start Date" data-error-msg="Start date is required!" required>

                                                        <span class="input-group-addon">
                                                             <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div><br />

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    End Date : <br />
                                                    <div class="input-group" style="z-index: 99999">

                                                        <input type="text" name="date_end" id="dt_end_date" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>"  placeholder="Start Date" data-error-msg="Start date is required!" required>

                                                        <span class="input-group-addon">
                                                             <i class="fa fa-calendar"></i>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div><br />





                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-xs-12">
                                                <a id="btn_print" href="#" target="_blank" class="btn btn-green" style="text-transform:none;font-family: tahoma;" ><i class="fa fa-print"></i> Print </a>
<!--                                                 <a href="Templates/layout/income-statement?type=&type=pdf" class="btn btn-primary" style="text-transform:none;font-family: tahoma;" ><i class="fa fa-file-pdf-o"></i> Download as PDF </a> -->
                                                <button class="btn btn-red" data-dismiss="modal" style="text-transform: capitalize;">Close</button>
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


<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var _cboDepartments;

        var _modal_filter = $('#modal_bsheet'),
            _modal_balance = $('#modal_balance'),
            _date_from = $('#date_from'),
            _date_to = $('#date_to'),
            _datepicker = $('.date-picker'),
            _btnPrint = $('#btn_print');

        _datepicker.datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });


        _cboDepartments=$('#cbo_departments').select2({
            placeholder: "Please select department.",
            allowClear: true
        });
        // _cboDepartments.select2('val',1);

        $('#btn_print').click(function(){
         $(this).attr('href',"Templates/layout/income-statement?type=&type=preview&start="+$('#dt_start_date').val()+"&end="+$('#dt_end_date').val()+"&depid="+_cboDepartments.select2('val'));
            //window.open($(this).attr('href')+"?start="+$('#dt_start_date').val()+"&end="+$('#dt_end_date').val()+"&depid="+_cboDepartments.select2('val'));

        });



        // _btnPrint.on('click', function(){
        //     $('#modal_balance').modal('show');
        // });

        _modal_filter.modal('show');
    })();
</script>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


</body>

</html>