<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-cdjp-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>
    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">

    <style>
        .drag_member{
            cursor: pointer;
        }

        .bg-change {
            border: 3px dashed #2196f3!important;
        }

        .unselectable {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            cursor: default;
        }

        .drag_member {
            cursor: all-scroll;
        }
    </style>
</head>

<body>

<div class="row" style="bottom: 0; width: 100%; position: fixed; background: #404040; border-top: 3px solid #2196f3;">
    <div class="container-fluid" style="padding: 10px;">
        <div class="col-xs-12 col-sm-2" style="width: 10.33%">
            <label style="color:white; margin-top: 5px;"><strong>Select Control :</strong></label>
        </div>
        <div class="col-xs-12 col-sm-5">
            <select class="form-control" id="cbo_controls">
                <option value="<label class='drag_member' data-parent='header' style='position:absolute; top: 10px; left:-60px;'>Enter Text Here</label>">Label</option>
                <option value="<img class='drag_member' data-parent='header' style='height: 100px; width: 100px; position:absolute;'/>">Image</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-2">
            <button id="btn_add" class="btn btn-primary btn-block">Add Control</button>
        </div>
        <div class="col-xs-12 col-sm-2" style="margin-left: -20px;">
            <button id="btn_save" class="btn btn-success btn-block">Save Print Layout</button>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <br />
            <center>
            <div id="div_area_scale" style="position: relative;padding: 0%; width: 100%;">
                <table border="1" style="position: absolute;left: 0in;top: 0in;z-index: -10000;border-collapse: collapse;">
                    <?php if($layouts->is_portrait==1){$row=11;$col=8;}else{$row=8;$col=11;} ?>

                    <?php for($x=1;$x<=$row;$x++){ ?>
                        <tr>
                            <?php for($i=1;$i<=$col;$i++){ ?>
                                <td style="border:1px solid #e2e2e2;height: 1in;width: 1in;background-color: white;"></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>

                <div class="header" name="report_header" style='height: 290px; width: 770px; position:absolute; border: 1px solid #c0c0c0; border-bottom-width: 5px;border-top-width: 5px; padding-top: 8%;'><h1 class="unselectable" style='color:#e2e2e2; z-index: -9999999999;'>Report Header</h1>
                    <?php 
                        foreach($module_layouts as $module_layout) 
                        {
                            if ($module_layout->parent == 'header') 
                            { 
                                if($module_layout->tag == 'label') {
                                    echo "<label class='drag_member' data-parent='".$module_layout->parent."' name='".$module_layout->field_name."' style='position:absolute; top: ".$module_layout->pos_top."px;left:".$module_layout->pos_left."px; font-family:".$module_layout->font.";font:".$module_layout->font_color.";font-size:".$module_layout->font_size."px;font-weight:".$module_layout->is_bold.";font-style:".$module_layout->is_italic.";'>".$module_layout->display_text."</label>";
                                } else if($module_layout->tag == 'img') {
                                    echo "<img class='drag_member' data-parent='".$module_layout->parent."' style='position:absolute; top:".$module_layout->pos_top."px; left:".$module_layout->pos_left."px; height: ".$module_layout->height."px; width: ".$module_layout->width."px;'>";
                                }
                            }
                        }
                    ?>
                </div>
                <div class="body" name="report_body"  style='height: 290px; width: 770px; position:absolute; border: 1px solid #c0c0c0; border-bottom-width: 5px;border-top-width: 5px; padding-top: 8%; top: 290px;'><h1 class="unselectable" style='color:#e2e2e2; z-index: -9999999999;'>Report Body</h1>
                    <?php 
                        foreach($module_layouts as $module_layout) 
                        {
                            if ($module_layout->parent == 'body') 
                            {   
                                if($module_layout->tag == 'label') 
                                {
                                    echo "<label class='drag_member' data-parent='".$module_layout->parent."' name='".$module_layout->field_name."' style='position:absolute; top: ".$module_layout->pos_top."px;left:".$module_layout->pos_left."px; font-family:".$module_layout->font.";font:".$module_layout->font_color.";font-size:".$module_layout->font_size."px;font-weight:".$module_layout->is_bold.";font-style:".$module_layout->is_italic.";'>".$module_layout->display_text."</label>";
                                } 
                                else if($module_layout->tag == 'img') 
                                {
                                    echo "<img class='drag_member' data-parent='".$module_layout->parent."' style='position:absolute; top:".$module_layout->pos_top."px; left:".$module_layout->pos_left."px; height: ".$module_layout->height."px; width: ".$module_layout->width."px;'>";
                                }
                            }
                        }
                    ?>
                </div>
            </div> <br />
        </div>
    </div>
        <br />
    </div>
    </div>
</body>

<!-- Modal -->
<div id="modal_image" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 22%;">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Image Property</h4>
      </div>
      <div class="modal-body">
        <form id="frm_check_layout">
            <div class="row">
                <div class="col-lg-12">
                    Field Name (Column name) : <br />
                    <input type="text" id="txt_field_name_img" name="field_name" class="form-control">
                </div>
                <div class="col-lg-12">
                    Height : <br />
                    <input type="text" id="txt_height" name="height" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    Width : <br />
                    <input type="text" id="txt_width" name="width" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btn_apply_img" type="button" class="btn btn-primary" data-dismiss="modal">Apply Changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modal_confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 22%;">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this?</p>
      </div>
      <div class="modal-footer">
        <button id="btn_yes" type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>

<div id="modal_new_layout" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog" style="width: 22%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="modal_title">Field Property</span></h4>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                <form id="frm_check_layout">
                    <div class="row">
                        <div class="col-lg-12">
                            Display Text : <br />
                            <input type="text" id="txt_display" name="display_text" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            Field Name (Column name) : <br />
                            <input type="text" id="txt_field_name" name="field_name" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            Font Size : <br />
                            <input type="text" id="txt_font_size" name="font_size" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            Font Family : <br />
                            <input type="text" id="txt_font_family" name="font_family" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12"><br />
                            <label class="radio-inline"><input type="checkbox" name="is_bold" id="is_bold" value="1"> Bold</label>
                            <label class="radio-inline"><input type="checkbox" name="is_italic" id="is_italic" value="1"> Italic</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_apply_changes" type="button" class="btn btn-primary"  style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;"><span class=""></span> Apply Property</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;">Cancel</button>
            </div>

        </div><!---content-->
    </div>
</div><!---modal-->

<?php echo $_def_js_files; ?>

<script>

    $(document).ready(function(){
        var _activeObject;

        $('img.drag_member,label.drag_member').on('contextmenu',function(e){
            _activeObject = $(this);
            $('#modal_confirmation').modal('show');
            e.preventDefault();
        });

        $('.drag_member').draggable({
            start: function (e, ui) {
                $(ui.helper).css('border', '1px solid #2196f3'); //change css 
                _activeObject = $(this);
            },
            stop: function(event, ui) {
                //var pos = ui.helper.position(); // just get pos.top and pos.left
                $(ui.helper).css('border', 'none');
            }
        });

        $('.header').droppable({
            hoverClass: 'bg-change',
            drop:function(event,ui){
                ui.draggable.data('parent','header');
            }
        });

        $('.body').droppable({
            hoverClass: 'bg-change',
            drop:function(event,ui){
                ui.draggable.data('parent','body');
            }
        });

        $('#btn_yes').on('click',function(){
            _activeObject.remove();
        });

        $('.drag_member').on('dblclick',function(){
            _activeObject=$(this);

            //load current property
            $('#txt_field_name').val( _activeObject.attr('name',));
            $('#txt_font_size').val( _activeObject.css('font-size'));
            $('#txt_font_family').val(_activeObject.css('font-family'));
            $('#txt_display').val( _activeObject.html());

            $('#txt_height').val(_activeObject.css('height'));
            $('#txt_width').val(_activeObject.css('width'));
            $('#is_bold').prop('checked',(_activeObject.css('font-weight')=="bold"));
            $('#is_italic').prop('checked',(_activeObject.css('font-style')=="italic"));

            $('#modal_title').html($(this).data('description'));

            if ($(this).is('img'))
                $('#modal_image').modal('show');
            else
                $('#modal_new_layout').modal('show');
        });

        $('#btn_add').click(function(){
            $('#div_area_scale').append(
                '' + $('#cbo_controls').val() + ''
            );

            $('.drag_member').draggable({
                start: function (e, ui) {
                    $(ui.helper).css('border', '1px solid #2196f3'); //change css 
                    _activeObject = $(this);
                },
                stop: function(event, ui) {
                    //var pos = ui.helper.position(); // just get pos.top and pos.left
                    $(ui.helper).css('border', 'none');
                }
            });

            $('.drag_member').on('dblclick',function(){
                _activeObject=$(this);

                //load current property
                $('#txt_field_name').val( _activeObject.attr('name',));
                $('#txt_font_size').val( _activeObject.css('font-size'));
                $('#txt_font_family').val( _activeObject.css('font-family'));
                $('#txt_display').val( _activeObject.html());
                $('#txt_height').val(_activeObject.css('height'));
                $('#txt_width').val(_activeObject.css('width'));

                $('#is_bold').prop('checked',( _activeObject.css('font-weight')=="bold"));
                $('#is_italic').prop('checked',( _activeObject.css('font-style')=="italic"));

                $('#modal_title').html($(this).data('description'));
                
                if ($(this).is('img'))
                    $('#modal_image').modal('show');
                else
                    $('#modal_new_layout').modal('show');
            });

            $('img.drag_member,label.drag_member').on('contextmenu',function(e){
                _activeObject = $(this);
                $('#modal_confirmation').modal('show');
                e.preventDefault();
            });

            $('.header').droppable({
                hoverClass: 'bg-change',
                drop:function(event,ui){
                    ui.draggable.data('parent','header');
                }
            });

            $('.body').droppable({
                hoverClass: 'bg-change',
                drop:function(event,ui){
                    ui.draggable.data('parent','body');
                }
            });
        });

        $('#btn_apply_img').click(function(){
            if($('#txt_field_name_img').val()!=""){
                _activeObject.attr('name',$('#txt_field_name_img').val()+'');
            }

            if($('#txt_font_family').val()!=""){
                _activeObject.css('font-family',$('#txt_font_family').val()+'');
            }

            if($('#txt_height').val()!=""){
                _activeObject.css('height',$('#txt_height').val()+'');
            }

            if($('#txt_width').val()!=""){
                _activeObject.css('width',$('#txt_width').val()+'');
            }

            $('#modal_image').modal('hide');
        });

        $('#btn_apply_changes').click(function(){
            if($('#txt_font_size').val()!=""){
                _activeObject.css('font-size',$('#txt_font_size').val()+'');
            }

            if($('#txt_field_name').val()!=""){
                _activeObject.attr('name',$('#txt_field_name').val()+'');
            }

            if($('#txt_display').val()!=""){
                _activeObject.html($('#txt_display').val());
            }

            if($('#txt_font_family').val()!=""){
                _activeObject.css('font-family',$('#txt_font_family').val()+'');
            }

            if($('#is_bold:checked').val()!=undefined){
                _activeObject.css('font-weight','bold');
            }else{
                _activeObject.css('font-weight','normal');
            }

            if($('#is_italic:checked').val()!=undefined){
                _activeObject.css('font-style','italic');
            }else{
                _activeObject.css('font-style','normal');
            }

            $('#modal_new_layout').modal('hide');
        });

        $('#btn_save').click(function(){
            saveScalePositions().done(function(response){
                showNotification(response);
            });
        });

        var showNotification=function(obj){
            PNotify.removeAll(); //remove all notifications
            new PNotify({
                title:  obj.title,
                text:  obj.msg,
                type:  obj.stat
            });
        };

        var saveScalePositions=function(){
            var _data=[];

            _data.push({name:'layout_id',value:<?php echo json_encode($this->input->get('id',TRUE)); ?>});
            _data.push({name:'type',value:"scale-only"});

            $.each($('label.drag_member'),function(i,value){
                _data.push({name:'display_text[]',value:$(this).html()});
                _data.push({name:'field_name[]',value:$(this).attr('name')});
                _data.push({name:'pos_top[]',value:$(this).css('top')});
                _data.push({name:'pos_bottom[]',value:$(this).css('bottom')});
                _data.push({name:'pos_left[]',value:$(this).css('left')});
                _data.push({name:'pos_right[]',value:$(this).css('right')});
                _data.push({name:'font[]',value:$(this).css('font-family')});
                _data.push({name:'font-color[]',value:$(this).css('color')});
                _data.push({name:'font-size[]',value:$(this).css('font-size')});
                _data.push({name:'is_bold[]',value:$(this).css('font-weight')});
                _data.push({name:'is_italic[]',value:$(this).css('font-style')});
                _data.push({name:'height[]',value:''});
                _data.push({name:'width[]',value:''});
                _data.push({name:'tag[]',value:'label'});
                _data.push({name:'parent[]',value:$(this).data('parent')});
            });

            $.each($('img.drag_member'),function(i,value){
                _data.push({name:'display_text[]',value:''});
                _data.push({name:'field_name[]',value:$(this).attr('name')});
                _data.push({name:'pos_top[]',value:$(this).css('top')});
                _data.push({name:'pos_bottom[]',value:$(this).css('bottom')});
                _data.push({name:'pos_left[]',value:$(this).css('left')});
                _data.push({name:'pos_right[]',value:$(this).css('right')});
                _data.push({name:'font[]',value:''});
                _data.push({name:'font-color[]',value:''});
                _data.push({name:'font-size[]',value:''});
                _data.push({name:'is_bold[]',value:''});
                _data.push({name:'is_italic[]',value:''});
                _data.push({name:'height[]',value:$(this).css('height')});
                _data.push({name:'width[]',value:$(this).css('width')});
                _data.push({name:'tag[]',value:'img'});
                _data.push({name:'parent[]',value:$(this).data('parent')});
            });

            return $.ajax({
                "dataType":"json",
                "type":"POST",
                "url":"Print_layout/transaction/update",
                "data":_data
            });
        };




    });




</script>
</html>