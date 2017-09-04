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
	    <?php echo $_def_js_files; ?>	
	    <?php echo $_switcher_settings; ?>
	    <!-- Date range use moment.js same as full calendar plugin -->
	    <script src="assets/plugins/fullcalendar/moment.min.js"></script>
	    <!-- Data picker -->
	    <script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>		
	    <!-- Select2 -->
	    <script src="assets/plugins/select2/select2.full.min.js"></script>
	    <!-- touchspin -->
	    <script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>
	</head>
	<body>
		<?php echo $_top_navigation; ?>	
		<div id="wrapper">
    		<div id="layout-static">
		       	<?php echo $_side_bar_navigation;?>
		        <div class="static-content-wrapper white-bg">
		            <div class="static-content">
		            	<div class="page-content">
	            			<div id="modal_sales_report" class="modal fade" role="dialog">
						        <div class="modal-dialog modal-lg">
						            <div class="modal-content">
						                <div class="modal-header modal-erp">
						                    <h4 class="modal-title" style="color: white;">Sales Report</h4>
						                </div>
						                <div class="modal-body">
						                	<div class="row">
						                		<div class="">
						                			<div class="col-xs-12 col-md-1">
						                				<label><strong>Customer:</strong></label>
						                			</div>
						                			<div class="col-xs-12 col-md-3">
						                				<select id="cbo_customers" class="form-control">
							                                <option value="All">All</option>
							                                <?php 
							                                    $this->db->where('is_deleted',FALSE);
							                                    $this->db->where('customer_name !=','');
							                                    $query = $this->db->get('customers');
							                                    foreach($query->result() as $row) {
							                                        echo '<option value='.$row->customer_id.'>'.$row->customer_name.'</option>';
							                                    }
							                                ?>
							                            </select>
						                			</div>
						                			<div class="col-xs-12 col-md-1">
						                				<label><strong>From :</strong></label>
						                			</div>
						                			<div class="col-xs-12 col-md-3">
						                				<input type="text" name="date_from" class="date-picker form-control" value="<?php echo date("Y-m-d"); ?>" data-error-msg="Start Date is required!" required>
						                			</div>
						                			<div class="col-xs-12 col-md-1">
						                				<label><strong>To :</strong></label>
						                			</div>
						                			<div class="col-xs-12 col-md-3">
						                				<input type="text" name="date_to" class="date-picker form-control" value="<?php echo date("Y-m-d"); ?>" data-error-msg="End Date is required!" required>
						                			</div>
						                		</div>
						                	</div><br>
						                    <div id="sales_report_content">
						                    </div>
						                    
						                </div>
						                <div class="modal-footer">
						                    <div class="row">
						                        <div class="col-xs-12">
						                            <button id="btn_print" class="btn btn-primary">Print</button>
						                            <!-- <button id="btn_preview" class="btn btn-info">Download as PDF</button> -->
						                            <button class="btn btn-red" data-dismiss="modal">Close</button>
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
	<script>
	    (function(){
	    	var cbo_customers = $('#cbo_customers'),
	    		sales_report_content = $('#sales_report_content'),
	    		date_from = $('input[name="date_from"]'),
	    		date_to = $('input[name="date_to"]'),
	    		btn_print = $('#btn_print')
	    		_date_picker = $('.date-picker');

			_date_picker.datepicker({
		        todayBtn: "linked",
		        keyboardNavigation: false,
		        format: 'yyyy-mm-dd',
		        forceParse: false,
		        calendarWeeks: true,
		        autoclose: true
		    });

	     	$.ajax({
	            "dataType":"html",
	            "type":"POST",
    			"url":"Templates/layout/sr?customerid="+cbo_customers.val()+"&start="+date_from.val()+"&end="+date_to.val()
	        }).done(function(response) {
	           sales_report_content.html(response);
	        });
        	$('#modal_sales_report').modal('show');

        	btn_print.on('click',function(){
				window.open('Templates/layout/sr?type=preview&customerid='+cbo_customers.val()+'&start='+date_from.val()+'&end='+date_to.val());
        	});

        	cbo_customers.on('change',function(){
        		$.ajax({
        			"dataType":"html",
        			"type":"POST",
        			"url":"Templates/layout/sr?customerid="+cbo_customers.val()+"&start="+date_from.val()+"&end="+date_to.val()
        		}).done(function(response) {
        			sales_report_content.html(response);
        		});
        	});
        	
        	date_from.on('change',function() {
        		$.ajax({
        			"dataType":"html",
        			"type":"POST",
        			"url":"Templates/layout/sr?customerid="+cbo_customers.val()+"&start="+date_from.val()+"&end="+date_to.val()
        		}).done(function(response){
        			sales_report_content.html(response);
        		});
        	});

        	date_to.on('change',function(){
        		$.ajax({
        			"dataType":"html",
        			"type":"POST",
        			"url":"Templates/layout/sr?customerid="+cbo_customers.val()+"&start="+date_from.val()+"&end="+date_to.val()
        		}).done(function(response){
        			sales_report_content.html(response);
        		});
        	});
	    })();
	</script>
</html>

