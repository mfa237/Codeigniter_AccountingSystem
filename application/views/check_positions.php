<html>
<head>
    <title>Check Positions</title>
    <style>
        html{
            zoom: 0.8;
            zoom: 80%;
        }


        @page{
            <?php
                if($layouts->is_portrait==1){
                    echo "size : 8in 11in;";
                } else{
                    echo "size : A4 landscape;";
                }
            ?>
            margin: -1.1in -1.1in -1.1in -1.1in;
        }





    </style>
</head>

<body>

<div style="position: relative;">

    <div id="span_particular" data-description="Particular" class="drag_member" style="position: absolute;left: <?php echo $layouts->particular_pos_left; ?>px;top: <?php echo $layouts->particular_pos_top; ?>px;font-style: <?php echo $layouts->particular_is_italic; ?>;font-weight:<?php echo ($layouts->particular_is_bold?'bold':'normal'); ?>;font-size: <?php echo $layouts->particular_font_size; ?>;font-family: <?php echo $layouts->particular_font_family; ?>">***Paul Christian Rueda***</div>

    <div id="span_amount_words" data-description="Amount in Words"  class="drag_member" style="position: absolute;left: <?php echo $layouts->words_pos_left; ?>px;top: <?php echo $layouts->words_pos_top; ?>px;font-style: <?php echo $layouts->words_is_italic; ?>;font-weight:<?php echo ($layouts->words_is_bold?'bold':'normal'); ?>;font-size: <?php echo $layouts->words_font_size; ?>;font-family: <?php echo $layouts->words_font_family; ?>">***One million pesos only***</div>

    <div id="span_date" data-description="Check Date" class="drag_member" style="position: absolute;left: <?php echo $layouts->date_pos_left; ?>px;top: <?php echo $layouts->date_pos_top; ?>px;font-style: <?php echo $layouts->date_is_italic; ?>;font-weight:<?php echo ($layouts->date_is_bold?'bold':'normal'); ?>;font-size: <?php echo $layouts->date_font_size; ?>;font-family: <?php echo $layouts->date_font_family; ?>">Jan 1, 2016</div>

    <div id="span_amount" data-description="Numeric Amount" class="drag_member" style="position: absolute;left: <?php echo $layouts->amount_pos_left; ?>px;top: <?php echo $layouts->amount_pos_top; ?>px;font-style: <?php echo $layouts->amount_is_italic; ?>;font-weight:<?php echo ($layouts->amount_is_bold?'bold':'normal'); ?>;font-size: <?php echo $layouts->amount_font_size; ?>;font-family: <?php echo $layouts->amount_font_family; ?>">1,000,000.00</div>



</div>
</body>


</html>