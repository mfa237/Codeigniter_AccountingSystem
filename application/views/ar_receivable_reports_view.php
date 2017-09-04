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

                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="AR_Receivable">A/R Receivable Reports</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="div_department_list">
                                        <div class="panel panel-default">
                                            <!-- <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Account Receivable Reports</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Account Receivable Reports</h2><hr>
												<div class="col-md-4">
													<div class="form-group">
													    <label for="customer" style="font-weight:bold;">Customer:</label>
													    <select id="customer_id_filter">
    														<option value="all">All</option>
    														<?php foreach($customers as $row){
    															echo "<option value=".$row->customer_id.">".$row->customer_name."</option>";
    														  }
    														?>
													    </select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													  <label for="customer" style="font-weight:bold;">From Period:</label>
													  <Input type="text" id="fromdate_filter" class="form-control date-picker" value="<?php echo date("m/d/Y"); ?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													  <label for="customer" style="font-weight:bold;">To Period:</label>
													  <Input type="text" id="todate_filter" class="form-control date-picker" value="<?php echo date("m/d/Y"); ?>">
													</div>
												</div>
                                                <reports id="ar_receivable_reports">
													<!-- reports here -->
												</reports>
                                            </div>
                                            <div class="panel-footer">
											<button type="button" id="print_ar" class="btn btn-success">Print</button>
											<button type="button" id="download_ar" class="btn btn-success">Download PDF</button>
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

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>

<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script>
var customer_id="all";

$(document).ready(function(){

        var _cboCustomer;


        //Get ALL 
		customer_id=$('#customer_id_filter').val();
		fromdate_filter=$('#fromdate_filter').val();
		todate_filter=$('#todate_filter').val();
		var fromdate = fromdate_filter.replace(/\//g, "-");
		var todate = todate_filter.replace(/\//g, "-");
        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"AR_Reports/layout/ar_receivable_reports/"+customer_id+"/"+fromdate+"/"+todate,
        beforeSend : function(){
                    $('#ar_receivable_reports').html("<center><img src='assets/img/loader/ajax-loader-lg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#ar_receivable_reports').html(response);
            });
            //END GET
			
		$("#customer_id_filter").change(function(){
			//GET FILTER
    		customer_id=$('#customer_id_filter').val();
    		fromdate_filter=$('#fromdate_filter').val();
    		todate_filter=$('#todate_filter').val();
    		var fromdate = fromdate_filter.replace(/\//g, "-");
    		var todate = todate_filter.replace(/\//g, "-");
            $.ajax({
            "dataType":"html",
            "type":"POST",
            "url":"AR_Reports/layout/ar_receivable_reports/"+customer_id+"/"+fromdate+"/"+todate,
            beforeSend : function(){
                        $('#ar_receivable_reports').html("<center><img src='assets/img/loader/ajax-loader-lg.gif'><h3>Loading...</h3></center>");
                    },
            }).done(function(response){
                $('#ar_receivable_reports').html(response);
            });
            //END GET
        });
		
		$("#fromdate_filter").change(function(){
			//GET FILTER
		customer_id=$('#customer_id_filter').val();
		fromdate_filter=$('#fromdate_filter').val();
		todate_filter=$('#todate_filter').val();
		var fromdate = fromdate_filter.replace(/\//g, "-");
		var todate = todate_filter.replace(/\//g, "-");
        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"AR_Reports/layout/ar_receivable_reports/"+customer_id+"/"+fromdate+"/"+todate,
        beforeSend : function(){
                    $('#ar_receivable_reports').html("<center><img src='assets/img/loader/ajax-loader-lg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#ar_receivable_reports').html(response);
            });
            //END GET
        });
		
		$("#todate_filter").change(function(){
			//GET FILTER
		customer_id=$('#customer_id_filter').val();
		fromdate_filter=$('#fromdate_filter').val();
		todate_filter=$('#todate_filter').val();
		var fromdate = fromdate_filter.replace(/\//g, "-");
		var todate = todate_filter.replace(/\//g, "-");
        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"AR_Reports/layout/ar_receivable_reports/"+customer_id+"/"+fromdate+"/"+todate,
        beforeSend : function(){
                    $('#ar_receivable_reports').html("<center><img src='assets/img/loader/ajax-loader-lg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#ar_receivable_reports').html(response);
            });
            //END GET
        });
		
		$("#print_ar").click(function(){
            customer_id=$('#customer_id_filter').val();
    		fromdate_filter=$('#fromdate_filter').val();
    		todate_filter=$('#todate_filter').val();
    		var fromdate = fromdate_filter.replace(/\//g, "-");
    		var todate = todate_filter.replace(/\//g, "-");
                window.open('AR_Reports/layout/ar_receivable_reports/'+customer_id+'/'+fromdate+'/'+todate+'/preview', '_blank');
            //alert(_selectedID);
        });
		
		$("#download_ar").click(function(){
            customer_id=$('#customer_id_filter').val();
    		fromdate_filter=$('#fromdate_filter').val();
    		todate_filter=$('#todate_filter').val();
    		var fromdate = fromdate_filter.replace(/\//g, "-");
    		var todate = todate_filter.replace(/\//g, "-");
                window.location = 'AR_Reports/layout/ar_receivable_reports/'+customer_id+'/'+fromdate+'/'+todate+'/pdf';
            //alert(_selectedID);
        });
		
		$('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

        _cboCustomer=$('#customer_id_filter').select2({
            //placeholder: "Please select Customer.",
            allowClear: false
        });
});

</script>

</body>

</html>