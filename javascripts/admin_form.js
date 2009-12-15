jQuery(function () {
  jQuery("#rounded").click(function(){
    jQuery("#groupon_widget").toggleClass("rounded_on");
    jQuery("#groupon_box").toggleClass("rounded_on");
  })
  jQuery('.colorpick').ColorPicker(
		{
			onChange:function(input, rgb, hex, c, d){
				jQuery(input).val(hex);
				preview(jQuery(input).attr("id"), hex);
			},
			color: jQuery(this).val()
		});
		
		
	jQuery('#grpn_division_select').change(function(e){
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
  var obj = {"#link_color" : ".groupon_widget_text_link",
  "#text_color" : ".groupon_widget_text",
  "#header_footer_color" : "#groupon_widget",
  "#title_color" : "#groupon_widget h1",
  "#get_it_color" : "#groupon_widget #get_it",
  "#price_tag_color" : "#price_tag, #triangle"};
  
  var formToFuncMappings = {"#link_color" : "update_link_color",
  "#text_color" : "update_text_color",
  "#header_footer_color" : "update_widget_background",
  "#title_color" : "update_title",
  "#get_it_color" : "update_get_it_button",
  "#price_tag_color" : "update_price_tag"};
  
  for(var field in formToFuncMappings) {
    this[formToFuncMappings[field]].call(this, jQuery(field).val());
  }
}


function preview(elem, hex) {
  switch (elem){
  case "link_color": update_link_color(hex);
  break;
  case "text_color": update_text_color(hex);
  break;
  case "header_footer_color": update_widget_background(hex);
  break;
  case "title_color": update_title(hex);
  break;
  case "main_bg_color": update_main_bg(hex);
  break;
  case "get_it_color": update_get_it_button(hex);
  break;
  case "price_tag_color": update_price_tag(hex);
  break;
  }
}

function update_link_color(hex){
  jQuery(".groupon_widget_text_link").css("color", "#"+hex);
}

function update_text_color(hex){
  jQuery(".groupon_widget_text").css("color", "#"+hex);
}

function update_widget_background(hex){
  jQuery("#groupon_widget").css("background-color", "#"+hex);
}

function update_title(hex){
  jQuery("#groupon_widget h1").css("color", "#"+hex);
}

function update_main_bg(hex){
  jQuery("#groupon_box").css("background-color", "#"+hex);
  jQuery("#groupon_widget #footer a").css("background-color", "#"+hex);
  tri_bord = get_triangle_border_color();
  jQuery("#triangle").css("border-color", "#"+hex+"#67D6F2"+"#"+hex+"#"+hex);
}

function update_get_it_button(hex){
  jQuery("#groupon_widget #get_it").css("background-color", "#"+hex);
}

function update_price_tag(hex){
  jQuery("#price_tag").css("background-color", "#"+hex);
  jQuery("#triangle").css("border-color", "#FFFFFF"+"#"+hex+"#FFFFFF #FFFFFF");
}

function get_triangle_border_color(){
  
}

function update_rounded(){
  
  jQuery("#groupon_widget").toggleClass("rounded_on");
}