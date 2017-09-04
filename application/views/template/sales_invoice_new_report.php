<!DOCTYPE html>
<html>
<head>
	<title>Sales Invoice</title>
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
</head>
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
    <td><h2>SALES INVOICE</h2></td>
    <table width="100%" cellspacing="0" border="1" cellpadding="4">
    	<tr>
    		<td width="50%"><strong style="font-size: 16px;">DEPARTMENT : </strong><br><?php echo $sales_info->department_name; ?></td>
    		<td width="50%"><strong style="font-size: 16px;">SALESPERSON : </strong><br><?php echo ($sales_info->salesperson_name == '' ? '&nbsp;' : $sales_info->salesperson_name); ?></td>
    	</tr>
    	<tr>
    		<td></td>
    	</tr>
    </table>
</body>
</html>