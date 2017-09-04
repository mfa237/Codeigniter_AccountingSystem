<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from avenxo.kaijuthemes.com/ui-typography.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2016 12:09:25 GMT -->
<head>
    <meta charset="utf-8">
    <title>JCORE - <?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">


    <?php echo $_def_css_files; ?>

    <style>
        body{
            font-family: open sans,lucida grande,lucida sans unicode,helvetica,arial,sans-serif;
        }

        button{
            text-transform: none;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }


        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        .custom_frame{
            border: 1px solid #d1d0d5;
            width: 95%;
            background-color: #ffffff;
            margin-left: auto;
            margin-right: auto;
        }

        .font-bold {
            font-weight: 600;
        }
        .font-normal {
            font-weight: 500;
        }

        .btn-white {
            background: white none repeat scroll 0 0;
            border: 1px solid #e7eaec;
            color: inherit;
            text-transform: none;
        }


        .mail-body .form-group {
            margin-bottom: 5px;
        }
        .mail-text .note-editor .note-toolbar {
            background-color: #f9f8f8;
        }
        .mail-attachment {
            border-top: 1px solid #e7eaec;
            font-size: 12px;
            padding: 20px;
        }
        .mailbox-content {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            padding: 10px;
        }
        .mail-ontact {
            width: 23%;
        }

        .file {
            border: 1px solid #e7eaec;
            padding: 0;
            background-color: #ffffff;
            position: relative;
            margin-bottom: 20px;
            margin-right: 20px;
        }
        .file-manager .hr-line-dashed {
            margin: 15px 0;
        }

        .file-box {
            float: left;
            width: 220px;
        }
        .file-manager h5 {
            text-transform: uppercase;
        }
        .file-manager {
            list-style: outside none none;
            margin: 0;
            padding: 0;
        }

        .file .icon,
        .file .image {
            height: 100px;
            overflow: hidden;
        }
        .file .icon {
            padding: 15px 10px;
            text-align: center;
        }
        .file-control {
            color: inherit;
            font-size: 11px;
            margin-right: 10px;
        }
        .file-control.active {
            text-decoration: underline;
        }
        .file .icon i {
            font-size: 70px;
            color: #dadada;
        }
        .file .file-name {
            padding: 10px;
            background-color: #f8f8f8;
            border-top: 1px solid #e7eaec;
        }
        .file-name small {
            color: #676a6c;
        }
        .corner {
            position: absolute;
            display: inline-block;
            width: 0;
            height: 0;
            line-height: 0;
            border: 0.6em solid transparent;
            border-right: 0.6em solid #f1f1f1;
            border-bottom: 0.6em solid #f1f1f1;
            right: 0em;
            bottom: 0em;
        }


        .sidebard-panel {
            width: 220px;
            background: #ebebed;
            padding: 10px 20px;
            position: absolute;
            right: 0;
        }
        .sidebard-panel .feed-element img.img-circle {
            width: 32px;
            height: 32px;
        }
        .sidebard-panel .feed-element,
        .media-body,
        .sidebard-panel p {
            font-size: 12px;
        }
        .sidebard-panel .feed-element {
            margin-top: 20px;
            padding-bottom: 0;
        }
        .sidebard-panel .list-group {
            margin-bottom: 10px;
        }
        .sidebard-panel .list-group .list-group-item {
            padding: 5px 0;
            font-size: 12px;
            border: 0;
        }


        .feed-activity-list .feed-element {
            border-bottom: 1px solid #e7eaec;
        }
        .feed-element:first-child {
            margin-top: 0;
        }
        .feed-element {
            padding-bottom: 15px;
        }
        .feed-element,
        .feed-element .media {
            margin-top: 15px;
        }
        .feed-element,
        .media-body {
            overflow: hidden;
        }
        .feed-element > .pull-left {
            margin-right: 10px;
        }
        .feed-element img.img-circle,
        .dropdown-messages-box img.img-circle {
            width: 38px;
            height: 38px;
        }
        .feed-element .well {
            border: 1px solid #e7eaec;
            box-shadow: none;
            margin-top: 10px;
            margin-bottom: 5px;
            padding: 10px 20px;
            font-size: 11px;
            line-height: 16px;
        }
        .feed-element .actions {
            margin-top: 10px;
        }
        .feed-element .photos {
            margin: 10px 0;
        }
        .feed-photo {
            max-height: 180px;
            border-radius: 4px;
            overflow: hidden;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .text-navy {
            color: #1ab394;
        }
        .text-primary {
            color: inherit;
        }
        .text-success {
            color: #1c84c6;
        }
        .text-info {
            color: #23c6c8;
        }
        .text-warning {
            color: #f8ac59;
        }
        .text-danger {
            color: #ed5565;
        }
        .text-muted {
            color: #888888;
        }


        .chat-activity-list .chat-element {
            border-bottom: 1px solid #e7eaec;
        }
        .chat-element:first-child {
            margin-top: 0;
        }
        .chat-element {
            padding-bottom: 15px;
        }
        .chat-element,
        .chat-element .media {
            margin-top: 15px;
        }
        .chat-element,
        .media-body {
            overflow: hidden;
        }
        .media-body {
            display: block;
        }
        .chat-element > .pull-left {
            margin-right: 10px;
        }
        .chat-element img.img-circle,
        .dropdown-messages-box img.img-circle {
            width: 38px;
            height: 38px;
        }
        .chat-element .well {
            border: 1px solid #e7eaec;
            box-shadow: none;
            margin-top: 10px;
            margin-bottom: 5px;
            padding: 10px 20px;
            font-size: 11px;
            line-height: 16px;
        }
        .chat-element .actions {
            margin-top: 10px;
        }
        .chat-element .photos {
            margin: 10px 0;
        }
        .right.chat-element > .pull-right {
            margin-left: 10px;
        }
        .chat-photo {
            max-height: 180px;
            border-radius: 4px;
            overflow: hidden;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .chat {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }
        .chat li.left .chat-body {
            margin-left: 60px;
        }
        .chat li.right .chat-body {
            margin-right: 60px;
        }
        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }
        .panel .slidedown .glyphicon,
        .chat .glyphicon {
            margin-right: 5px;
        }
        .chat-panel .panel-body {
            height: 350px;
            overflow-y: scroll;

        }



    </style>

</head>

<body class="animated-content"  style="font-family: tahoma;font-weight: 400">

<?php echo $_top_navigation; ?>

<div id="wrapper">
<div id="layout-static">




<div class="static-content-wrapper" style="background-color: white">


    <div class="static-content"  >
        <div class="page-content"><!-- #page-content -->
            <br />
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom_frame p-lg ">


                        <div class="mail-box-header">


                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="pull-right">
                                        <a href="#" id="btn_mark_approved_po" data-id="<?php echo $po_info[0]->purchase_order_id; ?>" class="btn btn-primary btn-sm btn_mark_approved <?php echo (in_array('7-1',$this->session->user_rights)?'':'disabled'); ?>" style="text-transform: none;" data-toggle="tooltip" data-placement="top" title="Mark as Approved"><i class="fa fa-check-circle"></i> <span class=""></span> Approved this Purchase Order</a>
                                    </div>


                                    Purchase Order # :
                                    <h4>
                                        <strong><?php echo $po_info[0]->po_no; ?></strong>
                                    </h4>


                                    <div>
                                        <br /> Supplier :<br /> <strong><?php echo $po_info[0]->supplier_name; ?></strong>
                                        <br /><br />  Terms :<br /> <strong><?php echo $po_info[0]->term_description; ?></strong>
                                        <br /><br />  Remarks :<br /> <strong><?php echo $po_info[0]->remarks; ?></strong>


                                    </div>
                                </div>
                            </div>


                            <br /><hr />
                            <div class="">
                                <h5>
                                    <span class="pull-right font-normal">Created : <?php echo $po_info[0]->date_created; ?></span>
                                    <span class="font-normal">Posted by : <?php echo $po_info[0]->posted_by; ?></span>
                                </h5>
                            </div>




                            <div class="mail-attachment">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-white btn-sm btn_upload_file"" data-toggle="tooltip" data-placement="top" title="Add Attachments"><i class="fa fa-paperclip"></i> Add Attachments to PO</a>

                                </div>

                                <p>
                                    <span><i class="fa fa-paperclip"></i> <span id="attach_count"><?php echo count($po_attachments); ?></span> attachment(s) - </span>
                                    <a href="#">Download all</a>
                                    |
                                    <a href="#">View all images</a>
                                </p>

                                <div class="attachment_file">


                                    <?php foreach($po_attachments as $file){ ?>

                                    <div class="file-box"  data-id="<?php echo $file->po_attachment_id; ?>">
                                        <div class="file">
                                            <a href="<?php echo $file->server_file_directory; ?>"  download>
                                                <span class="corner"></span>

                                                <div class="icon">
                                                    <i class="fa fa-file"></i>
                                                </div>
                                                <div class="file-name">
                                                    <?php echo $file->orig_file_name; ?>                                  <br/>
                                                    <small>Added: <?php echo $file->date_added; ?></small><br />
                                                    <small>By : <?php echo $file->added_by; ?></small>
                                                </div>
                                            </a>
                                        </div>

                                    </div>

                                    <?php } ?>

                                </div>

                                <div class="clearfix"></div>

                            </div>

<hr /><br />


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-container tab-default">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#home1" data-toggle="tab">Messages</a></li>


                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home1">
                                                <br />

                                                <div class="feed-activity-list">

                                                    <?php foreach($po_messages as $msg){ ?>

                                                    <div class="feed-element" data-id="<?php echo $msg->po_message_id; ?>">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="<?php echo $msg->photo_path; ?>">
                                                        </a>

                                                        <div class="media-body">


                                                            <div class="pull-right">
                                                                <small class="text-navy"><?php echo $msg->time_description; ?></small> <br />
                                                                <?php if($this->session->user_id==$msg->user_id){ ?>
                                                                <a id="btn_remove_announcement" data-id="<?php echo $msg->po_message_id; ?>" class="btn btn-xs btn-white"><i class="fa fa-trash"></i> </a>
                                                                <?php } ?>
                                                            </div>
                                                            <strong><?php echo $msg->message_posted_by; ?></strong>
                                                            <p><?php echo $msg->message; ?></p>


                                                            <small class="text-muted"><?php echo $msg->full_date_description; ?></small>

                                                        </div>


                                                    </div>


                                                    <?php } ?>

                                                </div><!-- feed activity-->



                                                <br />

                                                <form id="frm_message">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input id="txt_po_id" name="purchase_order_id" type="hidden" value="<?php echo $po_info[0]->purchase_order_id; ?>" />


                                                        <div class="form-group" style="margin-bottom: .5%;">
                                                            <label class="control-label"><strong>Message :</strong></label>
                                                            <textarea id="txt_message" name="message" class="form-control" placeholder="Post your message here" data-error-msg="Please make sure you enter your message." required></textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mt-n col-lg-12">
                                                        <button id="btn_post_message" type="button" class="btn btn-primary col-lg-3 pull-right" style="text-transform: none;"><span class=""></span> Post your message</button>
                                                    </div>

                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>




                        </div>


                    </div>
                </div>
            </div>

        </div> <!-- #page-content -->



        <div id="modal_file_upload" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
            <div class="modal-dialog modal-m">
                <div class="modal-content"><!---content--->
                    <div class="modal-header">
                        <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title"><span id="modal_mode"> </span>Attach File</h4>

                    </div>

                    <div class="modal-body">
                        <input type="file" name="file_upload[]" multiple>
                    </div>

                    <div class="modal-footer">
                        <button id="btn_upload" type="button" class="btn btn-primary" style="text-transform: none;"><span class=""> </span> Attach File</button>

                    </div>
                </div><!---content---->
            </div>
        </div><!---modal-->

</div>




<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">&copy; 2016 - Paul Christian Rueda</h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>




</div>
</div>


</div>


<?php echo $_switcher_settings; ?>
<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="assets/js/enquire.min.js"></script>

<!-- Load Enquire -->

<script type="text/javascript" src="assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="assets/plugins/velocityjs/velocity.ui.min.js"></script>


<script type="text/javascript" src="assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->
<script type="text/javascript" src="assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->
<script type="text/javascript" src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->
<script type="text/javascript" src="assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="assets/js/application.js"></script>
<script type="text/javascript" src="assets/demo/demo.js"></script>
<script type="text/javascript" src="assets/demo/demo-switcher.js"></script>


<!-- PNotify -->
<script type="text/javascript" src="assets/plugins/notify/pnotify.core.js"></script>
<script type="text/javascript" src="assets/plugins/notify/pnotify.buttons.js"></script>
<script type="text/javascript" src="assets/plugins/notify/pnotify.nonblock.js"></script>



<script>
    $(document).ready(function(){
            var _files;

            var bindEventHandlers=(function(){
                    $('#btn_post_message').click(function(){
                        postMessage().done(function(response){
                            var _message=response.new_message[0];

                            var _parent=$('.feed-activity-list');
                            //_parent.prepend(createMessageSpinner(reponse.posted_id));
                            var _lastSibling=_parent.find('.feed-element:last');
                            //console.log(_lastSibling);
                            if(_lastSibling.length==0){
                                _parent.prepend(createMessageFeedStructure(_message));
                            }else{
                                $(createMessageFeedStructure(_message)).insertAfter(_lastSibling);
                            }

                            showNotification(response);
                        }).always(function(){
                            clearFields();
                            showSpinningProgress($('#btn_post_message'));
                        });
                    });

                $('input[type="file"]').on('change',function(event){
                    _files=event.target.files;
                });


                $('div.feed-activity-list').on('click','#btn_remove_announcement',function(){
                    var id=$(this).data('id');
                    $.ajax({
                        "dataType":"json",
                        "type":"POST",
                        "url":"Po_messages/transaction/delete-message/"+id
                    }).done(function(response){

                        //
                        $('div.feed-element[data-id="'+id+'"]').remove();
                        //alert($('div.feed-element[data-id="'+id+'"]').length);
                        showNotification(response);

                    });

                });

                $('#btn_upload').click(function(){
                    var data=new FormData();
                    var btn=$(this);

                    $.each(_files,function(key,value){
                        data.append(key,value);
                    });

                    $.ajax({
                        url : 'Po_messages/transaction/upload-attachments?id='+$('#txt_po_id').val(),
                        type : "POST",
                        data : data,
                        cache : false,
                        dataType : 'json',
                        processData : false,
                        contentType : false,
                        beforeSend : function(){
                            showSpinningProgress(btn);
                        },
                        success : function(response){
                            showNotification(response);
                            $('#modal_file_upload').modal('hide');
                        },
                        complete : function(){
                            showSpinningProgress(btn);
                        }
                    });


                });


                    $('#btn_mark_approved_po').click(function(){
                        var btn=$(this);
                        var id=$(this).data('id');

                        $.ajax({
                            "dataType":"json",
                            "type":"POST",
                            "url":"Purchases/transaction/mark-approved",
                            "data":{"purchase_order_id" : id},
                            "beforeSend" : function(){
                                showSpinningProgress(btn);
                            }
                        }).done(function(response){
                            showNotification(response);
                        }).always(function(){
                            showSpinningProgress(btn);
                        });

                    });


                    $('.btn_upload_file').click(function(){
                        $('#modal_file_upload').modal('show');
                    });

                    $('#txt_message').keypress(function(e){
                        if(e.keyCode==13){
                            $('#btn_post_message').click();
                            //$(this).val('');
                            return false;
                        }
                    });

            })();




            var messageRequest=function(){
                setInterval(function(){

                    $.ajax({
                        "dataType": "json",
                        "type": "GET",
                        "url": "Po_messages/transaction/list-messages/"+$('#txt_po_id').val(),
                        "success": function (response) {


                            //console.log(response);
                            var _parent=$('.feed-activity-list');
                            var _messages=response.po_messages;

                            $.each(_messages,function(i,value){
                                var _target=_parent.find('.feed-element[data-id="'+value.po_message_id+'"]');


                                if(_target.length==0){
                                    // _parent.siblings().last().append(createMessageFeedStructure(value));
                                    var _lastSibling=_parent.find('.feed-element:last');
                                    if(_lastSibling.length>0){
                                        $(createMessageFeedStructure(value)).insertAfter(_lastSibling);
                                    }else{
                                        _parent.prepend(createMessageFeedStructure(value));
                                    }

                                }else{
                                    _target.replaceWith(createMessageFeedStructure(value));
                                }
                            });



                            //attachments
                            var _attachCount=0;
                            var _attachParent=$('.attachment_file');
                            var _list=response.po_attachments;


                            $.each(_list,function(i,value){
                                _attachCount++;
                                //alert(value.file_id);
                                var _fileTarget=_attachParent.find('.file-box[data-id="'+value.po_attachment_id+'"]');
                                //console.log(_fileTarget);
                                if(_fileTarget.length==0){
                                    //var _lastSiblingAttach=_attachParent.find('.file-box:last');
                                    //$(createAttachmentStructure(value)).insertAfter(_lastSiblingAttach);
                                    _attachParent.append(createAttachmentStructure(value));
                                    //alert("d");
                                }else{
                                    //alert("d");
                                    _fileTarget.replaceWith(createAttachmentStructure(value));
                                }

                            });

                            $('#attach_count').html(_attachCount);



                        }

                    });

                },5000);

            }();



            //functions here
            var postMessage=function(){
                var data=$('#frm_message').serializeArray();

                return $.ajax({
                    "dataType":"json",
                    "type":"POST",
                    "url":"Po_messages/transaction/post-message",
                    "data":data,
                    "beforeSend" : function(){
                        showSpinningProgress($('#btn_post_message'));
                    }
                });
            };


            var showSpinningProgress=function(e){
                $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
            };

            var showNotification=function(obj){
                PNotify.removeAll(); //remove all notifications
                new PNotify({
                    title:  obj.title,
                    text:  obj.msg,
                    type:  obj.stat
                });
            };


            var clearFields=function(){
                $('textarea[name="message"]').val('');
            };


            var createMessageFeedStructure=function(row){
                var _btnTrash=(<?php echo $this->session->user_id; ?>==row.user_id?'<a id="btn_remove_announcement" data-id="'+row.po_message_id+'" class="btn btn-xs btn-white"><i class="fa fa-trash"></i> </a>':'');

                return '<div class="feed-element" data-id="'+row.po_message_id+'">'+
                '<a href="#" class="pull-left">'+
                '<img alt="image" class="img-circle" src="'+row.photo_path+'">'+
                '</a>'+
                '<div class="media-body">'+
                '<div class="pull-right">'+
                '<small class="pull-right text-navy">'+row.time_description+'</small> <br />'+
                _btnTrash+
                '</div>'+
                '<strong>'+row.message_posted_by+'</strong>'+
                '<p>'+row.message+'</p>'+
                '<small class="text-muted">'+row.full_date_description+'</small>'+
                '</div>'
                '</div>';
            };


            var createMessageSpinner=function(pid){
                return '<div class="feed-element" data-id="'+pid+'">'+
                '<br />'+
                '<center><img src="assets/img/loader/ajax-loader-sm.gif"></center> <br />'+
                '</div>';
            };


            var createAttachmentStructure=function(row){
                return '<div class="file-box"  data-id="'+row.po_attachment_id+'">'+
                '<div class="file">'+
                '<a href="'+row.server_file_directory+'"  download>'+
                '<span class="corner"></span>'+
                '<div class="icon">'+
                '<i class="fa fa-file"></i>'+
                '</div>'+
                '<div class="file-name">'+
                row.orig_file_name+
                '<br/>'+
                '<small>Added: '+row.date_added+'</small><br />'+
                '<small>By : '+row.added_by+'</small>'+
                '</div>'+
                '</a>'+
                '</div>'+
                '</div>';


            };


    });

</script>



</body>


</html>