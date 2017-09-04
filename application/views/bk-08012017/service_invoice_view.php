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
    <link href="assets/css/dark-theme.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <!--/twitter typehead-->
    <link href="assets/plugins/twittertypehead/twitter.typehead.css" rel="stylesheet">
    <style>
        html{
            zoom: 0.82;
            zoom: 82%;
        }
        #span_invoice_no{
            min-width: 50px;
        }
        #span_invoice_no:focus{
            border: 3px solid orange;
            background-color: yellow;
        }
        .alert {
            border-width: 0;
            border-style: solid;
            padding: 24px;
            margin-bottom: 32px;
        }
        .alert-danger, .alert-danger h1, .alert-danger h2, .alert-danger h3, .alert-danger h4, .alert-danger h5, .alert-danger h6, .alert-danger small {
            color: #dd191d;
        }
        .alert-danger {
            color: #dd191d;
            background-color: #f9bdbb;
            border-color: #e84e40;
        }
        #tbl_items td,#tbl_items tr,#tbl_items th{
            table-layout: fixed;
           border: 1px solid gray;
            border-collapse: collapse;
        }
        .toolbar{
            float: left;
        }
        td.details-control {
            background: url('assets/img/print.png') no-repeat center center;
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
            z-index: 9999999999;
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
        .custom_frame{
            border: 1px solid lightgray;
            margin: 1% 1% 1% 1%;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .numeric{
            text-align: right;
        }
       /* .container-fluid {
            padding: 0 !important;
        }
        .panel-body {
            padding: 0 !important;
        }*/
        #btn_new {
            margin-top: 10px;
            margin-bottom: 10px;
            text-transform: uppercase!important;
        }
        @media screen and (max-width: 480px) {
            table{
                min-width: 800px;
            }
            .dataTables_filter{
                min-width: 800px;
            }
            .dataTables_info{
                min-width: 800px;
            }
            .dataTables_paginate{
                float: left;
                width: 100%;
            }
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
    <link type="text/css" href="assets/css/dark-theme.css" rel="stylesheet">
</head>
<body class="animated-content"  style="font-family: tahoma;">
<?php echo $_top_navigation; ?>
<div id="wrapper">
<div id="layout-static">
<?php echo $_side_bar_navigation;
?>
<div class="static-content-wrapper white-bg">
<div class="static-content"  >
<div class="page-content"><!-- #page-content -->
<ol class="breadcrumb"  style="margin-bottom: 0;">
    <li><a href="Dashboard">Dashboard</a></li>
    <li><a href="Service_invoice">Service Invoice</a></li>
</ol>
<div class="container-fluid"">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">
<div id="div_service_invoice_list">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Service Invoice</b>
        </div>

        <div class="panel-body table-responsive">
            <table id="tbl_service_invoice" cellspacing="0" width="100%" style="">
                <thead class="">
                <tr>
                    <th></th>
                    <th>Invoice #</th>
                    <th>Invoice Date</th>
                    <th>Due Date</th>
                    <th>Customer</th>
                    <th>Department</th>
                    <th>Remarks</th>
                    <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- <div class="panel-footer"></div> -->
    </div>
</div>
<div id="div_service_invoice_fields" style="display: none;">
    <div class="panel panel-default" style="border: 4px solid #2980b9;border-radius: 8px;">
        <div class="pull-right">
            <h4 class="service_invoice_title" style="margin-top: 0%;"></h4>
            <div class="btn btn-green" style="margin-left: 10px;">
                <strong><a id="btn_receive_so" href="#" style="text-decoration: none; color: white;">Create </a></strong>
            </div>
        </div>
        <div class="panel-body" style="padding-bottom: 0%;padding-top: 0%;">
        <div class="row" style="padding: 1%;margin-top: 0%;font-family: "Source Sans Pro", "Segoe UI", "Droid Sans", Tahoma, Arial, sans-serif">
            <form id="frm_service_invoice" role="form" class="form-horizontal">
                <h4 style="margin-bottom: 6px;"><b>Invoice # : <span id="span_invoice_no">INV-XXXX</span></b></h4>
                <div style="border: 1px solid #a0a4a5;padding: 1%;border-radius: 5px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <font color="red"><b>*</b></font> Department : <br />
                            <select name="department" id="cbo_departments" data-error-msg="Department is required." required>
                                <option value="0">[ Create New Department ]</option>
                                <?php foreach($departments as $department){ ?>
                                    <option value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2 col-sm-offset-4">
                            <font color="red"><b>*</b></font> Invoice Date : <br />
                            <div class="input-group">
                                <input type="text" name="date_invoice" id="invoice_default" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Invoice" data-error-msg="Please set the date this items are issued!" required>
                                 <span class="input-group-addon">
                                     <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <font color="red"><b>*</b></font> Customer : <br />
                            <select name="customer" id="cbo_customers" data-error-msg="Customer is required." required>
                                <option value="0">[ Create New Customer ]</option>
                                <?php foreach($customers as $customer){ ?>
                                    <option data-address="<?php echo $customer->address; ?>" value="<?php echo $customer->customer_id; ?>" data-term-default="<?php echo ($customer->term=="none"?"":$customer->term); ?>"><?php echo $customer->customer_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            Sales person :<br/>
                            <select name="salesperson_id" id="cbo_salesperson">
                                <option value="0">[ Create New Salesperson ]</option>
                                <?php foreach($salespersons as $salesperson){ ?>
                                    <option value="<?php echo $salesperson->salesperson_id; ?>"><?php echo $salesperson->acr_name.' - '.$salesperson->fullname; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <font color="red"><b>*</b></font> Due Date : <br />
                            <div class="input-group">
                                <input type="text" name="date_due" id="due_default" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Due" data-error-msg="Please set the date this items are issued!" required>
                                 <span class="input-group-addon">
                                     <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            Address :<br>
                            <input class="form-control" id="txt_address" type="text" name="address" placeholder="Customer Address">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div style="border: 1px solid #a0a4a5;padding: 1%;border-radius: 5px;">
            <label class="control-label" style="font-family: Tahoma;"><strong>Enter PLU or Search Item :</strong></label>
            <div id="custom-templates">
                <input class="typeahead" type="text" placeholder="Enter PLU or Search Item">
            </div><br />
            <form id="frm_items">
                <div class="table-responsive">
                    <table id="tbl_items" cellspacing="0" width="100%" style="font-font:tahoma;">
                        <thead class="">    
                        <tr>
                            <th width="10%">Qty</th>
                            <th width="10%">UM</th>
                            <th width="30%">Item</th>
                            <th width="20%" style="text-align: right;">Unit Price</th>
                            <th width="12%" style="text-align: right;display: none;">Discount</th>
                            <th style="display: none;">T.D</th> <!-- total discount -->
                            <th style="display: none;">Tax %</th>
                            <th width="20%" style="text-align: right;">Total</th>
                            <th style="display: none;">V.I</th> <!-- vat input -->
                            <th style="display: none;">N.V</th> <!-- net of vat -->
                            <td style="display: none;">Item ID</td><!-- product id -->
                            <th><center>Action</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--<tr>
                                    <td width="10%"><input type="text" class="numeric form-control" align="right"></td>
                                    <td width="5%">pcs</td>
                                    <td width="30%">Computer Case</td>
                                    <td width="12%"><input type="text" class="numeric form-control"></td>
                                    <td width="12%"><input type="text" class="numeric form-control"></td>
                                    <td></td>
                                    <td width="15%">
                                        <select class="form-control">
                                            <?php foreach($tax_types as $tax_type){ ?>
                                                <option value="<?php echo $tax_type->tax_type_id; ?>"><?php echo $tax_type->tax_type; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td width="12%" align="right"><input type="text" class="numeric form-control"></td>
                                    <td></td>
                                    <td></td>
                                    <td><button type="button" class="btn btn-default"><i class="fa fa-trash"></i></button></td>
                                </tr>-->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" style="height: 50px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Total Amount :</strong></td>
                                <td align="right" colspan="1" id="total_amount" color="red">0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
        <form id="frm_remarks">
        <div class="row">
            <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br />
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label control-label><strong>Remarks :</strong></label>
                        <div class="col-lg-12" style="padding: 0%;">
                            <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-lg-4 col-lg-offset-8">
                        <div class="table-responsive">
                            <table id="tbl_service_invoice_summary" class="table invoice-total" style="font-family: tahoma;">
                                <tbody>
                                <tr>
                                    <td><strong>Total After Tax :</strong></td>
                                    <td align="right"><b>0.00</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </form>
        <br />
    </div>
    <div class="panel-footer" style="border-top: 3px solid #2980b9">
        <div class="row">
            <div class="col-sm-12">
                <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>Save Changes</button>
                <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
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
            <div class="modal-header ">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <p id="modal-body-message">Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->


<div id="modal_new_customer" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2ecc71;">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>New Customer</h4>
            </div>
            <div class="modal-body">
                <form id="frm_customer_new">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Customer Name :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" data-error-msg="Customer Name is required!" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Contact Person :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <input type="text" name="contact_name" class="form-control" placeholder="Contact Person" data-error-msg="Contact Person is required!" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Address :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-home"></i>
                                         </span>
                                         <textarea name="address" class="form-control" data-error-msg="Supplier address is required!" placeholder="Address" required ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;">Email Address :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope-o"></i>
                                        </span>
                                        <input type="text" name="email_address" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;">Landline :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" name="landline" id="landline" class="form-control" placeholder="Landline">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;">Mobile No :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-mobile"></i>
                                        </span>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label boldlabel" style="text-align:left;padding-top:10px;"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px;"></i>Customer's Photo</label>
                                    <hr style="margin-top:0px !important;height:1px;background-color:black;">
                                </div>
                                <div style="width:100%;height:300px;border:2px solid #34495e;border-radius:5px;">
                                    <center>
                                        <img name="img_user" id="img_user" src="assets/img/anonymous-icon.png" height="140px;" width="140px;"></img>
                                    </center>
                                    <hr style="margin-top:0px !important;height:1px;background-color:black;">
                                    <center>
                                         <button type="button" id="btn_browse" style="width:150px;margin-bottom:5px;" class="btn btn-primary">Browse Photo</button>
                                         <button type="button" id="btn_remove_photo" style="width:150px;" class="btn btn-danger">Remove</button>
                                         <input type="file" name="file_upload[]" class="hidden">
                                    </center> 
                                </div>
                            </div>   
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_create_customer" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                <button id="btn_close_customer" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->
<div id="modal_new_salesperson" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2ecc71;">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 id="salesperson_title" class="modal-title" style="color: #ecf0f1;"><span id="modal_mode"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="frm_salesperson" role="form">
                        <div class="">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> Salesperson Code :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="salesperson_code" class="form-control" placeholder="Salesperson Code" data-error-msg="Salesperson Code is required!" required>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> First name :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="firstname" class="form-control" placeholder="Firstname" data-error-msg="Firstname is required!" required>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong>&nbsp;&nbsp;Middle name :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="middlename" class="form-control" placeholder="Middlename">
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong><font color="red">*</font> Last name :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="lastname" class="form-control" placeholder="Lastname" data-error-msg="Lastname is required!" required>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong>Contact Number :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Contact Number">
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong>Department :</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <select name="department_id" id="cbo_department" class="form-control" data-error-msg="Department is required!">
                                            <option value="0">[ Create New Department ]</option>
                                            <?php foreach($departments as $department) { ?>
                                                <option value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-md-4 control-label "><strong>TIN Number:</strong></label>
                                    <div class="col-xs-12 col-md-8">
                                        <input type="text" name="tin_no" id="tin_no" class="form-control" placeholder="TIN Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_create_salesperson" class="btn btn-primary" name="btn_save">Save</button>
                <button id="btn_close_salesperson" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_new_department" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #2ecc71">
                 <h2 id="department_title" class="modal-title" style="color:white;">Create New Department</h2>
            </div>
            <div class="modal-body">
                <form id="frm_department_new" role="form" class="form-horizontal">
                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class=""><font color="red">*</font> Department Name :</label>
                                <textarea name="department_name" class="form-control" data-error-msg="Department Name is required!" placeholder="Department name" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class="">Department Description :</label>
                                <textarea name="department_desc" class="form-control" placeholder="Department Description"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_create_department" class="btn btn-primary">Save</button>
                <button id="btn_cancel_department" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_new_department_sp" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #2ecc71">
                 <h2 id="department_title" class="modal-title" style="color:white;">Create New Department</h2>
            </div>
            <div class="modal-body">
                <form id="frm_department_new_sp" role="form" class="form-horizontal">
                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class=""><font color="red">*</font> Department Name :</label>
                                <textarea name="department_name" class="form-control" data-error-msg="Department Name is required!" placeholder="Department name" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class="">Department Description :</label>
                                <textarea name="department_desc" class="form-control" placeholder="Department Description"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_create_department_sp" class="btn btn-primary">Save</button>
                <button id="btn_cancel_department_sp" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
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
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>
<!-- twitter typehead -->
<script src="assets/plugins/twittertypehead/handlebars.js"></script>
<script src="assets/plugins/twittertypehead/bloodhound.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.bundle.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>
<!-- touchspin -->
<script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>
<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboDepartments; var _cboDepartments; var _cboCustomers; var dt_so;
    var oTableItems={
        qty : 'td:eq(0)',
        unit_price : 'td:eq(3)',
        total : 'td:eq(4)',

    };
    var oTableDetails={
        total : 'tr:eq(0) > td:eq(1)'
    };
    var initializeControls=function(){
        dt=$('#tbl_service_invoice').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Service_invoice/transaction/list-invoice",
            "language": {
                "searchPlaceholder":"Search Invoice"
            },
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "service_invoice_no" },
                { targets:[2],data: "date_invoice" },
                { targets:[3],data: "date_due" },
                { targets:[4],data: "customer_name" },
                { targets:[5],data: "department_name" },
                { targets:[6],data: "remarks" },
                {
                    targets:[7],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-danger btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';
                        return '<center>'+btn_edit+"&nbsp;"+btn_trash+'</center>';
                    }
                }
            ]
        });

        $('.numeric').autoNumeric('init');
        $('#contact_no').keypress(validateNumber);
        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-success" id="btn_new" style="text-transform: none;font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="Record Service Invoice" >'+
                '<i class="fa fa-plus"></i> Record Service Invoice</button>';
            $("div.toolbar").html(_btnNew);
        }();
        _cboDepartments=$("#cbo_departments").select2({
            placeholder: "Please select Department.",
            allowClear: true
        });
        _cboDepartment=$("#cbo_department").select2({
            placeholder: "Please select Department.",
            allowClear: true
        });
        _cboCustomers=$("#cbo_customers").select2({
            placeholder: "Please select customer.",
            allowClear: true
        });
        _cboSalesperson=$("#cbo_salesperson").select2({
            placeholder: "Please select sales person.",
            allowClear: true
        });
        _cboSalesperson.select2('val',null);
        _cboDepartments.select2('val', null);
        _cboDepartment.select2('val', null);
        _cboCustomers.select2('val',null);
        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        // $services is from controller function index
        var raw_data = <?php echo json_encode($services); ?>;
        var services = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('service_code','service_desc','service_amount'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local : raw_data
        });
        var _objTypeHead=$('#custom-templates .typeahead');
        _objTypeHead.typeahead(null, {
        name: 'services',
        display: 'service_code',
        source: services,  // edit this , this must be the same as the var services declared in the new BLoodhound
        templates: {
            header: [
                '<table width="100%"><tr><td width=20%" style="padding-left: 1%;"><b>PLU</b></td><td width="20%" align="left"><b>Description</b></td><td width="10%" align="left" style="padding-right: 2%;"><b>SRP</b></td></tr></table>'
            ].join('\n'),
            suggestion: Handlebars.compile('<table width="100%"><tr><td width="20%" style="padding-left: 1%;">{{service_code}}</td><td width="20%" align="left">{{service_desc}}</td><td width="10%" align="left" style="padding-right: 2%;">{{service_amount}}</td></tr></table>')
        }
        }).on('keyup', this, function (event) {
            if (_objTypeHead.typeahead('val') == '') {
                return false;
            }
            if (event.keyCode == 13) {
                //$('.tt-suggestion:first').click();
                _objTypeHead.typeahead('close');
                _objTypeHead.typeahead('val','');
            }
        }).bind('typeahead:select', function(ev, suggestion) {


            var service_price= 0.00;
            service_price=suggestion.service_amount;
            var service_line_total=getFloat(service_price);


            $('#tbl_items > tbody').append(newRowItem({
                inv_qty : "1",
                service_unit_id : suggestion.service_unit_id,
                service_id : suggestion.service_id,
                service_desc : suggestion.service_desc,
                service_unit : suggestion.service_unit_name,
                service_price : service_price,
                line_total : service_line_total
            }));
            reInitializeNumeric();
            reComputeTotal();
            //alert("dd")
        });
        $('div.tt-menu').on('click','table.tt-suggestion',function(){
            _objTypeHead.typeahead('val','');
        });
        $("input#touchspin4").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'fa fa-fw fa-plus',
            verticaldownclass: 'fa fa-fw fa-minus'
        });
    }();
    var bindEventHandlers=(function(){
        var detailRows = [];

        _cboSalesperson.on('select2:select',function(e){
            var i=$(this).select2('val');
            if(i == 0) {
                //clearFields($('#modal_new_salesperson').find('form'));
                _cboSalesperson.select2('val',null);
                $('#modal_new_salesperson').modal('show');
                $('#salesperson_title').text('Create New Salesperson');
            }
        });
        $('#btn_close_salesperson').on('click',function(){
            $('#modal_new_salesperson').modal('hide');
        });
        //loads modal to create new department
        _cboDepartments.on('select2:select', function(){
            if (_cboDepartments.val() == 0) {
                clearFields($('#frm_department_new'));
                $('#modal_new_department').modal('show');
                $('#modal_new_salesperson').modal('hide');
            }
        });
        _cboDepartment.on('select2:select', function(){
            if (_cboDepartment.val() == 0) {
                clearFields($('#frm_department_new'));
                $('#modal_new_department_sp').modal('show');
                $('#modal_new_salesperson').modal('hide');
            }
        });
        $('#btn_cancel_department').on('click', function(){
            $('#modal_new_department').modal('hide');
            _cboDepartments.select2('val',null);
        });
        $('#btn_cancel_department_sp').on('click', function(){
            $('#modal_new_department_sp').modal('hide');
            $('#modal_new_salesperson').modal('show');
            _cboDepartment.select2('val',null);
        });
        _cboCustomers.on("select2:select", function (e) {
            var i=$(this).select2('val');
            if(i==0){ //new customer
                //clearFields($('#modal_new_customer').find('form'));
                _cboCustomers.select2('val',null)
                $('#modal_new_customer').modal('show');
            }
            var obj_customers=$('#cbo_customers').find('option[value="' + i + '"]');
            $('#txt_address').val(obj_customers.data('address'));
        });
        $('#btn_create_salesperson').click(function(){
            var btn=$(this);
            if(validateRequiredFields($('#frm_salesperson'))){
                var data=$('#frm_salesperson').serializeArray();
                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Salesperson/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_salesperson').modal('hide');
                    var _salesperson=response.row_added[0];
                    $('#cbo_salesperson').append('<option value="'+_salesperson.salesperson_id+'" selected>'+ _salesperson.salesperson_code + ' - ' +_salesperson.fullname+'</option>');
                    $('#cbo_salesperson').select2('val',_salesperson.salesperson_id);
                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });
        //create new department
        $('#btn_create_department').click(function(){
            var btn=$(this);
            if(validateRequiredFields($('#frm_department_new'))){
                var data=$('#frm_department_new').serializeArray();
                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Departments/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_department').modal('hide');
                    var _department=response.row_added[0];
                    $('#cbo_departments').append('<option value="'+_department.department_id+'" selected>'+_department.department_name+'</option>');
                    $('#cbo_departments').select2('val',_department.department_id);
                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });
        $('#btn_create_department_sp').click(function(){
            var btn=$(this);
            if(validateRequiredFields($('#frm_department_new_sp'))){
                var data=$('#frm_department_new_sp').serializeArray();
                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Departments/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_department_sp').modal('hide');
                    $('#modal_new_salesperson').modal('show');
                    var _department=response.row_added[0];
                    $('#cbo_department').append('<option value="'+_department.department_id+'" selected>'+_department.department_name+'</option>');
                    $('#cbo_department').select2('val',_department.department_id);
                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });
        $('#btn_create_customer').click(function(){
            var btn=$(this);
            if(validateRequiredFields($('#frm_customer_new'))){
                var data=$('#frm_customer_new').serializeArray();
                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Customers/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_customer').modal('hide');
                    var _customer=response.row_added[0];
                    $('#cbo_customers').append('<option value="'+_customer.customer_id+'" selected>'+ _customer.customer_name + '</option>');
                    $('#cbo_customers').select2('val',_customer.customer_id);
                    $('#txt_address').val(_customer.address);
                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });

        $('#btn_cancel').click(function(){
        showList(true);
    });

        $('#btn_new').click(function(){
            _txnMode="new";
            clearFields($('#div_service_invoice_fields'));
            $('#span_invoice_no').html('INV-XXXX');
            showList(false);

            $('#tbl_items > tbody').html('');
            $('#cbo_departments').select2('val', null);
            $('#cbo_department').select2('val', null);
            $('#cbo_customers').select2('val', null);
            $('#cbo_salesperson').select2('val', null);
            $('#img_user').attr('src','assets/img/anonymous-icon.png');

            $('#total_amount').html('0.00');

            $('#invoice_default').datepicker('setDate', 'today');
            $('#due_default').datepicker('setDate', 'today');
            reComputeTotal(); //this is to make sure, display summary are recomputed as 0
        });


        $('#tbl_service_invoice tbody').on('click','button[name="edit_info"]',function(){
            ///alert("ddd");
            _txnMode="edit";
            $('.service_invoice_title').html('Edit Sales Invoice');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.service_invoice_id;
            $('#span_invoice_no').html(data.service_invoice_no);
            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                        _elem.val(value);
                    }
                });
            });
            $('#cbo_departments').select2('val',data.department_id);
            $('#cbo_department').select2('val',data.department_id);
            $('#cbo_customers').select2('val',data.customer_id);
            $('#cbo_salesperson').select2('val',data.salesperson_id);
            $('#txt_address').html('val',data.address);

            $.ajax({
                url : 'Service_invoice/transaction/items-invoice/'+data.service_invoice_id,
                type : "GET",
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                beforeSend : function(){
                    $('#tbl_items > tbody').html('<tr><td align="center" colspan="8"><br /><img src="assets/img/loader/ajax-loader-sm.gif" /><br /><br /></td></tr>');
                },
                success : function(response){
                    var rows=response.data;
                    $('#tbl_items > tbody').html('');
                    $.each(rows,function(i,value){
                        $('#tbl_items > tbody').append(newRowItem({
                            inv_qty : value.service_qty,
                            service_id : value.service_id,
                            service_desc : value.service_desc,
                            service_unit_id : value.service_unit_id,
                            service_unit : value.service_unit_name,
                            service_price : value.service_price,
                            line_total : value.service_line_total


                        }));
                    });
                    reComputeTotal();
                }
            });
            showList(false);
        });
        $('#tbl_service_invoice tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.service_invoice_id;
            //alert(_selectedID);
            $('#modal_confirmation').modal('show');
        });
        //track every changes on numeric fields
        $('#tbl_items tbody').on('keyup','input.numeric,input.number',function(){
            var row=$(this).closest('tr');
            var price=parseFloat(accounting.unformat(row.find(oTableItems.unit_price).find('input.numeric').val()));
            var qty=parseFloat(accounting.unformat(row.find(oTableItems.qty).find('input.number').val()));
            var line_total=price*qty;
            $(oTableItems.total,row).find('input.numeric').val(accounting.formatNumber(line_total,2)); // line total amount


            reComputeTotal();
        });
        $('#btn_yes').click(function(){
            removeIssuanceRecord().done(function(response){
                showNotification(response);
                if(response.stat=="success"){
                    dt.row(_selectRowObj).remove().draw();
                }
            });
            //}
        });

        $('#btn_save').click(function(){
            if(validateRequiredFields($('#frm_service_invoice'))){
                if(_txnMode=="new"){
                    createServiceInvoice().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_service_invoice'));
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }else{
                    updateServiceInvoice().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields($('#frm_service_invoice'));
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }
            }
        });
    
        $('#tbl_items > tbody').on('click','button[name="remove_item"]',function(){
            $(this).closest('tr').remove();
            reComputeTotal();
        });
        $('#btn_browse').click(function(event){
            event.preventDefault();
            $('input[name="file_upload[]"]').click();
        });
        $('input[name="file_upload[]"]').change(function(event){
            var _files=event.target.files;
            /*$('#div_img_product').hide();
            $('#div_img_loader').show();*/
            var data=new FormData();
            $.each(_files,function(key,value){
                data.append(key,value);
            });
            console.log(_files);
            $.ajax({
                url : 'Customers/transaction/upload',
                type : "POST",
                data : data,
                cache : false,
                dataType : 'json',
                processData : false,
                contentType : false,
                success : function(response){
                    $('img[name="img_user"]').attr('src',response.path);
                }
            });
        });
        $('#btn_remove_photo').click(function(event){
            event.preventDefault();
            $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
        });
    })();
    var validateRequiredFields=function(f){
        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
                if($(this).is('select')){
                    if($(this).val()==0 || $(this).val()==null || $(this).val()==undefined || $(this).val()==""){
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
    var createCustomer=function(){
        var _data=$('#frm_customer').serializeArray();
        _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Customers/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_create_customer'))
        });
    };
    var createServiceInvoice=function(){
        var _data=$('#frm_service_invoice,#frm_items,#frm_remarks').serializeArray();
        var tbl_summary=$('#tbl_service_invoice_summary');
        _data.push({name : "summary_total_amount", value : tbl_summary.find(oTableDetails.total).text()});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Service_invoice/transaction/create-invoice", // edit this
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };
    var updateServiceInvoice=function(){
        var _data=$('#frm_service_invoice,#frm_items,#frm_remarks ').serializeArray();
        var tbl_summary=$('#tbl_service_invoice_summary');
        _data.push({name : "summary_total_amount", value : tbl_summary.find(oTableDetails.total).text()});
        _data.push({name : "service_invoice_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Service_invoice/transaction/update-invoice",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };
    var removeIssuanceRecord=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"service_invoice/transaction/delete",
            "data":{service_invoice_id : _selectedID}
        });
    };
    var showList=function(b){
        if(b){
            $('#div_service_invoice_list').show();
            $('#div_service_invoice_fields').hide();
            $('.datepicker.dropdown-menu').hide();
        }else{
            $('#div_service_invoice_list').hide();
            $('#div_service_invoice_fields').show();
        }
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
        $('input,textarea,select,input:not(.date-picker)',f).val('');
        $('#remarks').val('');
        $(f).find('input:first').focus();
    };
    function format ( d ) {
        //return
    };
    function validateNumber(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 8 || event.keyCode === 46
            || event.keyCode === 37 || event.keyCode === 39) {
            return true;
        }
        else if ( key < 48 || key > 57 ) {
            return false;
        }
        else return true;
    };
    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };
    var newRowItem=function(d){
        return '<tr>'+
        '<td width="10%"><input name="qty[]" type="text" class="number form-control" value="'+ d.inv_qty+'"></td>'+
        '<td width="5%">'+ d.service_unit+'</td>'+
        '<td width="30%">'+d.service_desc+'</td>'+
        '<td width="11%"><input name="service_price[]" type="text" class="numeric form-control" value="'+accounting.formatNumber(d.service_price,2)+'" style="text-align:right;"></td>'+
        '<td width="11%" align="right"><input name="line_total[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.line_total,2)+'" readonly></td>'+
        '<td style="display: none;"><input name="service_id[]" type="text" class=" form-control" value="'+ d.service_id+'" readonly></td>'+
        '<td style="display: none;"><input name="service_unit[]" type="text" class=" form-control" value="'+ d.service_unit_id+'" readonly></td>'+
        '<td align="center"><button type="button" name="remove_item" class="btn btn-red"><i class="fa fa-trash"></i></button></td>'+
        '</tr>';
    };
    var reComputeTotal=function(){
        var rows=$('#tbl_items > tbody tr');
        var total_amount=0;
        $.each(rows,function(){


        total_amount+=parseFloat(accounting.unformat($(oTableItems.total,$(this)).find('input.numeric').val()));
        });
        var tbl_summary=$('#tbl_service_invoice_summary');
        tbl_summary.find(oTableDetails.total).html('<b>'+accounting.formatNumber(total_amount,2)+'</b>');

        $('#total_amount').html('<b>'+accounting.formatNumber(total_amount,2)+'</b>');
  
    };
    var resetSummary=function(){
        var tbl_summary=$('#tbl_service_invoice_summary');
        tbl_summary.find(oTableDetails.total).html('<b>0.00</b>');
    };
    var reInitializeNumeric=function(){
        $('.numeric').autoNumeric('init');
    };

});
</script>
</body>
</html>