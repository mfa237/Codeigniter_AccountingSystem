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

        #tbl_beginning_inventory td:nth-child(n+2){
            text-align: right;
        }

        #tbl_ending_inventory td:nth-child(n+2){
            text-align: right;
        }

        #tbl_purchases td:nth-child(n+5){
            text-align: right;
        }
/*tr:hover {
    transition: .4s;
    background: transparent!important;
    color: white!important;
}



tr:nth-child(odd) {
    background-color: transparent!important;
}
tr:nth-child(even) {
    background-color: transparent!important;
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


                    <div class="container-fluid" style="padding-top: 15px;!important;">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_payable_list">

                                        <div class="panel-group panel-default" id="accordionA">


                                            <div class="panel panel-default" style="border-radius: 0px;border: 1px solid lightgrey;min-height: 800px;">
                                               <!--  <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;;"><b style="color:white;font-size: 12pt;"><i class="fa fa-bars"></i> </b></div></a> -->


                                                <div id="collapseTwo" class="collapse in">
                                                    <div class="panel-body">
                                                    <h2 class="h2-panel-heading">Cost of Goods Sold</h2><hr>
                                                        <div>
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
                                                                    Period Start * :<br />
                                                                    <div class="input-group">
                                                                        <input type="text" id="txt_start" name="date_from" class="date-picker form-control" value="01/01/<?php echo date("Y"); ?>">
                                                                         <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                         </span>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3">
                                                                    Period End * :<br />
                                                                    <div class="input-group">
                                                                        <input type="text" id="txt_end" name="date_to" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>">
                                                                         <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                         </span>
                                                                    </div>
                                                                </div>

                                                            </div>



                                                        </div>

                                                        <div class="row" style="margin-bottom: 5px;margin-top: 5px;">
                                                            <div class="col-lg-5">
                                                                <button id="btn_print" class="btn btn-primary col-lg-8" style="text-transform: none;"><i class="fa fa-print"></i> Print Report</button>

                                                                <button id="btn_refresh" class="btn btn-green" style="text-transform: none;margin-left: 5px;"><i class="fa fa-refresh"></i> Refresh</button>
                                                            </div>

                                                        </div>

                                                        <table id="tbl_account_subsidiary" class="custom-design table-striped" cellspacing="0" width="100%">


                                                            <tbody>
                                                                <tr>

                                                                    <td width="80" align="left"><a href="#" style="font-size: 16px;font-weight: 600;">Merchandise Inventory - Beginning </a> <br />Beginning Inventory of Period <span class="period_start">02/01/2017</span> to <span class="period_end">02/02/2017</span></td>
                                                                    <td width="20%" style="text-align: right;color:white;background-color: #3be00b"><span class="total_avg_cost" style="font-size: 16px;font-weight: 600;">1,500.00</span></td>

                                                                </tr>
                                                                <tr>
                                                                    <td style="padding:10px 10px 40px 10px;" colspan="1">


                                                                        <table id="tbl_beginning_inventory" class="custom-design table table-striped">

                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="70%">Product</th>
                                                                                    <th width="10%" style="text-align: right">On hand</th>
                                                                                    <th width="10%" style="text-align: right">Avg Cost</th>
                                                                                    <th width="10%" style="text-align: right">Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                           <tbody>
                                                                               <tr>
                                                                                   <td>Product 1</td>
                                                                                   <td align="right">1</td>
                                                                                   <td align="right">450.00</td>
                                                                                   <td align="right">Total</td>
                                                                               </tr>
                                                                           </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="2" align="right"><b>Merchandise Inventory - Beginning :</b></td>
                                                                                    <td colspan="2" align="right"><b class="total_avg_cost">0.00</b></td>
                                                                                </tr>

                                                                            </tfoot>

                                                                        </table>

                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td width="80" align="left">Add : <a href="#" style="font-size: 16px;font-weight: 600;">Purchases</a> <br />Purchase Invoice of period <span class="period_start">01/01/2017</span> to <span class="period_end">02/02/2017</span></td>
                                                                    <td width="20%" style="text-align: right;color:white;background-color: #3be00b"><span class="total_purchases" style="font-size: 16px;font-weight: 600;">0.00</span></td>

                                                                </tr>

                                                                <tr>
                                                                    <td style="padding:10px 10px 40px 10px;" colspan="1">


                                                                        <table id="tbl_purchases" class="custom-design table table-striped">

                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="15%">Reference</th>
                                                                                    <th width="10%">Date</th>
                                                                                    <th width="20%">Supplier</th>
                                                                                    <th width="20%">Product</th>
                                                                                    <th width="5%" style="text-align: right">Qty</th>
                                                                                    <th width="10%" style="text-align: right">Cost</th>
                                                                                    <th width="10%" style="text-align: right">Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>

                                                                            </tr>
                                                                            </tbody>
                                                                            <tfoot>
                                                                            <tr>
                                                                                <td colspan="5" align="right"><b>Add : Purchases</b></td>
                                                                                <td colspan="2" align="right"><b class="total_purchases">0.00</b></td>
                                                                            </tr>

                                                                            </tfoot>

                                                                        </table>

                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td width="80" align="right"><a href="#" style="font-size: 16px;font-weight: 600;">
                                                                            Total Goods Available for Sale :</a> <br />
                                                                            ( Merchandise Inventory + Purchases )

                                                                    </td>
                                                                    <td width="20%" style="text-align: right;color:white;background-color: #3be00b"><span class="total_available_goods" style="font-size: 20px;font-weight: 600;">1,500.00</span></td>

                                                                </tr>

                                                                <tr><td>&nbsp;</td></tr>

                                                                <tr>

                                                                    <td width="80" align="left">Less : <a href="#" style="font-size: 16px;font-weight: 600;">Merchandise Inventory -End </a> <br />Inventory</td>
                                                                    <td width="20%" style="text-align: right;color:white;background-color: #3be00b"><span class="total_avg_cost" style="font-size: 16px;font-weight: 600;">1,500.00</span></td>

                                                                </tr>

                                                                <tr>
                                                                    <td style="padding:10px 10px 40px 10px;" colspan="1">


                                                                        <table id="tbl_ending_inventory" class="custom-design table table-striped">

                                                                            <thead>
                                                                            <tr>
                                                                                <th width="70%">Product</th>
                                                                                <th width="10%" style="text-align: right">On hand</th>
                                                                                <th width="10%" style="text-align: right">Avg Cost</th>
                                                                                <th width="10%" style="text-align: right">Total</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                            <tfoot>
                                                                            <tr>
                                                                                <td colspan="2" align="right"><b>Merchandise Inventory - Ending :</b></td>
                                                                                <td colspan="2" align="right"><b class="total_avg_cost_ending">0.00</b></td>
                                                                            </tr>

                                                                            </tfoot>

                                                                        </table>

                                                                    </td>

                                                                </tr>

                                                                <tr>

                                                                    <td width="80" align="right"><a href="#" style="font-size: 16px;font-weight: 600;"> Cost of Goods Sold : </a> <br />Period <span class="period_start">01/01/2017</span> to <span class="period_end">02/02/2017</span></td>
                                                                    <td width="20%" style="text-align: right;color:white;background-color: #80b0fc;"><span class="total_cost_of_goods_sold" style="font-size: 25px;font-weight: 600;">1,500.00</span></td>

                                                                </tr>

                                                            </tbody>
                                                        </table><br /><br /><br />




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
        var dtInventoryCosting; var dtPurchases; var dtInventoryEndingCosting; var _cboDepartments;

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

            $('.period_start').text($('#txt_start').val());
            $('.period_end').text($('#txt_end').val());

            reloadInventoryCosting();
            reloadPurchases();
            reloadInventoryCostingEnding();



        }();


        var bindEventHandlers=function(){

            _cboDepartments.on("select2:select", function (e) {
                reComputeCostOfGoodsSold();
               reloadList();
            });

            $('#btn_print').click(function(){

                var totalInventoryBegin=getFloat($('.total_avg_cost_ending').first().text());
                var totalPurchases=getFloat($('.total_purchases').first().text());
                var totalGoodsForSale=totalInventoryBegin+totalPurchases;
                var totalInventoryCostEnd=getFloat($('.total_avg_cost_ending').first().text());
                var cog=totalGoodsForSale-totalInventoryCostEnd;

                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "Cogs/transaction/print");

                form.setAttribute("target", "view");

                $('<input />').attr('type', 'hidden')
                    .attr('name', "inv_begin")
                    .attr('value', totalInventoryBegin)
                    .appendTo(form);

                $('<input />').attr('type', 'hidden')
                    .attr('name', "purchases")
                    .attr('value', totalPurchases)
                    .appendTo(form);

                $('<input />').attr('type', 'hidden')
                    .attr('name', "goodsForSale")
                    .attr('value', totalGoodsForSale)
                    .appendTo(form);

                $('<input />').attr('type', 'hidden')
                    .attr('name', "inv_end")
                    .attr('value', totalInventoryCostEnd)
                    .appendTo(form);

                $('<input />').attr('type', 'hidden')
                    .attr('name', "cogs")
                    .attr('value', cog)
                    .appendTo(form);

                $('<input />').attr('type', 'hidden')
                    .attr('name', "department")
                    .attr('value', $('#cbo_departments').val())
                    .appendTo(form);

                console.log($('#cbo_departments').select2('data').text);
                document.body.appendChild(form);


                form.submit();

            });

            $('#btn_refresh').click(function(){
                reloadList();
            });

            $('#txt_start,#txt_end').on('change',function(){
                $('.period_start').text($('#txt_start').val());
                $('.period_end').text($('#txt_end').val());

                reloadList();
            });

        }();


        function reloadList(){
            dtInventoryCosting.clear().draw();
            dtInventoryCosting.destroy();

            dtInventoryEndingCosting.clear().draw();
            dtInventoryEndingCosting.destroy();

            dtPurchases.clear().draw();
            dtPurchases.destroy();

            reloadInventoryCosting();
            reloadPurchases();
            reloadInventoryCostingEnding();

            //reComputeCostOfGoodsSold();
        }

        function reloadInventoryCostingEnding(){
            dtInventoryEndingCosting=$('#tbl_ending_inventory').DataTable({
                    "bLengthChange":true,
                    "pageLength":10,
                    "language": {
                        "searchPlaceholder": "Search",
                        "loadingRecords": "<br /><center><img src='assets/img/loader/facebook.gif'></center><br />"
                    },
                    "ajax": {
                        "url": "Cogs/transaction/merchandise-inventory-ending",
                        "type": "GET",
                        "bDestroy": true,
                        "data": function ( d ) {
                            return $.extend( {}, d, {
                                "start":$('#txt_start').val(),
                                "end":$('#txt_end').val(),
                                "depid":$('#cbo_departments').val()
                            });
                        }
                    },
                    "columns": [
                        { targets:[0],data: "product_desc" },
                        { targets:[1],data: "BalanceQty" },
                        { targets:[2],data: "AvgCost" },
                        { targets:[3],data: "TotalAvgCost" }
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
                        total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );


                        $('.total_avg_cost_ending').text(accounting.formatNumber(total,4));
                        reComputeCostOfGoodsSold();
                    }


                }
            );
        }

        function reloadInventoryCosting(){
            dtInventoryCosting=$('#tbl_beginning_inventory').DataTable({
                    "bLengthChange":true,
                    "pageLength":10,
                    "language": {
                        "searchPlaceholder": "Search",
                        "loadingRecords": "<br /><center><img src='assets/img/loader/facebook.gif'></center><br />"
                    },
                    "ajax": {
                        "url": "Cogs/transaction/merchandise-inventory",
                        "type": "GET",
                        "bDestroy": true,
                        "data": function ( d ) {
                            return $.extend( {}, d, {
                                "start":$('#txt_start').val(),
                                "end":$('#txt_end').val(),
                                "depid":$('#cbo_departments').val()
                            });
                        }
                    },
                    "columns": [
                        { targets:[0],data: "product_desc" },
                        { targets:[1],data: "BalanceQty" },
                        { targets:[2],data: "AvgCost" },
                        { targets:[3],data: "TotalAvgCost" }

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
                        total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );


                        $('.total_avg_cost').text(accounting.formatNumber(total,4));
                        reComputeCostOfGoodsSold();

                    }


                }
            );
        };

        function getFloat(f){
            return parseFloat(accounting.unformat(f));
        };

        function reComputeCostOfGoodsSold(){

            var totalInventoryBegin=getFloat($('.total_avg_cost_ending').first().text());
            var totalPurchases=getFloat($('.total_purchases').first().text());

            var totalGoodsForSale=totalInventoryBegin+totalPurchases;
            $('span.total_available_goods').text(accounting.formatNumber(totalGoodsForSale,2));

            var totalInventoryCostEnd=getFloat($('.total_avg_cost_ending').first().text());


            var cog=totalGoodsForSale-totalInventoryCostEnd;
            $('span.total_cost_of_goods_sold').text(accounting.formatNumber(cog,2));

        };


        function reloadPurchases(){
            dtPurchases=$('#tbl_purchases').DataTable({
                    "bLengthChange":true,
                    "pageLength":10,
                    "language": {
                        "searchPlaceholder": "Search",
                        "loadingRecords": "<br /><center><img src='assets/img/loader/facebook.gif'></center><br />",
                        "emptyTable": "No records found on specified department and period"
                    },
                    "ajax": {
                        "url": "Cogs/transaction/purchases",
                        "type": "GET",
                        "bDestroy": true,
                        "data": function ( d ) {
                            return $.extend( {}, d, {
                                "start":$('#txt_start').val(),
                                "end":$('#txt_end').val(),
                                "depid":$('#cbo_departments').val()
                            });
                        }
                    },
                    "columns": [
                        { targets:[0],data: "dr_invoice_no" },
                        { targets:[1],data: "delivered_date" },
                        { targets:[2],data: "supplier_name" },
                        { targets:[3],data: "product_desc" },
                        { targets:[4],data: "dr_qty" },
                        { targets:[5],data: "dr_price" },
                        { targets:[6],data: "dr_line_total_price" }

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
                        total = api
                            .column( 6 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );


                        $('.total_purchases').text(accounting.formatNumber(total,4));
                        reComputeCostOfGoodsSold();

                    }


                }
            );
        };



    });


</script>


</body>

</html>