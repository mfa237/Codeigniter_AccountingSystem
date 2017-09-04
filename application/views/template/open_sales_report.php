<!DOCTYPE html>
<html>
<head>
	<title>Open Sales Report</title>
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
        <h3><strong><center>OPEN SALES</center> </strong></h3>
    </div>


<?php foreach ($item as $batchNo) { ?>
<table  width="100%" cellpadding="3" cellspacing="0" border="1">
<thead>
<tr>
<td colspan="7"><strong>SO # : </strong><?php echo $batchNo->so_no; ?></strong></td>
</tr>
	<th width="10%" align="left">Sales Order No</th>
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
    <?php foreach ($sales as $so) {?>
		<?php if ($batchNo->so_no == $so->so_no) { ?>
	<tr>
		
<td width="10%"><?php echo $so->so_no; ?> </td>
<td width="10%"><?php echo $so->last_invoice_date; ?></td>
<td width="10%"><?php echo $so->product_code; ?> </td> 
<td width="30%"><?php echo $so->product_desc; ?> </td>
<td width="10%"><?php echo $so->SoQtyTotal; ?></td>
<td width="10%"><?php echo $so->SoQtyDelivered; ?> </td>
<td width="5%"><?php echo $so->SoQtyBalance; ?> </td>

	</tr>
	<?php } ?>
	<?php } ?> 

</tbody>



</table>
<br>
	<?php } ?>


	

<br>
