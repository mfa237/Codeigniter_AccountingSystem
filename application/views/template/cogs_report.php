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
        @media print {
              @page { margin: 0; }
              body { margin: 1.0cm; }
        }

    </style>
</head>

<body>

    <?php echo $company_header; ?>

    <br /><br />
    <div>
        <h2 style="display: table;margin: 0 auto;!important;">Schedule of Cost of Goods Sold</h2>
        <p style="display: table;margin: 0 auto;!important;"><?php echo $department[0]->department_name; ?></p>
        <p style="display: table;margin: 0 auto;!important;">Period 01/01/2017 to 02/02/2017</p>
    </div>



    <br /><br /><br /><br />
    <center>
    <div>
        <table width="80%" style="font-size: 12px;">
            <tr>
                <td width="65%">Merchandise Inventory - Beginning</td>
                <td width="15%" align="right"><?php echo number_format($inv_begin,2); ?></td>
            </tr>
            <tr>
                <td width="65%" style="padding-left: 15px;">Add : Purchases</td>
                <td width="15%" align="right" style="border-bottom: 1px solid black;"><?php echo number_format($purchases,2); ?></td>
            </tr>
            <tr>
                <td width="65%" align="left"><b>Total Goods available for Sale </b></td>
                <td width="15%" align="right" style="border-bottom: 0px solid black;"><b><?php echo number_format($goodsForSale,2); ?></b></td>
            </tr>
            <tr>
                <td width="65%" style="padding-left: 15px;">Less : Merchandise Inventory - End</td>
                <td width="15%" align="right" style="border-bottom: 2px solid black;"><?php echo number_format($inv_end,2); ?></td>
            </tr>
            <tr>
                <td width="65%" align="left"><b>Cost of Goods Sold </b></td>
                <td width="15%" align="right" style="border-bottom: 3px double black;"><b><?php echo number_format($cogs,2); ?></b></td>
            </tr>

        </table>
    </div></center>



</body>

<script>
    window.print();
</script>

</html>