<!DOCTYPE html>
<html>
<head>
	<title>Sales Summary Report</title>
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
            border-top: 1px solid #404040;
        }
    </style>
    <script type="text/javascript">
        (function(){
            window.print();
            setTimeout(function() {
                 //window.close();
             }, 500);
        })();
    </script>    
</head>
<body>
   <table width="100%">
        <tr>
            <td width="10%"><img src="<?php echo $company_info->logo_path; ?>" style="height: 90px; width: 120px; text-align: left;"></td>
            <td width="90%" class="align-center">
                <h1 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h1>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
            </td>
        </tr>
    </table><hr>
    <div>
        <h1 class="report-header" style="text-align: center;"><strong>SALES SUMMARY REPORT</strong></h1>
        <p style="text-align: center;">Period <?php echo $_GET['startDate']; ?> to <?php echo $_GET['endDate']; ?></p>
    </div>
    <?php foreach ($customers as $customer) { ?>
        <h2><?php echo $customer->customer_name; ?></h2>
    
    <table width="95%" style="margin-left: 5%; text-align: right;">
        <thead>
            <tr style="text-transform: uppercase;">
                <td style="text-align: left;"><strong>Invoice #</strong></td> 
                <td style="text-align: left;"><strong>Date</strong></td> 
                <td style="text-align: left;"><strong>Product Code</strong></td> 
                <td style="text-align: left;"><strong>Description</strong></td> 
                <td style="text-align: right;"><strong>Unit Price</strong></td> 
                <td style="text-align: left;"><strong>Qty</strong></td> 
                <td style="text-align: right;"><strong>Total Amount</strong></td> 
            </tr><hr>
        </thead>
        <tbody>
            <?php
                foreach($sales_details as $detail) {  
                    if($detail->customer_id==$customer->customer_id) { ?> 
                        <tr>
                            <td style="text-align: left;"><?php echo $detail->sales_inv_no; ?></td> 
                            <td style="text-align: left;"><?php echo $detail->date_invoice; ?></td> 
                            <td style="text-align: left;"><?php echo $detail->product_code; ?></td> 
                            <td style="text-align: left;"><?php echo $detail->product_desc; ?></td> 
                            <td style="text-align: right;"><?php echo number_format($detail->sale_price,2); ?></td> 
                            <td style="text-align: left;"><?php echo $detail->on_hand; ?></td> 
                            <td style="text-align: right;"><?php echo number_format($detail->total_amount,2); ?></td>
                        </tr>
                    <?php
                    }
                }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
</body>
</html>