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
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
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

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->

                    <ol class="breadcrumb">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Replenishment_report">Replenishment Report</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div class="panel panel-default">
                        <!--     <div class="panel-heading">
                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; </b>
                            </div> -->
                            <div class="panel-body">
                            <h2 class="h2-panel-heading">Replenishment Report</h2><hr>
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="container-fluid group-box">
                                            <div class="col-xs-12 col-md-4" style="margin-bottom: 10px;">
                                                <strong>As of Date :</strong>
                                                <div class="input-group">
                                                    <input id="txt_date" type="text" class="date-picker form-control" value="<?php echo date('m/d/Y'); ?>">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="container-fluid group-box">
                                            <button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 0; margin-bottom: 10px;" id="btn_print" style="text-transform: none; font-family: Tahoma, Georgia, Serif; ">
                                                <i class="fa fa-print"></i> Print Report
                                            </button>
                                            <table id="tbl_replenishment" class="table table-striped" width="100%" cellspacing="0">
                                                <thead class="">
                                                    <th></th>
                                                    <th>Document # / PCV #</th>
                                                    <th>Particular</th>
                                                    <th>Amount</th>
                                                    <th>Remarks</th>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
                        <li><h6 style="margin: 0;">&copy; 2017 - JDEV IT Business Solutions</h6></li>
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

<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>

$(document).ready(function(){
    var dtReplenish;

    var initializeControl=function(){
        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        InitializeDataTable();
    }();

    var bindEventHandlers=function(){
        $('#txt_date').change(function(){
            dtReplenish.destroy();
            InitializeDataTable();
        });

        $('#btn_print').click(function(){
            window.open('Replenishment_report/transaction/report?aod='+$('#txt_date').val());
        });
    }();

    function InitializeDataTable() {
        dtReplenish=$('#tbl_replenishment').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "language": {
                searchPlaceholder: "Search..."
            },
            "ajax": {
              "url":"Replenishment_report/transaction/list",
              "type":"GET",
              "bDestroy":true,
              "data":function (d) {
                return $.extend( {}, d, {
                    "aod": $('#txt_date').val()
                });
              }
            },
            "columns": [
                { visible:false, targets:[0],data: "batch_no" },
                { targets:[1],data: "txn_no" },
                { targets:[2],data: "supplier_name" },
                {
                    className: "text-right",
                    targets:[3],data: "amount",
                    render: function(data){
                        return accounting.formatNumber(data,2);
                    }
                },
                { targets:[4],data: "remarks" }
            ],
            "order": [[ 0, 'asc' ]],
            "displayLength": 25,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="5" style="background-color:#064475; color: white;"><strong>'+'BATCH #: <i>'+group+'</i></strong></td></tr>'
                        );
     
                        last = group;
                    }
                } );
            }
        });
    };
});

</script>

</body>

</html>