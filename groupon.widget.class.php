<?php
  class GrouponWidget extends WP_Widget {
  	function GrouponWidget() {
  		$widget_ops = array('classname' => 'groupon_widget', 'description' => 'Daily Deals from Groupon' );
  		$this->WP_Widget('groupon_widget', 'Groupon Widget', $widget_ops);
  	}
 
  	function widget($args, $instance) {
  		extract($args, EXTR_SKIP);
      
  		echo $before_widget;
  		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
  		$entry_title = empty($instance['entry_title']) ? '&nbsp;' : apply_filters('widget_entry_title', $instance['entry_title']);
  		$comments_title = empty($instance['comments_title']) ? '&nbsp;' : apply_filters('widget_comments_title', $instance['comments_title']);
 
  		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
  		groupon_render_widget(get_option("grpn_wdgt_city"));
  		echo $after_widget;
  	}
 
  	function update($new_instance, $old_instance) {
      update_option("grpn_wdgt_city", $_POST["grpn_wdgt_city"]);
      update_option("grpn_wdgt_referral_code", $_POST["grpn_wdgt_referral_code"]);
  	}
 
  	function form($instance) {
  		include("admin_widget_form.php");
  	}
  	
  	function loadStylesheet() {
  	  $theme_query_string = http_parse_query(groupon_build_theme_array());
    	$groupon_widget_stylesheet = WP_PLUGIN_URL . '/groupon-widget/widget.css.php?' . $theme_query_string;
      wp_register_style('groupon_widget_styles', $groupon_widget_stylesheet, array(), "1.0");
      wp_enqueue_style('groupon_widget_styles');
      wp_enqueue_script('groupon_widget', WP_PLUGIN_URL . '/groupon-widget/javascripts/widget.js');
  	}
  }
?>