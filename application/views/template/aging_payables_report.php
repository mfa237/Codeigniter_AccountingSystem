<!DOCTYPE html>
<html>
<head>
	<title>Aging of Payables Report</title>
	<style type="text/css">
        body {
            font-family: 'Calibri',sans-serif;
            font-size: 12px;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .data {
            border-bottom: 1px solid #404040;
        }

        .align-center {
            text-align: center;
        }

        .report-header {
            font-weight: bolder;
        }

        hr {
            border-top: 3px solid #404040;
        }
    </style>
    <script type="text/javascript">
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
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
    <td><h2>AGING OF PAYABLES REPORT</h2></td>
    <table width="100%" border="1" cellspacing="0">
    	<thead>
    		<th width="30%">Supplier Name</th>
    		<th width="15%">Current</th>
    		<th width="15%">30 Days</th>
    		<th width="15%">45 Days</th>
    		<th width="15%">60 Days</th>
    		<th width="15%">Over 90 Days</th>
    	</thead>
    	<tbody>
            <?php $sum_current = 0; $sum_thirty = 0; $sum_fortyfive = 0; $sum_sixty = 0; $sum_ninety = 0; ?>
    		<?php foreach($payables as $payable) { ?>
                <?php 
                    $sum_current += $payable->current; 
                    $sum_thirty += $payable->thirty_days;
                    $sum_fortyfive += $payable->fortyfive_days;
                    $sum_sixty += $payable->sixty_days;
                    $sum_ninety += $payable->over_ninetydays;
                ?>
	    		<tr>
	    			<td><?php echo $payable->supplier_name; ?></td>
	    			<td align="right"><?php echo (number_format($payable->current,2) == 0 ? '' : number_format($payable->current,2)); ?></td>
	    			<td align="right"><?php echo (number_format($payable->thirty_days,2) == 0 ? '' : number_format($payable->thirty_days,2)); ?></td>
	    			<td align="right"><?php echo (number_format($payable->fortyfive_days,2) == 0 ? '' : number_format($payable->fortyfive_days,2)); ?></td>
	    			<td align="right"><?php echo (number_format($payable->sixty_days,2) == 0 ? '' : number_format($payable->sixty_days,2)); ?></td>
	    			<td align="right"><?php echo (number_format($payable->over_ninetydays,2) == 0 ? '' : number_format($payable->over_ninetydays,2)); ?></td>
	    		</tr>
    		<?php } ?>
            <tr>
                <td></td>
                <td align="right"><?php echo number_format($sum_current,2); ?></td>
                <td align="right"><?php echo number_format($sum_thirty,2); ?></td>
                <td align="right"><?php echo number_format($sum_fortyfive,2); ?></td>
                <td align="right"><?php echo number_format($sum_sixty,2); ?></td>
                <td align="right"><?php echo number_format($sum_ninety,2); ?></td>
            </tr>
    	</tbody>
    </table>
</body>
</html>