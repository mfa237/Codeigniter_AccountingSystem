<center>
    <table class="customers_content" width="100%" style="font-family: tahoma;">
        <tbody>
        <tr>
            <td style="border: 0px !important;" class="supplier_tab">
                <div class="tab-container tab-top tab-default" style="height: auto;border-left: 0px!important;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#customer_info<?php echo $customer_info->customer_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Information</a></li>
                        <li ><a href="#invoice_info<?php echo $customer_info->customer_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Customer Invoice</a></li>
                        <li ><a href="#payment_info<?php echo $customer_info->customer_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Payment Details</a></li>

                    </ul>
                    <div class="tab-content" style="height: auto;">
                        <div class="tab-pane active" id="customer_info<?php echo $customer_info->customer_id; ?>" style="min-height: 300px;">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h4><span style="margin-left: 1%;color: #FFF;"><strong><i class="fa fa-user"></i> <?php echo $customer_info->customer_name; ?></strong></span></h4>
                                    <hr />

                                    <div style="margin-left: 10%">
                                        <i class="fa fa-globe"></i> Address : <?php echo $customer_info->address; ?><br />
                                        <i class="fa fa-send-o"></i> Email : <?php echo $customer_info->email_address; ?><br />
                                        <i class="fa fa-phone-square"></i> Landline : <?php echo $customer_info->contact_no; ?><br />

                                        <i class="fa fa-user"></i> Added : <?php echo $customer_info->user; ?><br />
                                        <i class="fa fa-calendar"></i> Date : <?php echo $customer_info->date_added; ?><br /><br /><br />


                                    </div>
                                </div>

                                <div class="col-lg-5"><br />
                                    <center>
                                        <img class="img-circle" src="<?php echo $customer_info->photo_path; ?>" style="border: 2px solid #000000" height="150" width="150" /></center>

                                    <br /><br />

                                    <i class="fa fa-user"></i> Your last payment : <?php echo (is_array($recent_payment)?$recent_payment[0]->date_paid:'none'); ?><br />
                                    <i class="fa fa-calendar"></i> Reference : <?php echo (is_array($recent_payment)?$recent_payment[0]->receipt_no:'none'); ?><br />
                                    <i class="fa fa-money"></i> Amount : <?php echo (is_array($recent_payment)?number_format($recent_payment[0]->total_paid_amount,2):'none'); ?><br /><br /><br />

                                    <i class="fa fa-star-o"></i> Total Unpaid : <b><?php echo number_format($customer_info->total_receivable_amount,2); ?></b><br /><br /><br /><br /><br />
                                </div>
                            </div>


                            <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Sales Order of <?php echo $customer_info->customer_name; ?></b> (Open and partially received)</span>
                            <hr />
                            <div class="col-lg-12 table-responsive">
                                <table id="tbl_so_<?php echo $customer_info->customer_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th>SO #</th>
                                        <th>Order Date</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>SO Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($sales as $item){ ?>
                                        <tr>
                                            <td><?php echo $item->so_no; ?></td>
                                            <td><?php echo $item->date_order; ?></td>
                                            <td><?php echo $item->remarks; ?></td>
                                            <td><?php echo $item->order_status; ?></td>
                                            <td><?php echo number_format($item->total_after_tax,2); ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
















                        <div class="tab-pane" id="invoice_info<?php echo $customer_info->customer_id; ?>" style="min-height: 300px;">

                            <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Sales Invoice of <?php echo $customer_info->customer_name; ?></b> </span>
                            <hr />
                            <div class="col-lg-12 table-responsive">
                                <table id="tbl_so_<?php echo $customer_info->customer_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th>Invoice </th>
                                        <th>Date</th>
                                        <th style="text-align: right;">Amount</th>
                                        <th>Remarks</th>
                               
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $total = 0;
                                    foreach($invoice as $item_invoice){ ?>
                                        <tr>
                                            <td><?php echo $item_invoice->sales_inv_no; ?></td>
                                            <td><?php echo $item_invoice->date_invoice; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($item_invoice->amount,2); ?></td>
                                            <td><?php echo $item_invoice->remarks; ?></td>
                                            
                                        </tr>
                                    <?php 

                                    $total += $item_invoice->amount;

                                    } ?>
                                    <tr>
                                    <td colspan="2" style="text-align: right;">Total Amount</td>
                                    <td style="text-align: right;"> <?php echo number_format($total,2); ?></td>
                                    <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>



                        <div class="tab-pane " id="payment_info<?php echo $customer_info->customer_id; ?>" style="min-height: 300px;">

                             <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Payments of <?php echo $customer_info->customer_name; ?></b> </span>
                             <hr />
                            <div class="col-lg-12 table-responsive">
                                <table id="tbl_so_<?php echo $customer_info->customer_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>

                                        <th>OR No </th>
                                        <th>Date Paid</th>
                                        <th>Invoice No.</th>
                                        <th style="text-align: right;">Invoice Paid</th>
                                        <th>Check Number</th>
                               
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php 
                                    $total = 0;
                                    foreach($payment as $item_payment){ ?>
                                        <tr>
                                            <td><?php echo $item_payment->receipt_no; ?></td>
                                            <td><?php echo $item_payment->date_paid; ?></td>
                                            <td><?php echo $item_payment->sales_inv_no; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($item_payment->total_paid_amount,2); ?></td>
                                            <td><?php echo $item_payment->check_no; ?></td>

                                           <?php $total += $item_payment->total_paid_amount; ?>

                                            
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                    <td colspan="3" style="text-align: right;">Total Paid Amount</td>
                                    <td style="text-align: right;"><?php echo number_format($total,2); ?></td>
                                    <td></td>
                                    </tr>


                                    </tbody>



                                </table>
                              
                            </div>

                        </div>









                    </div>
                </div>


            </td>
        </tr>
        </tbody>

    </table>
</center>

