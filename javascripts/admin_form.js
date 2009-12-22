jQuery(function () {
  jQuery("#rounded").click(function(){
    jQuery("#groupon_widget").toggleClass("rounded_on");
    jQuery("#groupon_box").toggleClass("rounded_on");
  })
  jQuery('.colorpick').ColorPicker(
		{
			onChange:function(input, rgb, hex, c, d){
				jQuery(input).val(hex);
				grouponUpdatePreview();
			},
			color: jQuery(this).val()
		});
		
		
	jQuery('#grpn_division_select').change(function(e){
	  if(GRPN.currentWidgetCountdown)
	    GRPN.currentWidgetCountdown.destroy();
	  jQuery.get(GRPN_WP_URL + "/index.php", {"grpn_action": "render_widget", "division" : jQuery(e.target).val()}, function(response){
	    jQuery("#preview-content").html(response);
	    grouponUpdatePreview();
	  })
	});
	grouponUpdatePreview();
});

function formatDateForParse(date){
  date.replace(/-/g, '/').replace(/Z$/, "").split("T").join(" ");
}

function grouponUpdatePreview() {
  
  var formToFuncMappings = {"#link_color" : "grouponUpdateLinkColor",
  "#text_color" : "grouponUpdateTextColor",
  "#header_footer_color" : "grouponUpdateShellColor",
  "#title_color" : "grouponUpdateTitleColor",
  "#get_it_color" : "grouponUpdateGetItBtnColor",
  "#price_tag_color" : "grouponUpdatePriceTagColor"};
  
  for(var field in formToFuncMappings) {
    this[formToFuncMappings[field]].call(this, jQuery(field).val());
  }
}

function grouponUpdateLinkColor(hex){
  jQuery(".groupon_widget_text_link").css("color", "#"+hex);
}

function grouponUpdateTextColor(hex){
  jQuery(".groupon_widget_text").css("color", "#"+hex);
}

function grouponUpdateShellColor(hex){
  jQuery("#groupon_widget").css("background-color", "#"+hex);
}

function grouponUpdateTitleColor(hex){
  jQuery("#groupon_widget h1").css("color", "#"+hex);
}

function grouponUpdateGetItBtnColor(hex){
  jQuery("#groupon_widget #get_it").css("background-color", "#"+hex);
}

function grouponUpdatePriceTagColor(hex){
  jQuery("#price_tag").css("background-color", "#"+hex);
  jQuery("#triangle").css("border-color", "#FFFFFF"+"#"+hex+"#FFFFFF #FFFFFF");
}

function grouponUpdateRounded(){
  jQuery("#groupon_widget").toggleClass("rounded_on");
}