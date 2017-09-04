
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
    <?php echo $_def_js_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <!--/twitter typehead-->
    <link href="assets/plugins/twittertypehead/twitter.typehead.css" rel="stylesheet">
    <!-- Datepicker -->
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <style>
        #tbl_items td,#tbl_items tr,#tbl_items th{
            table-layout: fixed;
            border: 1px solid gray;
            border-collapse: collapse;
        }
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

        @media screen and (max-width: 1000px) {
            .custom_frame{
                padding-left:5%;

            }
        }

        @media screen and (max-width: 480px) {

            table{
                min-width: 700px;
            }




            .dataTables_filter{
                min-width: 700px;
            }

            .dataTables_info{
                min-width: 700px;
            }

            .dataTables_paginate{
                float: left;
                width: 100%;
            }
        }

        .boldlabel {
            font-weight: bold;
        }

        #modal-supplier {
            padding-left:0px !important;
        }

        .form-group {
            padding:0;
            margin:5px;
        }

        .input-group {
            padding:0;
            margin:0;
        }

        textarea {
            resize: none;
        }

        .modal-body p {
            margin-left: 20px !important;
        }

        #img_user {
            padding-bottom: 15px;
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

<ol class="breadcrumb"  style="margin-bottom: 10px;">
    <li><a href="Dashboard">Dashboard</a></li>
    <li><a href="Deliveries">Purchase Invoice</a></li>
</ol>


<div class="container-fluid"">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">

<div id="div_delivery_list">
    <div class="panel panel-default">
<!--         <div class="panel-heading">
            <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Purchase Invoice</b>
        </div> -->
        <div class="panel-body table-responsive">
        <div class="row panel-row">
            <h2 style="margin-bottom: 0;" class="h2-panel-heading"> Purchase Invoice</h2><hr>
            <table id="tbl_delivery_invoice" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>Invoice #</th>
                    <th>Supplier</th>
                    <th>External Ref#</th>
                    <th>PO #</th>
                    <th>Terms</th>
                    <th>Delivered</th>
                    <th><center>Action</center></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>


<div id="div_delivery_fields" style="display: none;">
<div class="panel panel-default" style="border: 4px solid #2980b9;border-radius: 8px;">
<!-- <div class="panel-heading">
    <h2>Purchase Invoice</h2>
</div> -->


    <div class="col-xs-12 col-md-4" style="display: none;">
        <div class="btn btn-green"><strong> <a id="btn_receive_po" href="#" style="color: white; text-decoration: none;">Receive from Purchase Order</a> </strong></div>
        <div class="panel-ctrls" data-actions-container=""></div>
    </div>


<div class="panel-body">

