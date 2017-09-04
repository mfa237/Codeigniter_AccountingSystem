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
        div.dataTables_filter input { 
            margin-top: 10px;
        }

        .toolbar{
            float: left;
        }

        .text-right { 
            text-align: right!important; 
        } 
 
        .text-left {  
            text-align: left!important; 
        } 

        td:nth-child(5),td:nth-child(6){
            text-align: right;
        }

        td:nth-child(7){
            text-align: right;
            font-weight: bolder;
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

	                <ol class="breadcrumb" style="margin-bottom: 0px;">
	                    <li><a href="dashboard">Dashboard</a></li>
	                    <li><a href="vat_relief_report">VAT Relief Report</a></li>
	                </ol>

	                <div class="container-fluid">
	                    <div class="panel panel-default">
	                 <!--    	<div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;;"><b style="color:white;font-size: 12pt;"><i class="fa fa-bars"></i> VAT Relief Report </b></div> -->
		                    <div class="panel-body">
                                <h2 class="h2-panel-heading">Vat Relief Report</h2><hr>
		                    	<div class="row">
		                    		<div class="container-fluid">
		                    			<div class="container-fluid group-box">
		                    				<div class="col-xs-12 col-md-6">
		                    					<strong>Start Date * : </strong><br>
		                    					<div class="input-group">
			                    					<input id="startDate" type="text" class="date-picker form-control" name="date_from" value="<?php echo date("m/d/Y"); ?>">
			                    					<div class="input-group-addon">
			                    						<i class="fa fa-calendar"></i>
			                    					</div>
		                    					</div>
		                    				</div>
			                    			<div class="col-xs-12 col-md-6">
		                    					<strong>End Date * : </strong><br>
			                    				<div class="input-group">
			                    					<input id="endDate" type="text" class="date-picker form-control" name="date_to" value="<?php echo date("m/d/Y"); ?>">
			                    					<div class="input-group-addon">
			                    						<i class="fa fa-calendar"></i>
			                    					</div>
		                    					</div>
		                    				</div>
			                    		</div><br>
			                    		<div class="container-fluid group-box">
			                    			<button class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 10px; margin-bottom: 10px;" id="btn_print" style="text-transform: none; font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Print" ><i class="fa fa-print"></i> Print Report
                                            </button>
		                    				<table id="tbl_vat_relief" class="table table-striped" width="100%">
		                    					<thead>
		                    						<th>Supplier</th>
		                    						<th>Invoice / OR #</th>
		                    						<th>Invoice Amount</th>
		                    						<th>VAT Input</th>
		                    						<th>Net of VAT</th>
		                    					</thead>
		                    					<tbody>
		                    						
		                    					</tbody>
		                    				</table>
			                    		</div>
		                    		</div>		                    	
		                    	</div>
		                    </div>
		                    <div class="panel-footer"></div>
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
    	var dt;

       var initializeControls=function(){
            $('.date-picker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            initializeDataTable();
        }();

        var bindEventHandlers=function() {
        	$('#startDate').on('change', function() {
        		dt.destroy();
        		initializeDataTable();
        	});

        	$('#endDate').on('change', function() {
        		dt.destroy();
        		initializeDataTable();
        	});

        	$('#btn_print').on('click', function() {
        		window.open('Vat_relief_report/transaction/report?start='+ $('#startDate').val() +'&end='+ $('#endDate').val());
        	});
        }();

        function initializeDataTable(){
        	dt=$('#tbl_vat_relief').DataTable({
        		"dom": '<"toolbar">frtip',
        		"bLengthChange":false,
        		"language": {
        			"searchPlaceholder":"Search Supplier"
        		},
        		"ajax":{
        			"url": "Vat_relief_report/transaction/list",
                    "type": "GET",
                    "bDestroy": true,
                    "data": function ( d ) {
                        return $.extend( {}, d, {
                            "start":$('#startDate').val(),
                            "end":$('#endDate').val()
                        });
                    }
                },
                "columns": [
                    { "searchable": true,targets:[0],data: "supplier_name" }, 
                    { "searchable": false,targets:[1],data: "dr_invoice_no" },
                    { className: "text-right", "searchable": false,targets:[2],data: "total_after_tax",
	                    render: function(data){ 
                            return accounting.formatNumber(data,2); 
                        }  
                    }, 
                    { className: "text-right", "searchable": false,targets:[3],data: "total_tax_amount",
                    	render: function(data){ 
                            return accounting.formatNumber(data,2); 
                        }   
                    }, 
                    { className: "text-right", "searchable": false,targets:[4],data: "net_of_vat", 
                        render: function(data){ 
                            return accounting.formatNumber(data,2); 
                        }  
                    }
                ]
        	});
        };
    });
</script>


</body>

</html>