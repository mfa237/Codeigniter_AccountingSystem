<!DOCTYPE html>
<html>
<head>
	<title>Open Purchase Report</title>
	<style>
		body {
			font-family: 'Segoe UI',sans-serif;
			font-size: 12px;
		}
		table, th, td { border-color: white; }
		tr { border-bottom: none !important; }

		.report-header {
			font-size: 22px;
		}
		@media print {
      @page { margin: 0; }
      body { margin: 1.0cm; }
}

	</style>
	<script>
		(function(){
			window.print();
		})();
	</script>
</head>
<body>
	<table width="100%">
        <tr>
            <td width="10%"><img src="<?php echo base_url($company_info->logo_path); ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%">
                <span class="report-header"><strong><?php echo $company_info->company_name; ?></strong></span><br>
                <span><?php echo $company_info->company_address; ?></span><br>
                <span><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></span>
            </td>
        </tr>
    </table><hr>
    <div>
        <h3><strong><center>OPEN PURCHASES</center> </strong></h3>
    </div>


<?php foreach ($item as $batchNo) { ?>
<table  width="100%" cellpadding="3" cellspacing="0" border="1">
<thead>
<tr>
<td colspan="7"><strong>PO # : </strong><?php echo $batchNo->po_no; ?></strong></td>
</tr>
	<th width="10%" align="left">Purchase Order No</th>
	<th width="10%" align="left">Date</th>
	<th  width="10%" align="left">Product Code</th>
	<th  width="30%" align="left">Product Description</th>
	<th  width="10%" align="left">Order Qty</th>
	<th width="10%" align="left">Delivered Qty</th>
	<th  width="5%" align="left">Balance</th>

</thead>

<tbody>
<tr>

</tr>
    <?php foreach ($purchase as $po) {?>
		<?php if ($batchNo->po_no == $po->po_no) { ?>
	<tr>
		
<td width="10%"><?php echo $po->po_no; ?> </td>
<td width="10%"><?php echo $po->last_date_delivered; ?></td>
<td width="10%"><?php echo $po->product_code; ?> </td> 
<td width="30%"><?php echo $po->product_desc; ?> </td>
<td width="10%"><?php echo $po->PoQtyTotal; ?></td>
<td width="10%"><?php echo $po->PoQtyDelivered; ?> </td>
<td width="5%"><?php echo $po->PoQtyBalance; ?> </td>

	</tr>
	<?php } ?>
	<?php } ?> 

</tbody>



</table>
<br>
	<?php } ?>


	

<br>
