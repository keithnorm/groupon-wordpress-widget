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
    			<td><select name="city">
    					<option disabled="disabled" selected="selected">-- Select a city --</option>
    					<option value="austin">Austin</option>
    					<option value="baltimore">Baltimore</option>
    					<option value="boston">Boston</option>
    					<option value="charlotte">Charlotte</option>
    					<option value="chicago">Chicago</option>

    					<option value="dallas">Dallas</option>
    					<option value="denver">Denver</option>
    					<option value="houston">Houston</option>
    					<option value="los-angeles">Los Angeles</option>

    					<option value="miami">Miami</option>
    					<option value="minneapolis-stpaul">Minneapolis / St Paul</option>
    					<option value="nashville">Nashville</option>
    					<option value="new-york">New York</option>
    					<option value="philadelphia">Philadelphia</option>
    					<option value="phoenix">Phoenix</option>

    					<option value="portland">Portland</option>
    					<option value="san-diego">San Diego</option>
    					<option value="san-francisco">San Francisco</option>
    					<option value="seattle">Seattle</option>
    					<option value="stlouis">St Louis</option>
    					<option value="tampa">Tampa</option>
    					<option value="washington-dc">Washington DC</option>
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
    <?php $deal = groupon_get_deal_for('chicago'); ?>
    <?php print_r($deal); ?>
    <?php $time_left = groupon_time_left($deal->end_date);?>
    <div id="grpn_widget_preview">
      <div id="preview-top"></div>
			<div id="preview-content">
				<div id="groupon_widget" class="rounded_on">
				    <h1>Daily Deal in <span><?= $deal->division_name; ?></span></h1>
				    <div id="groupon_box" class="rounded_on">
				      <h2><a href="" class="groupon_widget_text_link"><?= $deal->title; ?></a></h2>
				      <div id="left">
				        <div id="price_tag_wrap">
				          <div id="triangle">
				          	<div id="hole"><img src="<?php echo WP_PLUGIN_URL; ?>/groupon-widget/images/hole.png"/></div>
				          </div>
				          <div id="price_tag"><?= groupon_format_price($deal->price); ?></div>
				        </div>
				        <table id="breakdown">
				          <tr>
				            <th class="groupon_widget_text">value</th>
				            <th class="groupon_widget_text">discount</th>
				            <th class="groupon_widget_text">save</th>
				          </tr>
				          <tr>
				            <td class="groupon_widget_text bold"><?= groupon_format_price($deal->value); ?></td>
				            <td class="groupon_widget_text bold"><?= $deal->discount_percent; ?>%</td>
				            <td class="groupon_widget_text bold"><?= groupon_format_price($deal->discount_amount); ?></td>
				          </tr>
				        </table>
				        <table id="number_bought" class="bold">
				          <tr>
				            <td class="groupon_widget_text" id="number"><?= $deal->quantity_sold; ?></td>
				          </tr>
				          <tr>
				            <td class="groupon_widget_text">bought</td>
				          </tr>
				        </table>
				        <table id="time_left_label" style="display:none;">
				          <tr colspan="4">
				            <td class="groupon_widget_text">time left to buy</td>
				          </tr>
				        </table>
				        <table id="time_left" class="bold">
				          <tr>
				            <td class="groupon_widget_text number"><?= $time_left["days"]; ?></td>
				            <td class="groupon_widget_text number"><?= $time_left["hours"]; ?></td>
				            <td class="groupon_widget_text number"><?= $time_left["minutes"]; ?></td>
				            <td class="groupon_widget_text number"><?= $time_left["seconds"]; ?></td>
				          </tr>
				          <tr>
				            <td class="groupon_widget_text label">D</td>
				            <td class="groupon_widget_text label">H</td>
				            <td class="groupon_widget_text label">M</td>
				            <td class="groupon_widget_text label">S</td>
				          </tr>
				        </table>
				      </div>

				      <div id="right">
				        <p id="deal_image">
				          <a href="<?= $deal->deal_url; ?>">
				          <img src="<?= $deal->large_image_url; ?>" alt="<?= $deal->title; ?>"/>
				          </a>
				        </p>
				          
				        <div id="get_it" class="get_it_rounded">
				          <a href="">GET IT!</a>
				        </div>
				      </div>
				    </div>
           </form>
				    <div id="grpn_wdgt_footer">
				      <a class="rounded_on groupon_widget_text_link" href="">Get this widget, get money!</a>
				    </div>

				  </div>
			</div>
			<div id="preview-bottom"></div>
    </div>
  </div>
  <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </p>
</form>
</div>