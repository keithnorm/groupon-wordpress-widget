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
  		groupon_render_widget('dallas');
  		echo $after_widget;
  	}
 
  	function update($new_instance, $old_instance) {
  		echo 'update';
  	}
 
  	function form($instance) {
  		echo 'form';
  	}
  	
  	function loadStylesheet() {
  	  $groupon_widget_stylesheet = WP_PLUGIN_URL . '/groupon-widget/widget.css';
      wp_register_style('groupon_widget_styles', $groupon_widget_stylesheet, array(), "1.0");
      wp_enqueue_style('groupon_widget_styles');
  	}
  }
?>