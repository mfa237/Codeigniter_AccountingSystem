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

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">

    <!--/twitter typehead-->
    <link href="assets/plugins/twittertypehead/twitter.typehead.css" rel="stylesheet">






    <style>
        html{
            zoom: 0.8;
            zoom: 80%;
        }



        .alert {
            border-width: 0;
            border-style: solid;
            padding: 24px;
            margin-bottom: 32px;
        }
        .alert-danger, .alert-danger h1, .alert-danger h2, .alert-danger h3, .alert-danger h4, .alert-danger h5, .alert-danger h6, .alert-danger small {
            color: white;
            font-weight: bolder;
            font-size: 14px;
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
                        <li><a href="Sales_invoice">Sales Invoice</a></li>
                    </ol>


                    <div class="container-fluid"">
                    <div data-widget-group="group1">
                        <div class="row">
                            <div class="col-md-12">

                                <div id="div_sales_invoice_list">

                                    <div class="panel panel-default" style="border: 3px solid #2980b9;min-height: 650px;">
                                        <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo"><div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;"><b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i> Sales Invoice</b></div></a>

                                        <div class="panel-body table-responsive">
                                            <table id="tbl_sales_invoice" class="custom-design table-striped" cellspacing="0" width="100%" style="">
                                                <thead class="">
                                                <tr>
                                                    <th></th>
                                                    <th>Invoice #</th>
                                                    <th>Invoice Date</th>
                                                    <th>Due Date</th>
                                                    <th>Issued to Branch</th>
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


                                <div id="div_sales_invoice_fields" style="display: none;">


                                    <div class="panel panel-default" style="border: 4px solid #2980b9;border-radius: 8px;">


                                        <div class="pull-right">
                                            <h4 class="sales_invoice_title" style="margin-top: 0%;"></h4>
                                            <div class="btn btn-green" style="margin-left: 10px;">
                                                <strong><a id="btn_receive_so" href="#" style="text-decoration: none; color: white;">Create from Sales Order</a></strong>
                                            </div>
                                        </div>

                                        <div class="panel-body" style="padding-bottom: 0%;padding-top: 0%;">


                                            <div class="row" style="padding: 1%;margin-top: 0%;font-family: "Source Sans Pro", "Segoe UI", "Droid Sans", Tahoma, Arial, sans-serif">
                                            <form id="frm_sales_invoice" role="form" class="form-horizontal">

                                                <h4 style="margin-bottom: 6px;"><b>DR # : <span id="span_invoice_no">INV-XXXX</span></b></h4>
                                                <div style="border: 1px solid #a0a4a5;padding: 1%;border-radius: 5px;">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            Branch (Main) : <br />
                                                            <select name="department" id="cbo_departments" data-error-msg="Branch is required." required>
                                                                <option value="0">[ Create New Branch ]</option>
                                                                <?php foreach($departments as $department){ ?>
                                                                    <option value="<?php echo $department->department_id; ?>" <?php echo ($department->department_id==1?'selected':''); ?>><?php echo $department->department_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2 col-sm-offset-6">
                                                            Invoice Date : <br />
                                                            <div class="input-group">
                                                                <input type="text" name="date_invoice" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Invoice" data-error-msg="Please set the date this items are issued!" required>
                                                                 <span class="input-group-addon">
                                                                     <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            Issue to Branch / Department * : <br />
                                                            <select name="issue_to_department" id="cbo_issue_departments" data-error-msg="Branch is required." required>
                                                                <option value="0">[ Create New Branch ]</option>
                                                                <?php foreach($departments as $department){ ?>
                                                                    <option value="<?php echo $department->department_id; ?>" data-address="<?php echo $department->delivery_address; ?>"><?php echo $department->department_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            SO # : <br />
                                                            <div class="input-group">
                                                                <input type="text" name="so_no" class="form-control">
                                                                <span class="input-group-addon">
                                                                    <a href="#" id="link_browse" style="text-decoration: none;color:black;"><b>...</b></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            Due Date : <br />
                                                            <div class="input-group">

                                                                <input type="text" name="date_due" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Date Due" data-error-msg="Please set the date this items are issued!" required>
                                                                 <span class="input-group-addon">
                                                                     <i class="fa fa-calendar"></i>
                                                                </span>

                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            Address :<br>
                                                            <textarea class="form-control" id="txt_address" type="text" name="address" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>


                                        <div style="border: 1px solid #a0a4a5;padding: 1%;border-radius: 5px;">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <label style="font-family: Tahoma;">Please select product type first :</label>
                                                    <div style="padding: 0%;">
                                                        <select name="producttype" id="cbo_prodType" data-error-msg="Product Type is required." required>
                                                            <?php foreach($refproducts as $refproduct){ ?>
                                                                <option value="<?php echo $refproduct->refproduct_id; ?>"><?php echo $refproduct->product_type; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label style="font-family: Tahoma;">Please select Default Lookup Price :</label>
                                                    <div style="padding: 0%;">
                                                        <select name="lookup_price" id="cboLookupPrice">
                                                            <option value="1">SRP (Recommended)</option>
                                                            <option value="2">Distributor Price</option>
                                                            <option value="3">Dealer Price</option>
                                                            <option value="4">Public Price</option>
                                                            <option value="5">Discounted Price</option>
                                                            <option value="6">Purchase Cost</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <br />

                                            <label class="control-label" style="font-family: Tahoma;"><strong>Enter PLU or Search Item :</strong></label>
                                            <div id="custom-templates">
                                                <input class="typeahead" type="text" placeholder="Enter PLU or Search Item">
                                            </div><br />



                                            <form id="frm_items">
                                                <div class="table-responsive"  style="min-height: 200px;padding: 1px;">
                                                    <table id="tbl_items" class="custom-design table-striped" cellspacing="0" width="100%" style="font-font:tahoma;">

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
                                                            <td colspan="2" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Discount :</strong></td>
                                                            <td align="right" colspan="1" id="td_discount color="red">0.00</td>
                                                            <td colspan="2" id="" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Total Before Tax :</strong></td>
                                                            <td align="right" colspan="1" id="td_before_tax" color="red">0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Tax :</strong></td>
                                                            <td align="right" colspan="1" id="td_tax" color="red">0.00</td>
                                                            <td colspan="2" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Total After Tax :</strong></td>
                                                            <td align="right" colspan="1" id="td_after_tax" color="red">0.00</td>
                                                        </tr>
                                                        </tfoot>



                                                    </table>
                                                </div>
                                            </form>


                                        </div>



                                        <div class="row">
                                            <div class="container-fluid">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br />
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label control-label><strong>Remarks :</strong></label>
                                                            <div class="col-lg-12" style="padding: 0%;">
                                                                <textarea name="remarks" class="form-control" placeholder="Remarks"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row" style="display: none;">
                                                        <div class="col-lg-4 col-lg-offset-8">
                                                            <div class="table-responsive">
                                                                <table id="tbl_sales_invoice_summary" class="table invoice-total" style="font-family: tahoma;">
                                                                    <tbody>

                                                                    <tr>
                                                                        <td>Discount :</td>
                                                                        <td align="right">0.00</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total before Tax :</td>
                                                                        <td align="right">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tax :</td>
                                                                        <td align="right">0.00</td>
                                                                    </tr>
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
                    <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Confirm Deletion</h4>

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


    <div id="modal_so_list" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
        <div class="modal-dialog" style="width: 80%;">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                    <h2 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Sales Order</h2>
                </div>

                <div class="modal-body">
                    <table id="tbl_so_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="">
                        <tr>
                            <th></th>
                            <th>SO#</th>
                            <th>Customer</th>
                            <th>Remarks</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th><center>Action</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Sales Order Content -->
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button id="btn_accept" type="button" class="btn btn-green" style="text-transform: none;font-family: Tahoma, Georgia, Serif;">Receive this Order</button>
                    <button id="cancel_modal" class="btn btn-default" style="text-transform: none;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                </div>
            </div><!---content---->
        </div>
    </div><!---modal-->

    <div id="modal_sales_invoice" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header " style="padding: 5px !important;">
                    <h2 style="color:white; padding-left: 10px;">Delivery Receipt</h2>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" style="overflow: scroll; width: 100%;">
                        <salesInvoice id="sales_invoice">
                        </salesInvoice>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div id="modal_new_department" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
        <div class="modal-dialog modal-md">
            <div class="modal-content"><!---content--->
                <div class="modal-header ">
                    <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>New Branch</h4>

                </div>

                <div class="modal-body">
                    <form id="frm_department_new">

                        <div class="form-group">
                            <label>* Branch :</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </span>
                                <input type="text" name="department_name" class="form-control" placeholder="Department" data-error-msg="Department name is required." required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Branch Description :</label>
                            <textarea name="department_desc" class="form-control"></textarea>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">
                    <button id="btn_create_department" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                    <button id="btn_close_close_department" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
                </div>
            </div><!---content---->
        </div>
    </div><!---modal-->








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
        var _lookUpPrice;
        var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboDepartments; var _cboCustomers; var dt_so, _productType, _cboSalesperson;
        var oTableItems={
            qty : 'td:eq(0)',
            unit_price : 'td:eq(3)',
            discount : 'td:eq(4)',
            total_line_discount : 'td:eq(5)',
            tax : 'td:eq(6)',
            total : 'td:eq(7)',
            vat_input : 'td:eq(8)',
            net_vat : 'td:eq(9)'

        };


        var oTableDetails={
            discount : 'tr:eq(0) > td:eq(1)',
            before_tax : 'tr:eq(1) > td:eq(1)',
            inv_tax_amount : 'tr:eq(2) > td:eq(1)',
            after_tax : 'tr:eq(3) > td:eq(1)'
        };


        var initializeControls=function(){

            dt=$('#tbl_sales_invoice').DataTable({
                "dom": '<"toolbar">frtip',
                "bLengthChange":false,
                "pageLength":15,
                "ajax" : "Sales_invoice/transaction/list",
                "columns": [
                    {
                        "targets": [0],
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ""
                    },
                    { targets:[1],data: "sales_inv_no" },
                    { targets:[2],data: "date_invoice" },
                    { targets:[3],data: "date_due" },
                    { targets:[4],data: "issued_department" },

                    { targets:[5],data: "remarks" },
                    {
                        targets:[6],
                        render: function (data, type, full, meta){
                            var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                            var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                            return '<center>'+btn_edit+"&nbsp;"+btn_trash+'</center>';
                        }
                    }
                ]

            });



            dt_so=$('#tbl_so_list').DataTable({
                "bLengthChange":false,
                "ajax" : "Sales_order/transaction/open",
                "columns": [
                    {
                        "targets": [0],
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ""
                    },
                    { targets:[1],data: "so_no" },
                    { targets:[2],data: "customer_name" },
                    { targets:[3],data: "remarks" },
                    { targets:[4],data: "date_order" },
                    { targets:[5],data: "order_status" },
                    {
                        targets:[6],
                        render: function (data, type, full, meta){
                            var btn_accept='<button class="btn btn-success btn-sm" name="accept_so"  style="margin-left:-15px;text-transform: none;" data-toggle="tooltip" data-placement="top" title="Create Sales Invoice on SO"><i class="fa fa-check"></i> Accept SO</button>';
                            return '<center>'+btn_accept+'</center>';
                        }
                    }

                ]

            });


            var createToolBarButton=function(){
                var _btnNew='<button class="btn btn-green" id="btn_new" style="text-transform: none;font-family: Tahoma, Georgia, Serif; " data-toggle="modal" data-target="#salesInvoice" data-placement="left" title="New Sales Invoice" >'+
                    '<i class="fa fa-plus-circle"></i> New Sales Invoice</button>';
                $("div.toolbar").html(_btnNew);
            }();


            _productType = $('#cbo_prodType').select2({
                placeholder: "Please select Product Type",
                allowClear: false
            });

            _cboDepartments=$("#cbo_departments").select2({
                placeholder: "Please select branch.",
                allowClear: true
            });
            _cboDepartments.select2('val', 1);
            _cboDepartments.select2("enable",false);

            _lookUpPrice = $('#cboLookupPrice').select2({
                allowClear: false
            });
            _lookUpPrice.select2('val',1);

            _cboIssueDepartments=$("#cbo_issue_departments").select2({
                placeholder: "Please select branch.",
                allowClear: true
            });
            _cboIssueDepartments.select2('val', null);



            _productType.select2('val',null);




            $('.date-picker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true

            });

            var products = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace(''),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    cache: false,
                    url: 'Sales_invoice/transaction/current-items/',
                    replace: function(url, uriEncodedQuery) {
                        var prod_type=$('#cbo_prodType').select2('val');
                        return url + '?type='+prod_type+'&description='+uriEncodedQuery;
                    }
                }
            });

            $('#custom-templates .typeahead').keypress(function(event){
                if (event.keyCode == 13) {
                    $('.tt-suggestion:first').click();
                }
            });

            var _objTypeHead=$('#custom-templates .typeahead');

            _objTypeHead.typeahead({minLength:1,hint:true}, {
            name: 'products',
            display: 'product_code',
            limit : 10000,
                source: products,
            templates: {
                header: [
                    '<table width="100%"><tr><td width=7%" style="padding-left: 1%;"><b>PLU</b></td><td width="20%" align="left"><b>Description 1</b></td><td width="7%" align="left"><b>Batch #</b></td><td width="7%" align="left"><b>Expiration</b></td><td width="7%" style="text-align: right;padding-right:1%;"><b>On hand</b></td><td width="7%" align="right" style="padding-right: 2%;"><b>SRP</b></td><td width="7%" align="right" style="padding-right: 0%;"><b>Dealer</b></td><td width="7%" align="right" style="padding-right: 0%;"><b>Distributor</b></td><td width="7%" align="right" style="padding-right: 0%;"><b>Discounted</b></td><td width="7%" align="right" style="padding-right: 0%;"><b>Public</b></td><td width="7%" align="right" style="padding-right: 1%;"><b>Cost</b></td></tr></table>'
                ].join('\n'),

                suggestion: Handlebars.compile('<table width="100%"><tr><td width="7%" style="padding-left: 1%">{{product_code}}</td><td width="20%" align="left">{{product_desc}}</td><td width="7%" align="left">{{batch_no}}</td><td width="7%" align="left">{{exp_date}}</td><td width="7%" style="padding-right:1%;" align="right">{{on_hand_per_batch}}</td><td width="7%" align="right" style="padding-right: 2%;">{{srp}}</td><td width="7%" align="right" style="padding-right: 0%;">{{srp_dealer}}</td><td width="7%" align="right" style="padding-right: 0%;">{{srp_distributor}}</td><td width="7%" align="right" style="padding-right: 0%;">{{srp_discounted}}</td><td width="7%" align="right" style="padding-right: 0%;">{{srp_public}}</td><td width="7%" align="right" style="padding-right: 1%;">{{srp_cost}}</td></tr></table>')

            }
            }).on('keyup', this, function (event) {
                if (_objTypeHead.typeahead('val') == '')
                    return false;
                if (event.keyCode == 13) {
                    //$('.tt-suggestion:first').click();
                    _objTypeHead.typeahead('close');
                    _objTypeHead.typeahead('val','');
                }
            }).bind('typeahead:select', function(ev, suggestion) {


                //var tax_rate=<?php echo $tax_percentage; ?>;

                var tax_rate=suggestion.tax_rate; // tax rate is based the tax type set to selected product
                var total=0;
                

                var _defLookUp=_lookUpPrice.select2('val');
                if(_defLookUp=="2"){
                    total=getFloat(suggestion.distributor_price);
                }else if(_defLookUp=="3"){
                    total=getFloat(suggestion.dealer_price);
                }
                else if(_defLookUp=="4"){
                    total=getFloat(suggestion.public_price);
                }
                else if(_defLookUp=="5"){
                    total=getFloat(suggestion.discounted_price);
                }
                else if(_defLookUp=="6"){
                    total=getFloat(suggestion.purchase_cost);
                }else{
                    total=getFloat(suggestion.sale_price);
                }

                var net_vat=0;
                var vat_input=0;

                var rowCount = $('#tbl_items .row-item').length + 1;

                if(suggestion.is_tax_exempt=="0"){ //not tax excempt
                    net_vat=total/(1+(getFloat(tax_rate)/100));
                    vat_input=total-net_vat;
                }else {
                    tax_rate=0;
                    net_vat=total;
                    vat_input=0;
                }


                if (true) {
                    $('#tbl_items > tbody').append(newRowItem({
                        inv_qty : "1",
                        product_code : suggestion.product_code,
                        unit_id : suggestion.unit_id,
                        unit_name : suggestion.unit_name,
                        product_id: suggestion.product_id,
                        product_desc : suggestion.product_desc,
                        inv_line_total_discount : "0.00",
                        tax_exempt : false,
                        inv_tax_rate : tax_rate,
                        inv_price : total,
                        inv_discount : "0.00",
                        tax_type_id : null,
                        inv_line_total_price : total,
                        inv_non_tax_amount: net_vat,
                        inv_tax_amount:vat_input,
                        batch_no:suggestion.batch_no,
                        exp_date:suggestion.exp_date,
                        max_qty:suggestion.on_hand_per_batch,
                        cost_upon_invoice:suggestion.purchase_cost

                    }));
                } else {
                    showNotification({title:"Error",stat:"error",msg:"Items must not exceed with <b>10</b>."});
                    return false;
                }

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

            $('#tbl_sales_invoice tbody').on( 'click', 'tr td.details-control', function () {

                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                var d=row.data();
                $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"Templates/layout/sales-invoice/"+ d.sales_invoice_id+"?type=drview&category=2"
                }).done(function(response){
                    $("#sales_invoice").html(response);
                    $("#modal_sales_invoice").modal('show');
                });

            } );



            $('#link_browse').click(function(){
                $('#btn_receive_so').click();
            });





            $('#tbl_so_list tbody').on( 'click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt_so.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );

                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice( idx, 1 );
                }
                else {
                    tr.addClass( 'details' );
                    //console.log(row.data());
                    _selectRowObj=$(this).closest('tr');
                    var d=dt_so.row(_selectRowObj).data();

                    $.ajax({
                        "dataType":"html",
                        "type":"POST",
                        "url":"Templates/layout/sales-order/"+ d.sales_order_id+'/contentview',
                        "beforeSend" : function(){
                            row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                        }
                    }).done(function(response){
                        row.child( response ).show();
                        // Add to the 'open' array
                        if ( idx === -1 ) {
                            detailRows.push( tr.attr('id') );
                        }
                    });


                }
            } );



            $('#btn_close_salesperson').on('click',function(){
                $('#modal_new_salesperson').modal('hide');
            });

            //loads modal to create new department
            _cboIssueDepartments.on("select2:select", function (e) {
                var i=$(this).select2('val');
                if(i==0){ //new department
                    clearFields($('#modal_new_department').find('form'));
                    _cboIssueDepartments.select2('val',null)
                    $('#modal_new_department').modal('show');
                }else{

                    var obj_department=$('#cbo_issue_departments').find('option[value="'+i+'"]');
                    $('textarea[name="address"]').val(obj_department.data('address'));
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
                        $('#cbo_issue_departments').append('<option value="'+_department.department_id+'" selected>'+_department.department_name+'</option>');
                        $('#cbo_issue_departments').select2('val',_department.department_id);

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }


            });


            $('#btn_receive_so').click(function(){
                $('#tbl_so_list tbody').html('<tr><td colspan="7"><center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center></td></tr>');
                dt_so.ajax.reload( null, false );
                $('#modal_so_list').modal('show');
            });

            //create new customer
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
                        $('#cbo_customers').append('<option value="'+_customer.customer_id+'" selected>'+_customer.customer_name+'</option>');
                        $('#cbo_customers').select2('val',_customer.customer_id);

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }
            });

            $('#btn_new').click(function(){
                _txnMode="new";


                $('#cbo_departments').select2('val', 1);
                $('#cbo_issue_departments').select2('val', null);
                $('#cbo_prodType').select2('val', 3);
                $('#cboLookupPrice').select2('val', 1);

                clearFields($('#div_sales_invoice_fields'));
                $('#span_invoice_no').html('INV-XXXX');
                showList(false);

            });

            $('#btn_browse').click(function(event){
                event.preventDefault();
                $('input[name="file_upload[]"]').click();
            });

            $('#btn_remove_photo').click(function(event){
                event.preventDefault();
                $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
            });



            $('#tbl_so_list > tbody').on('click','button[name="accept_so"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt_so.row(_selectRowObj).data();

                //alert(d.sales_order_id);

                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                            _elem.val(value);
                        }

                    });

                    $('#cbo_customers').select2('val',data.customer_id);
                    $('#cbo_departments').select2('val',data.department_id);
                    $('#cbo_salesperson').select2('val',data.salesperson_id);

                });


                $('#modal_so_list').modal('hide');
                resetSummary();


                $.ajax({
                    url : 'Sales_order/transaction/item-balance/'+data.sales_order_id,
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

                        var rowCount = $('#tbl-items .row-item');


                        console.log(rowCount);
                        $.each(rows,function(i,value){
                            $('#tbl_items > tbody').append(newRowItem({
                                inv_qty : value.so_qty,
                                product_code : value.product_code,
                                unit_id : value.unit_id,
                                unit_name : value.unit_name,
                                product_id: value.product_id,
                                product_desc : value.product_desc,
                                inv_line_total_discount : value.so_line_total_discount,
                                tax_exempt : false,
                                inv_tax_rate : value.so_tax_rate,
                                inv_price : value.so_price,
                                inv_discount : value.so_discount,
                                tax_type_id : null,
                                inv_line_total_price : value.so_line_total,
                                inv_non_tax_amount: value.non_tax_amount,
                                inv_tax_amount:value.tax_amount,
                                batch_no : value.batch_no,
                                cost_upon_invoice : value.purchase_cost
                            }));
                        });

                        reComputeTotal();
                    }
                });



            });







            $('#tbl_sales_invoice tbody').on('click','button[name="edit_info"]',function(){

                _txnMode="edit";
                $('#cbo_prodType').select2('val', 3);

                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.sales_invoice_id;

                $('#span_invoice_no').html(data.sales_inv_no);

                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                            _elem.val(value);
                        }
                    });
                });

                $('#cbo_departments').select2('val',1);
                $('#cbo_issue_departments').select2('val',data.issue_to_department);
                //$('#cbo_customers').select2('val',data.customer_id);
                //$('#cbo_salesperson').select2('val',data.salesperson_id);
                $('textarea[name="remarks"]').val(data.remarks);
                $('#cboLookupPrice').select2('val', 1);


                $.ajax({
                    url : 'Sales_invoice/transaction/items/'+data.sales_invoice_id,
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
                                inv_qty : value.inv_qty,
                                product_code : value.product_code,
                                unit_id : value.unit_id,
                                unit_name : value.unit_name,
                                product_id: value.product_id,
                                product_desc : value.product_desc,
                                inv_line_total_discount : value.inv_line_total_discount,
                                tax_exempt : false,
                                inv_tax_rate : value.inv_tax_rate,
                                inv_price : value.inv_price,
                                inv_discount : value.inv_discount,
                                tax_type_id : null,
                                inv_line_total_price : value.inv_line_total_price,
                                inv_non_tax_amount: value.inv_non_tax_amount,
                                inv_tax_amount:value.inv_tax_amount,
                                batch_no:value.batch_no,
                                exp_date:value.exp_date,
                                cost_upon_invoice:value.cost_upon_invoice

                            }));
                        });

                        reInitializeNumeric();
                        reComputeTotal();
                    }
                });




                showList(false);

            });

            $('#tbl_sales_invoice tbody').on('click','button[name="remove_info"]',function(){
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.sales_invoice_id;

                $('#modal_confirmation').modal('show');
            });



            //track every changes on numeric fields
            $('#tbl_items tbody').on('keyup','input.numeric,input.number',function(){
                var row=$(this).closest('tr');

                var price=parseFloat(accounting.unformat(row.find(oTableItems.unit_price).find('input.numeric').val()));
                var discount=parseFloat(accounting.unformat(row.find(oTableItems.discount).find('input.numeric').val()));
                var qty=parseFloat(accounting.unformat(row.find(oTableItems.qty).find('input.number').val()));
                var tax_rate=parseFloat(accounting.unformat(row.find(oTableItems.tax).find('input.numeric').val()))/100;




                if(discount>price){
                    showNotification({title:"Invalid",stat:"error",msg:"Discount must not greater than unit price."});
                    row.find(oTableItems.discount).find('input.numeric').val('0.00');
                    //$(this).trigger('keyup');
                    //return;
                }

                var discounted_price=price-discount;
                var line_total_discount=discount*qty;
                var line_total=discounted_price*qty;
                var net_vat=line_total/(1+tax_rate);
                var vat_input=line_total-net_vat;

                $(oTableItems.total,row).find('input.numeric').val(accounting.formatNumber(line_total,4)); // line total amount
                $(oTableItems.total_line_discount,row).find('input.numeric').val(line_total_discount); //line total discount
                $(oTableItems.net_vat,row).find('input.numeric').val(net_vat); //net of vat
                $(oTableItems.vat_input,row).find('input.numeric').val(vat_input); //vat input

                //console.log(net_vat);
                reComputeTotal();


            });







            $('#btn_yes').click(function(){
                //var d=dt.row(_selectRowObj).data();
                //if(getFloat(d.order_status_id)>1){
                //showNotification({title:"Error!",stat:"error",msg:"Sorry, you cannot delete purchase order that is already been recorded on purchase invoice."});
                //}else{
                removeIssuanceRecord().done(function(response){
                    showNotification(response);
                    if(response.stat=="success"){
                        dt.row(_selectRowObj).remove().draw();
                    }

                });
                //}
            });





            $('input[name="file_upload[]"]').change(function(event){
                var _files=event.target.files;

                $('#div_img_user').hide();
                $('#div_img_loader').show();


                var data=new FormData();
                $.each(_files,function(key,value){
                    data.append(key,value);
                });

                //console.log(_files);

                $.ajax({
                    url : 'Users/transaction/upload',
                    type : "POST",
                    data : data,
                    cache : false,
                    dataType : 'json',
                    processData : false,
                    contentType : false,
                    success : function(response){
                        //console.log(response);
                        //alert(response.path);
                        $('#div_img_loader').hide();
                        $('#div_img_user').show();
                        $('img[name="img_user"]').attr('src',response.path);

                    }
                });

            });

            $('#btn_cancel').click(function(){
                //$('#modal_so_list').modal('hide');
                showList(true);
                $('cbo_prodType').select2('val',null);
            });



            $('#btn_save').click(function(){

                if(validateRequiredFields($('#frm_sales_invoice'))){
                    if(_txnMode=="new"){
                        createSalesInvoice().done(function(response){
                            showNotification(response);
                            if(response.stat=="success"){
                                dt.row.add(response.row_added[0]).draw();
                                clearFields($('#frm_sales_invoice'));
                                showList(true);

                            }

                            if (response.current_row_index != undefined) {
                                var rowObj=$('#tbl_items > tbody tr:eq('+response.current_row_index+')');
                                rowHighlight(rowObj);
                            }


                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }else{
                        updateSalesInvoice().done(function(response){
                            showNotification(response);

                            if(response.stat=="success"){
                                dt.row(_selectRowObj).data(response.row_updated[0]).draw(false);
                                clearFields($('#frm_sales_invoice'));
                                showList(true);

                            }

                            if (response.current_row_index != undefined) {
                                var rowObj=$('#tbl_items > tbody tr:eq('+response.current_row_index+')');
                                rowHighlight(rowObj);
                            }


                        }).always(function(){
                            showSpinningProgress($('#btn_save'));
                        });
                    }
                    //$('#cbo_prodType').select2('val',null);

                }

            });



            $('#tbl_items > tbody').on('click','button[name="remove_item"]',function(){
                $(this).closest('tr').remove();
                reComputeTotal();
            });


        })();


        var validateRequiredFields=function(f){
            var stat=true;
            var rowObj=$('#tbl_items > tbody tr');
            rowHighlight(rowObj,false);

            $('div.form-group').removeClass('has-error');
            $('input[required],textarea[required],select[required]',f).each(function(){

                if($(this).is('select')){
                    if($(this).select2('val')==0||$(this).select2('val')==null){
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


        var createSalesInvoice=function(){
            var _data=$('#frm_sales_invoice,#frm_items').serializeArray();

            var tbl_summary=$('#tbl_sales_invoice_summary');

            _data.push({name : "remarks", value : $('textarea[name="remarks"]').val()});
            _data.push({name : "summary_discount", value : tbl_summary.find(oTableDetails.discount).text()});
            _data.push({name : "summary_before_discount", value :tbl_summary.find(oTableDetails.before_tax).text()});
            _data.push({name : "summary_tax_amount", value : tbl_summary.find(oTableDetails.inv_tax_amount).text()});
            _data.push({name : "summary_after_tax", value : tbl_summary.find(oTableDetails.after_tax).text()});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Sales_invoice/transaction/create",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var updateSalesInvoice=function(){
            var _data=$('#frm_sales_invoice,#frm_items').serializeArray();

            var tbl_summary=$('#tbl_sales_invoice_summary');
            _data.push({name : "remarks", value : $('textarea[name="remarks"]').val()});
            _data.push({name : "summary_discount", value : tbl_summary.find(oTableDetails.discount).text()});
            _data.push({name : "summary_before_discount", value :tbl_summary.find(oTableDetails.before_tax).text()});
            _data.push({name : "summary_tax_amount", value : tbl_summary.find(oTableDetails.inv_tax_amount).text()});
            _data.push({name : "summary_after_tax", value : tbl_summary.find(oTableDetails.after_tax).text()});
            _data.push({name : "sales_invoice_id" ,value : _selectedID});

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Sales_invoice/transaction/update",
                "data":_data,
                "beforeSend": showSpinningProgress($('#btn_save'))
            });
        };

        var removeIssuanceRecord=function(){
            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Sales_invoice/transaction/delete",
                "data":{sales_invoice_id : _selectedID}
            });
        };

        var showList=function(b){
            if(b){
                $('#div_sales_invoice_list').show();
                $('#div_sales_invoice_fields').hide();
            }else{
                $('#div_sales_invoice_list').hide();
                $('#div_sales_invoice_fields').show();
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

        $('#cancel_modal').on('click',function(){
            $('#modal_so_list').modal('hide');
        });



        var showSpinningProgress=function(e){
            $(e).toggleClass('disabled');
            $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
        };

        var clearFields=function(f){
            $('input:not(.date-picker),textarea',f).val('');
            $(f).find('input:first').focus();
            $('#tbl_items > tbody',f).html('');
            $('#cbo_prodType').select2('val', 3);
        };


        function format ( d ) {

            //return


        };


        var getFloat=function(f){
            return parseFloat(accounting.unformat(f));
        };

        var newRowItem=function(d){
            return '<tr class="row-item">'+
                '<td width="10%"><input name="inv_qty[]" type="text" class="number form-control" value="'+ d.inv_qty+'"></td>'+
                '<td width="5%">'+ d.unit_name+'</td>'+
                '<td width="10%">'+d.product_desc+'</td>'+
                '<td width="11%"><input name="inv_price[]" type="text" class="numeric form-control" value="'+accounting.formatNumber(d.inv_price,4)+'" style="text-align:right;"></td>'+
                '<td width="11%" style="display:none;"><input name="inv_discount[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.inv_discount,4)+'" style="text-align:right;"></td>'+
                '<td style="display: none;" width="11%"><input name="inv_line_total_discount[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.inv_line_total_discount,4)+'" readonly></td>'+
                '<td width="11%" style="display:none;"><input name="inv_tax_rate[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.inv_tax_rate,4)+'"></td>'+
                '<td width="11%" align="right"><input name="inv_line_total_price[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.inv_line_total_price,4)+'" readonly></td>'+
                '<td style="display: none;"><input name="inv_tax_amount[]" type="text" class="numeric form-control" value="'+ d.inv_tax_amount+'" readonly></td>'+
                '<td style="display: none;"><input name="inv_non_tax_amount[]" type="text" class="numeric form-control" value="'+ d.inv_non_tax_amount+'" readonly></td>'+
                '<td style="display: none;"><input name="product_id[]" type="text" class="form-control" value="'+ d.product_id+'" readonly></td>'+
                '<td style="display: none;"><input name="batch_no[]" type="text" class="form-control" value="'+ d.batch_no+'" readonly></td>'+
                '<td style="display: none;"><input name="max_qty[]" type="text" class="form-control" value="'+ d.max_qty+'" readonly></td>'+
                '<td style="display:none;"><input name="exp_date[]" type="text" class="form-control" value="'+ d.exp_date+'" readonly></td>'+
                '<td style="display:none;"><input name="cost_upon_invoice[]" type="text" class="form-control" value="'+ d.cost_upon_invoice+'" readonly></td>'+
                '<td align="center"><button type="button" name="remove_item" class="btn btn-red"><i class="fa fa-trash"></i></button></td>'+
                '</tr>';
        };



        var reComputeTotal=function(){
            var rows=$('#tbl_items > tbody tr');


            var discounts=0; var before_tax=0; var after_tax=0; var inv_tax_amount=0;

            $.each(rows,function(){
                //console.log($(oTableItems.net_vat,$(this)));
                discounts+=parseFloat(accounting.unformat($(oTableItems.total_line_discount,$(this)).find('input.numeric').val()));
                before_tax+=parseFloat(accounting.unformat($(oTableItems.net_vat,$(this)).find('input.numeric').val()));
                inv_tax_amount+=parseFloat(accounting.unformat($(oTableItems.vat_input,$(this)).find('input.numeric').val()));
                after_tax+=parseFloat(accounting.unformat($(oTableItems.total,$(this)).find('input.numeric').val()));
            });

            var tbl_summary=$('#tbl_sales_invoice_summary');
            tbl_summary.find(oTableDetails.discount).html(accounting.formatNumber(discounts,4));
            tbl_summary.find(oTableDetails.before_tax).html(accounting.formatNumber(before_tax,4));
            tbl_summary.find(oTableDetails.inv_tax_amount).html(accounting.formatNumber(inv_tax_amount,4));
            tbl_summary.find(oTableDetails.after_tax).html('<b>'+accounting.formatNumber(after_tax,4)+'</b>');

            $('#td_before_tax').html(accounting.formatNumber(before_tax,4));
            $('#td_after_tax').html('<b>'+accounting.formatNumber(after_tax,4)+'</b>');
            $('#td_discount').html(accounting.formatNumber(discounts,4));
            $('#td_tax').html(accounting.formatNumber(inv_tax_amount,4));

        };


        var resetSummary=function(){
            var tbl_summary=$('#tbl_sales_invoice_summary');
            tbl_summary.find(oTableDetails.discount).html('0.00');
            tbl_summary.find(oTableDetails.before_tax).html('0.00');
            tbl_summary.find(oTableDetails.inv_tax_amount).html('0.00');
            tbl_summary.find(oTableDetails.after_tax).html('<b>0.00</b>');
        };




        var reInitializeNumeric=function(){
            $('.numeric').autoNumeric('init',{mDec:4});
            $('.number').autoNumeric('init', {mDec:0});
        };



        var rowHighlight=function(rowObj,b=true){
            if(b){
                $('td:eq(0) input',rowObj).css({
                    "color": "red",
                    "border-color": "red",
                    "font-weight": "bolder"
                });


            }else{
                $('td:eq(0) input',rowObj).css({
                    "color": "black",
                    "border-color": "lightgray",
                    "font-weight": "normal"
                });
            }

        };




    });




</script>


</body>


</html>