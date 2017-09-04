<style>
/*
    .tab-container .nav.nav-tabs li a {

        background: #414141 !important;

        color: white !important;

    }



    .tab-container .nav.nav-tabs li a:hover {

        background: #414141 !important;

        color: white !important;

    }



    .tab-container .nav.nav-tabs li a:focus {

        background: #414141 !important;

        color: white !important;

    }*/



    table.table_journal_entries_review td {

        border: 0px !important;

    }



</style>



<center>





    <table class="table_journal_entries_review"  width="97%" style="font-family: tahoma;border: none!important">

        <tbody>

        <tr class="row_child_tbl_cash_disbursement_list" >

            <td>

                <br />



                <div class="tab-container tab-default ">

                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#journal_review_<?php echo $payment_info->payment_id; ?>" data-toggle="tab"><i class="fa fa-gavel"></i> Review Journal</a></li>

                        <li class=""><a href="#payment_review_<?php echo $payment_info->payment_id; ?>" data-toggle="tab"><i class="fa fa-folder-open-o"></i> Payment</a></li>

                    </ul>

                    <div class="tab-content">



                        <div class="tab-pane active" id="journal_review_<?php echo $payment_info->payment_id; ?>" data-parent-id="<?php echo $payment_info->payment_id; ?>" style="min-height: 300px;">



                            <?php

                            $is_check_not_due=$payment_info->payment_method_id==2 && $payment_info->rem_day_for_due>0;

                            if($is_check_not_due){

                                ?>



                                <div class="alert alert-dismissable alert-danger">

                                    <i class="ti ti-close"></i>&nbsp; <strong>Ooopss!</strong> Looks like the check on this transaction is not yet <b>Due</b>. Please see details below. <br />

                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                </div> <br /> <br />



                            <?php } ?>







                            <?php if(!$valid_particular){ ?>

                                <div class="alert alert-dismissable alert-danger">

                                    <i class="ti ti-close"></i>&nbsp; <strong>Sorry!</strong> We could not find the record of <b><?php echo $payment_info->supplier_name; ?></b>.<br />

                                    <i class="ti ti-close"></i>&nbsp; Please make sure that <b><?php echo $payment_info->supplier_name; ?></b> is not deleted or cancelled to your masterfile record.

                                    <br /><br />

                                    <i class="fa fa-bars"></i>&nbsp; Please call the System Administrator or Developer for assistance.

                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                </div>

                            <?php } ?>



                            <form id="frm_journal_review" role="form" class="form-horizontal row-border">



                                <br />

                                <input type="hidden" name="payment_id" value="<?php echo $payment_info->payment_id; ?>">



                                <div class="row">

                                    <div class="col-lg-8">

                                        <div style="border: 1px solid lightgrey;padding: 2%;border-radius: 5px;">



                                            <div class="row">

                                                <div class="col-lg-4">

                                                    Txn # * :<br />



                                                    <div class="input-group">

                                                        <span class="input-group-addon">

                                                            <i class="fa fa-calendar"></i>

                                                        </span>

                                                        <input type="text" name="txn_no" class="form-control" value="TXN-YYYYMMDD-XXX" readonly>

                                                    </div>



                                                </div><br />

                                            </div>



                                            <div class="row">

                                                <div class="col-lg-7">

                                                    Supplier * :<br />

                                                    <select name="supplier_id" class="cbo_customer_list">

                                                        <?php foreach($suppliers as $supplier){ ?>

                                                            <option value="<?php echo $supplier->supplier_id; ?>" <?php echo ($payment_info->supplier_id===$supplier->supplier_id?'selected':''); ?>><?php echo $supplier->supplier_name; ?></option>

                                                        <?php } ?>

                                                    </select>

                                                </div>



                                                <div class="col-lg-4 col-lg-offset-1">

                                                    Date * :<br />

                                                    <div class="input-group">

                                                        <input type="text" name="date_txn" class="date-picker  form-control" value="<?php echo $payment_info->payment_date; ?>">

                                                        <span class="input-group-addon">

                                                            <i class="fa fa-calendar"></i>

                                                        </span>

                                                    </div>

                                                </div><br />



                                            </div>



                                            <div class="row">

                                                <div class="col-lg-7">

                                                    Branch * :<br />

                                                    <select name="department_id" class="cbo_department_list">

                                                        <?php foreach($departments as $department){ ?>

                                                            <option value="<?php echo $department->department_id; ?>" <?php echo ($payment_info->department_id===$department->department_id?'selected':''); ?>><?php echo $department->department_name; ?></option>

                                                        <?php } ?>

                                                    </select>



                                                </div>



                                            </div>





                                        </div>

                                    </div>



                                    <div class="col-lg-4">

                                        <div style="border: 1px solid lightgrey;padding: 4%;border-radius: 5px;">





                                            <div class="row">

                                                <div class="col-lg-12">

                                                    Method of Payment * :<br />

                                                    <select name="payment_method" class="cbo_payment_method">

                                                        <?php foreach($methods as $method){ ?>

                                                            <option value="<?php echo $method->payment_method_id; ?>" <?php echo ($payment_info->payment_method_id==$method->payment_method_id?'selected':''); ?>><?php echo $method->payment_method; ?></option>

                                                        <?php } ?>

                                                    </select>

                                                </div>

                                            </div>



                                            <div class="row">

                                                <div class="col-lg-6">

                                                    OR # * :<br />



                                                    <div class="input-group">

                                                        <span class="input-group-addon">

                                                            <i class="fa fa-code"></i>

                                                        </span>

                                                        <input type="text" name="or_no" class="form-control" value="<?php echo $payment_info->receipt_no; ?>">

                                                    </div>

                                                </div>

                                                <div class="col-lg-6">

                                                    Amount* :<br />

                                                    <input type="text" name="amount" class="numeric form-control" value="<?php echo number_format($payment_info->total_paid_amount,2); ?>">



                                                </div>

                                            </div>





                                            <div class="row">

                                                <div class="col-lg-6">

                                                    Check Date :<br />

                                                    <div class="input-group">

                                                        <input type="text" name="check_date" class="date-picker form-control" value="<?php echo ($payment_info->payment_method_id==2?$payment_info->date_check:''); ?>">

                                                            <span class="input-group-addon">

                                                                <i class="fa fa-calendar"></i>

                                                            </span>

                                                    </div>

                                                </div>



                                                <div class="col-lg-6">

                                                    Check # :<br />

                                                    <input type="text" name="check_no" class="form-control" value="<?php echo ($payment_info->payment_method_id==2?$payment_info->check_no:''); ?>">

                                                </div>



                                            </div>





                                        </div>

                                    </div>



                                </div>



                                <h4><span style="margin-left: 1%"><strong><i class="fa fa-gear"></i> Journal Entries</strong></span></h4>

                                <hr />



                                <table id="tbl_entries_for_review_<?php echo $payment_info->payment_id; ?>" class="table table-striped" style="width: 100% !important;">

                                    <thead>

                                    <tr style="border-bottom:solid gray;">

                                        <th style="width: 30%;">Account</th>

                                        <th style="width: 30%;">Memo</th>

                                        <th style="width: 15%;text-align: right;">Dr</th>

                                        <th style="width: 15%;text-align: right;">Cr</th>

                                        <th>Action</th>

                                    </tr>

                                    </thead>



                                    <tbody>



                                    <?php



                                    $dr_total=0.00; $cr_total=0.00;



                                    foreach($entries as $entry){





                                        ?>

                                        <tr>

                                            <td>

                                                <select name="accounts[]" class="selectpicker show-tick form-control selectpicker_accounts" data-live-search="true" title="Please select Student">

                                                    <?php foreach($accounts as $account){ ?>

                                                        <option value='<?php echo $account->account_id; ?>' <?php echo ($entry->account_id==$account->account_id?'selected':''); ?> ><?php echo $account->account_title; ?></option>

                                                    <?php } ?>

                                                </select>

                                            </td>

                                            <td><input type="text" name="memo[]" class="form-control"  value="<?php echo $entry->memo; ?>"></td>

                                            <td><input type="text" name="dr_amount[]" class="form-control numeric" value="<?php echo number_format($entry->dr_amount,2); ?>"></td>

                                            <td><input type="text" name="cr_amount[]" class="form-control numeric"  value="<?php echo number_format($entry->cr_amount,2);?>"></td>

                                            <td>
                                        <button type="button" class="btn btn-default add_account"><i class="fa fa-plus-circle" style="color: green;"></i></button>
                                        <button type="button" class="btn btn-default remove_account"><i class="fa fa-times-circle" style="color: red;"></i></button>
<!--                                                 <button type="button" class="btn btn-primary add_account"><i class="fa fa-plus" style="color: white;"></i></button>

                                                <button type="button" class="btn btn-red remove_account"><i class="fa fa-times" style="color: white;"></i></button>
 -->
                                            </td>

                                        </tr>

                                        <?php

                                        $dr_total+=$entry->dr_amount;

                                        $cr_total+=$entry->cr_amount;



                                    }



                                    ?>





                                    </tbody>



                                    <tfoot>

                                    <tr>

                                        <td colspan="2" align="right"><strong>Total</strong></td>

                                        <td align="right"><strong><?php echo number_format($dr_total,2); ?></strong></td>

                                        <td align="right"><strong><?php echo number_format($cr_total,2); ?></strong></td>

                                        <td></td>

                                    </tr>

                                    </tfoot>



                                </table>





                                <hr />

                                <label class="col-lg-2"> Remarks :</label><br />

                                <div class="col-lg-12">

                                    <textarea name="remarks" class="form-control" style="width: 100%;"><?php echo $payment_info->remarks; ?></textarea>

                                </div>



                                <br /><hr />



                            </form>



                            <br /><br /><hr />





                            <div class="row">

                                <div class="col-lg-12">

                                    <button name="btn_finalize_journal_review" class="btn btn-primary <?php echo ($is_check_not_due?'disabled':''); ?> <?php echo (!$valid_particular?'disabled':''); ?>"><i class="fa fa-check-circle"></i> <span class=""></span> Finalize this Journal</button>

                                </div>

                            </div>





                        </div>



                        <div class="tab-pane" id="payment_review_<?php echo $payment_info->payment_id; ?>" >



                            <h4><span style="margin-left: 1%"><strong><i class="fa fa-bars"></i> Payment Transaction</strong></span></h4>

                            <hr />



                            <div style="margin-left: 2%;margin-right: 20px;">

                                <div class="row">

                                    <div class="col-lg-6">

                                        <i class="fa fa-code"></i> OR/AR # : <b><?php echo $payment_info->receipt_no; ?></b><br />

                                        <i class="fa fa-calendar"></i> Payment Date : <?php echo $payment_info->payment_date; ?><br />

                                        <i class="fa fa-caret-square-o-left"></i> Receipt type : <?php echo $payment_info->receipt_type; ?><br /><br />

                                        <i class="fa fa-bookmark"></i> Department : <?php echo $payment_info->department_name; ?><br />

                                        <i class="fa fa-users"></i> Customer : <?php echo $payment_info->supplier_name; ?><br /><br />

                                    </div>



                                    <div class="col-lg-6">

                                        <i class="fa fa-code"></i> Method of Payment : <?php echo $payment_info->payment_method; ?><br />

                                        <i class="fa fa-calendar"></i> Check Date : <?php echo $payment_info->date_check; ?><br />

                                        <i class="fa fa-caret-square-o-left"></i> Check # : <?php echo $payment_info->check_no; ?><br /><br />

                                        <i class="fa fa-bookmark"></i> Total Payment : <b><?php echo number_format($payment_info->total_paid_amount,2); ?></b><br />



                                    </div>



                                </div>





                                <table class="table table-striped" style="width: 100% !important;">

                                    <thead>

                                    <tr style="border-bottom: solid gray;">

                                        <td width="12%"><strong>Invoice #</strong></td>

                                        <td width="12%"><strong>Received Date</strong></td>

                                        <td width="12%"><strong>Term</strong></td>

                                        <td width="12%"><strong>Due Date</strong></td>

                                        <td width="38%"><strong>Remarks</strong></td>

                                        <td width="14%" style="text-align: right;"><strong>Paid Amount</strong></td>

                                    </tr>

                                    </thead>

                                    <tbody>

                                    <?php foreach($payments_list as $pay){ ?>

                                        <tr>

                                            <td><?php echo $pay->dr_invoice_no; ?></td>

                                            <td><?php echo $pay->delivered_date; ?></td>

                                            <td><?php echo $pay->terms; ?></td>

                                            <td><?php echo $pay->due_date; ?></td>

                                            <td><?php echo $pay->remarks; ?></td>

                                            <td align="right"><?php echo number_format($pay->payment_amount,2); ?></td>

                                        </tr>

                                    <?php } ?>

                                    </tbody>



                                    <tfoot>



                                    </tfoot>



                                </table>



                                <br /><br />

                            </div>



                        </div>



                    </div>

                </div>





            </td>

        </tr>

        </tbody>



    </table>

</center>





<style>

    tr {

        border: none!important;

    }


/*
    tr:nth-child(even){

        background: #414141 !important;

        border: none!important;

    }



    tr:hover {

        transition: .4s;

        background: #414141 !important;

        color: white;

    }



    tr:hover .btn {

        border-color: #494949!important;

        border-radius: 0!important;

        -webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);

        -moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);

        box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
*/
    }

</style>



