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
                width: 100% !important;
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

                    <ol class="breadcrumb" style="margin:0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Aging_receivables">Aging of Receivables</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_tax_list">
                                        <div class="panel panel-default">
                                           <!--  <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Aging of Receivables</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Aging of Receivables</h2><hr>
                                                <table id="tbl_aging" class="table table-striped" cellspacing="0" width="100%">
                                                    <thead class="">
                                                    <tr>
                                                        <th>Customer Name</th>
                                                        <th>Current</th>
                                                        <th>30 Days</th>
                                                        <th>45 Days</th>
                                                        <th>60 Days</th>
                                                        <th>Over 90 Days</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <td align="right">TOTAL :</td>
                                                        <td id="td_current" align="right">0.00</td>
                                                        <td id="td_thirty" align="right">0.00</td>
                                                        <td id="td_forty_five" align="right">0.00</td>
                                                        <td id="td_sixty" align="right">0.00</td>
                                                        <td id="td_ninety" align="right">0.00</td>
                                                    </tfoot>
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

    <?php echo $_switcher_settings; ?>
    <?php echo $_def_js_files; ?>

    <script src="assets/plugins/spinner/dist/spin.min.js"></script>
    <script src="assets/plugins/spinner/dist/ladda.min.js"></script>

    <script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <!-- numeric formatter -->
    <script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
    <script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

    <script src="assets/plugins/select2/select2.full.min.js"></script>

    <script>

    $(document).ready(function() {
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _taxTypeGroup;

        var initializeControls=function() {
            dt=$('#tbl_aging').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "ajax" : "Aging_receivables/transaction/list",
                "columns": [
                    { targets:[0],data: "customer_name" },
                    {
                        class: 'text-right',
                        targets:[1],data: "current",
                        render:function(data,type,full,meta){
                            return (data == 0 ? '' : accounting.formatNumber(data,2));
                        }
                    },
                    { 
                        class: 'text-right',
                        targets:[2],data: "thirty_days",
                        render:function(data,type,full,meta){
                            return (data == 0 ? '' : accounting.formatNumber(data,2));
                        } 
                    },
                    { 
                        class: 'text-right',
                        targets:[3],data: "fortyfive_days",
                        render:function(data,type,full,meta){
                            return (data == 0 ? '' : accounting.formatNumber(data,2));
                        }
                    },
                    { 
                        class: 'text-right',
                        targets:[4],data: "sixty_days",
                        render:function(data,type,full,meta){
                            return (data == 0 ? '' : accounting.formatNumber(data,2));
                        }
                    },
                    { 
                        class: 'text-right',
                        targets:[5],data: "over_ninetydays",
                        render:function(data,type,full,meta){
                            return (data == 0 ? '' : accounting.formatNumber(data,2));
                        }
                    },
                    {
                        visible:false,
                        targets:[6],data: "is_sales"
                    }
                ],
                "order": [[ 6, 'asc' ]],
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
         
                    api.column(6, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="6" style="background:#eaeaea;"><strong>'+(group == 1 ? 'PER SALES' : 'PER SERVICES')+'</strong></td></tr>'
                            );
                            
                            last = group;
                        }
                    } );
                },
                "footerCallback": function(a,b,c){
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    total_current = api
                        .column( 1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    total_thirty = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    total_forty_five = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    total_sixty = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    total_ninety = api
                        .column( 3 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    $('#td_current').html('<b>'+accounting.formatNumber(total_current,2)+'</b>');
                    $('#td_thirty').html('<b>'+accounting.formatNumber(total_thirty,2)+'</b>');
                    $('#td_forty_five').html('<b>'+accounting.formatNumber(total_forty_five,2)+'</b>');
                    $('#td_sixty').html('<b>'+accounting.formatNumber(total_sixty,2)+'</b>');
                    $('#td_ninety').html('<b>'+accounting.formatNumber(total_ninety,2)+'</b>');
                }
            });

            var createToolBarButton=function() {
                var _btnPrint='<button class="btn btn-primary" id="btn_print" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Print Aging Receivables" >'+
                    '<i class="fa fa-print"></i> Print Report</button>';
                $("div.toolbar").html(_btnPrint);
            }();
        }();


        var bindEventHandlers=function(){
            $('#btn_print').click(function(){
                window.open('Aging_receivables/transaction/print');   
            });
        }();
    });

    </script>

    </body>

</html>