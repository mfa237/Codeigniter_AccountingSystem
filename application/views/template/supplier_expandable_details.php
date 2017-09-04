<center>
    <table class="supplier_content" width="100%" style="font-family: tahoma;">
        <tbody>
        <tr>
            <td style="border: 0px !important;" class="supplier_tab">
                     <div class="tab-container tab-top tab-default" style="height: auto;border-left: 0px!important;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#supplier_info<?php echo $supplier_info->supplier_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Information</a></li>
                         <li class=""><a href="#supplier_invoice<?php echo $supplier_info->supplier_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Invoices</a></li>
                         <li class=""><a href="#supplier_payment<?php echo $supplier_info->supplier_id; ?>" data-toggle="tab" class="tab-label"><i class="fa fa-users"></i> Payments</a></li>
                    </ul>
                    <div class="tab-content" style="height: auto;">
                        <div class="tab-pane active" id="supplier_info<?php echo $supplier_info->supplier_id; ?>" style="min-height: 300px;">


                            <div class="row">
                                <div class="col-lg-7">
                                    <h4><span style="margin-left: 1%;color: #FFF;"><strong><i class="fa fa-user"></i> <?php echo $supplier_info->supplier_name; ?></strong></span></h4>
                                    <hr />

                                    <div style="margin-left: 10%">
                                        <i class="fa fa-globe"></i> Address : <?php echo $supplier_info->address; ?><br />
                                        <i class="fa fa-send-o"></i> Email : <?php echo $supplier_info->email_address; ?><br />
                                        <i class="fa fa-phone-square"></i> Landline : <?php echo $supplier_info->contact_no; ?><br />

                                        <i class="fa fa-ticket"></i> Tax : <?php echo $supplier_info->tax_type; ?><br />
                                        <i class="fa fa-reorder"></i> TIN # : <?php echo $supplier_info->tin_no; ?><br />
                                        <i class="fa fa-user"></i> Contact Person : <?php echo $supplier_info->contact_person; ?><br /><br /><br />

                                        <i class="fa fa-user"></i> Added : <?php echo $supplier_info->user; ?><br />
                                        <i class="fa fa-calendar"></i> Date : <?php echo $supplier_info->date_added; ?><br /><br /><br />


                                    </div>
                                </div>

                                <div class="col-lg-5"><br />
                                    <center>
                                    <img class="img-circle" src="<?php echo $supplier_info->photo_path; ?>" style="border: 2px solid #000000" height="150" width="150" /></center>

                                    <br /><br />

                                    <i class="fa fa-user"></i> Your last payment : <?php echo (is_array($recent_payment)?$recent_payment[0]->date_paid:'none'); ?><br />
                                    <i class="fa fa-calendar"></i> Reference : <?php echo (is_array($recent_payment)?$recent_payment[0]->receipt_no:'none'); ?><br />
                                    <i class="fa fa-money"></i> Amount : <?php echo (is_array($recent_payment)?number_format($recent_payment[0]->total_paid_amount,2):'none'); ?><br /><br /><br />

                                    <i class="fa fa-star-o"></i> Total Unpaid : <b><?php echo number_format($supplier_info->total_payable_amount,2); ?></b>
                                </div>

                                <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Purchase Order of <?php echo $supplier_info->supplier_name; ?></b> (Open and partially received)</span>
                                <hr />
                                <div class="col-lg-12 table-responsive">
                                    <table id="tbl_po_<?php echo $supplier_info->supplier_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>PO #</th>
                                            <th>Terms</th>
                                            <th>Remarks</th>
                                            <th>Delivery Address</th>
                                            <th>Approved</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($purchases as $item){ ?>
                                            <tr>
                                                <td><?php echo $item->po_no; ?></td>
                                                <td><?php echo $item->term_description; ?></td>
                                                <td><?php echo $item->remarks; ?></td>
                                                <td><?php echo $item->deliver_to_address; ?></td>
                                                <td><?php echo $item->approval_status; ?></td>
                                                <td><?php echo $item->order_status; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>


                            

                        </div>
                        <div class="tab-pane" id="supplier_invoice<?php echo $supplier_info->supplier_id; ?>" style="min-height: 300px;">


                            <div class="row">

                                <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Purchase Invoice of <?php echo $supplier_info->supplier_name; ?></b> </span>
                                <hr />
                                <div class="col-lg-12 table-responsive">
                                    <table id="tbl_po_<?php echo $supplier_info->supplier_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Date</th>
                                            <th style="text-align: right;">Amount</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach($invoice as $item){ ?>
                                            <tr>
                                                <td><?php echo $item->dr_invoice_no; ?></td>
                                                <td><?php echo $item->invoice_date; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($item->total_after_tax,2); ?></td>
                                                <td><?php echo $item->remarks; ?></td>
                                                <?php $total += $item->total_after_tax; ?>
                                            </tr>
                                        <?php } ?>
                                    <tr>
                                    <td colspan="2" style="text-align: right;">Total Paid Amount</td>
                                    <td style="text-align: right;"><?php echo number_format($total,2); ?></td>
                                    <td></td>
                                    </tr>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="supplier_payment<?php echo $supplier_info->supplier_id; ?>" style="min-height: 300px;">


                            <div class="row">

                                <span style="margin-left: 1%"><b><i class="fa fa-list"></i> List of Payments of <?php echo $supplier_info->supplier_name; ?></b> </span>
                                <hr />
                                <div class="col-lg-12 table-responsive">
                                    <table id="tbl_po_<?php echo $supplier_info->supplier_id; ?>" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Receipt #</th>
                                            <th>Date Paid</th>
                                            <th style="text-align: right;">Amount</th>
                                            <th>Check #</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach($payment as $item){ ?>
                                            <tr>
                                                <td><?php echo $item->dr_invoice_no; ?></td>
                                                <td><?php echo $item->receipt_no; ?></td>
                                                <td><?php echo $item->date_paid; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($item->total_paid,2); ?></td>
                                                <td><?php echo $item->check_no; ?></td>
                                                <?php $total += $item->total_paid; ?>
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
                </div>


            </td>
        </tr>
        </tbody>

    </table>
</center>

