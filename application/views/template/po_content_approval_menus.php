<br />


<div class="row">
    <div class="col-sm-12">
        <div style='border-bottom:1px solid gray;'></div>
    </div>
</div><br />

<div class="row" >
    <div class="col-lg-12">
        <div class="title-action" style="margin-left: 3%;">
            <button name="mark_as_approved" type="button" class="btn btn-primary" style="text-transform: none;"><i class="fa fa-check-circle"></i> <span class=""></span> Mark this as Approved </button>
           <!--  <button name="external_link_conversation" type="button" class="btn btn-default" style="text-transform: none;"><i class="fa fa-external-link"></i> Open Conversation</button> -->
            <a href="Templates/layout/po/<?php echo $purchase_info->purchase_order_id; ?>?type=preview" target="_blank" class="btn btn-default" style="text-transform:none;font-family: tahoma;" ><i class="fa fa-print"></i> Print PO </a>
            <a href="Templates/layout/po/<?php echo $purchase_info->purchase_order_id; ?>?type=pdf" class="btn btn-default" style="text-transform:none;font-family: tahoma;" ><i class="fa fa-file-pdf-o"></i> Download as PDF </a>
        </div>
    </div>

</div>

<br />