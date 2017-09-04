<?php

    function format_display($balance){
        $balance=(float)$balance;
        if($balance<0){
            $balance=str_replace("-","",$balance);
            return "(".number_format($balance,2).")";
        }else{
            return number_format($balance,2);
        }

    }

?>


<html>
<head>
    <title>Balance Sheet</title>
    <style>
        @page  {
            size: A4;

        }

        body{
            font-family: 'Times New Roman', serif;

        }
  @media print {
  @page { margin: 0; }
  body { margin: 1.0cm; }

    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td width="20%" valign="top"><img src="<?php echo base_url($company_info->logo_path); ?>" style="height: 100px; width: 100px; text-align: left;"></td>
            <td width="80%" class="align-center">
                <span style="font-size: 12pt;font-weight: bolder;"><strong><?php echo $company_info->company_name; ?></strong></span><br />
                <span style="font-size: 8pt;"><?php echo $company_info->company_address; ?></span><br />
                <span style="font-size: 8pt;"><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></span><br /><br />
                <span style="font-size: 12pt;font-weight: bolder;"><strong>Balance Sheet</strong></h3></span><br />
                <span style="font-size: 10pt;"><i>As of date <?php echo $date; ?></i></span><br /><br /><br />
            </td>
        </tr>
    </table>


    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="80%" style="border-collapse: collapse;border: 1px solid black;padding: 5px;padding-left: 10px;border-right: none;">
                <span style="font-size:10pt;"><b>Total Assets</b></span>
            </td>
            <td width="20%;" style="border-collapse: collapse;border: 1px solid black;padding: 5px;padding-left: 10px;border-left: none;">

            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-left: 1px solid black;border-right: 1px solid black;padding-right: 10px;">

                <table width="100%">
                    <?php $total_type=0; foreach($acc_classes as $class){ ?>
                        <?php if($class->account_type_id==1){ ?>
                            <tr>
                                <td width="80%" colspan="2">
                             <span style="font-size:10pt;padding-left: 30px;">
                                <i><?php echo $class->account_class; ?></i>
                            </span>
                                </td>
                            </tr>

                            <?php $total_balance=0; foreach($acc_titles as $account){ ?>
                                <?php if($class->account_class_id==$account->account_class_id){?>
                                    <tr>
                                        <td width="80%">
                                     <span style="font-size:10pt;padding-left: 85px;">
                                        <?php echo $account->account_title; ?>
                                    </span>
                                        </td>
                                        <td align="right" width="20%" style="padding-right: 15px;">
                                             <span style="font-size:10pt;"><?php echo format_display($account->balance); ?></span>
                                        </td>
                                    </tr>
                                    <?php $total_balance+=$account->balance; $total_type+=$account->balance; ?>
                                <?php } ?>
                            <?php } ?>


                            <tr>
                                <td width="80%" align="right" style="padding-right: 30px;">

                                </td>
                                <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">

                                </td>
                            </tr>


                            <tr>
                                <td width="80%" align="right" style="padding-right: 30px;">
                                    <span style="font-size:10pt;"><i>Total <?php echo $class->account_class; ?></i></span>
                                </td>
                                <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">
                                    <span style="font-size:10pt;"><b><?php echo format_display($total_balance); ?></b></span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>


                    <tr>
                        <td width="80%" align="right" style="padding-right: 30px;">
                            <br />
                            <span style="font-size:10pt;"><b>Total Assets :</b></span>
                        </td>
                        <td align="right" width="20%" style="padding-right: 15px; border-bottom: 3px solid black;">
                            <br />
                            <span style="font-size:10pt;"><b><?php echo format_display($total_type); ?></b></span>
                        </td>
                    </tr>

                </table>

                <br />

            </td>

        </tr>




        <tr>
            <td width="80%" style="border-collapse: collapse;border: 1px solid black;padding: 5px;padding-left: 10px;border-right: none;">
                <span style="font-size:10pt;"><b>Total Liabilities and Equities</b></span>
            </td>
            <td width="20%;" style="border-collapse: collapse;border: 1px solid black;padding: 5px;padding-left: 10px;border-left: none;">

            </td>
        </tr>

        <tr>
            <td colspan="2" style="border: 1px solid black;padding-right: 10px;">


                <table width="100%">
                    <?php $total_type=0; foreach($acc_classes as $class){ ?>
                        <?php if($class->account_type_id==2||$class->account_type_id==3){ ?>
                            <tr>
                                <td width="80%" colspan="2">
                             <span style="font-size:10pt;padding-left: 30px;">
                                <i><?php echo $class->account_class; ?></i>
                            </span>
                                </td>
                            </tr>

                            <?php $total_balance=0; foreach($acc_titles as $account){ ?>
                                <?php if($class->account_class_id==$account->account_class_id){?>
                                    <tr>
                                        <td width="80%">
                                     <span style="font-size:10pt;padding-left: 85px;">
                                        <?php echo $account->account_title; ?>
                                    </span>
                                        </td>
                                        <td align="right" width="20%" style="padding-right: 15px;">
                                            <span style="font-size:10pt;"><?php echo format_display($account->balance); ?></span>
                                        </td>
                                    </tr>
                                    <?php $total_balance+=$account->balance; $total_type+=$account->balance; ?>
                                <?php } ?>
                            <?php } ?>


                            <tr>
                                <td width="80%" align="right" style="padding-right: 30px;">

                                </td>
                                <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">

                                </td>
                            </tr>


                            <tr>
                                <td width="80%" align="right" style="padding-right: 30px;">
                                    <span style="font-size:10pt;"><i>Total <?php echo $class->account_class; ?></i></span>
                                </td>
                                <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">
                                    <span style="font-size:10pt;"><b><?php echo format_display($total_balance); ?></b></span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>

                    <tr>
                        <td width="80%" align="right" style="padding-right: 30px;">
                            <br />
                            <span style="font-size:10pt;"><i>Retained Earnings (<span style="color: lightgrey;">forwarded previous net income</span>)</i></span>
                        </td>
                        <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">
                            <br />
                            <span style="font-size:10pt;"><b><?php echo format_display($prev_net_income); ?></b></span>
                        </td>
                    </tr>

                    <tr>
                        <td width="80%" align="right" style="padding-right: 30px;">
                            <span style="font-size:10pt;"><i>Current Period Earnings (<span style="color: lightgrey;"><?php echo $net_period; ?></span>)</i></span>
                        </td>
                        <td align="right" width="20%" style="padding-right: 15px; border-bottom: 1px solid black;">
                            <span style="font-size:10pt;"><b><?php echo format_display($current_year_earnings); ?></b></span>
                        </td>
                    </tr>

                    <tr>
                        <td width="80%" align="right" style="padding-right: 30px;">
                            <br />
                            <span style="font-size:10pt;"><b>Total Liabilities and Equities :</b></span>
                        </td>
                        <td align="right" width="20%" style="padding-right: 15px; border-bottom: 3px solid black;">
                            <br />
                            <span style="font-size:10pt;"><b><?php echo format_display($total_type+$current_year_earnings+$prev_net_income); ?></b></span>
                        </td>
                    </tr>



                </table>



                <br />

            </td>

        </tr>


    </table>
</body>

<script>
    window.print();
</script>

</html>