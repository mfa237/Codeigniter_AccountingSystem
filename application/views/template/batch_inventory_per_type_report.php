<html>
<head>
    <title>Inventory Report</title>
    <style>
        body{
            font-family: tahoma;font-size: 11;
        }

        table {
            table-layout: fixed;
            border-collapse: collapse;
        }


        tr,td{

            border-bottom: 1px solid black;
            border-spacing: 0px;
        }

    </style>

    <script type="text/javascript">
        (function(){
            window.print();
        })();
    </script>


</head>

<body>

<div style="">

    <h3 style="margin-bottom: 0px;">Inventory Report</h3>
    <i>As of <?php echo $date; ?></i>



    <br /><br />

    <?php foreach($prod_types as $type){ ?>

        <h3 style="margin-bottom: 0px;"><?php echo $type->product_type; ?></b></h3><hr />

        <table width="95%" style="margin-left: 5%">
            <thead>
                <tr>

                    <td><b>PLU</b></th>
                    <td><b>Description</b></td>
                    <td><b>Size</b></td>
                    <!-- <td><b>Batch #</b></td>
                    <td><b>Expiration</b></td> -->
                    <td align="right"><b>On Hand</b></td>

                </tr>
            </thead>

            <tbody>
                <?php foreach($products as $product){ ?>
                    <?php if($product->refproduct_id==$type->refproduct_id){ ?>
                        <tr>

                            <td><?php echo $product->product_code; ?></td>
                            <td><?php echo $product->product_desc; ?></td>
                            <td><?php echo $product->size; ?></td>
                            <!-- <td><?php echo $product->batch_no; ?></td>
                            <td><?php echo $product->expiration; ?></td> -->
                            <td align="right"><?php echo number_format($product->on_hand_per_batch,2); ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <br /><br />


    <?php } ?>
</div>




</body>
</html>