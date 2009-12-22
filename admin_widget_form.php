
<?php $selected_division = get_option("grpn_wdgt_city"); ?>
<div><label>City</label><br />
<select id="grpn_division_select" name="grpn_wdgt_city">
		<option disabled="disabled" selected="selected">-- Select a city --</option>
		<?php foreach(groupon_get_divisions() as $division) : ?>
		  <option <?php if($division->id == $selected_division )  echo 'selected="selected"'; ?> value="<?= $division->id; ?>"><?= $division->name; ?></option>
		<?php endforeach; ?>
	</select></div>
<div><label>Referral Code:</label><br />
<input name="grpn_wdgt_referral_code" type="text" id="referral_input" maxlength="6" value="<?php echo get_option("grpn_wdgt_referral_code"); ?>" /></div>