<div class="row panel-row">

    <form id="frm_deliveries" role="form" class="form-horizontal">
        <h2 class="h2-panel-heading">Invoice # : <span id="span_invoice_no">INV-XXXX</span></h2><hr>
        <div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Invoice #:</label><br />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-code"></i>
                        </span>
                        <input type="text" name="dr_invoice_no" class="form-control" placeholder="P-INV-YYYYMMDD-XXX" readonly>
                    </div>
                </div>

                <div class="col-sm-2">
                    <label>Invoice Date :</label><br />
                    <div class="input-group">

                        <input type="text" name="date_delivered" id="order_default" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Due Date" data-error-msg="Delivery Date is required!" required>
                         <span class="input-group-addon">
                             <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>

                <div class="col-sm-3 col-sm-offset-4">

                </div>

            </div>



            <div class="row">
                <div class="col-sm-3">
                    <label>PO #:</label><br />
                    <div class="input-group">
                        <input type="text" name="po_no" class="form-control" placeholder="PO #">
                         <span class="input-group-addon">
                            <a href="#" id="link_browse_po"><b>...</b></a>
                        </span>
                    </div>
                </div>

                <div class="col-sm-2">
                    <label>Due Date:</label><br />
                    <div class="input-group">
                        <input type="text" name="date_due" id="due_default" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>" placeholder="Due Date" data-error-msg="Due Date is required!" required>
                        <span class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>

                <div class="col-sm-3 col-sm-offset-4">
                    <label>Reference #:</label><br />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-code"></i>
                        </span>
                        <input type="text" name="external_ref_no" class="form-control" placeholder="External Ref No.">
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-sm-5">
                   <b class="required">*</b><label> Department :</label> <br />
                    <select name="department" id="cbo_departments" data-error-msg="Department is required." required>
                        <option value="0">[ Create New Department ]</option>
                        <?php foreach($departments as $department){ ?>
                            <option value="<?php echo $department->department_id; ?>"  data-default-cost="<?php echo $department->default_cost; ?>" ><?php echo $department->department_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-sm-3 col-sm-offset-4">
                    <label>Terms :</label><br />
                    <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        <input type="text" name="terms" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-sm-5">
                    <b class="required">*</b> <label>Supplier </label>:<br />
                    <select name="supplier" id="cbo_suppliers" data-error-msg="Supplier is required." required>
                        <option value="0">[ Create New Supplier ]</option>
                        <?php foreach($suppliers as $supplier){ ?>
                            <option value="<?php echo $supplier->supplier_id; ?>" data-tax-type="<?php echo $supplier->tax_type_id; ?>" data-contact-person="<?php echo $supplier->contact_name; ?>"><?php echo $supplier->supplier_name; ?></option>
                        <?php } ?>
                    </select>
                </div>





                <div class="col-sm-3 col-sm-offset-4">
                    <label>Contact Person :</label><br />
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </span>
                        <input type="text" name="contact_person" class="form-control" placeholder="Contact Person">
                    </div>
                </div>

                <div class="col-sm-3 col-sm-offset-4" style="display: none;">
                    <label>Tax type :</label><br />
                    <select name="tax_type" id="cbo_tax_type"  data-error-msg="Tax Type is required !">
                        <?php foreach($tax_types as $tax_type){ ?>
                            <option value="<?php echo $tax_type->tax_type_id; ?>" data-tax-rate="<?php echo $tax_type->tax_rate; ?>"><?php echo $tax_type->tax_type; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div><hr />
        </div>
    </form>
   
</div>

<div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label class="control-label" style="font-family: Tahoma;"><strong>Enter PLU or Search Item :</strong></label>
        <div id="custom-templates">
            <input class="typeahead" type="text" placeholder="Enter PLU or Search Item">
        </div><br />

        <form id="frm_items">
            <div class="table-responsive" style="min-height: 200px;padding: 1px;">
                <table id="tbl_items" class="table table-striped" cellspacing="0" width="100%" style="font-font:tahoma;">
                <thead class="">
                <tr>
                    <th width="5%">Qty</th>
                    <th width="5%" style="display:none;">UM</th>
                    <th width="10%">Item</th>
                    <th width="5%" style="text-align: right;">Unit Price</th>
                    <th width="5%" style="text-align: right;">Discount (%)</th>
                    <th width="5%" style="display: none;">T.D</th> <!-- total discount -->
                    <th width="2%" style="display: none;">Tax %</th>
                    <th width="5%" colspan="3" style="text-align: right;"">Total</th>
                    <th width="5%" style="display: none;">V.I</th> <!-- vat input -->
                    <th width="5%" style="display: none;">N.V</th> <!-- net of vat -->
                    <td style="display:none;">Item ID</td><!-- product id -->
                    <th width="5%" ><center><strong>Action</strong></center></td>
                </tr>
                </thead>
                <tbody>
                <tr class="test"></tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="9" style="height: 20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Discount (%) :</strong></td>
                        <td align="right" colspan="1" id="" color="red"><input id="txt_overall_discount" name="total_overall_discount" type="text" class="numeric form-control" value="0.00" /></td>
                        <td style="text-align: right;"><strong><i class="glyph-icon icon-star"></i>Total After Discount :</strong></td>
                        <td id="td_total_after_discount" style="text-align: right;"><strong>0.00</strong></td>
                        <td style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Total Before Tax :</strong></td>
                        <td align="right" colspan="4" id="td_before_tax" color="red">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Tax :</strong></td>
                        <td align="right" colspan="1" id="td_tax" color="red">0.00</td>
                        <td colspan="2" style="text-align: right;"><strong><i class="glyph-icon icon-star"></i> Total After Tax :</strong></td>
                        <td align="right" colspan="4" id="td_after_tax" color="red">0.00</td>
                    </tr>
                </tfoot>

            </table>
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                Remarks :<br />
                <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea><br />
            </div>
        </div>


        <div class="row" style="display: none;">
            <div class="col-lg-4 col-lg-offset-8">
                <table id="tbl_delivery_summary" class="table invoice-total">
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
<div class="panel-footer">
    <div class="row">
        <div class="col-sm-12">
            <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>  Save Changes</button>
            <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
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
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>Confirm Deletion</h4>
            </div>
            <div class="modal-body">
                <p id="modal-body-message">Are you sure ?</p>
            </div>
            <div class="modal-footer">
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->

<div id="modal_po_list" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content"><!---content--->
            <div class="modal-header ">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Purchase Order</h4>

            </div>

            <div class="modal-body">
                <table id="tbl_po_list" class="table table-striped" cellspacing="0" width="100%">
                    <thead class="">
                    <tr>
                        <th></th>
                        <th>PO#</th>
                        <th>Vendor</th>
                        <th>Terms</th>
                        <th>Deliver to</th>
                        <th>Status</th>
                        <th><center>Action</center></th>
                    </tr>
                    </thead>
                    <tbody>



                    </tbody>
                </table>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: none;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->

<div id="modal_new_department" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #2ecc71">
                 <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                 <h2 id="department_title" class="modal-title" style="color:white;">New Department</h2>
            </div>
            <div class="modal-body">
                <form id="frm_department" role="form" class="form-horizontal">
                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label><b>*</b> Department :</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </span>
                                    <input type="text" name="department_name" class="form-control" placeholder="Department" data-error-msg="Department name is required." required>
                                </div>
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
                    </div><!-- 

                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class="">Delivery Address :</label>
                                <textarea name="delivery_address" class="form-control" placeholder="Delivery Address"></textarea>

                            </div>
                        </div>
                    </div>



                    <div class="row" style="margin: 1%;">
                        <div class="col-lg-12">
                            <div class="form-group" style="margin-bottom:0px;">
                                <label class="">Please specify the default cost of this Branch when purchasing items (Optional) :</label>
                                <select name="default_cost" id="cbo_default_cost" class="form-control" data-error-msg="Item type is required." required>
                                    <option value="1">Purchase Cost 1 (Luzon Area)</option>
                                    <option value="2">Purchase Cost 2 (Viz-Min Area)</option>
                                </select>
                            </div>
                        </div>
                    </div><br /><br /> -->



                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_create_new_department" class="btn btn-primary">Save</button>
                <button id="btn_close_new_department" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_new_supplier" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2ecc71;">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:#ecf0f1 !important;"><span id="modal_mode"> </span>New Supplier</h4>

            </div>

            <div class="modal-body" style="overflow:hidden;">
                

                <form id="frm_suppliers_new">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Company Name :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <input type="text" name="supplier_name" class="form-control" placeholder="Supplier Name" data-error-msg="Supplier Name is required!" required>
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


                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;">TIN # :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-code"></i>
                                        </span>
                                        <input type="text" name="tin_no" class="form-control" placeholder="TIN #">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4" id="label">
                                     <label class="control-label boldlabel" style="text-align:right;"><font color="red"><b>*</b></font> Tax :</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-code"></i>
                                        </span>
                                        <select name="tax_type_id" id="cbo_tax_group">
                                            <option value="">Please select tax type...</option>
                                            <?php foreach($tax_types as $tax_type){ ?>
                                                <option value="<?php echo $tax_type->tax_type_id; ?>" data-tax-rate="<?php echo $tax_type->tax_rate; ?>"><?php echo $tax_type->tax_type; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="control-label boldlabel" style="text-align:left;padding-top:10px;"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px;"></i>Supplier's Photo</label>
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
                <button id="btn_create_new_supplier" type="button" class="btn"  style="background-color:#2ecc71;color:white;"><span class=""></span> Save</button>
                <button id="btn_close_new_supplier" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->






<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2017 - JDEV OFFICE SOLUTIONS</h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>




</div>
</div>


</div>


<?php echo $_switcher_settings; ?>

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
<script src="assets/plugins/twittertypehead/typeahead.bundle.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>

<!-- touchspin -->
<script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>

<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script>




$(document).ready(function(){
    var dt; var dt_po; var _txnMode; var _selectedID; var _selectRowObj; var _cboSuppliers; var _cboTaxType;
    var _productType; var _cboDepartments; var _defCostType;

    //_defCostType=0;

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
        tax_amount : 'tr:eq(2) > td:eq(1)',
        after_tax : 'tr:eq(3) > td:eq(1)'
    };


    var initializeControls=function(){

        dt_po=$('#tbl_po_list').DataTable({
            "bLengthChange":false,
            "ajax" : "Purchases/transaction/open",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "po_no" },
                { targets:[2],data: "supplier_name" },
                { targets:[3],data: "term_description" },
                { targets:[5],data: "deliver_to_address" },
                { targets:[6],data: "order_status" },
                {
                    targets:[7],
                    render: function (data, type, full, meta){
                        var btn_accept='<button class="btn btn-success btn-sm" name="accept_po"  style="margin-left:-15px;text-transform: none;" data-toggle="tooltip" data-placement="top" title="Receive this PO"><i class="fa fa-check"></i> Accept PO</button>';
                        return '<center>'+btn_accept+'</center>';
                    }
                }

            ]
        });

        dt=$('#tbl_delivery_invoice').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "language": {
                "searchPlaceholder":"Search Purchase Invoice"
            },
            "ajax" : "Deliveries/transaction/delivery_list_count",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "dr_invoice_no" },
                { targets:[2],data: "supplier_name" },
                { targets:[3],data: "external_ref_no" },
                { targets:[4],data: "po_no" },
                { targets:[5],data: "term_description" },
                { targets:[6],data: "date_delivered" },
                {
                    targets:[7],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_trash='<button class="btn btn-red btn-sm" name="remove_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+btn_edit+'&nbsp;'+btn_trash+'</center>';
                    }
                }
            ]
        });


        var createToolBarButton=function(){
            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Record Purchase Invoice" >'+
                '<i class="fa fa-plus"></i> Record Purchase Invoice</button>';

            $("div.toolbar").html(_btnNew);
        }();





        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

        $('.numeric').autoNumeric('init');

        $('#contact_no').keypress(validateNumber);

        _cboSuppliers=$("#cbo_suppliers").select2({
            placeholder: "Please select supplier.",
            allowClear: true
        });

        _cboSuppliers.select2('val',null);

        _cboTaxType=$('#cbo_tax_type').select2({
            placeholder: "Please select tax type.",
            allopwClear: true
        });

        var _cboTaxGroup=$('#cbo_tax_group').select2({
            placeholder: "Please select tax type.",
            allopwClear: true,
            dropdownParent: "#modal_new_supplier"
        });

        _cboDepartments=$("#cbo_departments").select2({
            placeholder: "Please select department.",
            allowClear: true
        });

        _cboDepartments.select2('val',null); 

        var raw_data = <?php echo json_encode($products); ?>;

        var products = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('product_code','product_desc','product_desc1','purchase_cost'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local : raw_data
        });

        /*var products = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('product_code','product_desc','product_desc1'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                cache: false,
                url: 'Purchases/transaction/product-lookup/',

                replace: function(url, uriEncodedQuery) {
                    //var prod_type=$('#cbo_prodType').select2('val');
                    //var prod_type=$('#cbo_prodType').select2('val');
                    //var sid=$('#cbo_suppliers').select2('val');
                    //var prod_type=$('#cbo_prodType').select2('val');

                    return url + '?description='+uriEncodedQuery;
                }
            }

            //local : raw_data
        });*/

        var _objTypeHead=$('#custom-templates .typeahead');

        _objTypeHead.typeahead(null, {
                name: 'products',
                display: 'product_code',
                source: products,
                templates: {
                    header: [
                        '<table class="tt-head"><tr><td width=20%" style="padding-left: 1%;"><b>PLU</b></td><td width="20%" align="left"><b>Description 1</b></td><td width="20%" align="left"><b>Description 2</b></td><td width="10%" align="right" style="padding-right: 2%;"><b>On hand</b><td width="10%" align="right" style="padding-right: 2%;"><b>Cost</b></td></tr></table>'
                    ].join('\n'),

                    suggestion: Handlebars.compile('<table class="tt-items"><tr><td width="20%" style="padding-left: 1%">{{product_code}}</td><td width="20%" align="left">{{product_desc}}</td><td width="20%" align="left">{{produdct_desc1}}</td><td width="10%" align="right" style="padding-right: 2%;">{{on_hand}}</td><td width="10%" align="right" style="padding-right: 2%;">{{purchase_cost}}</td></tr></table>')

                }
            }).on('keyup', this, function (event) {
                if (_objTypeHead.typeahead('val') == '') {
                    return false;
                }
                if (event.keyCode == 13) {
                    $('.tt-suggestion:first').click();
                    // _objTypeHead.typeahead('close'); -- changed due to barcode scan not working
                    // _objTypeHead.typeahead('val',''); -- changed due to barcode scan not working
                }
            }).bind('typeahead:select', function(ev, suggestion) {

                var tax_rate=suggestion.tax_rate; 
                var total=getFloat(suggestion.purchase_cost);
                var net_vat=0;
                var vat_input=0;

                if(suggestion.is_tax_exempt=="0"){ //this is not excempted to tax
                    net_vat=total/(1+(getFloat(tax_rate)/100));
                    vat_input=total-net_vat;
                }else{
                    tax_rate=0;
                    net_vat=total;
                    vat_input=0;
                }


                $('#tbl_items > tbody').append(newRowItem({
                    //dr_qty : value.dr_qty,
                    dr_qty : "1",
                    product_code : suggestion.product_code,
                    unit_id : suggestion.unit_id,
                    unit_name : suggestion.unit_name,
                    product_id: suggestion.product_id,
                    product_desc : suggestion.product_desc,
                    dr_line_total_discount : "0.00",
                    tax_exempt : false,
                    dr_tax_rate : tax_rate,
                    dr_price : suggestion.purchase_cost,
                    dr_discount : "0.00",
                    tax_type_id : null,
                    dr_line_total_price : total,
                    dr_non_tax_amount: net_vat,
                    dr_tax_amount:vat_input
                }));


                reInitializeNumeric();
                reComputeTotal();


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

        $('#tbl_delivery_invoice tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
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
                var d=row.data();

                $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"Templates/layout/dr/"+ d.dr_invoice_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response,'no-padding' ).show();
                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                });
            }
        } );


        $('#tbl_po_list tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt_po.row( tr );
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
                var d=dt_po.row(_selectRowObj).data();

                $.ajax({
                    "dataType":"html",
                    "type":"POST",
                    "url":"Templates/layout/po/"+ d.purchase_order_id+'/contentview',
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

        _cboDepartments.on("select2:select", function (e) {

            var i=$(this).select2('val');

            if(i==0){ //new supplier
                _cboDepartments.select2('val',null)
                $('#modal_new_department').modal('show');
                //clearFields($('#modal_new_supplier').find('form'));
            }else{
                var obj_department=$('#cbo_departments').find('option[value="'+i+'"]');
                _defCostType=obj_department.data('default-cost');
                // _cboTaxType.select2('val',obj_supplier.data('tax-type')); //set tax type base on selected Supplier
            }


        });

        _cboSuppliers.on("select2:select", function (e) {

            var i=$(this).select2('val');

            if(i==0){ //new supplier
                _cboSuppliers.select2('val',null)
                $('#modal_new_supplier').modal('show');
                //clearFields($('#modal_new_supplier').find('form'));
            }else{
                // var obj_supplier=$('#cbo_suppliers').find('option[value="'+i+'"]');
                // _cboTaxType.select2('val',obj_supplier.data('tax-type')); //set tax type base on selected Supplier
                // $('input[name="contact_person"]').text(obj_supplier.data('contact-person'));
                _cboTaxType.select2('val',$(this).find('option:selected').data('tax-type'));
                $('input[name="contact_person"]').val($(this).find('option:selected').data('contact-person'));
            }

        });


        $('#tbl_delivery_invoice tbody').on('click','#btn_email',function(){
            _selectRowObj=$(this).parents('tr').prev();
            var d=dt.row(_selectRowObj).data();

            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Email/send/po/"+ d.dr_invoice_id,
                "data": {email:$(this).data('supplier-email')}
            }).done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).data(response.row_updated[0]).draw();
            });
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            //$('.toggle-fullscreen').click();
            $('#span_invoice_no').html('INV-XXXX');
            clearFields($('#frm_deliveries'));
            $('#cbo_departments').select2('val', null);
            $('#cbo_suppliers').select2('val', null);
            $('#img_user').attr('src','assets/img/anonymous-icon.png');
            $('#td_discount').html('0.00');
            $('#td_before_tax').html('0.00');
            $('#td_tax').html('0.00');
            $('#td_after_tax').html('0.00');
            $('#tbl_items tbody').html('');
            $('#order_default').datepicker('setDate', 'today');
            $('#due_default').datepicker('setDate', 'today');
            showList(false);
        });

        $('#btn_receive_po').click(function(){
            $('#tbl_po_list tbody').html('<tr><td colspan="7"><center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center></td></tr>');
            dt_po.ajax.reload( null, false );
            $('#modal_po_list').modal('show');
        });


        $('#btn_remove_photo').click(function(event){
            event.preventDefault();
            $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
        });



        $('#tbl_po_list > tbody').on('click','button[name="accept_po"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt_po.row(_selectRowObj).data();

            $('textarea[name="remarks"]').val(data.remarks);
            $('#cbo_suppliers').select2('val',data.supplier_id);
            $('#cbo_departments').select2('val',data.department_id);


            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                        _elem.val(value);
                    }
                });
            });


            $('#modal_po_list').modal('hide');
            resetSummary();


            // var exp_date = <?php echo json_encode(date("m/d/Y")); ?>;

            $.ajax({
                url : 'Purchases/transaction/item-balance/'+data.purchase_order_id,
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

                    var total_discount=0;
                    var total_tax_amount=0;
                    var total_non_tax_amount=0;
                    var gross_amount=0;

                    $.each(rows,function(i,value){

                        var _deductionVat = 0, _newTaxAmount = 0;

                        _deductionVat = (value.po_price / (1 + ((value.po_tax_rate)/100)));
                        _newTaxAmount = (value.po_price - _deductionVat) * value.po_qty;

                        $('#tbl_items > tbody').append(newRowItem({
                            dr_qty : value.po_qty,
                            product_code : value.product_code,
                            unit_id : value.unit_id,
                            unit_name : value.unit_name,
                            product_id: value.product_id,
                            product_desc : value.product_desc,
                            dr_line_total_discount : value.po_line_total_discount,
                            tax_exempt : false,
                            dr_tax_rate : value.po_tax_rate,
                            dr_price : value.po_price,
                            dr_discount : value.po_discount,
                            tax_type_id : null,
                            dr_line_total_price : value.po_line_total,
                            dr_non_tax_amount: value.non_tax_amount,
                            dr_tax_amount: _newTaxAmount,
                            // exp_date: exp_date,
                            batch_no:""
                        }));

                        //sum up all footer details
                        // total_discount+=getFloat(value.po_line_total_discount);
                        // total_tax_amount+=getFloat(value.tax_amount);
                        // total_non_tax_amount+=getFloat(value.non_tax_amount);
                        // gross_amount+=getFloat(value.po_line_total);

                    });
                    reInitializeNumeric();
                    reComputeTotal();
                    $('#txt_overall_discount').val(accounting.formatNumber($('#txt_overall_discount').val(),2));
                }

            });
        });


        $('#btn_create_user_suppliers').click(function(){

            var btn=$(this);

            if(validateRequiredFields($('#frm_supplier_new'))){
                var data=$('#frm_supplier_new').serializeArray();

                $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Suppliers/transaction/create",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress(btn);
                    }
                }).done(function(response){
                    showNotification(response);
                    $('#modal_new_supplier').modal('hide');

                    var _suppliers=response.row_added[0];
                    $('#cbo_suppliers').append('<option value="'+_suppliers.supplier_id+'" data-tax-type="'+_suppliers.tax_type_id+'" selected>'+_suppliers.supplier_name+'</option>');
                    $('#cbo_suppliers').select2('val',_suppliers.supplier_id);
                    $('#cbo_tax_type').select2('val',_suppliers.tax_type_id);

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });

        $('#btn_create_new_department').click(function(){

            var btn=$(this);

            if(validateRequiredFields($('#frm_department'))){
                var data=$('#frm_department').serializeArray();
                /*_data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});*/
                createDepartment().done(function(response){
                    showNotification(response);
                    $('#modal_new_department').modal('hide');

                    var _department=response.row_added[0];
                    $('#cbo_departments').append('<option value="'+_department.department_id+'" data-tax-type="'+_department.department_id+'" selected>'+_department.department_name+'</option>');
                    $('#cbo_departments').select2('val', _department.department_id);
                    $('#cbo_tax_type').select2('val',_department.tax_type_id);

                    clearFields($('#modal_new_department'));

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });

        $('#btn_create_new_supplier').click(function(){

            var btn=$(this);

            if(validateRequiredFields($('#frm_suppliers_new'))){
                var data=$('#frm_suppliers_new').serializeArray();
                /*_data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});*/
                createSupplier().done(function(response){
                    showNotification(response);
                    $('#modal_new_supplier').modal('hide');

                    var _suppliers=response.row_added[0];
                    $('#cbo_suppliers').append('<option value="'+_suppliers.supplier_id+'" data-tax-type="'+_suppliers.tax_type_id+'" selected>'+_suppliers.supplier_name+'</option>');
                    $('#cbo_suppliers').select2('val',_suppliers.supplier_id);
                    $('#cbo_tax_type').select2('val',_suppliers.tax_type_id);

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }
        });


        $('#tbl_delivery_invoice tbody').on('click','button[name="edit_info"]',function(){
           
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.dr_invoice_id;
            _count=data.count;
            _is_journal_posted=data.is_journal_posted;

            if(_is_journal_posted > 0){
                showNotification({title:"Error!",stat:"error",msg:"Cannot Edit: Invoice is already Posted in Purchase Journal."});
            }
            else if (_count > 0){
                showNotification({title:"Error!",stat:"error",msg:"Cannot Edit: Invoice is already in use in Record Payment."});
            }
            else
            {
               _txnMode="edit";
                _selectRowObj=$(this).closest('tr');
                var data=dt.row(_selectRowObj).data();
                _selectedID=data.dr_invoice_id;

                $('#span_invoice_no').html(data.dr_invoice_no);

                $('textarea[name="remarks"]').val(data.remarks);
                $('#cbo_suppliers').select2('val',data.supplier_id);
                $('#cbo_departments').select2('val',data.department_id);

                $('input,textarea').each(function(){
                    var _elem=$(this);
                    $.each(data,function(name,value){
                        if(_elem.attr('name')==name&&_elem.attr('type')!='password'){
                            _elem.val(value);
                        }
                    });
                });


                resetSummary();

                $.ajax({
                    url : 'Deliveries/transaction/items/'+data.dr_invoice_id,
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

                        var total_discount=0;
                        var total_tax_amount=0;
                        var total_non_tax_amount=0;
                        var gross_amount=0;

                        $.each(rows,function(i,value){
                            $('#tbl_items > tbody').append(newRowItem({
                                dr_qty : value.dr_qty,
                                product_code : value.product_code,
                                unit_id : value.unit_id,
                                unit_name : value.unit_name,
                                batch_no : value.batch_no,
                                product_id: value.product_id,
                                product_desc : value.product_desc,
                                dr_line_total_discount : value.dr_line_total_discount,
                                tax_exempt : false,
                                dr_tax_rate : value.dr_tax_rate,
                                dr_price : value.dr_price,
                                dr_discount : value.dr_discount,
                                tax_type_id : null,
                                dr_line_total_price : value.dr_line_total_price,
                                dr_non_tax_amount: value.dr_non_tax_amount,
                                dr_tax_amount:value.dr_tax_amount,
                                exp_date : value.expiration,
                                batch_no : value.batch_no
                            }));

                            reComputeTotal();
                            //sum up all footer details
                            /*total_discount+=getFloat(value.dr_line_total_discount);
                            total_tax_amount+=getFloat(value.tax_amount);
                            total_non_tax_amount+=getFloat(value.non_tax_amount);
                            gross_amount+=getFloat(value.dr_line_total_price);*/


                        });

                        reInitializeNumeric();
                        reInitializeExpireDate();
                        //write summary details
                        /*var tbl_summary=$('#tbl_delivery_summary');
                        tbl_summary.find(oTableDetails.discount).html(accounting.formatNumber(total_discount,4));
                        tbl_summary.find(oTableDetails.before_tax).html(accounting.formatNumber(total_non_tax_amount,4));
                        tbl_summary.find(oTableDetails.tax_amount).html(accounting.formatNumber(total_tax_amount,4));
                        tbl_summary.find(oTableDetails.after_tax).html('<b>'+accounting.formatNumber(gross_amount,4)+'</b>');*/

                        reComputeTotal();

                    }


                });
                showList(false);
            }
        });

        $('#tbl_delivery_invoice tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.dr_invoice_id;
            _count=data.count;
            _is_journal_posted=data.is_journal_posted;

            if(_is_journal_posted > 0){
                showNotification({title:"Error!",stat:"error",msg:"Cannot Delete: Invoice is already Posted in Purchase Journal."});
            }
            else if (_count > 0){
                showNotification({title:"Error!",stat:"error",msg:"Cannot Delete: Invoice is already in use in Record Payment."});
            }
            else
            {


            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.dr_invoice_id;           
            _count=data.count;
            if(_count > 0){
                showNotification({title:"Error!",stat:"error",msg:"Cannot Delete: Invoice is already in use in Record Payment."});
            } else { 
                $('#modal_confirmation').modal('show');
            }

        }
        });


        $('#tbl_items tbody').on('keyup','input.numeric',function(){
            var row=$(this).closest('tr');
            var price=parseFloat(accounting.unformat(row.find(oTableItems.unit_price).find('input.numeric').val()));
            var discount=parseFloat(accounting.unformat(row.find(oTableItems.discount).find('input.numeric').val()));
            var qty=parseFloat(accounting.unformat(row.find(oTableItems.qty).find('input.numeric').val()));
            var tax_rate=parseFloat(accounting.unformat(row.find(oTableItems.tax).find('input.numeric').val()))/100;

            // if(discount>price){
            //     showNotification({title:"Invalid",stat:"error",msg:"Discount must not greater than unit price."});
            //     row.find(oTableItems.discount).find('input.numeric').val('');`
            // }

            var discounted_price=price-discount;
            var line_total_discount=discount*qty;
            var line_total=price*qty;
            var new_discount_price=line_total*(discount/100);
            var new_line_total=line_total-new_discount_price;
            var net_vat=line_total/(1+tax_rate);
            var vat_input=line_total-net_vat;

            $(oTableItems.total,row).find('input.numeric').val(accounting.formatNumber(new_line_total,2)); // line total amount
            $(oTableItems.total_line_discount,row).find('input.numeric').val(accounting.formatNumber(line_total_discount,2)); //line total discount
            $(oTableItems.net_vat,row).find('input.numeric').val(accounting.formatNumber(net_vat,2)); //net of vat
            $(oTableItems.vat_input,row).find('input.numeric').val(accounting.formatNumber(vat_input,2)); //vat input

            //console.log(net_vat);
            reComputeTotal();
        });

        $('#btn_yes').click(function(){
            removePurchaseInvoice().done(function(response){
                showNotification(response);
                dt.row(_selectRowObj).remove().draw();            
            });
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
            showList(true);
        });

        $('#btn_close_new_department').click(function() {
            $('#modal_new_department').modal('hide');
        });

        $('#btn_close_new_supplier').click(function() {
            $('#modal_new_supplier').modal('hide');        });

        $('#btn_save').click(function(){
            //alert('save');
            if(validateRequiredFields($('#frm_deliveries'))){
                if(_txnMode=="new"){
                    createDeliverInvoice().done(function(response){
                        showNotification(response);
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_deliveries'));
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }else{
                    updatePurchaseOrder().done(function(response){
                        showNotification(response);
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                        clearFields($('#frm_deliveries'));
                        showList(true);
                    }).always(function(){
                        showSpinningProgress($('#btn_save'));
                    });
                }

            }

        });

        $('#link_browse_po').click(function(){
            $('#btn_receive_po').click();
        });

        $('#tbl_items > tbody').on('click','button[name="remove_item"]',function(){
            $(this).closest('tr').remove();
            reComputeTotal();
        });

        $('#btn_browse').click(function(event){
            event.preventDefault();
            $('input[name="file_upload[]"]').click();
        });

        $('#btn_remove_photo').click(function(event){
            event.preventDefault();
            $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
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
                url : 'Suppliers/transaction/upload',
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


    })();


    var validateRequiredFields=function(f){
        var stat=true;

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

    var createDepartment=function(){
        var _data=$('#frm_department').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Departments/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_create_new_department'))
        });
    };

    var createSupplier=function() {
        var _data=$('#frm_suppliers_new').serializeArray();
        _data.push({name : "photo_path" ,value : $('img[name="img_user"]').attr('src')});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Suppliers/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_create_new_supplier'))
        });
    };

    var createDeliverInvoice=function(){
        var _data=$('#frm_deliveries,#frm_items').serializeArray();

        var tbl_summary=$('#tbl_delivery_summary');
        _data.push({name : "total_after_discount", value: $('#td_total_after_discount').text() });
        _data.push({name : "remarks", value : $('textarea[name="remarks"]').val()});
        _data.push({name : "summary_discount", value : tbl_summary.find(oTableDetails.discount).text()});
        _data.push({name : "summary_before_discount", value :tbl_summary.find(oTableDetails.before_tax).text()});
        _data.push({name : "summary_tax_amount", value : tbl_summary.find(oTableDetails.tax_amount).text()});
        _data.push({name : "summary_after_tax", value : tbl_summary.find(oTableDetails.after_tax).text()});
        console.log(_data);
        return $.ajax({ 
            "dataType":"json",
            "type":"POST",
            "url":"Deliveries/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var updatePurchaseOrder=function(){
        var _data=$('#frm_deliveries,#frm_items').serializeArray();

        var tbl_summary=$('#tbl_delivery_summary');

        _data.push({name : "remarks", value : $('textarea[name="remarks"]').val()});
        _data.push({name : "summary_discount", value : tbl_summary.find(oTableDetails.discount).text()});
        _data.push({name : "summary_before_discount", value :tbl_summary.find(oTableDetails.before_tax).text()});
        _data.push({name : "summary_tax_amount", value : tbl_summary.find(oTableDetails.tax_amount).text()});
        _data.push({name : "summary_after_tax", value : tbl_summary.find(oTableDetails.after_tax).text()});
        _data.push({name : "dr_invoice_id" ,value : _selectedID});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Deliveries/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removePurchaseInvoice=function(){

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Deliveries/transaction/delete",
            "data":{dr_invoice_id : _selectedID}
        });
    };

    var showList=function(b){
        if(b){
            $('#div_delivery_list').show();
            $('#div_delivery_fields').hide();
        }else{
            $('#div_delivery_list').hide();
            $('#div_delivery_fields').show();
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
        $(e).toggleClass('disabled');
    };

    var clearFields=function(f){
        $('input,textarea,select,input:not(.date-picker)',f).val('');
        $('input,textarea',f).val('');
        $('#remarks').val('');
        $('#txt_overall_discount').val('0.00');
        $(f).find('input:first').focus();
        //$('#tbl_items > tbody').html('');
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
        '<td width="6%"><input name="dr_qty[]" type="text" class="numeric form-control" value="'+ d.dr_qty +'"></td>'+
        '<td width="5%" style="display:none;">'+ d.unit_name+'</td>'+
        '<td width="10%">'+d.product_desc+'</td>'+
        '<td width="6%"><input name="dr_price[]" type="text" class="numeric form-control" value="'+accounting.formatNumber(d.dr_price,2)+'" style="text-align:right;"></td>'+
        '<td width="6%"><input name="dr_discount[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.dr_discount,2)+'" style="text-align:right;"></td>'+
        '<td width="6%" style="display: none;"><input name="dr_line_total_discount[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.dr_line_total_discount,2)+'" readonly></td>'+
        '<td width="6%" style="display: none;"><input name="dr_tax_rate[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.dr_tax_rate,2)+'"></td>'+
        '<td colspan="3" width="6%" align="right"><input name="dr_line_total_price[]" type="text" class="numeric form-control" value="'+ accounting.formatNumber(d.dr_line_total_price,2)+'" readonly></td>'+
        '<td width="6%" style="display: none;"><input name="dr_tax_amount[]" type="text" class="numeric form-control" value="'+ d.dr_tax_amount+'" readonly></td>'+
        '<td width="6%" style="display: none;"><input name="dr_non_tax_amount[]" type="text" class="numeric form-control" value="'+ d.dr_non_tax_amount+'" readonly></td>'+
        '<td  style="display:none;" width="6%"><input name="product_id[]" type="text" class="numeric form-control" value="'+ d.product_id+'" readonly></td>'+
        '<td width="6%" align="center"><button type="button" name="remove_item" class="btn btn-red"><i class="fa fa-trash"></i></button></td>'+
        '</tr>';
    };

    $('#txt_overall_discount').on('change',function(){
        reComputeTotal();
    });

    var reComputeTotal=function(){
        var rows=$('#tbl_items > tbody tr');

        var discounts=0; var before_tax=0; var after_tax=0; var tax_amount=0; var after_discount=0;

        $.each(rows,function(){
            discounts+=parseFloat(accounting.unformat($(oTableItems.total_line_discount,$(this)).find('input.numeric').val()));
            before_tax+=parseFloat(accounting.unformat($(oTableItems.net_vat,$(this)).find('input.numeric').val()));
            tax_amount+=parseFloat(accounting.unformat($(oTableItems.vat_input,$(this)).find('input.numeric').val()));
            after_tax+=parseFloat(accounting.unformat($(oTableItems.total,$(this)).find('input.numeric').val()));
        });
        
        var tbl_summary=$('#tbl_delivery_summary');
        tbl_summary.find(oTableDetails.discount).html(accounting.formatNumber(discounts,2));
        tbl_summary.find(oTableDetails.before_tax).html(accounting.formatNumber(before_tax,2));
        tbl_summary.find(oTableDetails.tax_amount).html(accounting.formatNumber(tax_amount,2));
        tbl_summary.find(oTableDetails.after_tax).html('<b>'+accounting.formatNumber(after_tax,2)+'</b>');
        tbl_summary.find(oTableDetails.total_line_discount).html('<b>'+accounting.formatNumber(after_discount,2)+'</b>');

        $('#td_before_tax').html(accounting.formatNumber(before_tax,2));
        $('#td_after_tax').html('<b>'+accounting.formatNumber(after_tax,2)+'</b>');
        $('#td_discount').html(accounting.formatNumber(discounts,2));
        $('#td_tax').html(accounting.formatNumber(tax_amount,2));
        $('#td_total_after_discount').html(accounting.formatNumber(after_tax - (after_tax * ($('#txt_overall_discount').val() / 100)),2));
    };



    var reInitializeNumeric=function(){
        $('.numeric').autoNumeric('init',{mDec: 2});
    };



    var resetSummary=function(){
        var tbl_summary=$('#tbl_delivery_summary');
        tbl_summary.find(oTableDetails.discount).html('0.00');
        tbl_summary.find(oTableDetails.before_tax).html('0.00');
        tbl_summary.find(oTableDetails.tax_amount).html('0.00');
        tbl_summary.find(oTableDetails.after_tax).html('<b>0.00</b>');
    };




});




</script>


</body>


</html>