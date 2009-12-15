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
    			<td><span>#</span><input name="theme[link_color]" class="colorpick" type="text" id="link_color" maxlength="6" value="0981b3"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="text_color">Text color</label></th>
    			<td><span>#</span><input name="theme[color]" class="colorpick" type="text" id="text_color" maxlength="6" value="000000"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="header_footer_color">Header/Footer background color</label></th>
    			<td><span>#</span><input name="theme[shell_background]" class="colorpick" type="text" id="header_footer_color" maxlength="6" value="7fb93c"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="title_color">Title color</label></th>
    			<td><span>#</span><input name="theme[header_color]" class="colorpick" type="text" id="title_color" maxlength="6" value="ffffff"/></td>
    		</tr>
    		<tr>
    			<th><label for="main_bg_color">Main background color</label></th>
    			<td><span>#</span><input name="theme[deal_background]" class="colorpick" type="text" id="main_bg_color" maxlength="6" value="ffffff"/></td>
    		</tr>
    		<tr valign="top">
    			<th><label for="get_it_color">"GET IT!" button color</label></th>
    			<td><span>#</span><input name="theme[get_it_btn_background]" class="colorpick" type="text" id="get_it_color" maxlength="6" value="7fb93c"/></td>
    		</tr>
		
    		<tr valign="top">
    			<th><label for="price_tag_color">Price tag color</label></th>
    			<td><span>#</span><input name="theme[price_tag_btn_background]" class="colorpick" type="text" id="price_tag_color" maxlength="6" value="67d6f2"/></td>
    		</tr>
		
    		<tr>
    			<th><label for="link-color">Rounded Corners?</label></th>
    			<td><input name="theme[rounded]" type="checkbox" id="rounded" checked="checked"/></td>
    		</tr>
			
    		<tr valign="top">
    			<td><h2>City Selector</h2></td>
    		</tr>
    		<tr valign="top">
    		  <th><label for="link-color">daily deal for</label></th>
    			<td><select id="grpn_division_select" name="city">
    					<option disabled="disabled" selected="selected">-- Select a city --</option>
    					<?php foreach(groupon_get_divisions() as $division) : ?>
    					  <option value="<?= $division->id; ?>"><?= $division->name; ?></option>
    					<?php endforeach; ?>
    				</select>
    				</td>
    		</tr>
    		<tr valign="top">
    			<td><h2>Referral Code</h2></td>
    		</tr>
		
    		<tr valign="top">
    			<th><label for="get_it_color">http://www.groupon.com/r/&nbsp;</label></th>
    			<td><input name="referral_code" type="text" id="referral_input" maxlength="6"/>
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
				<?php groupon_render_widget("dallas"); ?>
				    
			</div>
			<div id="preview-bottom"></div>
    </div>
  </div>
  <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </p>
</form>
</div>