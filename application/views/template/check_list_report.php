<!DOCTYPE html>
<html>
<head>
    <title>Account Subsidiary Report</title>
    <style type="text/css">
        body {
            font-family: 'Tahoma',sans-serif;
            font-size: 10px;
        }
        @media print{@page {size: portrait}}
        td{
            padding: 3px;
        }
        th{
            padding: 5px;
        }


    </style>
</head>

<body>

<?php echo $company_header; ?>

<br /><br />
<div>
    <h2 style="display: table;margin: 0 auto;!important;">Check Summary - <?php echo $bank; ?></h2>
    <p style="display: table;margin: 0 auto;!important;">Period <?php echo $start; ?> to <?php echo $end; ?></p>
</div>



<br /><br /><br /><br />
<center>
    <div>
        <table width="100%" border="1" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Check #</th>
                    <th>Amount</th>
                    <th>Reference</th>
                    <th>Particular</th>
                    <th>Remarks</th>
                    <th align="center">Issued</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($checks as $check){ ?>
                <tr>
                    <td><?php echo $check->bank_name; ?></td>
                    <td><?php echo $check->check_no; ?></td>
                    <td align="right"><?php echo number_format($check->amount,2); ?></td>
                    <td><?php echo $check->ref_no; ?></td>
                    <td><?php echo $check->supplier_name; ?></td>
                    <td><?php echo $check->remarks; ?></td>
                    <td align="center"><?php echo ($check->check_status==1?'Y':'N'); ?></td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</center>



</body>

<script>
    //window.print();
</script>

</html>