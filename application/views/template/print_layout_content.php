<style type="text/css">
	body {
	  -webkit-print-color-adjust: exact;
	}
</style>
<div>
    <?php foreach($module_layouts as $module_layout) { ?>
        <?php 
            if($module_layout->tag == 'label') {
                echo "<label class='drag_member' name='".$module_layout->field_name."' style='position:absolute; top: ".$module_layout->pos_top."px;left:".$module_layout->pos_left."px; font-family:".$module_layout->font.";font:".$module_layout->font_color.";font-size:".$module_layout->font_size."px;font-weight:".$module_layout->is_bold.";font-style:".$module_layout->is_italic.";'>".(array_key_exists($module_layout->field_name, (array)$company_info) ? $company_info->{$module_layout->field_name} : "")."</label>";
            } else if($module_layout->tag == 'img') {
                echo "<img class='drag_member' src=".(array_key_exists($module_layout->field_name, (array)$company_info) ? base_url($company_info->{$module_layout->field_name}) : "")." style='position:absolute; top:".$module_layout->pos_top."px; left:".$module_layout->pos_left."px; height: ".$module_layout->height."px; width: ".$module_layout->width."px;'>";
            }
        ?>
    <?php } ?>
</div>