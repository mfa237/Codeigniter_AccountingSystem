

<div style="padding:1%;">

   <center>
       <table width="100%"  style="border-collapse: collapse;">
           <thead>
                <tr class="">
                    <td style="border: 1px solid lightgrey;padding: 5px;"><b>Txn Date</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;"><b>Reference</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;"><b>Txn Type</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;"><b>Description</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;"><b>In</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;"><b>Out</b></td>
                    <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;"><b>Balance</b></td>
                </tr>

           </thead>
           <tbody>
                <?php if(count($products)==0){ ?>
                    <tr>
                        <td colspan="9" style="border: 1px solid lightgrey;padding: 10px;" align="center">No transaction found.</td>
                    </tr>
                <?php } ?>

                <?php foreach($products as $product){ ?>
               <tr>
                   <td style="border: 1px solid lightgrey;padding: 5px;"><?php echo date("M d, Y",strtotime($product->txn_date)); ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;"><?php echo $product->ref_no; ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;"><?php echo $product->type; ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;"><?php echo $product->Description; ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;"><?php echo number_format($product->in_qty,0); ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;"><?php echo number_format($product->out_qty,0); ?></td>
                   <td style="border: 1px solid lightgrey;padding: 5px;text-align: right;font-weight: bolder;"><?php echo number_format($product->balance,0); ?></td>
               </tr>
                <?php } ?>

           </tbody>
       </table>
       <br /><br />

   </center>
</div>

<style>
  tr {
      border: none!important;
  }

/*  tr:nth-child(even){
      background: #414141 !important;
      border: none!important;
  }

  tr:hover {
      transition: .4s;
      background: #414141 !important;
      color: white;
  }

  tr:hover .btn {
      border-color: #494949!important;
      border-radius: 0!important;
      -webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
      -moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
      box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
  }*/
</style>


















