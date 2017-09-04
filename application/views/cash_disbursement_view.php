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
        .alert {
            border-width: 0;
            border-style: solid;
            padding: 24px;
            margin-bottom: 32px;
        }
        .alert-danger, .alert-danger h1, .alert-danger h2, .alert-danger h3, .alert-danger h4, .alert-danger h5, .alert-danger h6, .alert-danger small {
            color: white;
        }

        .alert-danger {
            color: #dd191d;
            background-color: #f9bdbb;
            border-color: #e84e40;
        }


        .toolbar{
            float: left;
        }

        body {
            overflow-x: hidden;
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
            z-index: 999999999;
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

        .boldlabel {
            font-weight: bold;
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

        .select2-container {
            width: 100% !important;
        }


        input[type=checkbox] {
          /* Double-sized Checkboxes */
          margin-top: 10px;
          margin-left: 10px;
          -ms-transform: scale(1.5); /* IE */
          -moz-transform: scale(1.5); /* FF */
          -webkit-transform: scale(1.5); /* Safari and Chrome */
          -o-transform: scale(1.5); /* Opera */
        }

        #tbl_check_list td:nth-child(6),#tbl_check_list th:nth-child(6){
            text-align: center;
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
    <li><a href="Cash_disbursement">Disbursement</a></li>
</ol>

<div class="container-fluid">
<div data-widget-group="group1">
<div class="row">
<div class="col-md-12">

<div id="div_payable_list">

    <div class="panel-group panel-default" id="accordionA">


        <div class="panel panel-default">
            <div class="panel-body panel-responsive" >
            <a data-toggle="collapse" data-parent="#accordionA" href="#collapseTwo" style="text-decoration: none;">
<!--             <div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;"><b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i> Review Expense (Pending)</b></div> -->
            <h2 class="h2-panel-heading"> Review Expense (Pending)</h2><hr>
            </a>

            <div id="collapseTwo" class="collapse in">

                    <div style="padding: 1%;border-radius: 5px;padding-bottom: 2%;">
                        <table id="tbl_expense_for_review" class="table table-striped" cellspacing="0" width="100%">
                            <thead class="">
                            <tr>
                                <th></th>
                                <th>Receipt #</th>
                                <th>Supplier</th>
                                <th>Remarks</th>
                                <th>Payment</th>
                                <th>Notice</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
        </div>

<br>

        <div class="panel panel-default" style="border-radius:6px;">
            <div class="panel-body panel-responsive">
              <a data-toggle="collapse" data-parent="#accordionA" href="#collapseOne" style="text-decoration: none;">
<!--               <div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;"><b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i> Cash Disbursement Journal</b></div> -->
            <h2 class="h2-panel-heading">Cash Disbursement Journal</h2><hr>

              </a>
                <div id="collapseOne" class="collapse in">
                        <div >
                            <table id="tbl_cash_disbursement_list" class="table-striped table" cellspacing="0" width="100%">
                                <thead class="">
                                <tr>
                                    <th></th>
                                    <th>Txn #</th>
                                    <th>Voucher #</th>
                                    <th>Particular</th>
                                    <th>Method</th>
                                    <th>Txn Date</th>
                                    <th>Posted</th>
                                    <th>Status</th>
                                    <th><center>Action</center></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>                </div>
                </div>
        </div>

        <div class="panel panel-default" style="border-radius:6px;">

                    <div class="panel-body panel-responsive" style="min-height: 400px;">
            <a data-toggle="collapse" data-parent="#accordionA" href="#collapseOne" style="text-decoration: none;">
<!--             <div class="panel-heading" style="background: #2ecc71;border-bottom: 1px solid lightgrey;"><b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i> Check Summary</b></div> -->
    <h2 class="h2-panel-heading"> Check Summary</h2>
            </a>
                <div id="collapseOne" class="collapse in">
                        <div >
                            <table id="tbl_check_list" class="table table-striped" cellspacing="0" width="100%">
                                <thead style="display:none;background-color:#161616!important;">
                                <tr>
                                    <th>Bank</th>
                                    <th>Check #</th>
                                    <th>Amount</th>
                                    <th>Check Date</th>
                                    <th>Voucher #</th>
                                    <th>Particular</th>
                                    <th>Remarks</th>
                                    <th>Issued</th>
                                    <th><center>Action</center></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>

    </div>


</div>

<div id="div_payable_fields" style="display: none;">
<div class="row">
<div class="col-lg-12">

    <div class="panel panel-default" style="margin: 1%;">
    <div class="panel-body panel-responsive">
    <h2 class="h2-panel-heading"> Cash Disbursement Journal</h2>
     <!--    <b><i class="fa fa-bars"></i> Cash Disbursement Journal</b><hr /> -->
        <button id="btn_browse_recurring" class="btn btn-primary" style="margin-bottom: 15px; text-transform: capitalize;"><i class="fa fa-folder-open-o"></i> Browse Recurring Template</button>
        <form id="frm_journal" role="form" class="form-horizontal">

            <div>

                <div class="row">
                    <div class="col-lg-3">
                       <b class="required"> * </b> <label>Txn #  :</label><br />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-code"></i>
                            </span>
                            <input type="text" name="txn_no" class="form-control" placeholder="TXN-YYYYMMDD-XXX" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                       <b class="required"> * </b> <label>Date  :</label><br />
                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                            <input type="text" name="date_txn" class="date-picker form-control" data-error-msg="Date is required." required>
                        </div>
                    </div>


                    <div class="col-lg-4 col-lg-offset-2">
                        <b class="required"> * </b> <label>Method of Payment  :</label><br />
                        <select id="cbo_pay_type" name="payment_method" class="form-control" data-error-msg="Payment method is required." required>
                            <?php foreach($payment_methods as $payment_method){ ?>
                                <option value='<?php echo $payment_method->payment_method_id; ?>'><?php echo $payment_method->payment_method; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <b class="required"> * </b> <label>Reference type :</label><br />
                        <select id="cbo_refType" class="form-control" name="ref_type" data-error-msg="Reference type is required." required>
                            <option value="CV" selected>CV</option>
                            <option value="JV">JV</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <b class="required"> * </b> <label>Reference # :</label><br />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-code"></i>
                            </span>
                            <input type="text" name="ref_no" maxlength="15" class="form-control"  data-error-msg="Reference # is required." required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2">
                        <label>Bank :</label><br />
                        <select id="cbo_bank" class="form-control" name="bank_id">
                            <option value="create_bank">[Create New Bank]</option>
                            <?php foreach($bank_refs as $bank) { ?>
                                <option value="<?php echo $bank->bank_id; ?>"><?php echo $bank->bank_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <b class="required"> * </b> <label>Supplier  :</label><br />
                        <select id="cbo_suppliers" name="supplier_id" class="selectpicker show-tick form-control" data-live-search="true" data-error-msg="Supplier name is required." required>
                            <option value="0">[ Create New Supplier ]</option>
                            <?php foreach($suppliers as $supplier){ ?>
                                <option value='<?php echo $supplier->supplier_id; ?>'><?php echo $supplier->supplier_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-2 col-lg-offset-2">
                        <label>Check Date :</label><br />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" name="check_date" id="check_date" class="date-picker form-control" data-error-msg="Check date is required!" >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <label>Check # :</label><br />
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-list-alt"></i>
                            </span>
                            <input type="text" name="check_no" id="check_no" maxlength="15" class="form-control" data-error-msg="Check number is required!">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                       <b class="required"> * </b> <label>Department  :</label><br />
                        <select id="cbo_branch" name="department_id" class="selectpicker show-tick form-control" data-live-search="true" data-error-msg="Department is required." required>
                            <option value="0">[ Create New Department ]</option>
                            <?php foreach($departments as $department){ ?>
                                <option value='<?php echo $department->department_id; ?>'><?php echo $department->department_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-4 col-lg-offset-2">
                      <b class="required"> * </b>  <label>Amount  :</label><br />
                        <input class="form-control text-center numeric" id="cash_amount" type="text" maxlength="12" value="0.00" name="amount" required data-error-msg="Amount is Required!">
                    </div>
                </div>


            </div>

            <hr />

            <div>
                <span><strong><i class="fa fa-bars"></i> Journal Entries</strong></span>
                <hr />

                <div style="width: 100%;">
                    <table id="tbl_entries" class="table-striped table">
                        <thead class="">
                        <tr>
                            <th style="width: 30%;">Account</th>
                            <th style="width: 30%;">Memo</th>
                            <th style="width: 15%;text-align: right;">Dr</th>
                            <th style="width: 15%;text-align: right;">Cr</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>

                                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" >
                                    <?php $i=0; foreach($accounts as $account){ ?>
                                        <option value='<?php echo $account->account_id; ?>' <?php echo ($i==0?'':''); ?>><?php echo $account->account_title; ?></option>
                                        <?php $i++; } ?>
                                </select>
                            </td>
                            <td><input type="text" name="memo[]" class="form-control"></td>
                            <td><input type="text" name="dr_amount[]" class="form-control numeric"></td>
                            <td><input type="text" name="cr_amount[]" class="form-control numeric"></td>
                            <td>
                                <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true">
                                    <?php $i=0; foreach($accounts as $account){ ?>
                                        <option value='<?php echo $account->account_id; ?>' <?php echo ($i==0?'':''); ?> > <?php echo $account->account_title; ?> </option>
                                        <?php $i++; } ?>
                                </select>
                            </td>
                            <td><input type="text" name="memo[]" class="form-control"></td>
                            <td><input type="text" name="dr_amount[]" class="form-control numeric"></td>
                            <td><input type="text" name="cr_amount[]" class="form-control numeric"></td>
                            <td>
                                <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
                            </td>
                        </tr>

                        </tbody>

                        <tfoot>
                        <tr>
                            <td colspan="2" align="right"><strong>Total</strong></td>
                            <td align="right"><strong>0.00</strong></td>
                            <td align="right"><strong>0.00</strong></td>
                            <td></td>
                        </tr>
                        </tfoot>


                    </table>



                </div>



            </div>



            <br />
            <div class="row">
                <div class="col-lg-12">
                    <label>Remarks :</label><br />
                    <textarea name="remarks" class="form-control"></textarea>
                </div>
            </div>
            <br /><br />


        </form>
        <div id="div_check">
            <input type="checkbox" name="chk_save">&nbsp;&nbsp;<label for="chk_save"><strong>Save as Template</strong></label>
        </div>
        <div id="div_no_check">
            <br>
            <br>
        </div>

        <br />
        <div class="row">
            <div class="col-sm-12">
                <button id="btn_save" class="btn-primary btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span>  Save Changes</button>
                <button id="btn_cancel" class="btn-default btn" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"">Cancel</button>
            </div>
        </div>
    </div>
    </div>
    <table id="table_hidden" class="hidden">
        <tr>
            <td width="30%">
                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" >
                    <?php $i=0; foreach($accounts as $account){ ?>
                        <option value='<?php echo $account->account_id; ?>' <?php echo ($i==0?'':''); ?>><?php echo $account->account_title; ?></option>
                        <?php $i++; } ?>
                </select>
            </td>
            <td><input type="text" name="memo[]" class="form-control"></td>
            <td><input type="text" name="dr_amount[]" class="form-control numeric"></td>
            <td><input type="text" name="cr_amount[]" class="form-control numeric"></td>
            <td>
                <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
            </td>
        </tr>
    </table>


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


<div id="modal_recurring" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: white;"><i class="fa fa-folder-open-o"></i>  Browse Recurring Templates</h4>
            </div>
            <div class="modal-body">
                <table id="tbl_recurring" class="table table-striped" width="100%">
                    <thead>
                        <th>Template Code</th>
                        <th>Template Description</th>
                        <th>Payee / Particular</th>
                        <th><center>Action</center></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="btn_cancel_browsing" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-sm">
        <div class="modal-content"><!---content--->
            <div class="modal-header ">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Confirm Cancellation</h4>

            </div>

            <div class="modal-body">
                <p id="modal-body-message">Are you sure you want to cancel this journal?</p>
            </div>

            <div class="modal-footer">
                <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">No</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->

<div id="modal_print_check_list_option" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>Print Options - Check List</h4>
            </div>

            <div class="modal-body">
                <b> * </b> Filter by Bank  :<br />
                <select id="cbo_banks" class="form-control">
                    <option value="0">All Banks</option>
                    <?php foreach($bank_refs as $bank){ ?>
                        <option value='<?php echo $bank->bank_id; ?>'><?php echo $bank->bank_name; ?></option>
                    <?php } ?>
                </select>

                <b> * </b> Period Start :<br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" id="txt_start" class="date-picker form-control" value="<?php echo date('m/d/Y'); ?>">
                </div>

                <b> * </b> Period End :<br />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" id="txt_end" class="date-picker form-control" value="<?php echo date('m/d/Y'); ?>">
                </div>

            </div>

            <div class="modal-footer">
                <button id="btn_print_list" type="button" class="btn btn-primary" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"> <i class="fa fa-print"></i> Print List </button>
                <button id="" type="button" class="btn btn-danger" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>
        </div><!---content---->
    </div>
</div><!---modal-->




<div id="modal_new_department" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color: white;"><span id="modal_mode"> </span>New Department</h4>

            </div>

            <div class="modal-body" style="padding: 2%;">
                <form id="frm_department_new">

                    <div class="form-group">
                        <label><b> * </b> Department :</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </span>
                            <input type="text" name="department_name" class="form-control" placeholder="Department" data-error-msg="Department name is required." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Department Description :</label>
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
                                <div class="col-md-8" style="padding: 0; margin-top: 5px;">
                                    <select name="tax_type_id" id="cbo_tax_group" class="form-control" data-error-msg="Tax type is required!" required>
                                        <?php foreach($tax_types as $tax_type){ ?>
                                            <option value="<?php echo $tax_type->tax_type_id; ?>" data-tax-rate="<?php echo $tax_type->tax_rate; ?>"><?php echo $tax_type->tax_type; ?></option>
                                        <?php } ?>
                                    </select>
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
                <button id="btn_create_new_supplier" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Create</button>
                <button id="btn_close_new_supplier" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>
        </div><!---content-->
    </div>
</div><!---modal-->

<div id="modal_check_layout" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2ecc71;">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title" style="color:#ecf0f1 !important;"><span id="modal_mode"> </span>Select Check Layout</h4>

            </div>

            <div class="modal-body" style="padding-right: 20px;">

                <div class="row">
                        <div class="container-fluid">
                            <div class="col-xs-12">
                                <select name="check_layout" class="form-control" id="cbo_layouts">
                                    <?php foreach($layouts as $layout){ ?>
                                        <option value="<?php echo $layout->check_layout_id; ?>"><?php echo $layout->check_layout; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                </div>


            </div>

            <div class="modal-footer">
                <button id="btn_preview_check" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Preview Check</button>
                <button id="btn_close_check" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>
        </div><!---content-->
    </div>
</div><!---modal-->




<div id="modal_bank" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="bank_title" class="modal-title" style="color: white;">New Bank</h4>
            </div>
            <div class="modal-body">
                <form id="frm_bank" role="form" class="form-horizontal row-border">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><strong><b> * </b> Bank Code :</strong></label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-code"></i>
                                </span>
                                <input type="text" name="bank_code" class="form-control" placeholder="Bank Code" data-error-msg="Bank Code is required!" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><strong><b> * </b> Bank :</strong></label>
                        <div class="col-md-8">
                            <div class="input-group col-md-12">
                                <input type="text" name="bank_name" class="form-control" placeholder="Bank" data-error-msg="Bank is required!" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><strong><b> * </b> Account Number :</strong></label>
                        <div class="col-md-8">
                            <div class="input-group col-md-12">
                                <input type="text" name="account_number" class="form-control" placeholder="Account Number" data-error-msg="Account Number is required!" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><strong><b> * </b> Account Type :</strong></label>
                        <div class="col-md-8">
                            <select name="account_type" class="form-control" id="cbo_account_type" data-error-msg="Account Type is required!" placeholder="Account Type" required>
                                <option value="" disabled selected>Select Account Type</option>
                                <option value="1">Current Account</option>
                                <option value="2">Savings Account</option>
                            </select>
                        </div>
                    </div><br/>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_save_bank" class="btn btn-primary">Save</button>
                <button id="btn_cancel_bank" class="btn btn-default">Cancel</button>
            </div>
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
    var _txnMode; var _cboSuppliers; var _cboMethods; var _selectRowObj; var _selectedID; var _txnMode, _cboBranches, _cboPaymentMethod, _cboBanks, _cboAccountType;
    var dtReview; var cbo_refType; var _cboLayouts; var dtRecurring; var dtCheckList; var _attribute; var _cboTax;


    var oTBJournal={
        "dr" : "td:eq(2)",
        "cr" : "td:eq(3)"
    };

    var oTFSummary={
        "dr" : "td:eq(1)",
        "cr" : "td:eq(2)"
    };

    var initializeRecurringTable=function(){
        dtRecurring=$('#tbl_recurring').DataTable({
            "bLengthChange": false,
            "bPaginate":true, 
            language: { 
                "searchPlaceholder": "Search Template" 
            },
            "ajax" : {
                "url":"Recurring_template/transaction/list-template?type=CDJ",
                "bDestroy": true
            },
            "columns": [
                { targets:[0],data: "template_code" },
                { targets:[1],data: "template_description" },
                { targets:[2],data: "particular" },
                {
                    targets:[3],
                    render: function (data, type, full, meta){
                        var btn_recurring='<button class="btn btn-success" name="accept_rt"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Accept Recurring"><i class="fa fa-check"></i></button>';

                        return '<center>'+btn_recurring+'</center>';
                    }
                }
            ]
        });
    };

    var initializeControls=function(){
        initializeRecurringTable();

        dt=$('#tbl_cash_disbursement_list').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Cash_disbursement/transaction/list",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "txn_no" },
                { targets:[2],data: "ref_no" },
                { targets:[3],data: "particular" },
                { targets:[4],data: "payment_method" },
                { targets:[5],data: "date_txn" },
                { targets:[6],data: "posted_by" },
                {
                    targets:[7],data: null,
                    render: function (data, type, full, meta){
                        var _attribute='';
                        //console.log(data.is_email_sent);
                        if(data.is_active=="1"){
                            _attribute=' class="fa fa-check-circle" style="color:green;" ';
                        }else{
                            _attribute=' class="fa fa-times-circle" style="color:red;" ';
                        }

                        return '<center><i '+_attribute+'></i></center>';
                    }

                },
                {
                    targets:[7],
                    render: function (data, type, full, meta){
                        var btn_edit='<button class="btn btn-primary btn-sm" name="edit_info"  style="margin-left:-15px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                        var btn_cancel='<button class="btn btn-red btn-sm" name="cancel_info" style="margin-right:0px;" data-toggle="tooltip" data-placement="top" title="Cancel Journal"><i class="fa fa-times"></i> </button>';
                        var btn_check_print='<button class="btn btn-success btn-sm" name="print_check" style="margin-right:0px;text-transform: none;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-print"></i> Print Check</button>';


                        return '<center>'+btn_edit+"&nbsp;"+btn_check_print+"&nbsp;"+btn_cancel+'</center>';
                    }
                }
            ]
        });
        
        dtReview=$('#tbl_expense_for_review').DataTable({
            "bLengthChange":false,
            "ajax" : "Payable_payments/transaction/expense-for-review",
            "columns": [
                {
                    "targets": [0],
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { targets:[1],data: "receipt_no" },
                { targets:[2],data: "supplier_name" },
                { targets:[3],data: "remarks" },
                { targets:[4],data: "date_paid" },
                {
                    targets:[5],
                    data: "rem_day_for_due",
                    render: function (data, type, full, meta){
                        if(full.payment_method_id==2&&data>0){ //if check and remaining day before due is greater than 0
                            return "<span style='color: red'><b><i class='fa fa-times-circle'></i> "+data+"</b> day(s) before Check is due.</span>";
                        }else{
                            return "";
                        }
                    }
                },
                { targets:[6],data: "total_paid_amount" }
            ]
        });

        dtCheckList=$('#tbl_check_list').DataTable({
            "dom": '<"print">frtip',
            "bLengthChange":false,
            "pageLength" : 7,
            "ajax" : "Cash_disbursement/transaction/get-check-list",
            "columnDefs": [
                { "visible": false, "targets": 0 }
            ],
            "columns": [

                { targets:[0],data: "bank" },
                { targets:[1],data: "check_no" },
                { targets:[2],data: "amount",
                    render: function(data, type, full, meta){
                        return accounting.formatNumber(data,2);
                    }
                },
                { targets:[3],data: "check_date" },
                { targets:[4],data: "ref_no" },
                { targets:[5],data: "supplier_name" },
                { targets:[6],data: "remarks" },
                {  targets:[7],data: "check_status",
                    render: function (data, type, full, meta){
                        //alert(data.check_status);
                        if(data=="1"){
                            _attribute=' class="fa fa-check-circle" style="color:green;" ';
                        }else{
                            _attribute=' class="fa fa-times-circle" style="color:red;" ';
                        }

                        return '<center><i '+_attribute+'></i></center>';
                    }
                },
                {  targets:[8],
                    render: function (data, type, full, meta){
                        var btn_check_print='<button class="btn btn-success btn-sm" name="print_check" style="margin-right:0px;text-transform: none;" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-print"></i> Print Check</button>';
                        return '<center>'+btn_check_print+'</center>';
                    } }
            ],
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;

                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last!== group ) {
                        $(rows).eq( i ).before(
                            // '<tr class="group" style="background-color:#161616!important"><td colspan="8" align="left"><b style="text-transform: capitalize;font-size: 15px;color:white;"><i class="fa fa-bars"></i> '+group+'</b></td></tr>' +
                            '<tr class="group" >'+
                                    '<td><b>Check #</b></td>'+
                                    '<td><b >Amount</b></td>'+
                                    '<td><b >Check Date</b></td>'+
                                    '<td><b >Voucher #</b></td>'+
                                    '<td><b >Particular</b></td>'+
                                    '<td><b>Remarks</b></td>'+
                                    '<td align="center"><b >Issued</b></td>'+
                                    '<td ><center><b >Action</b></center></td>'+
                            '</tr>'
                        );

                        last = group;
                    }
                } );
            }
        });

        reInitializeNumeric();
        reInitializeDropDownAccounts($('#tbl_entries'),false);


        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

        var createToolBarButton=function() {
            var _btnNew='<button class="btn btn-primary" id="btn_new" style="text-transform: none;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New Journal" >'+
                '<i class="fa fa-plus"></i> New Cash Disbursement Journal</button>';
            $("div.toolbar").html(_btnNew);

            var _btnPrint='<button class="btn btn-primary" id="btn_print_check_list" style="text-transform: none;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Print Check list" >'+
                '<i class="fa fa-print"></i> Print Check list</button>';

            var _refresh='<button class="btn btn-green" id="btn_refresh_check_list" style="text-transform: none;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="Refresh" >'+
                '<i class="fa fa-refresh"></i> Refresh</button>';

            $("div.print").html(_btnPrint+" "+_refresh);

        }();

        _cboAccountType=$('#cbo_account_type').select2({
            placeholder: "Please Select Account Type",
            allowClear:true
        });

        _cboBanks=$('#cbo_bank').select2({
            placeholder: "Please Select Bank",
            allowClear:true
        });

        _cboTax=$('#cbo_tax_group').select2({
            placeholder: "Please Select Tax type",
            allowClear:true
        });

        _cboSuppliers=$('#cbo_suppliers').select2({
            placeholder: "Please select supplier.",
            allowClear: true
        });
        _cboSuppliers.select2('val',null);

        _cboPaymentMethod = $('#cbo_pay_type').select2({
            placeholder: "Please select Payment Type.",
            allowClear: true
        });
        _cboPaymentMethod.select2('val',null);

         _cboBranches=$('#cbo_branch').select2({
            placeholder: "Please select department.",
            allowClear: true
        });
        _cboBranches.select2('val',null);

        _cboLayouts=$('#cbo_layouts').select2({
            placeholder: "Please select check layout.",
            allowClear: true
        });
        _cboAccountType.select2('val',null);
        _cboLayouts.select2('val',null);
        _cboTax.select2('val',null);
        _cboBanks.select2('val',null);


        cbo_refType=$('#cbo_refType').select2({
            placeholder: "Please select reference type.",
            allowClear: true
        });

        // _cboMethods=$('#cbo_methods').select2({
        //placeholder: "Please select method of payment.",
        //allowClear: true
        //});

        //_cboMethods.select2('val',null);
    }();



    var bindEventHandlers=function(){
        var detailRows = [];

        _cboBanks.on('select2:select',function(){
            if (_cboBanks.select2('val') == 'create_bank'){
                $('#modal_bank').modal('show');
                _cboBanks.select2('val',null);
            }
        });

        $('#btn_cancel_bank').click(function(){
            $('#modal_bank').modal('hide');
            clearFields($('#frm_bank'));
        });

        $('#tbl_cash_disbursement_list tbody').on( 'click', 'tr td.details-control', function () {
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
                    "url":"Templates/layout/journal-cdj?id="+ d.journal_id,
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

        $('#tbl_recurring tbody').on('click', 'button[name="accept_rt"]', function() {
            _selectRowObj=$(this).closest('tr');
            var data=dtRecurring.row(_selectRowObj).data();
            _selectedID=data.template_id;

            $.ajax({
                url: 'Recurring_template/transaction/get-entries?id=' + _selectedID,
                type: 'GET',
                cache: false,
                dataType: 'html',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#tbl_entries > tbody').html('<tr><td align="center" colspan="4"><br /><img src="assets/img/loader/ajax-loader-sm.gif" /><br /><br /></td></tr>');
                }
            }).done(function(response){
                $('#tbl_entries > tbody').html(response);
                reInitializeDropDownAccounts($('#tbl_entries'),false);
                reInitializeNumeric();
                reComputeTotals($('#tbl_entries'));
            });

            _cboSuppliers.select2('val',data.supplier_id);

            $('#modal_recurring').modal('hide');

        });

        $('#btn_browse_recurring').on('click', function(){
            dtRecurring.destroy();
            initializeRecurringTable();
            $('#modal_recurring').modal('show');
        });

        $('#btn_cancel_browsing').on('click',function(){
            $('#modal_recurring').modal('hide');    
        });

        $('#btn_refresh_check_list').click(function(){
            //dtCheckList.destroy();
            dtCheckList.ajax.reload();
        });

        $('#btn_print_check_list').on('click',function(){
            $('#modal_print_check_list_option').modal('show');
        });


        $('#tbl_purchase_review tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dtReview.row( tr );
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
                    "url":"Templates/layout/ap-journal-for-review?id="+ d.dr_invoice_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response ).show();

                    reInitializeSpecificDropDown($('.cbo_supplier_list'));
                    reInitializeNumeric();

                    var tbl=$('#tbl_entries_for_review_'+ d.dr_invoice_id);
                    var parent_tab_pane=$('#journal_review_'+ d.dr_invoice_id);

                    reInitializeDropDownAccounts(tbl);
                    reInitializeChildEntriesTable(tbl);
                    reInitializeChildElements(parent_tab_pane);

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }


                });




            }
        } );


        $('#tbl_expense_for_review tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dtReview.row( tr );
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
                    "url":"Templates/layout/expense-for-review?id="+ d.payment_id,
                    "beforeSend" : function(){
                        row.child( '<center><br /><img src="assets/img/loader/ajax-loader-lg.gif" /><br /><br /></center>' ).show();
                    }
                }).done(function(response){
                    row.child( response,'no-padding' ).show();

                    reInitializeSpecificDropDown($('.cbo_customer_list'));
                    reInitializeSpecificDropDown($('.cbo_department_list'));
                    reInitializeSpecificDropDown($('.cbo_payment_method'));


                    reInitializeNumeric();

                    var tbl=$('#tbl_entries_for_review_'+ d.payment_id);
                    var parent_tab_pane=$('#journal_review_'+ d.payment_id);

                    reInitializeDropDownAccounts(tbl,false);
                    reInitializeChildEntriesTable(tbl);
                    reInitializeChildElements(parent_tab_pane);

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }

                });




            }
        } );


        $('#btn_preview_check').click(function(){
            if ($('#cbo_layouts').select2('val') != null || $('#cbo_layouts').select2('val') != undefined)
                window.open('Templates/layout/print-check?id='+$('#cbo_layouts').val()+'&jid='+_selectedID);
            else
                showNotification({ title: 'Error', msg: 'Please select check layout!', stat: 'error' });
        });


        //loads modal to create new department
        _cboBranches.on("select2:select", function (e) {

            var i=$(this).select2('val');
            if(i==0){ //new department
                _cboBranches.select2('val',null);
                $('#modal_new_department').modal('show');
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
                    $('#cbo_branch').append('<option value="'+_department.department_id+'" selected>'+_department.department_name+'</option>');
                    $('#cbo_branch').select2('val',_department.department_id);

                    clearFields($('#modal_new_department'));

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }


        });







        $('#btn_new').click(function(){
            _txnMode="new";
            $('#div_check').show();
            $('#div_no_check').hide();
            var _currentDate=<?php echo json_encode(date("m/d/Y")); ?>;

            reInitializeDropDownAccounts($('#tbl_entries'),true);
            clearFields($('#frm_journal'));

            $('#cbo_branch').select2('val',null);
            $('#cbo_pay_type').select2('val',1);
            $('#cbo_suppliers').select2('val',null);
            $('#cbo_refType').select2('val',"CV");

            //set defaults
            _cboPaymentMethod.select2('val',1);//set cash as default
            $('input[name="date_txn"]').val(_currentDate);

            showList(false);

        });



        //add account button on table
        $('#tbl_entries').on('click','button.add_account',function(){

            var row=$('#table_hidden').find('tr');
            row.clone().insertAfter('#tbl_entries > tbody > tr:last');

            reInitializeNumeric();
            reInitializeDropDownAccounts($('#tbl_entries'),false);

        });

        var _oTblEntries=$('#tbl_entries > tbody');
        _oTblEntries.on('keyup','input.numeric',function(){
            var _oRow=$(this).closest('tr');

            if(_oTblEntries.find(oTBJournal.dr).index()===$(this).closest('td').index()){ //if true, this is Debit amount
                if(getFloat(_oRow.find(oTBJournal.dr).find('input.numeric').val())>0){
                    _oRow.find(oTBJournal.cr).find('input.numeric').val('0.00');
                }
            }else{

                if(getFloat(_oRow.find(oTBJournal.cr).find('input.numeric').val())>0) {
                    _oRow.find(oTBJournal.dr).find('input.numeric').val('0.00');
                }
            }


            reComputeTotals($('#tbl_entries'));
        });


        $('#tbl_cash_disbursement_list').on('click','button[name="print_check"]',function(){

            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.journal_id;

            $('#modal_check_layout').modal('show');
        });

        $('#tbl_check_list').on('click','button[name="print_check"]',function(){


            _selectRowObj=$(this).closest('tr');
            var data=dtCheckList.row(_selectRowObj).data();
            _selectedID=data.journal_id;
            //alert(_selectedID);
            $('#modal_check_layout').modal('show');
        });


        $('#tbl_cash_disbursement_list').on('click','button[name="cancel_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.journal_id;
            $('#modal_confirmation').modal('show');
        });

        $('#btn_print_list').click(function(){
            window.open('Cash_disbursement/transaction/print-check-list?bank='+$('#cbo_banks').val()+'&start='+$('#txt_start').val()+"&end="+$('#txt_end').val());
        });

        $('#btn_yes').click(function(){
            $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Cash_disbursement/transaction/cancel",
                "data":{journal_id : _selectedID},
                "success": function(response){
                    showNotification(response);
                    if(response.stat=="success"){
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }

                }
            });
        });

        $('#tbl_cash_disbursement_list').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";

            $('#div_check').hide();
            $('#div_no_check').show();

            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.journal_id;


            $('input,textarea, select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });
            $('#cbo_pay_type').select2('val',data.payment_method_id);
            $('#cbo_suppliers').select2('val',data.supplier_id);
            $('#cbo_branch').select2('val',data.department_id);
            $('#cbo_refType').select2('val',data.ref_type);
            $('#cbo_bank').select2('val',data.bank_id);

            $.ajax({
                url: 'Cash_disbursement/transaction/get-entries?id=' + data.journal_id,
                type: "GET",
                cache: false,
                dataType: 'html',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#tbl_entries > tbody').html('<tr><td align="center" colspan="4"><br /><img src="assets/img/loader/ajax-loader-sm.gif" /><br /><br /></td></tr>');
                }
            }).done(function(response){
                $('#tbl_entries > tbody').html(response);
                reInitializeNumeric();
                reInitializeDropDownAccounts($('#tbl_entries'),false); //do not clear dropdown accounts
                reComputeTotals($('#tbl_entries'));
            });

            showList(false);

        });


        _cboSuppliers.on("select2:select", function (e) {
            var i=$(this).select2('val');
            if(i==0){ //new supplier
                _cboSuppliers.select2('val',null)
                $('#modal_new_supplier').modal('show');
                clearFields($('#modal_new_supplier').find('form'));
            }

        });



        $('#tbl_entries').on('click','button.remove_account',function(){
            var oRow=$('#tbl_entries > tbody tr');

            if(oRow.length>1){
                $(this).closest('tr').remove();
            }else{
                showNotification({"title":"Error!","stat":"error","msg":"Sorry, you cannot remove all rows."});
            }

            reComputeTotals($('#tbl_entries'));

        });


        $('#btn_save').click(function(){
            var btn=$(this);
            var f=$('#frm_journal');

            if(validateRequiredFields(f)){
                if(_txnMode=="new"){

                    if ($('input[name="chk_save"]').is(':checked')) {
                        createTemplate().done(function(response){
                            showNotification(response);
                        });
                    }

                    createJournal().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){


                            dt.row.add(response.row_added[0]).draw();
                            clearFields(f);
                            showList(true);

                            //dtCheckList.destroy();
                            dtCheckList.ajax.reload();

                        }

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }else{
                    updateJournal().done(function(response){
                        showNotification(response);
                        if(response.stat=="success"){
                            dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                            clearFields(f);
                            showList(true);

                            dtCheckList.ajax.reload();
                        }

                    }).always(function(){
                        showSpinningProgress(btn);
                    });
                }

            }

        });


        $('#btn_cancel').click(function(){
            showList(true);
        });

        $('#btn_save_bank').click(function(){
            if(validateRequiredFields($('#frm_bank'))){
                createBank().done(function(response){
                    showNotification(response);
                    var _bank = response.row_added[0];

                    $('#cbo_bank').append('<option value="'+_bank.bank_id+'">'+_bank.bank_name+'</option>');
                    _cboBanks.select2('val',_bank.bank_id);
                    
                    clearFields($('#frm_bank'));
                }).always(function(){
                    showSpinningProgress($('#btn_save_bank'));
                });
                $('#modal_bank').modal('hide');
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
                    ///$('#cbo_tax_type').select2('val',_suppliers.tax_type_id);

                }).always(function(){
                    showSpinningProgress(btn);
                });
            }

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

        $('#btn_remove_photo').click(function(event){
            event.preventDefault();
            $('img[name="img_user"]').attr('src','assets/img/anonymous-icon.png');
        });

        $("#cbo_pay_type").change(function(){
            if($(this).val() == 2) {
                $('#check_date').prop('required',true);
                $('#check_no').prop('required',true);
            } else {
                $('#check_date').prop('required',false);
                $('#check_no').prop('required',false);
            }
        });


    }();





    //*********************************************************************8
    //              user defines

    var createBank=function(){
        var _data=$('#frm_bank').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Bank/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save_bank'))
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

    var createJournal=function(){
        var _data=$('#frm_journal').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cash_disbursement/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))

        });
    };


    var updateJournal=function(){
        var _data=$('#frm_journal').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Cash_disbursement/transaction/update?id="+_selectedID,
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var createTemplate=function(){
        var _data=$('#frm_journal').serializeArray();
        _data.push({ name:'template_code', value:$("#cbo_suppliers option:selected").text() });
        _data.push({ name:'book_type', value: 'CDJ'});
        
        return $.ajax({ 
            "dataType":"json",
            "type":"POST",
            "url":"Cash_disbursement/transaction/create-template",
            "data":_data
        });
    };

    var showList=function(b){
        if(b){
            $('#div_payable_list').show();
            $('#div_payable_fields').hide();
        }else{
            $('#div_payable_list').hide();
            $('#div_payable_fields').show();
        }
    };

    var clearFields=function(f){
        $('input,textarea,select',f).val('');
        $(f).find('select').select2('val',null);



        $(f).find('input:first').focus();
        $('#tbl_entries > tbody tr').slice(2).remove();


        $('#tbl_entries > tfoot tr').find(oTFSummary.dr).html('<b>0.00</b>');
        $('#tbl_entries > tfoot tr').find(oTFSummary.cr).html('<b>0.00</b>');
    };

    //initialize numeric text
    function reInitializeNumeric(){
        $('.numeric').autoNumeric('init');
    };

    function reInitializeDropDownAccounts(tbl,bClear=false){
        var obj=tbl.find('select.selectpicker');

        obj.select2({
            placeholder: "Please select account.",
            allowClear: false
        });

        if(bClear){
            $.each(obj,function(){
                $(this).select2('val',null);
            });
        }

    };


    function reInitializeSpecificDropDown(elem){
        elem.select2({
            placeholder: "Please select item.",
            allowClear: false
        });
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

    var showSpinningProgress=function(e){
        $(e).toggleClass('disabled');
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };


    var reComputeTotals=function(tbl){
        var oRows=tbl.find('tbody tr');
        var _DR_amount=0.00; var _CR_amount=0.00;

        $.each(oRows,function(i,value){
            _DR_amount+=getFloat($(this).find(oTBJournal.dr).find('input.numeric').val());
            _CR_amount+=getFloat($(this).find(oTBJournal.cr).find('input.numeric').val());


        });



        tbl.find('tfoot tr').find(oTFSummary.dr).html('<b>'+accounting.formatNumber(_DR_amount,2)+'</b>');
        tbl.find('tfoot tr').find(oTFSummary.cr).html('<b>'+accounting.formatNumber(_CR_amount,2)+'</b>');

    };

    var getFloat=function(f){
        return parseFloat(accounting.unformat(f));
    };


    var showNotification=function(obj){
        PNotify.removeAll(); //remove all notifications
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };


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


        if(!isBalance()){
            showNotification({title:"Error!",stat:"error",msg:'Please make sure Debit and Credit is balance.'});
            stat=false;
        }

        return stat;
    };


    var isBalance=function(opTable=null){
        var oRow; var dr; var cr;

        if(opTable==null){
            oRow=$('#tbl_entries > tfoot tr');
        }else{
            oRow=$(opTable+' > tfoot tr');
        }

        dr=getFloat(oRow.find(oTFSummary.dr).text());
        cr=getFloat(oRow.find(oTFSummary.cr).text());

        return (dr==cr);
    };


    var reInitializeChildEntriesTable=function(tbl){

        var _oTblEntries=tbl.find('tbody');
        _oTblEntries.on('keyup','input.numeric',function(){
            var _oRow=$(this).closest('tr');

            if(_oTblEntries.find(oTBJournal.dr).index()===$(this).closest('td').index()){ //if true, this is Debit amount
                if(getFloat(_oRow.find(oTBJournal.dr).find('input.numeric').val())>0){
                    _oRow.find(oTBJournal.cr).find('input.numeric').val('0.00');
                }
            }else{
                if(getFloat(_oRow.find(oTBJournal.cr).find('input.numeric').val())>0) {
                    _oRow.find(oTBJournal.dr).find('input.numeric').val('0.00');
                }
            }
            reComputeTotals(tbl);
        });



        //add account button on table
        tbl.on('click','button.add_account',function(){

            var row=$('#table_hidden').find('tr');
            row.clone().insertAfter(tbl.find('tbody > tr:last'));

            reInitializeNumeric();
            reInitializeDropDownAccounts(tbl);

        });


        tbl.on('click','button.remove_account',function(){
            var oRow=tbl.find('tbody tr');

            if(oRow.length>1){
                $(this).closest('tr').remove();
            }else{
                showNotification({"title":"Error!","stat":"error","msg":"Sorry, you cannot remove all rows."});
            }

            reComputeTotals(tbl);

        });




    };
    //***************************************************************************************************************88


    var reInitializeChildElements=function(parent){
        var _dataParentID=parent.data('parent-id');
        var btn=parent.find('button[name="btn_finalize_journal_review"]');

        //initialize datepicker
        parent.find('input.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });


        parent.on('click','button[name="btn_finalize_journal_review"]',function(){

            var _curBtn=$(this);
            if(isBalance('#tbl_entries_for_review_'+_dataParentID)){
                finalizeJournalReview().done(function(response){
                    showNotification(response);
                    if(response.stat=="success"){
                        dt.row.add(response.row_added[0]).draw();
                        var _parentRow=_curBtn.parents('table.table_journal_entries_review').parents('tr').prev();
                        dtReview.row(_parentRow).remove().draw();
                    }


                }).always(function(){
                    showSpinningProgress(_curBtn);
                });
            }else{
                showNotification({title:"Not Balance!",stat:"error",msg:'Please make sure Debit and Credit amount are equal.'});
                stat=false;
            }


        });

        var finalizeJournalReview=function(){
            var _data_review=parent.find('form').serializeArray();

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Cash_disbursement/transaction/create",
                "data":_data_review,
                "beforeSend": showSpinningProgress(btn)

            });
        };



    };


});


</script>

</body>

</html>