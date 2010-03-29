<div class="wrap">
<h2>Edit Groupon Widget Options</h2>

<form method="post" action="options.php">
  <?php settings_fields('groupon-widget'); ?>
  <div class="clearfix" id="grpn_widget_form_wrap">
    <div id="grpn_widget_form">
      <table class="form-table">
        <tr>
          <td><h2>Appearance</h2></td>
        </tr>
        <tr valign="top">
    			<th><label for="link_color">Link color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_link_color" class="colorpick" type="text" id="link_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_link_color"); ?>"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="text_color">Text color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_text_color" class="colorpick" type="text" id="text_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_text_color"); ?>"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="header_footer_color">Header/Footer background color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_shell_background" class="colorpick" type="text" id="header_footer_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_shell_background"); ?>"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="title_color">Title color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_title_color" class="colorpick" type="text" id="title_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_title_color"); ?>"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="get_it_color">"GET IT!" button color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_get_it_btn_background" class="colorpick" type="text" id="get_it_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_get_it_btn_background"); ?>"/></td>
    		</tr>
		
    		<tr valign="top">
    			<th><label for="price_tag_color">Price tag color</label></th>
    			<td><span>#</span><input name="grpn_wdgt_price_tag_background" class="colorpick" type="text" id="price_tag_color" maxlength="6" value="<?php echo get_option("grpn_wdgt_price_tag_background"); ?>"/></td>
    		</tr>
    		
    		<tr valign="top">
    			<th><label for="width">Width</label></th>
    			<td><input name="grpn_wdgt_width" type="text" id="width" maxlength="6" value="<?php echo get_option("grpn_wdgt_width"); ?>"/><span>px</span></td>
    		</tr>
		
    		<tr>
    			<th><label for="link-color">Rounded Corners?</label></th>
    			<td><input name="grpn_wdgt_rounded" type="checkbox" id="rounded" <?php if(get_option("grpn_wdgt_rounded") == "on") echo 'checked="checked"'; ?>/></td>
    		</tr>
			
    		<tr valign="top">
    			<td><h2>City Selector</h2></td>
    		</tr>
    		<tr valign="top">
    		  <th><label for="link-color">daily deal for</label></th>
    		  <?php $selected_division = get_option("grpn_wdgt_city"); ?>
    			<td><select id="grpn_division_select" name="grpn_wdgt_city">
    					<option selected="selected">Auto-detect</option>
    					<?php foreach(groupon_get_divisions() as $division) : ?>
    					  <option <?php if($division->id == $selected_division )  echo 'selected="selected"'; ?> value="<?= $division->id; ?>"><?= $division->name; ?></option>
    					<?php endforeach; ?>
    				</select>
    				</td>
    		</tr>
    		<tr valign="top">
    			<td><h2>Referral Code</h2></td>
    		</tr>
		
    		<tr valign="top">
    			<th><label for="get_it_color">http://www.groupon.com/r/&nbsp;</label></th>
    			<td><input name="grpn_wdgt_referral_code" type="text" id="referral_input" maxlength="6" value="<?php echo get_option("grpn_wdgt_referral_code"); ?>"/>
    			  <div id="refer-link-directions">
      				<p>By entering your Groupon referral code you receive $10 every time someone makes their first purchase from your widget. The funds are automatically put in your Groupon account, so why not! Right?</p>
      				<p class="center"><a href="http://www.groupon.com/referral" title="Groupon Referral">Get my referral code!</a></p>
      			</div>
    			</td>
    		</tr>
      </table>
    </div>
    
    <div id="grpn_widget_preview">
      <div id="preview-top"></div>
			<div id="preview-content">
				<?php groupon_render_widget(array("city" => $selected_division)); ?>
				    
			</div>
			<div id="preview-bottom"></div>
    </div>
  </div>
  <p class="submit">
    <input type="submit" name="settings_update" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </p>
</form>
</div>