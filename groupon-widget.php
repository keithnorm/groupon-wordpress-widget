<?php
/*
Plugin Name: Groupon Widget
Plugin URI: http://grouponwidget.com
Description: Groupon Widget
Version: 1.0
Author: Matt Loseke, Steven Walker, Keith Norman
Author URI: http:://grouponwidget.com/about
*/

//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************
define(GROUPON_API_PATH, "http://groupon.com/api/v1/");
require_once("groupon.widget.class.php");

echo strftime("%c %I", time());

function groupon_widget_init() {
	register_widget('GrouponWidget');
}

function groupon_time_left($expires){
  $difference = (strtotime($expires) - time());
  $periods = array("days", "hours", "minutes", "seconds");
  $lengths = array("86400","3600","60","1");
  $time_array = array();
  for($j = 0; $j < count($lengths); $j++) {
    if($difference >= $lengths[$j]){
      $time_array[$periods[$j]] = round($difference / $lengths[$j]);
      $difference = ($difference % $lengths[$j]);
    }
    else{
      $time_array[$periods[$j]] = 0;
    }
  }
  return $time_array;
}

function groupon_widget_menu() {
  $page = add_options_page('Groupon Widget Options', 'Groupon Widget', 'administrator', 'groupon-widget', 'groupon_widget_options');
  add_action('admin_print_styles-' . $page, 'groupon_widget_head_admin');
}

function register_groupon_widget_settings() {
  register_setting('groupon-widget', 'grpn_widget_header_bg_color');
}

function groupon_widget_head_admin() {
	$groupon_widget_admin_stylesheet = WP_PLUGIN_URL . '/groupon-widget/admin_style.css';
	$groupon_widget_stylesheet = WP_PLUGIN_URL . '/groupon-widget/widget.css';
  wp_register_style('groupon_widget_admin_styles', $groupon_widget_admin_stylesheet, array(), "1.0");
  wp_register_style('groupon_widget_styles', $groupon_widget_stylesheet, array(), "1.0");
  wp_enqueue_style('groupon_widget_admin_styles');
  wp_enqueue_style('groupon_widget_styles');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-colorpicker', WP_PLUGIN_URL . '/groupon-widget/javascripts/colorpicker.js');
  wp_enqueue_script('groupon_widget_form', WP_PLUGIN_URL . '/groupon-widget/javascripts/admin_form.js');
}

function groupon_widget_options() {
  include("admin_form.php");
}

function groupon_render_widget($city){
  $deal = groupon_get_deal_for($city);
  $time_left = groupon_time_left($deal->end_date);
  include("widget.php");
}

function groupon_get_deal_for($city){
  $response = json_decode(groupon_do_request(GROUPON_API_PATH . $city . "/deals.json"));
  return $response->deals[0];
}

function groupon_get_divisions() {
  $response = json_decode(groupon_do_request(GROUPON_API_PATH . "divisions.json"));
  echo GROUPON_API_PATH . "divisions.json";
  return $response->divisions;
}

function groupon_do_request($url){
  $c = curl_init();
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($c, CURLOPT_URL, $url);
  curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1); 
  $contents = curl_exec($c);
  curl_close($c);
  if ($contents) return  $contents;
    else return false;
}


function groupon_format_price($price){
  $price = str_replace("USD", "", $price);
  $price = str_replace(".00", "", $price);
  $price = "$" . $price;
  return $price;
}

function groupon_request_handler() {
	global $wpdb;
	if (!empty($_GET['grpn_action'])) {
		switch($_GET['grpn_action']) {
			case 'render_widget':
				groupon_render_widget($_GET['division']);
				die();
				break;
		}
	}
}


function groupon_load_js_vars() {
  echo "<script type='text/javascript'>";
  echo "GRPN_WP_URL = '" . get_bloginfo('wpurl') . "'";
  echo "</script>";
  
}

add_action('admin_menu', 'groupon_widget_menu');
add_action('admin_init', 'register_groupon_widget_settings' );
add_action('widgets_init', 'groupon_widget_init');
add_action('wp_print_styles', array('GrouponWidget', 'loadStylesheet'));
add_action('wp_print_scripts', 'groupon_load_js_vars');
add_action('init', 'groupon_request_handler', 10);

?>