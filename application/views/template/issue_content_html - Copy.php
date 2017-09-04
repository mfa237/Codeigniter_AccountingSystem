<div style="width:100%;height:430px;">
<h3 style="text-align:center;margin:0px;padding:0px;font-weight:bold;font-family:tahoma;">Angeles Pet Care Center</h3>
<p style="text-align:center;margin:0px;padding:0px;padding-top:5px;font-family:tahoma;">VIVAPE Center Blk. 6 Lot 2, Mc Arthur Hi-way</p>
<p style="text-align:center;margin:0px;padding:0px;font-family:tahoma;">Brgy. Camachiles, Mabalacat, Pampanga</p>
<p style="text-align:center;margin:0px;padding:0px;font-family:tahoma;">Tel. # 045-598-0103, 045-598-0109</p>
<h4 style="font-weight:bold;">DELIVERY RECEIPT FOR LIVESTOCK<slipno style="float:right;"><?php echo $issuance_info->slip_no; ?></slipno></h4>
<table class="table">
    <thead>
    </thead>
    <tbody>
        <tr>
            <td style="font-weight:bold;width:20%;">Name of Customer: </td>
            <td style="border-bottom:1px solid black;"> <?php echo $issuance_info->customer_name; ?></td>
            <td style=""></td>
            <td style="text-align:right;font-weight:bold;">Date:</td>
            <td style="border-bottom:1px solid black;text-align:center;"><?php echo  date_format(new DateTime($issuance_info->date_issued),"m/d/Y"); ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">Address: </td>
            <td style="border-bottom:1px solid black;"> <?php echo $issuance_info->address; ?></td>
            <td style=""></td>
            <td style="text-align:right;font-weight:bold;">Terms:</td>
            <td style="border-bottom:1px solid black;text-align:center;"> <?php echo $issuance_info->terms; ?></td>
        </tr>
    </tbody>
</table>
<table style="font-family:tahoma;" class="table" style="width:100%;">
    <thead>
        <tr>
            <th style="text-align:left;border-bottom:2px solid black;">Description</th>
            <th style="text-align:center;border-bottom:2px solid black;">Quantity</th>
            <th style="text-align:center;border-bottom:2px solid black;">Pack. Size</th>
            <th style="text-align:center;border-bottom:2px solid black;">Unit Price</th>
            <th style="text-align:center;border-bottom:2px solid black;">Amount</th>
        </tr>
    </thead>
    <tbody>
       <?php 
            $grandtotal=0;
            foreach($issue_items as $item){
            $grandtotal+=$item->issue_line_total_price;
             ?>
                <tr>
                    <td><?php echo $item->product_desc; ?></td>
                    <td style="text-align:center;"><?php echo number_format($item->issue_qty,2); ?></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"><?php echo number_format($item->issue_price,2); ?></td>
                    <td style="text-align:center;"><?php echo number_format($item->issue_line_total_price,2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align:right;font-weight:bold;">Grand Total</td>
                <td style="text-align:center;font-weight:bold;color:#2ecc71;"><?php echo $grandtotal; ?></td>
            </tr>
    </tbody>
</table>
<hr></hr>
<table class="table">
    <tbody>
        <tr>
            <th style="width:35%;text-align:center"><br></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:22%;text-align:center;"></th>
            <th style="width:23%;text-align:center;"></th>
        </tr>
        <tr>
            <th style="width:35%;text-align:center;border-top:1px solid black;">Authorized Signature</th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:10%;text-align:center;"></th>
            <th style="width:22%;text-align:center;"></th>
            <th style="width:23%;text-align:center;border-top:1px solid black;">Customer's Signature</th>
        </tr>
    </tbody>
</table>
</div>









