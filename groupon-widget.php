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

add_option("grpn_wdgt_link_color", "0981b3");
add_option("grpn_wdgt_text_color", "000000");
add_option("grpn_wdgt_shell_background", "7fb93c");
add_option("grpn_wdgt_title_color", "ffffff");
add_option("grpn_wdgt_get_it_btn_background", "7fb93c");
add_option("grpn_wdgt_price_tag_background", "67d6f2");
add_option("grpn_wdgt_width", "296");
add_option("grpn_wdgt_rounded", "1");
add_option("grpn_wdgt_city", "chicago");
add_option("grpn_wdgt_referral_code", "");

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
  $theme_query_string = http_parse_query(groupon_build_theme_array());
	$groupon_widget_admin_stylesheet = WP_PLUGIN_URL . '/groupon-widget/admin_style.css';
	$groupon_widget_stylesheet = WP_PLUGIN_URL . '/groupon-widget/widget.css.php?' . $theme_query_string;
  wp_register_style('groupon_widget_admin_styles', $groupon_widget_admin_stylesheet, array(), "1.0");
  wp_register_style('groupon_widget_styles', $groupon_widget_stylesheet, array(), "1.0");
  wp_enqueue_style('groupon_widget_admin_styles');
  wp_enqueue_style('groupon_widget_styles');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-colorpicker', WP_PLUGIN_URL . '/groupon-widget/javascripts/colorpicker.js');
  wp_enqueue_script('groupon_widget_form', WP_PLUGIN_URL . '/groupon-widget/javascripts/admin_form.js');
  wp_enqueue_script('groupon_widget', WP_PLUGIN_URL . '/groupon-widget/javascripts/widget.js');
}

function groupon_widget_options() {
  include("admin_form.php");
}

function groupon_settings_process() {
  register_setting("groupon-widget", "grpn_wdgt_link_color");
  register_setting("groupon-widget", "grpn_wdgt_text_color");
  register_setting("groupon-widget", "grpn_wdgt_shell_background");
  register_setting("groupon-widget", "grpn_wdgt_title_color");
  register_setting("groupon-widget", "grpn_wdgt_get_it_btn_background");
  register_setting("groupon-widget", "grpn_wdgt_price_tag_background");
  register_setting("groupon-widget", "grpn_wdgt_width");
  register_setting("groupon-widget", "grpn_wdgt_rounded");
  register_setting("groupon-widget", "grpn_wdgt_city");
  register_setting("groupon-widget", "grpn_wdgt_referral_code"); 
}

function groupon_render_widget($params){
  $deal = groupon_get_deal_for($params);
  $time_left = groupon_time_left($deal->end_date);
  include("widget.php");
}

function groupon_get_deal_for($params){
  if(isset($params['city']) && $params['city'] != 'Auto-detect') {
    $url = GROUPON_API_PATH . $params['city'] . "/deals.json";
  }
  else{
    $geo = groupon_widget_get_geo_from_ip();
    $url = GROUPON_API_PATH . "/deals.json?lat={$geo['lat']}&lng={$geo['lng']}";
  }
  $response = json_decode(groupon_do_request($url));
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
				groupon_render_widget(array("city" => $_GET['division']));
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

function groupon_build_theme_array() {
  $opts = array();
  foreach(groupon_theme_options() as $option){
    $opts[$option] = get_option($option);
  }
  return $opts;
}

function groupon_theme_options() {
  return array("grpn_wdgt_link_color", "grpn_wdgt_text_color", "grpn_wdgt_shell_background", "grpn_wdgt_title_color",
              "grpn_wdgt_get_it_btn_background", "grpn_wdgt_price_tag_background", "grpn_wdgt_width",
              "grpn_wdgt_rounded", "grpn_wdgt_city", "grpn_wdgt_referral_code");
}

function http_parse_query( $array = NULL, $convention = '%s' ){  
  if( count( $array ) == 0 ) {
    return '';
  } 
  else {
    if(function_exists( 'http_build_query' )) {
      $query = http_build_query( $array );
    } 
    else {
      $query = '';
      foreach( $array as $key => $value ){
        if( is_array( $value ) ){
          $new_convention = sprintf( $convention, $key ) . '[%s]';
          $query .= http_parse_query( $value, $new_convention );
        } 
        else {
          $key = urlencode( $key );
          $value = urlencode( $value );      
          $query .= sprintf( $convention, $key ) . "=$value&";                        
        }
      }   
    }
  return $query;       
  }       
}

function groupon_widget_get_geo_from_ip() {
  $query = 'select Latitude,Longitude from ip.location where ip = "' . groupon_widget_get_visitor_ip() . '"';
  $yqlGeo = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query) . '&format=json&env=' . urlencode('store://datatables.org/alltableswithkeys');
  $json = json_decode(file_get_contents($yqlGeo));
  $geo = $json->query->results->Response;
  $latlng = array("lat" => $geo->Latitude, "lng" => $geo->Longitude);
  return $latlng;
}

function groupon_widget_get_visitor_ip() { 
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $theIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else 
    $theIp=$_SERVER['REMOTE_ADDR'];
  return trim($theIp);
}

add_action('admin_menu', 'groupon_widget_menu');
add_action('admin_init', 'register_groupon_widget_settings' );
add_action('widgets_init', 'groupon_widget_init');
add_action('wp_print_styles', array('GrouponWidget', 'loadStylesheet'));
add_action('wp_print_scripts', 'groupon_load_js_vars');
add_action('init', 'groupon_request_handler', 10);
add_action('admin_init', 'groupon_settings_process');
?>