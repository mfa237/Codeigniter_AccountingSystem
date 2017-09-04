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
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->

    <style>
        .toolbar{
            float: left;
        }

        #tbl_expenses td:nth-child(n+2){
            text-align: right;
        }
/*        tr:nth-child(odd) {
            background-color: transparent!important;
            color:white!important;
        }
        tr:nth-child(even) {
            background-color: transparent!important;
             color:white!important;
        }*/

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

<br>
                    <div class="container-fluid" style="padding: 5px;!important;">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_payable_list">                                     
                                            <div class="panel panel-default" >
                                                <!-- <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;;"><b style="color:white;font-size: 12pt;"><i class="fa fa-bars"></i> Schedule of Expense</b></div></a>
 -->

                                                <div id="collapseTwo" class="collapse in">
                                                    <div class="panel-body">
                                                        <h2 class="h2-panel-heading">Schedule of Expense</h2><hr>
                                                        <div style="padding: 8px;border-radius: 0px;padding-bottom: 10px;margin-bottom: 5px;">
                                                            <div class="row">

                                                                <div class="col-lg-6">
                                                                    Department * : <br />
                                                                    <select id="cbo_departments" class="form-control">
                                                                        <?php foreach($departments as $department){ ?>
                                                                            <option value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>


                                                                <div class="col-lg-3">
                                                                    As of Date * :<br />
                                                                    <div class="input-group">
                                                                        <input type="text" id="txt_date" name="current_date" class="date-picker form-control" value="01/01/<?php echo date("Y"); ?>">
                                                                         <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                         </span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>



                                                        <table id="tbl_expenses" class="table table-striped" >
                                                            <thead>
                                                            <tr>
                                                                <th width="55%">Operating Expenses</th>
                                                                <th width="15%" align="rigth">General and Administrative</th>
                                                                <th width="15%" align="rigth">Selling Expense</th>
                                                                <th width="15%" align="rigth">Total</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td align="right"><b>Total : </b></td>
                                                                <td align="right" id="td_general_expense"><b>0.00</b></td>
                                                                <td align="right" id="td_selling_expense"><b>0.00</b></td>
                                                                <td align="right" id="td_line_expense"><b>0.00</b></td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>


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

    $(document).ready(function(){
        var dtExpense; var _cboDepartments;

        var initializeControls=function(){

            _cboDepartments=$("#cbo_departments").select2({
                allowClear: false
            });

            _cboDepartments.select2('val',1);

            $('.date-picker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true

            });


            reloadList();
            createToolBar();

        }();


        var bindEventHandlers=function(){

            _cboDepartments.on("select2:select", function (e) {
                dtExpense.destroy();
                reloadList();
                createToolBar();
            });

            $(document).on('click','#btn_print',function(){
                window.open('Schedule_expense/transaction/print-schedule-expense');

            });

            $('#txt_date').change(function(){
                dtExpense.destroy();
                reloadList();
                createToolBar();
            });

            $(document).on('click','#btn_refresh',function(){
                dtExpense.destroy();
                reloadList();
                createToolBar();
            });




        }();


        function reloadList(){
            dtExpense=$('#tbl_expenses').DataTable({
                    "dom": '<"toolbar">frtip',
                    "bLengthChange":false,
                    "bPaginate":false,
                    "language": {
                        "searchPlaceholder": "Search",
                        "loadingRecords": "<br /><center><img src='assets/img/loader/facebook.gif'></center><br />",
                        "emptyTable": "No records found on specified department and period"
                    },
                    "ajax": {
                        "url": "Schedule_expense/transaction/schedule-expenses",
                        "type": "GET",
                        "bDestroy": true,
                        "data": function ( d ) {
                            return $.extend( {}, d, {
                                    'date' : $('#txt_date').val(),
                                    'depid' : $('#cbo_departments').val()
                            });
                        }
                    },
                    "columns": [
                        { targets:[0],data: "account_title" },
                        { targets:[1],data: "general_expense" },
                        { targets:[2],data: "selling_expense" },
                        { targets:[3],data: "line_expense" }
                    ],
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        general_expense = api
                            .column( 1 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        selling_expense = api
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        line_expense = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        $('#td_general_expense').html('<b>'+accounting.formatNumber(general_expense,2)+'</b>');
                        $('#td_selling_expense').html('<b>'+accounting.formatNumber(selling_expense,2)+'</b>');
                        $('#td_line_expense').html('<b>'+accounting.formatNumber(line_expense,2)+'</b>');

                    }


                }
            );
        };


        function getFloat(f){
            return parseFloat(accounting.unformat(f));
        };


        function createToolBar(){
            var _print='<button id="btn_print" class="btn btn-primary" style="text-transform: none;"><i class="fa fa-print"></i> Print Report</button>';
            var  _refresh='<button id="btn_refresh" class="btn btn-green" style="text-transform: none;margin-left: 5px;"><i class="fa fa-refresh"></i> Refresh</button>';
            $('div.toolbar').html(_print+" "+_refresh);
        };



    });


</script>


</body>

</html>