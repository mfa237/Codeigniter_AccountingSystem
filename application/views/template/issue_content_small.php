<div style="width:100%">
<h3 style="text-align:center;margin:0px;padding:0px;font-weight:bold;font-family:tahoma;">EVR VET-OPTIONS CORPORATION</h3>
<p style="text-align:center;margin:0px;padding:0px;padding-top:5px;font-family:tahoma;">VIVAPE Center Blk. 6 Lot 2, Mc Arthur Hi-way</p>
<p style="text-align:center;margin:0px;padding:0px;font-family:tahoma;">Brgy. Camachiles, Mabalacat, Pampanga</p>
<p style="text-align:center;margin:0px;padding:0px;font-family:tahoma;">Tel. # 045-598-0103, 045-598-0109</p>
<table style="font-family:tahoma;">
    <tbody>
        <tr>
            <td style="width:85%;font-size:21px;font-weight:bold;">DELIVERY RECEIPT FOR SMALL</td>
            <td style="width:15%;font-size:21px;font-weight:bold;"><?php echo $issuance_info->slip_no; ?></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
    </thead>
    <tbody>
        <tr>
            <td style="width:20%;font-weight:bold;">Name of Customer: </td>
            <td style="border-bottom:1px solid black;width:30%;"> <?php echo $issuance_info->customer_name; ?></td>
            <td style="width:10%;"></td>
            <td style="text-align:right;font-weight:bold;">Date:</td>
            <td style="border-bottom:1px solid black;width:20%;text-align:center;"><?php echo  date_format(new DateTime($issuance_info->date_issued),"m/d/Y"); ?></td>
        </tr>
        <tr>
            <td style="width:20%;font-weight:bold;">Address: </td>
            <td style="border-bottom:1px solid black;width:30%;"> <?php echo $issuance_info->address; ?></td>
            <td style="width:10%;"></td>
            <td style="text-align:right;font-weight:bold;">Terms:</td>
            <td style="border-bottom:1px solid black;width:20%;text-align:center;"> <?php echo $issuance_info->terms; ?></td>
        </tr>
    </tbody>
</table>
<table style="font-family:tahoma;">
    <thead>
        <tr>
            <th style="width:35%;text-align:left;border-bottom:2px solid black;">Description</th>
            <th style="width:10%;text-align:center;border-bottom:2px solid black;">Quantity</th>
            <th style="width:15%;text-align:center;border-bottom:2px solid black;">Pack. Size</th>
            <th style="width:20%;text-align:center;border-bottom:2px solid black;">Unit Price</th>
            <th style="width:20%;text-align:center;border-bottom:2px solid black;">Amount</th>
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
                <td style="text-align:center;font-weight:bold;color:#2ecc71;"><?php echo number_format($grandtotal,2); ?></td>
            </tr>
    </tbody>
</table>
<hr></hr>
<table>
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









